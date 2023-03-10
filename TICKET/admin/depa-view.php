<?php if( $_SESSION['nombre']!="" && $_SESSION['clave']!="" && $_SESSION['rol']==4046 ){ ?>
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
                if(isset($_POST['id_dele'])){
                    $id = MysqlQuery::RequestPost('id_dele');
 
                    if(MysqlQuery::ProcedimientoEliminarDepartamentos("Depa", "$id")){
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
                /* Todos los departamentos*/
                $num_depa_all=Mysql::consulta("SELECT DISTINCT d.idDepartamento,d.nombre,d.correo,d.descripcion, e.Nombre, c.nombre_completo, c.email_cliente FROM departamento d INNER JOIN estatus e ON d.idEstatus = e.idEstatus INNER JOIN cliente c ON d.idJefe = c.id_cliente");
                $num_total_all=mysqli_num_rows($num_depa_all);
            ?>

            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-pills nav-justified">
                            <li><a href="#"><i class="fa fa-list"></i>&nbsp;&nbsp;Todos los departamentos&nbsp;&nbsp;<span class="badge"><?php echo $num_total_all; ?></span></a></li>
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
                               
                                    $consulta= "SELECT SQL_CALC_FOUND_ROWS d.idDepartamento,d.nombre,d.correo,d.descripcion, e.Nombre, c.nombre_completo, c.email_cliente FROM departamento d INNER JOIN estatus e ON d.idEstatus = e.idEstatus INNER JOIN cliente c ON d.idJefe = c.id_cliente   ORDER BY d.nombre ASC LIMIT $inicio, $regpagina";
                         


                                $selticket=mysqli_query($mysqli,$consulta);

                                $totalregistros = mysqli_query($mysqli,"SELECT FOUND_ROWS()");
                                $totalregistros = mysqli_fetch_array($totalregistros, MYSQLI_ASSOC);
                        
                                $numeropaginas = ceil($totalregistros["FOUND_ROWS()"]/$regpagina);

                                if(mysqli_num_rows($selticket)>0):
                            ?>
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
                                        while ($row=mysqli_fetch_array($selticket, MYSQLI_ASSOC)): 
                                    ?>
                                    <tr>
                                       <td class="text-center"> <input type="checkbox" name="Depas[]" value="<?php  echo $row['idDepartamento'];?>" /></td>    
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
                           
                                                      <input  type="hidden" name="id_dele"  id="borrar_id" >       
                                                       <button     type="submit"  class="btn btn-success">SI</button>
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
                                        endwhile; 
                                    ?>

                                         <tr> 
                                           <td  class= "text-center" colspan="9"> Seleccionar : <input  type="checkbox" onclick="MarcarCheckBox(this);" />  Todos | Ninguno  </td>
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
                                        <a href="./admin.php?view=ticketadmin&ticket=<?php echo $ticketselected; ?>&pagina=<?php echo $pagina-1; ?>" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                
                                
                                <?php
                                    for($i=1; $i <= $numeropaginas; $i++ ){
                                        if($pagina == $i){
                                            echo '<li class="active"><a href="./admin.php?view=ticketadmin&ticket='.$ticketselected.'&pagina='.$i.'">'.$i.'</a></li>';
                                        }else{
                                            echo '<li><a href="./admin.php?view=ticketadmin&ticket='.$ticketselected.'&pagina='.$i.'">'.$i.'</a></li>';
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
                                        <a href="./admin.php?view=ticketadmin&ticket=<?php echo $ticketselected; ?>&pagina=<?php echo $pagina+1; ?>" aria-label="Previous">
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


                                                      




<script>
        $('.dropbtn').on('click',function () {
        $tr=$(this).closest("#tabla tbody tr");
       var datos=$tr.children("#tabla tbody tr td").map(function() {
       return $(this).text(); 
        });
       $("#borrar_id").val(datos[8]);                                           
        });

        
</script> 