<?php
if(isset($_POST['del_ticket'])){
  $id=MysqlQuery::RequestPost('del_ticket');
  $iid= $_SESSION['id'];
  if(MysqlQuery::Eliminar("ticket", "serie='$id'")){
    MysqlQuery::ProcedimientoAlmacenado("registro_alteracionesCliente","$iid,'Eliminar','".date("Y-m-d H:i:s") ."','cliente'");
      
    echo '
        <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="text-center">TICKET ELIMINADO</h4>
            <p class="text-center">
                El ticket fue eliminado con exito
            </p>
        </div>
    ';
  }else{
    echo '
        <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="text-center">OCURRIÓ UN ERROR</h4>
            <p class="text-center">
                Lo sentimos, no hemos podido eliminar el ticket
            </p>
        </div>
    ';
  }
}

$estatus = "";
$email_consul=  MysqlQuery::RequestGet('email_consul');
$id_colsul= MysqlQuery::RequestGet('id_consul');
$consulta_tablaTicket = Mysql::consulta("SELECT t.fecha,t.serie, e.Nombre as estado_ticket, c.nombre_completo, c.email_cliente, d.nombre as departamento, t.asunto, t.solucion, t.mensaje FROM ticket t LEFT JOIN cliente c ON t.idUsuario= c.id_cliente INNER JOIN estatus e ON e.idEstatus = t.idStatus INNER JOIN departamento d ON d.idDepartamento= t.idDepartamento WHERE t.serie = '$id_colsul' and c.email_cliente = '$email_consul';");
if(mysqli_num_rows($consulta_tablaTicket)>=1){
  $lsT=mysqli_fetch_array($consulta_tablaTicket, MYSQLI_ASSOC);
  

  $atiende = Mysql::consulta("SELECT c.id_cliente, c.nombre_usuario ,c.nombre_completo,c.email_cliente,c.telefono_celular,t.serie FROM cliente c INNER JOIN ticket t ON t.id_atiende = c.id_cliente WHERE t.serie = '$id_colsul';");
  $reg1 = mysqli_fetch_array($atiende, MYSQLI_ASSOC);

?>
        <div class="container">
            <div class="row well">
            <div class="col-sm-2">
                <img src="img/status.png" class="img-responsive" alt="Image">
            </div>

            <?php


            $semaforo = 0;
            
            if($lsT['estado_ticket']=='ABIERTO' || $lsT['estado_ticket']=='Abierto' || $lsT['estado_ticket']=='abierto'){
                echo '
                <div class="col-sm-10 lead text-justify">
                <h2 class="text-info">Estado de ticket de soporte</h2>
                <p>Si su <strong>ticket</strong> no ha sido solucionado aún, espere pacientemente, estamos trabajando para poder resolver su problema y darle una solución.</p>
              </div>                                
                ';

                $semaforo = 3;
            }
            else if($lsT['estado_ticket']=='EN PROCESO' || $lsT['estado_ticket']=='en proceso' || $lsT['estado_ticket']=='En proceso'){
                echo '
                <div class="col-sm-10 lead text-justify">
                <h2 class="text-info">Estado de ticket de soporte</h2>
                <p>Su <strong>ticket</strong> no ha sido solucionado aún, pero ya está en proceso. Espere pacientemente, estamos trabajando para poder resolver su problema y darle una solución.</p>
              </div>                                
                ';

                $semaforo = 2;
               }
            else{

                echo '
                <div class="col-sm-10 lead text-justify">
                <h2 class="text-info">Estado de ticket de soporte</h2>
                    <p> Soporte técnico Alcomex le informa, que el número de ticket <b>#' .$lsT['serie'] . ' </b> ha sido revisado y resuelto a la brevedad. Sí tiene otra duda favor de abrir otro ticket.
                    </p>
               </div>                                
                ';

                $semaforo = 1;
            }
             //Soporte técnico le informa, que el número de ticket # ha siudo revisado y resuelto a la brevedad. Si
            
            
            ?>
          
         
          </div><!--fin row well-->
          <div class="row">
              <div class="col-sm-12">

                     <?php 
                     
                     if($semaforo == 1){
                         echo ' <div class="panel panel-success">';
                     } else if($semaforo==2){
                        echo ' <div class="panel panel-warning">';
                     }else   echo ' <div class="panel panel-danger">';
               
                     
                     ?>
                   
                        <div class="panel-heading text-center"><h4><i class="fa fa-ticket"></i> Ticket &nbsp;#<?php echo $lsT['serie']; ?></h4></div>
                      <div class="panel-body">
                          <div class="container">
                              <div class="col-sm-12">
                                  <div class="row">
                                      <div class="col-sm-4">
                                          <img class="img-responsive" alt="Image" src="img/Support.png">
                                      </div>
                                      <div class="col-sm-8">
                                          <div class="row">
                                              <div class="col-sm-4"><strong>Fecha:</strong> <?php echo $lsT['fecha']; ?></div>
                                              <div class="col-sm-4"><strong>Asunto:</strong> <?php echo $lsT['asunto']; ?></div>
                                      
                                            </div>
                                          <br>
                                          <div class="row">
                                              <div class="col-sm-4"><strong>Creador:</strong> <?php echo $lsT['nombre_completo']; ?></div>
                                              <div class="col-sm-4"><strong>Email:</strong> <?php echo $lsT['email_cliente']; ?></div>
                                          </div>
                                          <br>
                                          <div class="row">
                                              <div class="col-sm-4"><strong>Departamento:</strong> <?php echo $lsT['departamento']; ?></div>
                                              <div class="col-sm-4"><strong>Estado:</strong> <?php echo $lsT['estado_ticket']; ?></div>
                                       
                                               </div>
                                          <br>
                                          <div class="row">
                                              <div class="col-sm-4"><strong>Problema:</strong> <?php echo $lsT['mensaje']; ?></div>
                                              <div class="col-sm-4"><strong>Atendido por :</strong> <?php echo $reg1['nombre_completo']; ?></div>
                                      
                                            </div>
                                          <br>
                                          <div class="row">
                                              <div class="col-sm-12"><strong>Solución:</strong> <?php echo $lsT['solucion']; ?></div>
                                             
                                            </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="panel-footer text-center">
                          <div class="row">
                              <h4>Opciones</h4>

                              <?php
                              
                              if($_SESSION['rol']==4046)
                              {
                                
                              ?>
                              <div class="col-sm-6">
                                  <form action="" method="POST">
                                      <input type="text" value="<?php echo $lsT['serie']; ?>" name="del_ticket" hidden="">
                                      <button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>&nbsp;  Eliminar ticket</button>
                                  </form>
                              </div>                            
                              <br class="hidden-lg hidden-md hidden-sm">
                              <div class="col-sm-6">
                                   <button id="save" class="btn btn-success" data-id="<?php echo $lsT['serie']; ?>"><span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar ticket en PDF</button>
                              </div>
                              <?php
                              }
                              else{
                             ?>
                                <br class="hidden-lg hidden-md hidden-sm">
                              <div class="col-sm-12">
                                   <button id="save" class="btn btn-success" data-id="<?php echo $lsT['serie']; ?>"><span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar ticket en PDF</button>
                              </div>
                             <?php
                                
                             
                              }?>
                          </div>
                      </div>
                    </div>
              </div>
          </div>
        </div>
 <?php }else{ ?>
        <div class="container">
            <div class="row  animated fadeInDownBig">
                <div class="col-sm-4">
                    <img src="img/error.png" alt="Image" class="img-responsive"/><br>
                    <img src="./img/Transp_ALCOMEX.png" alt="Image" class="img-responsive"/>
                    
                </div>
                <div class="col-sm-7 text-center">
                    <h1 class="text-danger">Lo sentimos ha ocurrido un error al hacer la consulta, esto se debe a lo siguiente:</h1>
                    <h3 class="text-warning"><i class="fa fa-check"></i> El Ticket ha sido eliminado completamente.</h3>
                    <h3 class="text-warning"><i class="fa fa-check"></i> Los datos ingresados no son correctos.</h3>
                    <br>
                    <h3 class="text-primary"> Por favor verifique que su <strong>id ticket</strong> y <strong>email</strong> sean correctos, e intente nuevamente.</h3>
                    <h4><a href="./index.php?view=soporte" class="btn btn-warning"><i class="fa fa-reply"></i> Regresar a soporte</a></h4>
                </div>
                <div class="col-sm-1">&nbsp;</div>
            </div>
        </div>
<?php } ?>
<script>
  $(document).ready(function(){
    $("button#save").click(function (){
       window.open ("./lib/pdf_user.php?id="+$(this).attr("data-id"));
    });
  });
</script>