<?php if( $_SESSION['nombre']!="" && $_SESSION['clave']!="" && $_SESSION['rol']==4046 ){
    
    $user= $_SESSION['id'];
    
    if (isset($_GET['ticket'])!=null && isset($_GET['busqueda']) ){
        $busqueda = MysqlQuery::RequestGet('busqueda');
        $where =MysqlQuery:: RequestGet('ticket');     
    }

    ?>
   
        <div class="container">
          <div class="row">
            <div class="col-sm-2">
              <img src="./img/msj.png" alt="Image" class="img-responsive animated tada">
            </div>
            <div class="col-sm-10">
              <p class="lead text-info">Bienvenido administrador, aqui se muestran todos los Tickets de Alcomex los cuales podra eliminar, modificar e imprimir.</p>
               </div>
          </div>
        </div>
            <?php
                if(isset($_POST['id_dele'])){
                    $id = MysqlQuery::RequestPost('id_dele');                
                    $user = $_SESSION['id'];
                    if(MysqlQuery::Eliminar("ticket", "id=$id")){
                        MysqlQuery::ProcedimientoAlmacenado("registro_alteracionesCliente","$user,'Eliminar','".date("Y-m-d H:i:s") ."','ticket'");
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
                $num_ticket_all=Mysql::consulta("SELECT t.id, t.fecha, t.serie , t.asunto, t.mensaje, t.solucion, c.nombre_completo as nombre_usuario, d.nombre as departamento, c.email_cliente, e.Nombre as estado_ticket FROM ticket t INNER JOIN estatus e ON t.idStatus = e.idEstatus INNER JOIN cliente c ON c.id_cliente = t.idUsuario INNER JOIN departamento d ON t.idDepartamento = d.idDepartamento  ORDER BY t.fecha DESC ");
                $num_total_all=mysqli_num_rows($num_ticket_all);

                /* Tickets pendientes*/
                $num_ticket_pend=Mysql::consulta("SELECT t.id, t.fecha, t.serie , t.asunto, t.mensaje, t.solucion, c.nombre_completo as nombre_usuario , d.nombre as departamento , c.email_cliente, e.Nombre as estado_ticket FROM ticket t INNER JOIN estatus e ON t.idStatus = e.idEstatus INNER JOIN cliente c ON c.id_cliente = t.idUsuario INNER JOIN departamento d ON t.idDepartamento = d.idDepartamento WHERE  e.idEstatus = 94574   ORDER BY t.fecha DESC");
                $num_total_pend=mysqli_num_rows($num_ticket_pend);

                /* Tickets en proceso*/
                $num_ticket_proceso=Mysql::consulta("SELECT t.id, t.fecha, t.serie , t.asunto, t.mensaje, t.solucion, c.nombre_completo as nombre_usuario, d.nombre as departamento , c.email_cliente, e.Nombre as estado_ticket FROM ticket t INNER JOIN estatus e ON t.idStatus = e.idEstatus INNER JOIN cliente c ON c.id_cliente = t.idUsuario INNER JOIN departamento d ON t.idDepartamento = d.idDepartamento WHERE  e.idEstatus = 94575   ORDER BY t.fecha DESC");
                $num_total_proceso=mysqli_num_rows($num_ticket_proceso);

                /* Tickets resueltos*/
                $num_ticket_res=Mysql::consulta("SELECT t.id, t.fecha, t.serie , t.asunto, t.mensaje, t.solucion, c.nombre_completo as nombre_usuario , c.email_cliente,d.nombre as departamento,  e.Nombre as estado_ticket FROM ticket t INNER JOIN estatus e ON t.idStatus = e.idEstatus INNER JOIN cliente c ON c.id_cliente = t.idUsuario INNER JOIN departamento d ON t.idDepartamento = d.idDepartamento WHERE  e.idEstatus = 94576   ORDER BY t.fecha DESC ;");
                $num_total_res=mysqli_num_rows($num_ticket_res);


                /* Mis tickets */
                $num_ticket_my=Mysql::consulta("SELECT t.id, t.fecha, t.serie , t.asunto, t.mensaje, t.solucion, c.nombre_completo as nombre_usuario , c.email_cliente,d.nombre as departamento,  e.Nombre as estado_ticket FROM ticket t INNER JOIN estatus e ON t.idStatus = e.idEstatus INNER JOIN cliente c ON c.id_cliente = t.idUsuario INNER JOIN departamento d ON t.idDepartamento = d.idDepartamento WHERE  t.id_atiende = $user  ORDER BY t.fecha DESC ;");
                $num_total_my=mysqli_num_rows($num_ticket_my);

                 /*Creados */

                 $num_ticket_cre=Mysql::consulta("SELECT t.id, t.fecha, t.serie , t.asunto, t.mensaje, t.solucion, c.nombre_completo as nombre_usuario , c.email_cliente,d.nombre as departamento,  e.Nombre as estado_ticket FROM ticket t INNER JOIN estatus e ON t.idStatus = e.idEstatus INNER JOIN cliente c ON c.id_cliente = t.idUsuario INNER JOIN departamento d ON t.idDepartamento = d.idDepartamento WHERE  t.idUsuario = $user  ORDER BY t.fecha DESC ;");
                 $num_total_cre=mysqli_num_rows($num_ticket_cre);
 


            ?>
 <div id="contenido">           
            <div class="container">
                <br><br>
                 <div class='btn-group'>   
                     <button class='btn dropdown-toggle btn-warning' data-toggle='dropdown' value='Más'>
                         Más
                             <span class='caret'></span>
                             </button>
                              <ul class='dropdown-menu'>
                               <!-- dropdown menu links -->
                             <li class=><span style='margin-left:22px;'class='glyphicon glyphicon-trash'></span> <input form="acciones" class='btn btn-link ' style='text-decoration:none;'type='submit' value='Eliminar' name="Eliminar"></li>                                                                                                                               
                              </ul>
                                    
                  </div>
                    <div style="display:flex; float:right;">
                       <input  style="width: 80%; float:left;" value="<?php echo $busqueda; ?>" name="busqueda" id="busqueda" placeholder="Buscar tickets" name="busqueda" value="" class="form-control mr-sm-2 alin" type="text">
                       <a id="mt" href="javascript:void()" style="float:right;" placeholder="Buscar" class="btn btn-warning" type="submit"><span class="glyphicon glyphicon-search"></span></a>       
                 
                </div>
                <br><br>
                                          
                <div class="row">
                    
                    <div class="col-md-12">
                        <ul class="nav nav-pills nav-justified">
                            <li><a href="./admin.php?view=ticketadmin&ticket=all"><i class="fa fa-list"></i>&nbsp;&nbsp;Todos los tickets&nbsp;&nbsp;<span class="badge"><?php echo $num_total_all; ?></span></a></li>
                            <li><a href="./admin.php?view=ticketadmin&ticket=pending"><i class="fa fa-envelope"></i>&nbsp;&nbsp;Tickets pendientes&nbsp;&nbsp;<span class="badge"><?php echo $num_total_pend; ?></span></a></li>
                            <li><a href="./admin.php?view=ticketadmin&ticket=process"><i class="fa fa-folder-open"></i>&nbsp;&nbsp;Tickets en proceso&nbsp;&nbsp;<span class="badge"><?php echo $num_total_proceso; ?></span></a></li>
                            <li><a href="./admin.php?view=ticketadmin&ticket=resolved"><i class="fa fa-thumbs-o-up"></i>&nbsp;&nbsp;Tickets resueltos&nbsp;&nbsp;<span class="badge"><?php echo $num_total_res; ?></span></a></li>
                            <li><a href="./admin.php?view=ticketadmin&ticket=myticket"><i class="fa fa-user-o"></i>&nbsp;&nbsp;Mis tickets&nbsp;&nbsp;<span class="badge"><?php echo $num_total_my; ?></span></a></li>
                            <li><a href="./admin.php?view=ticketadmin&ticket=created"><i class="fa fa-user-o"></i>&nbsp;&nbsp;Creados&nbsp;&nbsp;<span class="badge"><?php echo $num_total_cre; ?></span></a></li>
                    
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
                                    if($where=="all"){
                                          $consulta = "SELECT SQL_CALC_FOUND_ROWS t.id, t.fecha, t.serie, t.asunto,t.mensaje, t.solucion, c.nombre_completo AS nombre_usuario, c.email_cliente, c.telefono_celular , d.nombre AS departamento, e.Nombre AS estado_ticket,t.fecha_actualizacion FROM ticket t INNER JOIN departamento d ON t.idDepartamento = d.idDepartamento INNER JOIN estatus e ON t.idStatus=e.idEstatus INNER JOIN cliente c ON t.idUsuario = c.id_cliente WHERE (t.id LIKE '%$busqueda%' OR t.fecha LIKE '%$busqueda%' OR t.serie LIKE '%$busqueda%' OR t.asunto LIKE '%$busqueda%' OR t.mensaje LIKE '%$busqueda%' OR t.solucion LIKE '%$busqueda%' OR c.nombre_completo LIKE '%$busqueda%' OR d.nombre LIKE '%$busqueda%' OR e.Nombre LIKE '%$busqueda%' OR t.fecha_actualizacion LIKE '%$busqueda%' OR c.telefono_celular LIKE '%$busqueda%' OR c.email_cliente LIKE '%$busqueda%')  ORDER BY t.fecha DESC   LIMIT $inicio, $regpagina";
                                          $estatus ='<input type="hidden" name="estatus" value="all" id="estatus"/>';
                                          echo $estatus;    $mio= true;
                                        
                                   }
                                   else if($where=="pending"){
                                        $consulta = "SELECT SQL_CALC_FOUND_ROWS t.id, t.fecha, t.serie, t.asunto,t.mensaje, t.solucion, c.nombre_completo AS nombre_usuario, c.email_cliente, c.telefono_celular , d.nombre AS departamento, e.Nombre AS estado_ticket,t.fecha_actualizacion FROM ticket t INNER JOIN departamento d ON t.idDepartamento = d.idDepartamento INNER JOIN estatus e ON t.idStatus=e.idEstatus INNER JOIN cliente c ON t.idUsuario = c.id_cliente WHERE (t.id LIKE '%$busqueda%' OR t.fecha LIKE '%$busqueda%' OR t.serie LIKE '%$busqueda%' OR t.asunto LIKE '%$busqueda%' OR t.mensaje LIKE '%$busqueda%' OR t.solucion LIKE '%$busqueda%' OR c.nombre_completo LIKE '%$busqueda%' OR d.nombre LIKE '%$busqueda%' OR e.Nombre LIKE '%$busqueda%' OR t.fecha_actualizacion LIKE '%$busqueda%' OR c.telefono_celular LIKE '%$busqueda%' OR c.email_cliente LIKE '%$busqueda%')  AND t.idStatus = 94574 ORDER BY t.fecha DESC   LIMIT $inicio, $regpagina";
                                        $estatus ='<input type="hidden" name="estatus" value="pending" id="estatus"/>';
                                        echo $estatus;    $mio= true;
                                    }else if($where=="process"){
                                        $consulta = "SELECT SQL_CALC_FOUND_ROWS t.id, t.fecha, t.serie, t.asunto,t.mensaje, t.solucion, c.nombre_completo AS nombre_usuario, c.email_cliente, c.telefono_celular , d.nombre AS departamento, e.Nombre AS estado_ticket,t.fecha_actualizacion FROM ticket t INNER JOIN departamento d ON t.idDepartamento = d.idDepartamento INNER JOIN estatus e ON t.idStatus=e.idEstatus INNER JOIN cliente c ON t.idUsuario = c.id_cliente WHERE (t.id LIKE '%$busqueda%' OR t.fecha LIKE '%$busqueda%' OR t.serie LIKE '%$busqueda%' OR t.asunto LIKE '%$busqueda%' OR t.mensaje LIKE '%$busqueda%' OR t.solucion LIKE '%$busqueda%' OR c.nombre_completo LIKE '%$busqueda%' OR d.nombre LIKE '%$busqueda%' OR e.Nombre LIKE '%$busqueda%' OR t.fecha_actualizacion LIKE '%$busqueda%' OR c.telefono_celular LIKE '%$busqueda%' OR c.email_cliente LIKE '%$busqueda%')  AND t.idStatus = 94575 ORDER BY t.fecha DESC   LIMIT $inicio, $regpagina";
                                        $estatus ='<input type="hidden" name="estatus" value="process" id="estatus"/>';
                                        echo $estatus;    $mio= true;
                                    }else if($where=="resolved"){
                                        $consulta = "SELECT SQL_CALC_FOUND_ROWS t.id, t.fecha, t.serie, t.asunto,t.mensaje, t.solucion, c.nombre_completo AS nombre_usuario, c.email_cliente, c.telefono_celular , d.nombre AS departamento, e.Nombre AS estado_ticket,t.fecha_actualizacion FROM ticket t INNER JOIN departamento d ON t.idDepartamento = d.idDepartamento INNER JOIN estatus e ON t.idStatus=e.idEstatus INNER JOIN cliente c ON t.idUsuario = c.id_cliente WHERE (t.id LIKE '%$busqueda%' OR t.fecha LIKE '%$busqueda%' OR t.serie LIKE '%$busqueda%' OR t.asunto LIKE '%$busqueda%' OR t.mensaje LIKE '%$busqueda%' OR t.solucion LIKE '%$busqueda%' OR c.nombre_completo LIKE '%$busqueda%' OR d.nombre LIKE '%$busqueda%' OR e.Nombre LIKE '%$busqueda%' OR t.fecha_actualizacion LIKE '%$busqueda%' OR c.telefono_celular LIKE '%$busqueda%' OR c.email_cliente LIKE '%$busqueda%')  AND t.idStatus = 94576 ORDER BY t.fecha DESC   LIMIT $inicio, $regpagina";
                                        $estatus ='<input type="hidden" name="estatus" value="resolved" id="estatus"/>';
                                        echo $estatus;    $mio= true;
                                     }
                                      elseif($where=="myticket"){
                                        $consulta = "SELECT SQL_CALC_FOUND_ROWS t.id, t.fecha, t.serie, t.asunto,t.mensaje, t.solucion, c.nombre_completo AS nombre_usuario, c.email_cliente, c.telefono_celular , d.nombre AS departamento, e.Nombre AS estado_ticket,t.fecha_actualizacion FROM ticket t INNER JOIN departamento d ON t.idDepartamento = d.idDepartamento INNER JOIN estatus e ON t.idStatus=e.idEstatus INNER JOIN cliente c ON t.idUsuario = c.id_cliente WHERE (t.id LIKE '%$busqueda%' OR t.fecha LIKE '%$busqueda%' OR t.serie LIKE '%$busqueda%' OR t.asunto LIKE '%$busqueda%' OR t.mensaje LIKE '%$busqueda%' OR t.solucion LIKE '%$busqueda%' OR c.nombre_completo LIKE '%$busqueda%' OR d.nombre LIKE '%$busqueda%' OR e.Nombre LIKE '%$busqueda%' OR t.fecha_actualizacion LIKE '%$busqueda%' OR c.telefono_celular LIKE '%$busqueda%' OR c.email_cliente LIKE '%$busqueda%')  AND t.id_atiende = $user ORDER BY t.fecha DESC   LIMIT $inicio, $regpagina";
                                        $estatus ='<input type="hidden" name="estatus" value="myticket" id="estatus"/>';
                                        echo $estatus;    $mio= true;
                                    }
                                    elseif($_GET['ticket']=="created"){
                                        $consulta = "SELECT SQL_CALC_FOUND_ROWS t.id, t.fecha, t.serie, t.asunto,t.mensaje, t.solucion, c.nombre_completo AS nombre_usuario, c.email_cliente, c.telefono_celular , d.nombre AS departamento, e.Nombre AS estado_ticket,t.fecha_actualizacion FROM ticket t INNER JOIN departamento d ON t.idDepartamento = d.idDepartamento INNER JOIN estatus e ON t.idStatus=e.idEstatus INNER JOIN cliente c ON t.idUsuario = c.id_cliente WHERE (t.id LIKE '%$busqueda%' OR t.fecha LIKE '%$busqueda%' OR t.serie LIKE '%$busqueda%' OR t.asunto LIKE '%$busqueda%' OR t.mensaje LIKE '%$busqueda%' OR t.solucion LIKE '%$busqueda%' OR c.nombre_completo LIKE '%$busqueda%' OR d.nombre LIKE '%$busqueda%' OR e.Nombre LIKE '%$busqueda%' OR t.fecha_actualizacion LIKE '%$busqueda%' OR c.telefono_celular LIKE '%$busqueda%' OR c.email_cliente LIKE '%$busqueda%')  AND t.idUsuario = $user ORDER BY t.fecha DESC   LIMIT $inicio, $regpagina";
                                        $estatus= '<input type="hidden" name="estatus" value="created" id="estatus"/>';
                                        echo $estatus;    $mio= false;
                                    }
                                
                                     
                                }else{
                                    $consulta="SELECT SQL_CALC_FOUND_ROWS  t.id, t.fecha, t.serie , t.asunto, t.mensaje, t.solucion,c.telefono_celular , c.nombre_completo as nombre_usuario,c.email_cliente, d.nombre as departamento , e.Nombre as estado_ticket FROM ticket t INNER JOIN estatus e ON t.idStatus = e.idEstatus INNER JOIN cliente c ON c.id_cliente = t.idUsuario INNER JOIN departamento d ON t.idDepartamento = d.idDepartamento  ORDER BY t.fecha DESC LIMIT $inicio, $regpagina";
                                    $mio= true;
                                }


                                $selticket=mysqli_query($mysqli,$consulta);
                                $totalregistros = mysqli_query($mysqli,"SELECT FOUND_ROWS()");
                                $totalregistros = mysqli_fetch_array($totalregistros, MYSQLI_ASSOC);
                                  $encontrados = mysqli_num_rows($selticket);
                                $numeropaginas = ceil($totalregistros["FOUND_ROWS()"]/$regpagina);
                                if(mysqli_num_rows($selticket)>0):

                              
    
                            ?>
                            <div class="col-sm-10">
                                 <p class="lead text-info"><strong><?php echo $encontrados;?></strong> registros coinciden con tu busqueda</p>
                            </div>
                            <table id="tabla" class="table table-hover table-striped table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="text-center"></th>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Fecha</th>
                                        <th class="text-center">Serie</th>
                                        <th class="text-center">Estado</th>
                                        <th class="text-center">Usuario</th>
                                        <th class="text-center">Email usuario</th>
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
                                       <td class="text-center"> <input  form="acciones" type="checkbox" name="Tickets[]"  value="<?php  echo $row['id'];?>" /></td>    
                                        <td class="text-center"><?php echo $ct; ?></td>
                                        <td class="text-center"><?php echo $row['fecha']; ?></td>
                                        <td class="text-center"><?php echo $row['serie']; ?></td>
                                        <td class="text-center"><?php echo $row['estado_ticket']; ?></td>
                                        <td class="text-center"><?php echo $row['nombre_usuario']; ?></td>
                                        <td class="text-center"><?php echo $row['email_cliente']; ?></td>
                                        <td class="text-center"><?php echo $row['telefono_celular']; ?></td>
                                        <td class="text-center"><?php echo $row['departamento']; ?></td>
                                        <td style= "display:none" class="text-center"><?php echo $row['id'];?></td>
                                        <td class="text-center">
                                            <a href="./lib/pdf.php?id_del=<?php echo $row['serie']; ?>" class="btn btn-sm btn-success" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>
                                            <?php if($mio==true){?>  <a href="admin.php?view=ticketedit&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a> <?php }?>
                                                <!-- Aqui hay un problema, de 11-02-2023 resolver lunes -->
                                                <button type="button" data-toggle='modal'   data-target='#pregunta' type="button" class="dropbtn btn btn-sm btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button>                                                                        
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
                            <form id="acciones" method="POST" action="../TICKET/admin/accionesTicket-view.php">
                              <input type="hidden" name="nombre" value="<?php echo $_SESSION['nombre'] ;?>"/>
                              <input type="hidden" name="rol"value="<?php echo $_SESSION['rol'];?>"/>
                              <input type="hidden" name="id" value="<?php echo $_SESSION['id'];?>"/>
                            </form>
                            <?php else: ?>
                                <h2 class="text-center">No hay tickets que coincidan con tu búsqueda </h2>
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
                                           <?php echo '<a onclick="NextPage(' . $pag = $pagina-1 .');"  id="page' . $pagina . ' "href="javascript:void()" aria-label="Previous">';?>
                                        
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                        
                                
                                <?php
                                    for($i=1; $i <= $numeropaginas; $i++ ){
                                        if($pagina == $i){
                                            echo '<li class="active"><a   onclick="NextPage(' .$i .');" type="button" id="page' . $i . ' "href="javascript:void()">'.$i.'</a></li>';
                                                echo '<input   type="hidden"  id="pagina' . $i .'" value="' . $i . '" />' ;
                                        }else{
                                            echo '<li><a  onclick="NextPage(' .$i .');" type="button" id="page' . $i . '" href="javascript:void()">'.$i.'</a></li>';
                                            echo '<input type="hidden" id="pagina' . $i . '" value="' . $i . '" />' ;
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
                                    <?php echo '<a onclick="NextPage(' . $pag = $pagina+1 .');"  id="page' . $pagina . ' "href="javascript:void()" aria-label="Previous">';?>
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
}

else{
?>
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <img src="./img/Stop.png" alt="Image" class="img-responsive animated slideInDown"/><br>
                    <img src="./img/Transp_Alcomex.png" alt="Image" class="img-responsive"/>
                    
                </div>
                <div class="col-sm-7 animated flip">
                    <h1 class="text-danger">Lo sentimos esta página es solamente para administradores de Alcomex</h1>
                    <h3 class="text-info text-center">Inicia sesión como administrador para poder acceder</h3>
                </div>
                <div class="col-sm-1">&nbsp;</div>
            </div>
        </div>
<?php
}
?>


                                                      
<!-- MODAL PARA ELIMINAR -->
<div class="modal fade" id="pregunta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                               <div class="modal-content">
                                               <div style="text-align:center; background: #fb5d14; color:white;" class="modal-header">
                                                   <h3 class="modal-title" id="exampleModalLabel">¿Estás seguro de que deseas elminar este ticket(Todo lo que este relacionado a él se eliminara de forma permanente)?</h3>
                                               
                                               </div>
                                               <div class="modal-body">
                                                   
                                               </div>
                                               <div style="align-items:center; justify-content:center;"class="modal-footer">
                                                   <center>
                                                   <form id="formularios" action="" method="POST" style="display: inline-block;">                                             
                           
                                                      <input  type="hidden" name="id_dele"  id="borrar_id" >       
                                                       <button     type="submit"  class="btn btn-success">SI</button>
                                                      <button type="button" class="btn btn-danger" data-dismiss="modal">CANCELAR</button>
                                                   </form>                        
                                                   </center>
                                               </div>
                                               </div>
                                           </div>    
                                       </div>


                                       

                
<script>
        $('.dropbtn').on('click',function () {
        $tr=$(this).closest("#tabla tbody tr");
       var datos=$tr.children("#tabla tbody td").map(function() {
       return $(this).text(); 
        });
       $("#borrar_id").val(datos[9]);                                           
        });

        
</script> 

 
<script>
$("#mt").click(BuscarTicket);
    function BuscarTicket(){
        //admin.php?view=ticketadmin&ticket=all
         var URL = "./admin.php?view=searchTicket&ticket=" + $("#estatus").val() + "&busqueda=" + $("#busqueda").val();   
          $.get(URL,function (datos,estado){
            $("#contenido").html(datos);
        }
        );
    }

    
function NextPage(pageId){
    var newPageId = "#pagina" + pageId; // Construir el nuevo ID de la página
    var URL2 = "./admin.php?view=searchTicket&ticket=" + $("#estatus").val() + "&busqueda=" + $("#busqueda").val() + "&pagina=" + $(newPageId).val();   
    
    $.get(URL2, function(datos, estado) {
        $("#contenido").html(datos);
    });
} 
</script>

