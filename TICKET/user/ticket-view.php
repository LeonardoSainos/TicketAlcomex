<?php if($_SESSION['nombre']!= "" && $_SESSION['rol']==9947 ||  $_SESSION['rol']==4046){
        

        if( isset($_POST['name_ticket']) && isset($_POST['email_ticket'])){

          /*Este codigo nos servira para generar un numero diferente para cada ticket*/
          $codigo = ""; 
          $longitud = 2; 
          for ($i=1; $i<=$longitud; $i++){ 
            $numero = rand(0,9); 
            $codigo .= $numero; 
          } 
          $num=Mysql::consulta("SELECT id FROM ticket");
          $numero_filas = mysqli_num_rows($num);

          $numero_filas_total=$numero_filas+1;
          $id_ticket="TK".$codigo."N".$numero_filas_total;
          /*Fin codigo numero de ticket*/


         // $fecha_ticket= MysqlQuery::RequestPost('fecha_ticket');
          $nombre_ticket= MysqlQuery::RequestPost('name_ticket');
          $email_ticket=MysqlQuery::RequestPost('email_ticket');
          $departamento_ticket=MysqlQuery::RequestPost('departamento_ticket');
          $asunto_ticket=MysqlQuery::RequestPost('asunto_ticket');        
          $mensaje_ticket=MysqlQuery::RequestPost('mensaje_ticket');
          $estado_ticket="Pendiente";






          
          $cabecera="From: LinuxStore El Salvador<linuxstore@hifenix.com>";
          $mensaje_mail="¡Gracias por reportarnos su problema! Buscaremos una solución para su producto lo mas pronto posible. Su ID ticket es: ".$id_ticket;
          $mensaje_mail=wordwrap($mensaje_mail, 70, "\r\n");

          if(MysqlQuery::Guardar("ticket","serie,asunto,mensaje,idUsuario,idDepartamento,idStatus,id_atiende", "'$nombre_ticket','$email_ticket','$departamento_ticket','$asunto_ticket','$mensaje_ticket','', '$estado_ticket','$id_ticket'")){
             /*----------  Enviar correo con los datos del ticket
            mail($email_ticket, $asunto_ticket, $mensaje_mail, $cabecera)
            ----------*/
            
            echo '
                <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="text-center">TICKET CREADO</h4>
                    <p class="text-center">
                        Ticket creado con exito '.$_SESSION['nombre'].'<br>El TICKET ID es: <strong>'.$id_ticket.'</strong>
                    </p>
                </div>
            ';

          }else{
            echo '
                <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                    <p class="text-center">
                        No hemos podido crear el ticket. Por favor intente nuevamente.
                    </p>
                </div>
            ';
          }
        }
?>
        <div class="container">
          <div class="row well">
            <div class="col-sm-3">
              <img src="img/ticket.png" class="img-responsive" alt="Image">
            </div>
            <div class="col-sm-9 lead">
              <h2 class="text-info">¿Cómo abrir un nuevo Ticket?</h2>
              <p>Para abrir un nuevo ticket deberá de llenar todos los campos de el siguiente formulario. Usted podra verificar el estado de su ticket mediante el <strong>Ticket ID</strong> que se le proporcionara a usted cuando llene y nos envie el siguiente formulario.</p>
            </div>
          </div><!--fin row 1-->

          <div class="row">
            <div class="col-sm-12">
              <div class="panel panel-info">
                <div class="panel-heading">
                  <h3 class="panel-title text-center"><strong><i class="fa fa-ticket"></i>&nbsp;&nbsp;&nbsp;Ticket</strong></h3>
                </div>
                <div class="panel-body">
                  <div class="row">
                    <div class="col-sm-4 text-center">
                      <br><br><br>
                      <img src="img/write_email.png" alt=""><br><br>
                      <p class="text-primary text-justify">Por favor llene todos los datos de este formulario para abrir su ticket. El <strong>Ticket ID</strong> será enviado a la dirección de correo electronico proporcionada en este formulario.</p>
                    </div>
                    <div class="col-sm-8">
                      <form class="form-horizontal" role="form" action="" method="POST">
                          <fieldset>
                      <!--  <div class="form-group">
                            <label class="col-sm-2 control-label">Fecha</label>
                            <div class='col-sm-10'>
                                <div class="input-group">
                                    <input class="form-control" type="text" id="fechainput" placeholder="Fecha" name="fecha_ticket" required  >
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div> -->

                        <div class="form-group">
                          <label  class="col-sm-2 control-label">Nombre</label>
                          <div class="col-sm-10">
                              <div class='input-group'>
                                <input type="text" class="form-control" placeholder="Nombre" required="" pattern="[a-zA-Z ]{1,30}"  required  name="name_ticket" title="Nombre Apellido" value="<?php echo $_SESSION['nombre_completo']; ?>" >
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                              </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                          <div class="col-sm-10">
                              <div class='input-group'>
                                <input type="email" class="form-control" id="inputEmail3" required  placeholder="Email" name="email_ticket" required="" title="Ejemplo@dominio.com" value="<?php echo $_SESSION['email']; ?>" >
                                <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                              </div> 
                          </div>
                        </div>

                        <div class="form-group">
                          <label  class="col-sm-2 control-label">Departamento</label>
                          <div class="col-sm-10">
                              <div class='input-group'>
                              <select class="form-control" name="estado_ticket">
                                      <?php 
                                        $sql = Mysql::consulta("SELECT * FROM departamento");
                                        while( $reg1=mysqli_fetch_array($sql, MYSQLI_ASSOC)){
                                          echo "
                                            <option value='" . $reg1['idDepartamento']  . "'>" .
                                             $reg1['nombre'];?>  
                                            </option>
                                            <?php
                                          }
                
                                        ?> 
                                        
                                    
                                        
                                      </select>
                                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                              </div> 
                          </div>
                        </div>

                        <div class="form-group">
                          <label  class="col-sm-2 control-label">Asunto</label>
                          <div class="col-sm-10">
                              <div class='input-group'>
                                <input type="text" class="form-control" placeholder="Asunto" name="asunto_ticket" required="">
                                <span class="input-group-addon"><i class="fa fa-paperclip"></i></span>
                              </div> 
                          </div>
                        </div>

                        <div class="form-group">
                          <label  class="col-sm-2 control-label">Técnico</label>
                          <div class="col-sm-10">
                              <div class='input-group'>
                                          <select class="form-control" name="tecnico">
                                            <?php
                                            $t = Mysql::consulta("SELECT * from cliente Where id_rol = 9947");
                                          //  $tecnicos = mysqli_fetch_array($t, MYSQLI_ASSOC);
                                             if(mysqli_num_rows($t)>0){
                                              $num = 1;
                                              while($tecnicos = mysqli_fetch_array($t)){
                                                     $c=  Mysql:: consulta("SELECT count(*) FROM ticket WHERE (fecha BETWEEN  date('Y-m-d 00:00:00') AND date('Y-m-d 23:59:59')) AND id_atiende=" . $tecnicos['id_cliente']);
                                                      if(mysqli_num_rows($c)<=20){

                                                        echo "<option value= '" . $tecnicos['id_cliente'] .  " '>".
                                                       " Técnico " .  $num;
                                                        //$tecnicos['nombre_usuario'] .
                                                         "</option>
                                                        ";
                                                  $num++;
                                                      }
                                                     
                                              }
                                            }
                                            else{

                                              echo "<option> No hay técnicos </option>";
                                            }
                                           
                                            ?>

                                          </select>


                                   <span class="input-group-addon"><i class="fa fa-laptop"></i></span>
                              </div> 
                          </div>
                        </div>



                        <div class="form-group">
                          <label  class="col-sm-2 control-label">Detalles del problema</label>
                          <div class="col-sm-10">
                            <textarea class="form-control" rows="3" placeholder="Escriba el problema que presenta su producto" name="mensaje_ticket" required=""></textarea>
                          </div>
                        </div>
                        

                        <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-info">Abrir ticket</button>
                          </div>
                        </div>
                             </fieldset> 
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

<?php
}else{
?>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <img src="./img/Stop.png" alt="Image" class="img-responsive"/><br>
                <img src="./img/Transp_ALCOMEX.png" alt="Image" class="img-responsive"/>
                
            </div>
            <div class="col-sm-7 text-center">
                <h1 class="text-danger">Lo sentimos esta página es solamente para usuarios registrados en soporte técnico Alcomex</h1>
                <h3 class="text-info">Inicia sesión para poder acceder</h3>
            </div>
            <div class="col-sm-1">&nbsp;</div>
        </div>
    </div>
<?php
}
?>
<script type="text/javascript">
  $(document).ready(function(){
      $("#fechainput").datepicker();
  });
</script>