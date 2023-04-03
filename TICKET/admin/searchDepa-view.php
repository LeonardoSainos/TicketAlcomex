<?php if( $_SESSION['nombre']!="" && $_SESSION['clave']!="" && $_SESSION['rol']==4046 ){ 
    
    if (isset($_GET['depa'])!=""){
        $busqueda = MysqlQuery::RequestGet('depa');     
    }
    
    
    ?>
  <div id="contenido">
    <div class="container">
          <div class="row">
            <div class="col-sm-2">
              <img src="./img/depa.png"  stlyle="max-width: 100%;"alt="Image" class="img-responsive animated tada">
            </div>
            <div class="col-sm-10">
              <p class="lead text-info">Bienvenido administrador, aqui se muestran todos los departamentos de trabajo de Alcomex los cuales podra eliminar, modificar e imprimir.</p>
            </div>
          </div>
        </div>
            <?php
               $iid= $_SESSION['id'];
            // ELIMINAR DEPARTAMENTOS
                if(isset($_POST['id_dele'])){
                    $id = MysqlQuery::RequestPost('id_dele');
                  
                    if($id!=null || $id!=""){
                                $eliminar = MysqlQuery::ProcedimientoAlmacenado("Depa", "$id");
                                $idM = $_SESSION['id'];                            
                                MysqlQuery::ProcedimientoAlmacenado("registro_alteracionesCliente","$idM,'Eliminar','".date("Y-m-d H:i:s") ."','departamento'");
                                
                        echo '
                            <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <h4 class="text-center">DEPARTAMENTO ELIMINADO</h4>
                                <p class="text-center">
                                    El departamento fue eliminado del sistema con éxito
                                </p>
                            </div>
                        ';
                    }
                    else{
                        echo '
                            <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                                <p class="text-center">
                                    No hemos podido eliminar el departamento
                                </p>
                            </div>
                        '; 
                    }
                }

                //AÑADIR NUEVO DEPARTAMENTO

                else if(isset($_POST['Gnombre']) && isset($_POST['Gcorreo']) && isset($_POST['Gdescripcion'])){
                    $Gnombre = MysqlQuery:: RequestPost('Gnombre');
                    $Gcorreo = MysqlQuery :: RequestPost('Gcorreo');
                    $Gdescripcion = MysqlQuery:: RequestPost('Gdescripcion');
                    $Gestatus = MysqlQuery :: RequestPost('Gestatus');
                    $Glider = MysqlQuery :: RequestPost('Glider');

                    $Existe = Mysql::consulta("SELECT * FROM departamento WHERE correo = '" . $Gcorreo . "' OR nombre = '" . $Gnombre . "'");
                    if(mysqli_num_rows($Existe)<=0){
                        if(MysqlQuery :: Guardar("departamento","nombre,correo,descripcion,idEstatus,idJefe","'$Gnombre','$Gcorreo','$Gdescripcion',$Gestatus, $Glider")){
                            MysqlQuery::ProcedimientoAlmacenado("registro_alteracionesCliente","$iid,'Insertar','".date("Y-m-d H:i:s") ."','departamento'");

                     
                            echo '
                            <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <h4 class="text-center">REGISTRO EXITOSO</h4>
                                <p class="text-center">
                                    Departamento creado correctamente.
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
                                Este correo o departamento ya han sido registrados.
                            </p>
                        </div>
                    '; 

                    }

                }
                /* Todos los departamentos*/
                $num_depa_all=Mysql::consulta("SELECT DISTINCT d.idDepartamento,d.nombre,d.correo,d.descripcion, e.Nombre, c.nombre_completo, c.email_cliente FROM departamento d INNER JOIN estatus e ON d.idEstatus = e.idEstatus INNER JOIN cliente c ON d.idJefe = c.id_cliente");
                $num_total_all=mysqli_num_rows($num_depa_all);
            ?>
             <div class="container"><br><br>
                            <div class='btn-group'>
                                 <button class='btn dropdown-toggle btn-warning' data-toggle='dropdown' value='Más'>Más<span class='caret'></span></button>
                                   <ul class='dropdown-menu'>
                                           <li class=><span style='margin-left:22px'class='glyphicon glyphicon-lock'></span>  <input class="btn btn-link" style='text-decoration:none;' type="button" data-toggle='modal' data-target='#modal1' value="Nuevo"> </li>
                                       <li class=><span style='margin-left:22px;'class='glyphicon glyphicon-trash'></span> <input form="acciones" class='btn btn-link ' style='text-decoration:none;'type='submit' value='Eliminar' name="Eliminar"></li>                                                                                                  
                                   </ul>
                            </div>
                            <div style="display:flex; float:right;">
                                   <input  style="width: 80%; float:left;" value="<?php echo $busqueda; ?>" name="busqueda" id="busqueda" placeholder="Buscar tickets" name="busqueda" value="" class="form-control mr-sm-2 alin" type="text">
                                   <a id="mt" href="javascript:void()" style="float:right;" placeholder="Buscar" class="btn btn-warning" type="submit"><span class="glyphicon glyphicon-search"></span></a>       
                             </div>
                                       
                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-pills nav-justified">
                            <li><a href="./admin.php?view=depa"><i class="fa fa-list"></i>&nbsp;&nbsp;Todos los departamentos&nbsp;&nbsp;<span class="badge"><?php echo $num_total_all; ?></span></a></li>
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
                                $consulta= "SELECT SQL_CALC_FOUND_ROWS d.idDepartamento,d.nombre,d.correo,d.descripcion,e.Nombre,c.nombre_completo,d.fecha, c.email_cliente FROM departamento d INNER JOIN cliente c ON d.idJefe = c.id_cliente INNER JOIN estatus e ON e.idEstatus = d.idEstatus WHERE (d.idDepartamento LIKE '%$busqueda%' OR d.nombre LIKE '%$busqueda%' OR  d.correo  LIKE '%$busqueda%' OR  d.descripcion  LIKE '%$busqueda%' OR  e.Nombre  LIKE '%$busqueda%' OR  c.nombre_completo  LIKE '%$busqueda%' OR  c.email_cliente  LIKE '%$busqueda%' OR  c.telefono_celular  LIKE '%$busqueda%' OR  d.fecha  LIKE '%$busqueda%' ) ORDER BY d.nombre DESC LIMIT  $inicio, $regpagina";
                                $seldepa=mysqli_query($mysqli,$consulta);
                                $totalregistros = mysqli_query($mysqli,"SELECT FOUND_ROWS()");
                                $totalregistros = mysqli_fetch_array($totalregistros, MYSQLI_ASSOC);
                                $encontrados = mysqli_num_rows($seldepa);
                                $numeropaginas = ceil($totalregistros["FOUND_ROWS()"]/$regpagina);

                                if(mysqli_num_rows($seldepa)>0):
                            ?>
                              <div class="col-sm-10">
                                 <p class="lead text-info"><strong><?php echo $encontrados;?></strong> registros coinciden con tu busqueda</p>
                            </div>
                            <table id="tabla" class="table table-hover table-striped table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="text-center"></th>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Nombre</th>
                                        <th class="text-center">Correo</th>
                                        <th class="text-center">Descripción</th>
                                        <th class="text-center">Estatus</th>
                                        <th class="text-center">Líder</th>
                                        <th class="text-center">Contacto líder</th>        
                                        <th class="text-center">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $ct=$inicio+1;
                                        while ($row=mysqli_fetch_array($seldepa, MYSQLI_ASSOC)): 
                                    ?>
                                    <tr>
                                       <td class="text-center"> <input type="checkbox" form="acciones" name="Depas[]" value="<?php  echo $row['idDepartamento'];?>" /></td>    
                                        <td class="text-center"><?php echo $ct; ?></td>
                                        <td class="text-center"><?php echo $row['nombre']; ?></td>
                                        <td class="text-center"><?php echo $row['correo']; ?></td>
                                        <td class="text-center"><?php echo $row['descripcion']; ?></td>
                                        <td class="text-center"><?php echo $row['Nombre']; ?></td>          
                                        <td class="text-center"><?php echo $row['nombre_completo']; ?></td>
                                        <td class="text-center"><?php echo $row['email_cliente']; ?></td>  
                                        <td style="display:none"  ><?php echo $row['idDepartamento']; ?></td>  
                                        <td class="text-center">
                                            <a href="admin.php?view=depaedit&id=<?php echo $row['idDepartamento']; ?>" class="btn btn-sm btn-success"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                             <!-- Aqui hay un problema, de 11-02-2023 resolver lunes -->
                                             <button type="button" data-toggle='modal'   data-target='#pregunta' type="button" class="dropbtn btn btn-sm btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button>                                    
                                       
                                       
                                        </td>
                                    </tr>
                                    <?php
                                        $ct++;
                                        endwhile; 
                                    ?>

                                         <tr> 
                                           <td  class= "text-center" colspan="9"> Seleccionar : <input form="acciones"  type="checkbox" onclick="MarcarCheckBox(this);" />  Todos | Ninguno  </td>
                                        </tr>
                                </tbody>
                            </table>
                            <form id="acciones" method="POST" action="../TICKET/admin/accionesDepartamento-view.php">
                              <input type="hidden" name="nombre" value="<?php echo $_SESSION['nombre'] ;?>"/>
                              <input type="hidden" name="rol"value="<?php echo $_SESSION['rol'];?>"/>
                              <input type="hidden" name="id" value="<?php echo $_SESSION['id'];?>"/>
                              </form>
                            
                            <?php else: ?>
                                <h2 class="text-center">No hay departamentos registrados en el sistema</h2>
                            <?php endif; ?>
                        </div>
                        <?php 
                            if($numeropaginas>=1):
                            if(isset($_GET['depa'])){
                                $ticketselected=$_GET['depa'];
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
                                        <a href="./admin.php?view=depa&depa=<?php echo $ticketselected; ?>&pagina=<?php echo $pagina-1; ?>" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                
                                
                                <?php
                                    for($i=1; $i <= $numeropaginas; $i++ ){
                                        if($pagina == $i){
                                            echo '<li class="active"><a href="./admin.php?view=depa&depa='.$ticketselected.'&pagina='.$i.'">'.$i.'</a></li>';
                                        }else{
                                            echo '<li><a href="./admin.php?view=depa&depa='.$ticketselected.'&pagina='.$i.'">'.$i.'</a></li>';
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
                                        <a href="./admin.php?view=depa&depa=<?php echo $ticketselected; ?>&pagina=<?php echo $pagina+1; ?>" aria-label="Previous">
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
                    <h1 class="text-danger">Lo sentimos esta página es solamente para administradores de Alcomex</h1>
                    <h3 class="text-info text-center">Inicia sesión como administrador para poder acceder</h3>
                </div>
                <div class="col-sm-1">&nbsp;</div>
            </div>
        </div>
<?php
}
?>
                                                
<!-- Modal para insertar -->
<div class="container">
                            <div class="modal" tabindex="-1" id="modal1" >
                                <div class="modal-dialog modal-xlg  modal-dialog-centered">
                                    <div class="modal-content">
                                    <div class="modal-header" style="background: black; text-align:center;">
                                        <button class="close" data-dismiss="modal">&times;</button>
                                          <h1 style="color: white;">Agregar nuevo departamento</h1>
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
                                                      <br> <br>  <br>
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
                                                    <label class="col-sm-2 control-label">Descripción:</label>
                                                      <div class='col-sm-10'>
                                                        <div class="input-group">
                                                           <input  REQUIRED  class="formu form-control" type="text" name="Gdescripcion" placeholder="Descripción" maxlength="150">
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
                                                                <?php $E=Mysql::consulta("SELECT * FROM estatus WHERE ((idEstatus = 31448 OR idEstatus = 94573 ) OR   (idEstatus = 19231 OR idEstatus =  25542 ) ) ORDER BY Nombre");
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
                                                    <label class="col-sm-2 control-label">Encargado:</label>
                                                      <div class='col-sm-10'>
                                                        <div class="input-group">
                                                                    <?php $E=Mysql::consulta("SELECT * FROM cliente WHERE idEstatus<> 25542 ORDER BY nombre_completo ");
                                                                    echo "
                                                                        
                                                                    <select REQUIRED  class='formu form-control'name='Glider'>";
                                                                    if ($E) {
                                                                        while ($EST=mysqli_fetch_array($E,MYSQLI_ASSOC)) {
                                                                            echo"  <option value=" .$EST['id_cliente']. ">" .$EST['nombre_completo']. "</option>";
                                                                        }
                                                                    }
                                                                    echo "</select>"
                                                                    ?>
                                                               <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                                            </div>
                                                      </div>
                                                </div>
                                                      <br><br>
                                                 <br><br>
                                                
                                                <!--id_usuario	id_estatus	id_rol	nombre	apellidos	id_departamento	contraseña	correo	id_zona	fecha_creacion	fecha_actualizacion	
  -->                                      <div class="modal-footer">

                                                    
                                                  <input class="btn btn-warning" type="submit" value="Crear departamento">
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

<!--MODAL PARA ELIMINAR -->
<div class="modal fade" id="pregunta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                               <div class="modal-content">
                                               <div style="text-align:center; background: #fb5d14; color:white;" class="modal-header">
                                                   <h3 class="modal-title" id="exampleModalLabel">¿Estás seguro de que deseas elminar este Departamento(Todo lo que este relacionado a él se eliminara de forma permanente)?</h3>
                                               
                                               </div>
                                               <div class="modal-body">
                                                   
                                               </div>
                                               <div style="align-items:center; justify-content:center;"class="modal-footer">
                                                   <center>
                                                   <form id="formularios" action="" method="POST" style="display: inline-block;">                                             
                                                      <input form="formularios" type="hidden" name="id_dele"  id="borrar_id" >       
                                                       <button form="formularios"    type="submit"  class="btn btn-success">SI</button>
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
       var datos=$tr.children("#tabla tbody tr td").map(function() {
       return $(this).text(); 
        });
       $("#borrar_id").val(datos[8]);                                           
        });
       
</script> 





<script src= "/TICKET/js/jquery-2.1.0.min.js"></script>
 
<script>
$("#mt").click(BuscarDepartamento);
    function BuscarDepartamento(){
        //admin.php?view=ticketadmin&ticket=all
         var URL = "./admin.php?view=searchDepa&depa=" + $("#busqueda").val();   
        alert(URL);             
        $.get(URL,function (datos,estado){
            $("#contenido").html(datos);
        }
        );
    }
</script>