<?php if($_SESSION['nombre']!="" && $_SESSION['rol']==4046){ ?>    
        <?php 
            if(isset($_POST['id_dele'])){
                $id_user=MysqlQuery::RequestPost('id_dele');
         
                    $eliminar= "email_cliente='$id_user'";
      
                if(MysqlQuery::Eliminar("cliente", $eliminar)){
                echo '
                        <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="text-center">USUARIO ELIMINADO</h4>
                            <p class="text-center">
                                El usuario fue eliminado del sistema con exito

                                '. $eliminar .'
                            </p>
                        </div>
                    ';  
                }else{
                    echo '
                        <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                            <p class="text-center">
                                No hemos podido eliminar el usuario
                            </p>
                        </div>
                    ';
                }
            }

            $idA=$_SESSION['id'];
            /* Todos los admins*/
            $num_admin=Mysql::consulta("SELECT * FROM cliente WHERE id_rol=4046");
            $num_total_admin = mysqli_num_rows($num_admin);

            /* Todos los users*/
            $num_user=Mysql::consulta("SELECT * FROM cliente WHERE id_rol=9947");
            $num_total_user = mysqli_num_rows($num_user);
             
            /*Todos los tecnicos */ 
               $num_tec=Mysql::consulta("SELECT * FROM cliente WHERE id_rol =5267");
               $num_total_tec = mysqli_num_rows($num_tec);
   
        ?>
 
        <div class="container">
          <div class="row">
            <div class="col-sm-2">
                <img src="./img/card_identy.png" alt="Image" class="img-responsive animated flipInY">
            </div>
            <div class="col-sm-10">
              <p class="lead text-info">Bienvenido administrador, en esta página se muestran todos los usuarios  registrados en soporte técnico Alcomex, usted podra eliminarlos si lo desea.</p>
            </div>
          </div>
        </div>
        
        <br><br>
        
        <div class="container">
        <div class='btn-group'>
                                                <button class='btn dropdown-toggle btn-warning' data-toggle='dropdown' value='Más'>
                                                    Más
                                                <span class='caret'></span>
                                                </button>
                                                <ul class='dropdown-menu'>
                                                <!-- dropdown menu links -->
                                                         <li class=><span style='margin-left:22px'class='glyphicon glyphicon-user'></span>  <input class="btn btn-link" style='text-decoration:none;' type="button" data-toggle='modal' data-target='#modal1' value="Nuevo usuario"> </li>
                                                  
                                                        <li class=><span style='margin-left:22px;'class='glyphicon glyphicon-trash'></span> <input class='btn btn-link ' style='text-decoration:none;'type='submit' value='Eliminar' name="Eliminar"></li>
                                                    
                                                    
                                                          
                                                </ul>
                                                </div>
                                                <br><br>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <ul class="nav nav-pills nav-justified">
                            <li><a href="./admin.php?view=users"><i class="fa fa-users"></i>&nbsp;&nbsp;Usuarios&nbsp;&nbsp;<span class="badge"><?php echo $num_total_user; ?></span></a></li>
                            <li><a href="./admin.php?view=admin"><i class="fa fa-male"></i>&nbsp;&nbsp;Administradores&nbsp;&nbsp;<span class="badge"><?php echo $num_total_admin; ?></span></a></li>
                            <li><a href="./admin.php?view=tec"><i class="fa fa-male"></i>&nbsp;&nbsp;Técnicos&nbsp;&nbsp;<span class="badge"><?php echo $num_total_tec; ?></span></a></li>
                   
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
                                $regpagina = 15;
                                $inicio = ($pagina > 1) ? (($pagina * $regpagina) - $regpagina) : 0;

                                $selusers=mysqli_query($mysqli,"SELECT SQL_CALC_FOUND_ROWS cliente.id_cliente, cliente.telefono_celular as celular, cliente.nombre_completo,cliente.nombre_usuario,cliente.email_cliente,departamento.nombre as Depa, estatus.nombre as Esta   FROM cliente  INNER JOIN departamento  ON cliente.id_departamento = departamento.idDepartamento INNER JOIN estatus   ON estatus.idEstatus = cliente.idEstatus  where cliente.id_rol=9947  ORDER by cliente.nombre_completo LIMIT $inicio, $regpagina");
                                $totalregistros = mysqli_query($mysqli,"SELECT FOUND_ROWS()");
                                $totalregistros = mysqli_fetch_array($totalregistros, MYSQLI_ASSOC);                        
                                $numeropaginas = ceil($totalregistros["FOUND_ROWS()"]/$regpagina);
                                if(mysqli_num_rows($selusers)>0):
                            ?>
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
                                        while ($row=mysqli_fetch_array($selusers, MYSQLI_ASSOC)){
                                    ?>
                                    <tr>
                                        <td class="text-center"> <input type="checkbox" name="Usuarios[]" value="<?php  echo $row['id_cliente'];?>" /></td>
                                        <td class="text-center"><?php echo $ct; ?></td>
                                        <td class="text-center"><?php echo $row['nombre_completo']; ?></td>
                                        <td class="text-center"><?php echo $row['nombre_usuario']; ?></td>
                                        <td class="text-center"><?php echo $row['email_cliente']; ?></td>
                                        <td class="text-center"><?php echo $row['Depa']; ?> </td>
                                        <td class="text-center"><?php echo $row['Esta'];?> </td>
                                        <td class="text-center"><?php echo $row['celular'];?> </td>
                                      
                                        <td class="text-center">
                                                  <!-- Aqui hay un problema, de 11-02-2023 resolver lunes -->
                                                  <a href="admin.php?view=useredit&id=<?php echo $row['id_cliente']; ?>" class="btn btn-sm btn-success"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                      
                                                  <button type="button" data-toggle='modal'   data-target='#pregunta' type="button" class=" dropbtn btn btn-sm btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button>                                    
                                             
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


                                        </td>
                                    </tr>

                                      <?php
                                        $ct++;

                                        
                                        }
                                    ?>

                                        <tr> 
                                           <td  class= "text-center" colspan="9"> Seleccionar : <input  type="checkbox" onclick="MarcarCheckBox(this);" />  Todos | Ninguno  </td>
                                        </tr>
                                
                                </tbody>
                            </table>


                         
                            <?php else: ?>
                                <h2 class="text-center">No hay usuarios registrados en el sistema</h2>
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
                                        <a href="./admin.php?view=users&pagina=<?php echo $pagina-1; ?>" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                <?php endif; ?>                               
                                <?php
                                    for($i=1; $i <= $numeropaginas; $i++ ){
                                        if($pagina == $i){
                                            echo '<li class="active"><a href="./admin.php?view=users&pagina='.$i.'">'.$i.'</a></li>';
                                        }else{
                                            echo '<li><a href="./admin.php?view=users&pagina='.$i.'">'.$i.'</a></li>';
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
                                        <a href="./admin.php?view=users&pagina=<?php echo $pagina+1; ?>" aria-label="Previous">
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
<?php
}else{
?>
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                <img src="./img/Stop.png" alt="Image" class="img-responsive animated slideInDown"/><br>
                 
                     <img src="./img/Transp_ALCOMEX.png" alt="Image" class="img-responsive"/>
                    
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















<div class="container">
                            <div class="modal" tabindex="-1" id="modal1" >
                                <div class="modal-dialog modal-xlg  modal-dialog-centered">
                                    <div class="modal-content">
                                    <div class="modal-header" style="background: black; text-align:center;">
                                        <button class="close" data-dismiss="modal">&times;</button>
                                          <h1 style="color: white;">Agregar un nuevo usuario</h1>
                                        </div>
                                          <div class="modal-body">
                                            <form id="add"class="formu"  action= "" method="post">
                                                  <h1>Formulario para crear usuario nuevo </h1>
                                                <br>
                                                
                                                <label for="name">Nombre:</label>
                                                <input REQUIRED  class="formu form-control" type="text" name="name" placeholder="Nombre">
                                                <br>
                                                <label for="apellidos">Apellidos :</label>
                                                <input REQUIRED  class=" formu form-control" type="text" name="apellidos" placeholder="Apellidos">
                                                <br>
                                                <label for="contraseña">La contraseña se debe resetear desde la lista de usuarios para seguridad del usuario</label>
                                                   <br>
                                                   <br>
                                                <label for="correo">Correo:</label>
                                                <input  REQUIRED  class="formu form-control" type="email" name="correo" placeholder="Correo electronico">
                                                <br>
                                                <?php $E=Mysql::consulta("SELECT * FROM estatus");
                                                echo "
                                                <label for='estatus'>Estatus :</label>
                                                
                                                <select REQUIRED  class='formu form-control'name='estatus'>";
                                                if ($E) {
                                                    while ($EST=mysqli_fetch_array($E,MYSQLI_ASSOC)) {
                                                        echo"  <option value=" .$EST['idEstatus']. ">" .$EST['Nombre']. "</option>";
                                                    }
                                                }
                                                
                                                
                                                 echo "</select>"
                                                ?>
                                                <br>
                                                <?php $E=Mysql::consulta("SELECT * FROM rol ");
                                                echo "
                                                <label for='rol'>Rol:</label>
                                                
                                                <select REQUIRED  class='formu form-control'name='rol'>";
                                                if ($E) {
                                                    while ($EST=mysqli_fetch_array($E,MYSQLI_ASSOC)) {
                                                        echo"  <option value=" .$EST['idRol']. ">" .$EST['Nombre']. "</option>";
                                                    }
                                                }
                                                 echo "</select>"
                                                ?>
                                                <br>
                                                <?php $E=Mysql::consulta("SELECT nombre,idDepartamento From departamento");
                                                echo "
                                                <label for='departamento'>Departamento:</label>
                                                
                                                <select REQUIRED  class='formu form-control'name='departamento'>";
                                                if ($E) {
                                                    while ($EST=mysqli_fetch_array($E,MYSQLI_ASSOC)) {
                                                        echo"  <option value=" .$EST['idDepartamento']. ">" .$EST['nombre']. "</option>";
                                                    }
                                                }
                                                 echo "</select>"
                                                ?>
                                                
                                                   <br>
                                                   <label for="correo">Teléfono:</label>
                                                <input  REQUIRED  class="formu form-control" type="tel" name="telefono" placeholder="Número de celular" maxlenght="10"/>
                                              
                                                
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


<script>
        $('.dropbtn').on('click',function () {
        $tr=$(this).closest("#tabla tbody tr");
       var datos=$tr.children("#tabla tbody td").map(function() {
       return $(this).text(); 
        });
       $("#borrar_id").val(datos[4]);                                           
        });

        
</script> 