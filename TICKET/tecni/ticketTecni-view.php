<?php if( $_SESSION['nombre']!="" && $_SESSION['clave']!="" && $_SESSION['rol']==5267 ){ 
    
    $idAtiende = $_SESSION['id'];
    $orderby=["t.fecha","t.serie","e.Nombre","t.fecha_actualizacion","c.nombre_completo"];
    $ordenamuestra= $orderby[0];
    
    
    ?>
       <div id="contenido">
        <div class="container">
          <div class="row">
            <div class="col-sm-2">
              <img src="./img/msj.png" alt="Image" class="img-responsive animated tada">
            </div>
            <div class="col-sm-10">
              <p class="lead text-info">Bienvenido técnico, aqui se muestran todos los Tickets de Alcomex los cuales puedes modificar e imprimir.</p>
            </div>
          </div>
        </div>


            <?php

         
                if(isset($_POST['id_del'])){
                    $id = MysqlQuery::RequestPost('id_del');
                    if(MysqlQuery::Eliminar("ticket", "id='$id'")){
                        MysqlQuery::ProcedimientoAlmacenado("registro_alteracionesCliente","$idAtiende,'Eliminar','".date("Y-m-d H:i:s") ."','ticket'");
      
                        echo '
                            <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <h4 class="text-center">TICKET ELIMINADO</h4>
                                <p class="text-center">
                                    El ticket fue eliminado del sistema con exito
                                </p>
                            </div>
                        ';
                    }else{
                        echo '
                            <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                                <p class="text-center">
                                    No hemos podido eliminar el ticket
                                </p>
                            </div>
                        '; 
                    }
                }

               

          
                /* Todos los tickets*/
         
                $num_ticket_all=Mysql::consulta("SELECT t.id_atiende, t.id, t.fecha, t.serie , t.asunto, t.mensaje, t.solucion, c.nombre_completo as nombre_usuario, d.nombre as departamento, c.email_cliente, e.Nombre as estado_ticket FROM ticket t INNER JOIN estatus e ON t.idStatus = e.idEstatus INNER JOIN cliente c ON c.id_cliente = t.idUsuario INNER JOIN departamento d ON t.idDepartamento = d.idDepartamento WHERE t.id_atiende = $idAtiende ORDER BY " .$ordenamuestra. " DESC ");
                $num_total_all=mysqli_num_rows($num_ticket_all);

                /* Tickets pendientes*/
                $num_ticket_pend=Mysql::consulta("SELECT t.id, t.fecha, t.serie , t.asunto, t.mensaje, t.solucion, c.nombre_completo as nombre_usuario , d.nombre as departamento , c.email_cliente, e.Nombre as estado_ticket FROM ticket t INNER JOIN estatus e ON t.idStatus = e.idEstatus INNER JOIN cliente c ON c.id_cliente = t.idUsuario INNER JOIN departamento d ON t.idDepartamento = d.idDepartamento WHERE ( e.idEstatus = 94574 OR (e.Nombre='PENDIENTE' OR e.Nombre='pendiente')) AND t.id_atiende = $idAtiende ORDER BY " . $ordenamuestra . " DESC");
                $num_total_pend=mysqli_num_rows($num_ticket_pend);

                /* Tickets en proceso*/
                $num_ticket_proceso=Mysql::consulta("SELECT t.id, t.fecha, t.serie , t.asunto, t.mensaje, t.solucion, c.nombre_completo as nombre_usuario, d.nombre as departamento , c.email_cliente, e.Nombre as estado_ticket FROM ticket t INNER JOIN estatus e ON t.idStatus = e.idEstatus INNER JOIN cliente c ON c.id_cliente = t.idUsuario INNER JOIN departamento d ON t.idDepartamento = d.idDepartamento WHERE ( e.idEstatus = 94575 OR (e.Nombre='EN PROCESO' OR e.Nombre='En proceso')) AND t.id_atiende = $idAtiende ORDER BY " .  $ordenamuestra. " DESC");
                $num_total_proceso=mysqli_num_rows($num_ticket_proceso);

                /* Tickets resueltos*/
                $num_ticket_res=Mysql::consulta("SELECT t.id, t.fecha, t.serie , t.asunto, t.mensaje, t.solucion, c.nombre_completo as nombre_usuario , c.email_cliente,d.nombre as departamento,  e.Nombre as estado_ticket FROM ticket t INNER JOIN estatus e ON t.idStatus = e.idEstatus INNER JOIN cliente c ON c.id_cliente = t.idUsuario INNER JOIN departamento d ON t.idDepartamento = d.idDepartamento WHERE ( e.idEstatus = 94576 OR (e.Nombre='Resuelto' OR e.Nombre='RESUELTO')) AND t.id_atiende = $idAtiende ORDER BY " . $ordenamuestra. " DESC");
                $num_total_res=mysqli_num_rows($num_ticket_res);

                 /*Creados */

                 $num_ticket_cre=Mysql::consulta("SELECT t.id, t.fecha, t.serie , t.asunto, t.mensaje, t.solucion, c.nombre_completo as nombre_usuario , c.email_cliente,d.nombre as departamento,  e.Nombre as estado_ticket FROM ticket t INNER JOIN estatus e ON t.idStatus = e.idEstatus INNER JOIN cliente c ON c.id_cliente = t.idUsuario INNER JOIN departamento d ON t.idDepartamento = d.idDepartamento WHERE  t.idUsuario = $idAtiende  ORDER BY $ordenamuestra DESC ;");
                 $num_total_cre=mysqli_num_rows($num_ticket_cre);
 
            ?>

            <div class="container">
            <div style="display:flex; float:right;">
                       <input  style="width: 80%; float:left;" name="busqueda" required="" id="busqueda" placeholder="Buscar tickets" name="busqueda" value="" class="form-control mr-sm-2 alin" type="text">
                       <a id="mt" href="javascript:void()" style="float:right;" placeholder="Buscar" class="btn btn-warning" type="submit"><span class="glyphicon glyphicon-search"></span></a>      
                       <div class='btn-group' style="display:flex; float:left">
                                            <button class='btn dropdown-toggle btn-success' data-toggle='dropdown' value='Más'><span class='fa fa-reorder'></span></button>
                                            <ul class='dropdown-menu'>
                                         
                                            <li ><a  id="fechaa" href='javascript:void()' class='btn btn-link ' type="submit" style='text-decoration:none;'>Fecha</a></li>  
                                             <li ><a id="seriee" href='javascript:void()' class='btn btn-link ' type="submit" style='text-decoration:none;'>Serie</a></li>  
                                             <li ><a  id="estatuss" href='javascript:void()' class='btn btn-link ' type="submit" style='text-decoration:none;'>Estatus</a></li>  
                                             <li ><a id="actualizadoo" href='javascript:void()' class='btn btn-link ' type="submit" style='text-decoration:none;'>Actualizado</a></li>   
                                             <li ><a id="creadorr" href='javascript:void()' class='btn btn-link ' type="submit" style='text-decoration:none;'>Creadores</a></li>  
                                            
                                            </ul>
                                         </div> 
                 </div>
                                           <br><br><br>
                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-pills nav-justified">
                            <li><a href="./tecni.php?view=ticketTecni&ticket=all"><i class="fa fa-list"></i>&nbsp;&nbsp;Todos los tickets&nbsp;&nbsp;<span class="badge"><?php echo $num_total_all; ?></span></a></li>
                            <li><a href="./tecni.php?view=ticketTecni&ticket=pending"><i class="fa fa-envelope"></i>&nbsp;&nbsp;Tickets pendientes&nbsp;&nbsp;<span class="badge"><?php echo $num_total_pend; ?></span></a></li>
                            <li><a href="./tecni.php?view=ticketTecni&ticket=process"><i class="fa fa-folder-open"></i>&nbsp;&nbsp;Tickets en proceso&nbsp;&nbsp;<span class="badge"><?php echo $num_total_proceso; ?></span></a></li>
                            <li><a href="./tecni.php?view=ticketTecni&ticket=resolved"><i class="fa fa-thumbs-o-up"></i>&nbsp;&nbsp;Tickets resueltos&nbsp;&nbsp;<span class="badge"><?php echo $num_total_res; ?></span></a></li>
                            <li><a href="./tecni.php?view=ticketTecni&ticket=created"><i class="fa fa-user-o"></i>&nbsp;&nbsp;Creados&nbsp;&nbsp;<span class="badge"><?php echo $num_total_cre; ?></span></a></li>
                    
                        </ul>
                    </div>

                    
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <?php
                                $mysqli = mysqli_connect(SERVER, USER, PASS, BD);
                                mysqli_set_charset($mysqli, "utf8");

                                $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
                                $regpagina = 50;
                                $inicio = ($pagina > 1) ? (($pagina * $regpagina) - $regpagina) : 0;
                                if(isset($_GET['ticket'])){
                                    if($_GET['ticket']=="tecni"){
                                        //SELECT SQL_CALC_FOUND_ROWS * FROM ticket t INNER JOIN estatus e ON t.idStatus = e.idEstatus INNER JOIN cliente c ON c.id_cliente = t.idUsuario INNER JOIN departamento d ON t.idDepartamento = d.idDepartamento
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS  t.id, t.fecha, t.serie , t.asunto, t.mensaje, t.solucion,c.telefono_celular ,c.nombre_completo as nombre_usuario ,c.email_cliente, d.nombre as departamento, e.Nombre as estado_ticket FROM ticket t INNER JOIN estatus e ON t.idStatus = e.idEstatus INNER JOIN cliente c ON c.id_cliente = t.idUsuario INNER JOIN departamento d ON t.idDepartamento = d.idDepartamento    ORDER BY  $ordenamuestra DESC   LIMIT $inicio, $regpagina";
                                        $estatus ='<input type="hidden" name="estatus" value="all" id="estatus"/>';
                                        echo $estatus;
                                    }elseif($_GET['ticket']=="pending"){
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS  t.id, t.fecha, t.serie , t.asunto, t.mensaje, t.solucion, c.telefono_celular ,c.nombre_completo as nombre_usuario ,c.email_cliente, d.nombre as departamento, e.Nombre as estado_ticket FROM ticket t INNER JOIN estatus e ON t.idStatus = e.idEstatus INNER JOIN cliente c ON c.id_cliente = t.idUsuario INNER JOIN departamento d ON t.idDepartamento = d.idDepartamento WHERE  t.idStatus = 94574 AND t.id_atiende = '$idAtiende'   ORDER BY  $ordenamuestra DESC   LIMIT $inicio, $regpagina";
                                        $estatus ='<input type="hidden" name="estatus" value="pending" id="estatus"/>';
                                        echo $estatus;
                                    }elseif($_GET['ticket']=="process"){
                                    $consulta = "SELECT SQL_CALC_FOUND_ROWS  t.id, t.fecha, t.serie , t.asunto, t.mensaje, t.solucion,c.telefono_celular , c.nombre_completo as nombre_usuario ,c.email_cliente, d.nombre as departamento, e.Nombre as estado_ticket FROM ticket t INNER JOIN estatus e ON t.idStatus = e.idEstatus INNER JOIN cliente c ON c.id_cliente = t.idUsuario INNER JOIN departamento d ON t.idDepartamento = d.idDepartamento WHERE  t.idStatus = 94575 AND t.id_atiende = '$idAtiende'    ORDER BY  $ordenamuestra DESC   LIMIT $inicio, $regpagina";
                                    $estatus ='<input type="hidden" name="estatus" value="process" id="estatus"/>';
                                    echo $estatus;
                                    }elseif($_GET['ticket']=="resolved"){
                                    $consulta = "SELECT SQL_CALC_FOUND_ROWS  t.id, t.fecha, t.serie , t.asunto, t.mensaje, t.solucion,c.telefono_celular , c.nombre_completo as nombre_usuario ,c.email_cliente, d.nombre as departamento, e.Nombre as estado_ticket FROM ticket t INNER JOIN estatus e ON t.idStatus = e.idEstatus INNER JOIN cliente c ON c.id_cliente = t.idUsuario INNER JOIN departamento d ON t.idDepartamento = d.idDepartamento WHERE  t.idStatus = 94576  AND t.id_atiende = '$idAtiende'  ORDER BY  $ordenamuestra DESC   LIMIT $inicio, $regpagina";
                                    $estatus ='<input type="hidden" name="estatus" value="resolved" id="estatus"/>';
                                    echo $estatus;
                                    }else if ($_GET['ticket']=="all"){
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS  t.id, t.fecha, t.serie , t.asunto, t.mensaje, t.solucion, c.telefono_celular ,c.nombre_completo as nombre_usuario ,c.email_cliente, d.nombre as departamento, e.Nombre as estado_ticket FROM ticket t INNER JOIN estatus e ON t.idStatus = e.idEstatus INNER JOIN cliente c ON c.id_cliente = t.idUsuario INNER JOIN departamento d ON t.idDepartamento = d.idDepartamento WHERE t.id_atiende = '$idAtiende' ORDER BY  $ordenamuestra DESC LIMIT $inicio, $regpagina";
                                        $estatus ='<input type="hidden" name="estatus" value="all" id="estatus"/>';
                                        echo $estatus;
                                    }
                                    else if($_GET['ticket']=="created"){
                                        $consulta = "SELECT  SQL_CALC_FOUND_ROWS t.id, t.fecha, t.serie , t.asunto, t.mensaje, t.solucion, c.nombre_completo as nombre_usuario , c.email_cliente, c.telefono_celular,d.nombre as departamento,  e.Nombre as estado_ticket FROM ticket t INNER JOIN estatus e ON t.idStatus = e.idEstatus INNER JOIN cliente c ON c.id_cliente = t.idUsuario INNER JOIN departamento d ON t.idDepartamento = d.idDepartamento WHERE  t.idUsuario = '$idAtiende' ORDER BY $ordenamuestra DESC";
                                        $estatus= '<input type="hidden" name="estatus" value="created" id="estatus"/>';
                                        echo $estatus;
                                    }
                                    
                                }else{
                                    $consulta="SELECT SQL_CALC_FOUND_ROWS  t.id, t.fecha, t.serie , t.asunto, t.mensaje, t.solucion,c.telefono_celular , c.nombre_completo as nombre_usuario,c.email_cliente, d.nombre as departamento , e.Nombre as estado_ticket FROM ticket t INNER JOIN estatus e ON t.idStatus = e.idEstatus INNER JOIN cliente c ON c.id_cliente = t.idUsuario INNER JOIN departamento d ON t.idDepartamento = d.idDepartamento WHERE t.id_atiende = '$idAtiende' ORDER BY  $ordenamuestra DESC LIMIT $inicio, $regpagina";
                                    $estatus ='<input type="hidden" name="estatus" value="all" id="estatus"/>';
                                    echo $estatus;
                                }


                                $selticket=mysqli_query($mysqli,$consulta);

                                $totalregistros = mysqli_query($mysqli,"SELECT FOUND_ROWS()");
                                $totalregistros = mysqli_fetch_array($totalregistros, MYSQLI_ASSOC);
                        
                                $numeropaginas = ceil($totalregistros["FOUND_ROWS()"]/$regpagina);

                                if(mysqli_num_rows($selticket)>0):
                            ?>
                            <table class="table table-hover table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Fecha</th>
                                        <th class="text-center">Serie</th>
                                        <th class="text-center">Estado</th>
                                        <th class="text-center">Nombre</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Teléfono</th>
                                        <th class="text-center">Departamento</th>
                                      
                                        <th class="text-center">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $ct=$inicio+1;
                                        while ($row=mysqli_fetch_array($selticket, MYSQLI_ASSOC)): 
                                    ?>
                                    <tr>
                                    <td class="text-center"> <input type="checkbox" name="Tickets[]" value="<?php  echo $row['id'];?>" /></td>
                                     
                                        <td class="text-center"><?php echo $ct; ?></td>
                                        <td class="text-center"><?php echo $row['fecha']; ?></td>
                                        <td class="text-center"><?php echo $row['serie']; ?></td>
                                        <td class="text-center"><?php echo $row['estado_ticket']; ?></td>
                                        <td class="text-center"><?php echo $row['nombre_usuario']; ?></td>
                                        <td class="text-center"><?php echo $row['email_cliente']; ?></td>
                                        <td class="text-center"><?php echo $row['telefono_celular']; ?></td>
                                        <td class="text-center"><?php echo $row['departamento']; ?></td>
                                        <td class="text-center">
                                            <a href="./lib/pdf.php?id_del=<?php echo $row['serie']; ?>" class="btn btn-sm btn-success" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>

                                            <a href="tecni.php?view=ticketedit&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                        $ct++;
                                        endwhile; 
                                    ?>
                                      <tr> 
                                           <td  class= "text-center" colspan="10"> Seleccionar : <input  type="checkbox" onclick="MarcarCheckBox(this);" />  Todos | Ninguno  </td>
                                        </tr>
                                </tbody>
                            </table>
                            <?php else: ?>
                                <h2 class="text-center">No hay tickets registrados en el sistema</h2>
                            <?php endif; ?>
                        </div>
                        <?php 
                            if($numeropaginas>=1):
                            if(isset($_GET['ticket'])){
                                $ticketselected=$_GET['ticket'];
                            }else{
                                $ticketselected="all";
                            }
                        ?>
                        <nav aria-label="Page navigation" class="text-center">
                            <ul class="pagination">
                                <?php if($pagina == 1): ?>
                                    <li class="disabled">
                                        <a aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                <?php else: ?>
                                    <li>
                                        <a href="./tecni.php?view=ticketTecni&ticket=<?php echo $ticketselected; ?>&pagina=<?php echo $pagina-1; ?>" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                
                                
                                <?php
                                    for($i=1; $i <= $numeropaginas; $i++ ){
                                        if($pagina == $i){
                                            echo '<li class="active"><a href="./tecni.php?view=ticketTecni&ticket='.$ticketselected.'&pagina='.$i.'">'.$i.'</a></li>';
                                        }else{
                                            echo '<li><a href="./tecni.php?view=ticketTecni&ticket='.$ticketselected.'&pagina='.$i.'">'.$i.'</a></li>';
                                        }
                                    }
                                ?>
                                
                                
                                <?php if($pagina == $numeropaginas): ?>
                                    <li class="disabled">
                                        <a aria-label="Previous">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                <?php else: ?>
                                    <li>
                                        <a href="./tecni.php?view=ticketTecni&ticket=<?php echo $ticketselected; ?>&pagina=<?php echo $pagina+1; ?>" aria-label="Previous">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                        <?php endif; ?>
                    </div>
                </div>
            </div><!--container principal-->
         </div>
<?php
}else{
?>
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <img src="./img/Stop.png" alt="Image" class="img-responsive animated slideInDown"/><br>
                    <img src="./img/Transp_Alcomex.png" alt="Image" class="img-responsive"/>
                    
                </div>
                <div class="col-sm-7 animated flip">
                    <h1 class="text-danger">Lo sentimos esta página es solamente para técnicoss de Alcomex</h1>
                    <h3 class="text-info text-center">Inicia sesión como técnico para poder acceder</h3>
                </div>
                <div class="col-sm-1">&nbsp;</div>
            </div>
        </div>
<?php
}
?>

