<?php if($_SESSION['nombre']!="" && $_SESSION['rol']==5267){ ?>    
        <?php
            $iid= $_SESSION['id'];
                 
            if (isset($_GET['admin'])) {
                $busqueda = MysqlQuery::RequestGet('admin');
                $where ='admin';
                $rol=4046;  
            }else if(isset($_GET['tec'])){
                $busqueda = MysqlQuery::RequestGet('tec');
                $rol=5267;  
                $where='tec';
            }else if(isset($_GET['users'])){
                $busqueda = MysqlQuery::RequestGet('users');
                $where = 'users';
                $rol=9947;  

            }
          
        
            //ELIMINAR USUARIO
            if(isset($_POST['id_dele'])){
                $id_user=MysqlQuery::RequestPost('id_dele');
                        $iproc= Mysql::consulta("SELECT * FROM cliente WHERE email_cliente = '" .$id_user . "'");
                         $iproc2 = mysqli_fetch_array($iproc, MYSQLI_ASSOC);
                         $idBorrar = $iproc2['id_cliente'];   
                          // $eliminar= "email_cliente='$id_user'";                               
                            $cr = Mysql:: consulta(" SELECT * FROM ticket WHERE idUsuario = $idBorrar");
                            $creados = mysqli_num_rows($cr);
                            $re= Mysql:: consulta(" SELECT * FROM ticket WHERE id_Atiende = $idBorrar AND idStatus = 94576");
                            $resueltos= mysqli_num_rows($re); 
                            $pen= Mysql:: consulta  ("SELECT * FROM ticket WHERE id_Atiende = $idBorrar AND idStatus = 94574 ");
                            $pendientes = mysqli_num_rows($pen);
                            $pro = Mysql:: consulta ("SELECT * FROM  ticket WHERE id_Atiende = $idBorrar AND idStatus = 94575");
                            $proceso = mysqli_num_rows($pro);
      
                if(MysqlQuery::ProcedimientoAlmacenado("EliminarUsuario","$idBorrar,'". date("Y-m-d")  ."','" . date("Y-m-d") . "',$pendientes, $creados, $resueltos, $proceso")){
                    MysqlQuery::ProcedimientoAlmacenado("registro_alteracionesCliente","$iid,'EliminarU','".date("Y-m-d H:i:s") ."','cliente'");
                    MysqlQuery::ProcedimientoAlmacenado("registro_alteracionesCliente","$iid,'EliminarU','".date("Y-m-d H:i:s") ."','ticket'");
                    MysqlQuery::ProcedimientoAlmacenado("registro_alteracionesCliente","$iid,'EliminarU','".date("Y-m-d H:i:s") ."','departamento'");
                  
                    echo '
                        <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="text-center">ADMINISTRADOR ELIMINADO</h4>
                            <p class="text-center">
                                El administrador fue eliminado del sistema con exito
                            </p>
                        </div>
                    ';
                }else{
                    echo '
                        <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                            <p class="text-center">
                                No hemos podido eliminar el administrador
                            </p>
                        </div>
                    ';
                } 
            }

            // GUARDAR NUEVO USUARIO 
        
              else if(isset($_POST['Gnombre']) && isset($_POST['Gapellidos']) && isset($_POST['Gcorreo'] )){
                $N = MysqlQuery :: RequestPost('Gnombre');
                $A = MysqlQuery :: RequestPost('Gapellidos');
                $Ncompleto = $N . " " . $A;
                $Gcorreo = MysqlQuery :: RequestPost('Gcorreo');
                $Departamento = MysqlQuery :: RequestPost('Gdepartamento');
                $Rol = MysqlQuery :: RequestPost('Grol');
                $Estatus = MysqlQuery :: RequestPost('Gestatus');
                $Telefono = MysqlQuery :: RequestPost('Gtelefono');
                $Gusuario = Mysqlquery:: RequestPost('Gusuario');
                $Verificar = Mysql::consulta("SELECT * FROM cliente WHERE email_cliente = '" . $Gcorreo ."' OR telefono_celular = ' " . $Telefono  . "'");
                if(mysqli_num_rows($Verificar)<=0){
                    if(MysqlQuery::Guardar("cliente", "nombre_completo, nombre_usuario, email_cliente,id_departamento,id_rol,idEstatus,telefono_celular", "'$Ncompleto', '$Gusuario', '$Gcorreo',$Departamento, $Rol,$Estatus,' $Telefono'"))
                    {
                        MysqlQuery::ProcedimientoAlmacenado("registro_alteracionesCliente","$iid,'Insertar','".date("Y-m-d H:i:s") ."','cliente'");
                        echo '
                        <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="text-center">REGISTRO EXITOSO</h4>
                            <p class="text-center">
                                Cuenta creada exitosamente, resetea la contraseña del usuario para que posteriormente se le notifique que ya puede iniciar sesión.
                            </p>
                        </div>
                    ';
                    }
                }
                else{
                    echo '
                    <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                        <p class="text-center">
                        Este correo o número de teléfono ya han sido registrados.
                        </p>
                    </div>
                '; 
                  }

            }

            $idA=$_SESSION['id'];
            /* Todos los admins*/
            $num_admin=Mysql::consulta("SELECT * FROM cliente WHERE id_rol= 4046");
            $num_total_admin = mysqli_num_rows($num_admin);

            /* Todos los users*/
            $num_user=Mysql::consulta("SELECT * FROM cliente WHERE id_rol = 9947");
            $num_total_user = mysqli_num_rows($num_user);

            /*Todos los tecnicos */ 
            $num_tec=Mysql::consulta("SELECT * FROM cliente WHERE id_rol =5267");
            $num_total_tec = mysqli_num_rows($num_tec);

        ?>
        <div  id="contenido">
        <div class="container" >
       
          <div class="row">
            <div class="col-sm-2">
                <img src="./img/card_identy.png" alt="Image" class="img-responsive animated flipInY">
            </div>
            <div class="col-sm-10">
              <p class="lead text-info">Bienvenido técnico, en esta página se muestran todos los <strong>Usuarios </strong> registrados en soporte técnico Alcomex, usted podra eliminarlos si lo desea.</p>
            </div>
          </div>
        </div> 
        <br><br>
        <div   class="container">
                                      <div class='btn-group'>
                                                <button class='btn dropdown-toggle btn-warning' data-toggle='dropdown' value='Más'>
                                                    Más
                                                <span class='caret'></span>
                                                </button>                                                
                                                   <ul class='dropdown-menu'>
                                                <!-- dropdown menu links -->
                                                        <li class=><span style='margin-left:22px'class='glyphicon glyphicon-user'></span>  <input class="btn btn-link" style='text-decoration:none;' type="button" data-toggle='modal' data-target='#modal1' value="Nuevo usuario"> </li>
                                                        <li class=><span style='margin-left:22px;'class='glyphicon glyphicon-trash'></span> <input  form="acciones" class='btn btn-link ' style='text-decoration:none;'type='submit' value='Eliminar' name="Eliminar"></li>
                                                        <li class=><span style='margin-left:22px;'class='glyphicon glyphicon-ban-circle'></span> <input   form="acciones" class='btn btn-link ' style='text-decoration:none;'type='submit' value='Bloquear' name="Bloquear"></li>
                                                        <li class=><span style='margin-left:22px;'class='glyphicon glyphicon-refresh'></span> <input   form="acciones" class='btn btn-link ' style='text-decoration:none;'type='submit' value='Desbloquear' name="Desbloquear"></li>
                                                        <li class=><a href='' class='btn btn-link '   > <span class='glyphicon glyphicon-log-in'></span><input  form="acciones" class='btn btn-link ' style='text-decoration:none;'  type="submit" value=" Resetear contraseña" name="Resetear"  /> </a></li>  
                                                    </ul>                                                                                    
                                               
                                          </div>
                                          <div style="display:flex; float:right;">
                                                   <input id="busqueda" style="width: 80%; float:left;" placeholder="Buscar usuarios" id="search" name="busqueda" value="<?php echo $busqueda; ?>" class="form-control mr-sm-2 alin" type="text">
                                                   <input id="where" type="hidden" name="where" value="<?php echo $where;?>">
                                                   <a id="mt" href="javascript:void()" style="float:right;"placeholder="Buscar"class="btn btn-warning" type="submit"><span class="glyphicon glyphicon-search"></span></a>      
                                           </div>
                                          <br><br>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <ul class="nav nav-pills nav-justified">
                            <li><a href="./tecni.php?view=users"><i class="fa fa-users"></i>&nbsp;&nbsp;Usuarios&nbsp;&nbsp;<span class="badge"><?php echo $num_total_user; ?></span></a></li>
                            <li><a href="./tecni.php?view=tec"><i class="fa fa-male"></i>&nbsp;&nbsp;Técnicos&nbsp;&nbsp;<span class="badge"><?php echo $num_total_tec; ?></span></a></li>
                        </ul>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div  class="table-responsive">
                            <?php 
                                $mysqli = mysqli_connect(SERVER, USER, PASS, BD);
                                mysqli_set_charset($mysqli, "utf8");
                                $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
                                $regpagina = 15;
                                $inicio = ($pagina > 1) ? (($pagina * $regpagina) - $regpagina) : 0;
                                $seladmin= mysqli_query($mysqli,"SELECT SQL_CALC_FOUND_ROWS c.id_cliente,c.nombre_completo, c.nombre_usuario, c.email_cliente, d.nombre as Depa, r.Nombre, c.telefono_celular as celular, c.Fecha_creacion, e.Nombre as Esta FROM cliente c INNER JOIN departamento d ON c.id_departamento = d.idDepartamento INNER JOIN estatus e ON e.idEstatus = c.idEstatus INNER JOIN rol r ON c.id_rol = r.idRol WHERE (c.id_cliente LIKE '%$busqueda%' OR c.nombre_usuario LIKE '%$busqueda%' OR c.nombre_completo LIKE '%$busqueda%' OR c.email_cliente LIKE '%$busqueda%' OR c.telefono_celular LIKE '%$busqueda%' OR c.Fecha_creacion LIKE '%$busqueda%' OR d.nombre LIKE '%$busqueda%' OR r.Nombre LIKE '%$busqueda%' OR e.Nombre LIKE '%$busqueda%' ) AND id_rol = $rol LIMIT $inicio,$regpagina");
                                $totalregistros = mysqli_query($mysqli,"SELECT FOUND_ROWS()");
                                $totalregistros = mysqli_fetch_array($totalregistros, MYSQLI_ASSOC);

                                $encontrados = mysqli_num_rows($seladmin);
                                $numeropaginas = ceil($totalregistros["FOUND_ROWS()"]/$regpagina);
                                if(mysqli_num_rows($seladmin)>0):
                               
                            ?>
                              <form id="acciones" method="POST" action="../TICKET/admin/acciones-view.php">
                            <input type="hidden" name="nombre" value="<?php echo $_SESSION['nombre'] ;?>"/>
                            <input type="hidden" name="rol"value="<?php echo $_SESSION['rol'];?>"/>
                            <input type="hidden" name="id" value="<?php echo $_SESSION['id'];?>"/>
                            <div class="col-sm-10">
                                 <p class="lead text-info"><strong><?php echo $encontrados;?></strong> registros coinciden con tu busqueda</p>
                            </div>
                            <table id="tabla" class="table table-hover table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Nombre completo</th>
                                        <th class="text-center">Nombre de usuario</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Departamento</th>
                                        <th class="text-center">Estatus</th>
                                        <th class="text-center">Teléfono </th>
                                        <th class="text-center">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $ct=$inicio+1;
                                        while ($row=mysqli_fetch_array($seladmin, MYSQLI_ASSOC)): 
                                    ?>
                                    <tr>
                                        <td class="text-center"><input type="checkbox" name="Usuarios[]" value="<?php echo $row['id_cliente']; ?>"></td>
                                        <td class="text-center"><?php echo $ct; ?></td>
                                        <td class="text-center"><?php echo $row['nombre_completo']; ?></td>
                                        <td class="text-center"><?php echo $row['nombre_usuario']; ?></td>
                                        <td class="text-center"><?php echo $row['email_cliente']; ?></td>
                                        <td class="text-center"><?php echo $row['Depa']; ?> </td>
                                        <td class="text-center"><?php echo $row['Esta'];?> </td>
                                        <td class="text-center"><?php echo $row['celular'];?> </td>
                                        <td class="text-center">
                                                  <!-- Aqui hay un problema, de 11-02-2023 resolver lunes -->
                                                  <a href="tecni.php?view=useredit&id=<?php echo $row['id_cliente']; ?>" class="btn btn-sm btn-success"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                      
                                                  <button type="button" data-toggle='modal'   data-target='#pregunta' type="button" class=" dropbtn btn btn-sm btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button>                                    
                                       
                                                  
                                        </td>
                                    </tr>
                                    <?php
                                        $ct++;
                                        endwhile; 
                                    ?>
                                    <tr>
                                        <td class="text-center"  colspan="9"> Seleccionar :<input onclick="MarcarCheckBox(this);"  type="checkbox" /> Todos | Ninguno </td>
                                    </tr>
                                </tbody>
                            </table>
                              </form>
                            <?php else: ?>
                                <h2 class="text-center">No hay registros que coincidan con tu busqueda</h2>
                            <?php endif; ?>
                        </div>
                        <?php if($numeropaginas>=1): ?>
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
                                        <a href="./tecni.php?view=admin&pagina=<?php echo $pagina-1; ?>" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                
                    
                                <?php
                                    for($i=1; $i <= $numeropaginas; $i++ ){
                                        if($pagina == $i){
                                            echo '<li class="active"><a href="./tecni.php?view=admin&pagina='.$i.'">'.$i.'</a></li>';
                                        }else{
                                            echo '<li><a href="./tecni.php?view=admin&pagina='.$i.'">'.$i.'</a></li>';
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
                                        <a href="./tecni.php?view=admin&pagina=<?php echo $pagina+1; ?>" aria-label="Previous">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                        <?php endif; ?>
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
                    <img src="./img/Stop.png" alt="Image" class="img-responsive animated slideInDown"/><br>
                    <img src="./img/SadTux.png" alt="Image" class="img-responsive"/>
                    
                </div>
                <div class="col-sm-7 animated flip">
                    <h1 class="text-danger">Lo sentimos esta página es solamente para técnicos de Alcomex</h1>
                    <h3 class="text-info text-center">Inicia sesión como técnico para poder acceder</h3>
                </div>
                <div class="col-sm-1">&nbsp;</div>
            </div>
        </div>
<?php
}
?>

<!-- Modal para agregar usuario -->
<div class="container">
                            <div class="modal" tabindex="-1" id="modal1" >
                                <div class="modal-dialog modal-xlg  modal-dialog-centered">
                                    <div class="modal-content">
                                    <div class="modal-header" style="background: black; text-align:center;">
                                        <button class="close" data-dismiss="modal">&times;</button>
                                          <h1 style="color: white;">Agregar  nuevo usuario</h1>
                                        </div>
                                          <div class="modal-body">
                                            <form id="add" class="formu"  action= "" method="POST">
                                                
                                                
                                                <div class="form-group">
                                               <label class="col-sm-2 control-label">Nombre:</label>
                                                      <div class='col-sm-10'>
                                                        <div class="input-group">
                                                             <input REQUIRED  class="formu form-control" type="text" name="Gnombre" placeholder="Nombre" maxlength="75">
                                                             <span class="input-group-addon"><i class="fa fa-user"></i></span>
                           
                                                        </div>
                                                      </div>
                                                </div> 
                                                <br>
                                                <br> <br>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Apellidos:</label>
                                                      <div class='col-sm-10'>
                                                        <div class="input-group">
                                                          <input REQUIRED  class=" formu form-control" type="text" name="Gapellidos" placeholder="Apellidos" maxlength="70">
                                                          <span class="input-group-addon"><i class="fa fa-user-o"></i></span>
                           
                                                        </div>
                                                      </div>
                                                </div>
                                             
                                                    <br>
                                                   <br>
                                                   <div class="form-group">
                                                    <label class="col-sm-2 control-label">Correo:</label>
                                                      <div class='col-sm-10'>
                                                        <div class="input-group">
                                                           <input  REQUIRED  class="formu form-control" type="email" name="Gcorreo" placeholder="Correo electronico" maxlength="70">
                                                           <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                           
                                                        </div>
                                                      </div>
                                                   </div>
                                                <br>
                                                <br>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Usuario:</label>
                                                      <div class='col-sm-10'>
                                                        <div class="input-group">
                                                           <input  REQUIRED  class="formu form-control" type="text" name="Gusuario" placeholder="Nombre de usuario" maxlength="70">
                                                           <span class="input-group-addon"><i class="fa fa-address-book"></i></span>
                           
                                                        </div>
                                                      </div>
                                                   </div>
                                                <br>
                                                <br>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Estatus:</label>
                                                      <div class='col-sm-10'>
                                                        <div class="input-group">
                                                <?php $E=Mysql::consulta("SELECT * FROM estatus WHERE ((idEstatus = 31448 OR idEstatus = 94573 ) OR   (idEstatus = 19231 OR idEstatus =  25542 ) ) ORDER BY Nombre ");
                                                echo "
                                            
                                                
                                                <select REQUIRED  class='formu form-control'name='Gestatus'>";
                                                if ($E) {
                                                    while ($EST=mysqli_fetch_array($E,MYSQLI_ASSOC)) {
                                                        echo"  <option value=" .$EST['idEstatus']. ">" .$EST['Nombre']. "</option>";
                                                    }
                                                }
                                                
                                                
                                                 echo "</select>"
                                                ?>
                                                  <span class="input-group-addon"><i class="fa fa-info"></i></span>
                           
                                                        </div>
                                                      </div>
                                                   </div>
                                                <br><br>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Rol:</label>
                                                      <div class='col-sm-10'>
                                                        <div class="input-group">
                                                <?php $E=Mysql::consulta("SELECT * FROM rol ");
                                                echo "
                                                   <select REQUIRED  class='formu form-control'name='Grol'>";
                                                if ($E) {
                                                    while ($EST=mysqli_fetch_array($E,MYSQLI_ASSOC)) {
                                                        echo"  <option value=" .$EST['idRol']. ">" .$EST['Nombre']. "</option>";
                                                    }
                                                }
                                                 echo "</select>"
                                                ?>
                                                          <span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
                           
                                                        </div>
                                                      </div>
                                                </div>
                                                <br>
                                                <br>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Departamento: </label>
                                                      <div class='col-sm-10'>
                                                        <div class="input-group">
                                        
                                                <?php $E=Mysql::consulta("SELECT nombre,idDepartamento From departamento");
                                                echo "
                                                    
                                                <select REQUIRED  class='formu form-control'name='Gdepartamento'>";
                                                if ($E) {
                                                    while ($EST=mysqli_fetch_array($E,MYSQLI_ASSOC)) {
                                                        echo"  <option value=" .$EST['idDepartamento']. ">" .$EST['nombre']. "</option>";
                                                    }
                                                }
                                                 echo "</select>"
                                                ?>
                                                               <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                                            </div>
                                                      </div>
                                                </div>
                                                      <br><br>
                                                   <div class="form-group">
                                                    <label class="col-sm-2 control-label">Teléfono:</label>
                                                      <div class='col-sm-10'>
                                                        <div class="input-group">
                                                              <input  REQUIRED  class="formu form-control" type="tel" name="Gtelefono" placeholder="Número de celular"  maxlength="10"/>
                                                             <span class="input-group-addon"><i class="fa fa-phone-square"></i></span>
                                                        </div>
                                                      </div>
                                                   </div><br><br>
                                                
                                                <!--id_usuario	id_estatus	id_rol	nombre	apellidos	id_departamento	contraseña	correo	id_zona	fecha_creacion	fecha_actualizacion	
  -->                                      <div class="modal-footer">

                                                    
                                                  <input class="btn btn-warning" type="submit" value="Crear usuario">
                                                <input class="btn btn-success"  onclick="funcion_reiniciar('add');"type="button" value="Restablecer">
                                                <button class="btn btn-danger" data-dismiss="modal">Cancelar </button>

                                          </div>
                                            </form>

                                        </div>
                                              
                                        </div>
                                    </div>
                                </div>
                                     <!--FIN DEL MODAL -->
                            </div>

<!--Modal para eliminar usuarios -->

<div class="modal fade" id="pregunta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog" role="document">
           <div class="modal-content">
                <div style="text-align:center; background: #fb5d14; color:white;" class="modal-header">
                     <h3 class="modal-title" id="exampleModalLabel">¿Estás seguro de que deseas elminar al usuario (Todo lo que este relacionado a él se eliminara de forma permanente)?</h3>                                                           
                 </div>
            <div class="modal-body">                                              
       </div>
       <div style="align-items:center; justify-content:center;"class="modal-footer">
                    <center>
                             <form id="formulario" action="" method="POST" style="display: inline-block;">                                                                             
                                    <input  type="hidden" name="id_dele"  id="borrar_id" >       
                                    <button   name="ide" type="submit"  class="btn btn-success">SI</button>
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
       $("#borrar_id").val(datos[4]);                                           
        });

        
</script> 

<script src= "/TICKET/js/jquery-2.1.0.min.js"></script>
 
<script>

$("#mt").click(BuscarUsuario);

    function BuscarUsuario(){
        var URL = "./tecni.php?view=searchUsers&" + $("#where").val() + "=" + $("#busqueda").val();    
                         
    
        $.get(URL,function (datos,estado){
            $("#contenido").html(datos);
        }

        );
    }


</script>