<div style="display:none">
<input type="hidden" id="fecha" value="Fecha"/> 
<input type="hidden" id="serie" value="Serie"/> 
<input type="hidden" id="eestatus" value="Estatus"/>
<input type="hidden" id="actualizado" value="Actualizado"/>  
<input type="hidden" id="creador" value="Creadores"/>
</div>
<!-- MODAL PARA ELIMINAR TICKET -->

<div class="modal fade" id="pregunta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                         <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                            <div style="text-align:center; background: #fb5d14; color:white;" class="modal-header">
                                                                <h3 class="modal-title" id="exampleModalLabel">¿Estás seguro de que deseas elminar este Ticket (Todo lo que este relacionado a el se eliminara de forma permanente)?</h3>
                                                            
                                                            </div>
                                                            <div class="modal-body">
                                                                
                                                            </div>
                                                            <div style="align-items:center; justify-content:center;"class="modal-footer">
                                                                <center>
                                                                   <input form="formulario" type="hidden" name="id_del" value="<?php echo $row['id']; ?>">       
                                                                    <button form="formulario" type="submit"  class="btn btn-success">SI</button>
                                                                   <button type="button" class="btn btn-danger" data-dismiss="modal">CANCELAR</button>
                                                                
                                                                </center>
                                                            </div>
                                                            </div>
                                                        </div>    
                                                 </div>
<script>
$("#mt").click(BuscarTicket);
    function BuscarTicket(){
        //admin.php?view=ticketadmin&ticket=all
         var URL = "./tecni.php?view=searchTicket&ticket=" + $("#estatus").val() + "&busqueda=" + $("#busqueda").val();   
        alert(URL);
        $.get(URL,function (datos,estado){
            $("#contenido").html(datos);
        }
        );
    }



    $("#fechaa").click(FiltroTicketf);
            function FiltroTicketf(){
                //admin.php?view=ticketadmin&ticket=all
                var URL = "./tecni.php?view=filterTicket&ticket=" + $("#estatus").val() +"&filtro=" + $("#fecha").val();   
                alert(URL);
                $.get(URL,function (datos,estado){
                    $("#contenido").html(datos);
                }
                );
            }

            $("#seriee").click(FiltroTickets);
            function  FiltroTickets(){
                //tecni.php?view=tickettecni&ticket=all
                var URL = "./tecni.php?view=filterTicket&ticket=" + $("#estatus").val() + "&filtro=" + $("#serie").val();   
                alert(URL);
                $.get(URL,function (datos,estado){
                    $("#contenido").html(datos);
                }
                );
            }

            $("#estatuss").click(FiltroTickete);
            function  FiltroTickete(){
                //tecni.php?view=tickettecni&ticket=all
                var URL = "./tecni.php?view=filterTicket&ticket=" + $("#estatus").val() + "&filtro=" + $("#eestatus").val();   
                alert(URL);
                $.get(URL,function (datos,estado){
                    $("#contenido").html(datos);
                }
                );
            }

            $("#actualizadoo").click(FiltroTicketa);
            function FiltroTicketa(){
                //tecni.php?view=ticketadmin&ticket=all
                var URL = "./tecni.php?view=filterTicket&ticket=" + $("#estatus").val() + "&filtro=" + $("#actualizado").val();   
                alert(URL);
                $.get(URL,function (datos,estado){
                    $("#contenido").html(datos);
                }
                );
            }
            $("#creadorr").click( FiltroTicketr);
            function FiltroTicketr(){
                //tecni.php?view=ticketadmin&ticket=all
                var URL = "./tecni.php?view=filterTicket&ticket=" + $("#estatus").val() + "&filtro=" + $("#creador").val();   
                alert(URL);
                $.get(URL,function (datos,estado){
                    $("#contenido").html(datos);
                }
                );
            }
</script>
