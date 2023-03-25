<?php if($_SESSION['nombre']!="" && $_SESSION['rol']==4046){ 

/* Guardar nuevo admin */
if(isset($_POST['nom_admin_reg']) && isset($_POST['admin_reg']) && isset($_POST['admin_clave_reg'])){

    $nom_complete_save=MysqlQuery::RequestPost('nom_admin_reg');
    $nom_usu_save=MysqlQuery::RequestPost('admin_reg');
    $pass_save=md5(MysqlQuery::RequestPost('admin_clave_reg'));
    $email_save=MysqlQuery::RequestPost('admin_email_reg');
    $estatus= MysqlQuery:: RequestPost('Estatus'); 
    $depa=MysqlQuery:: RequestPost('Departamento');
    $cel = MysqlQuery::RequestPost('Telefono');
  

   if(MysqlQuery::Guardar("cliente", "nombre_completo, nombre_usuario, clave, email_cliente, id_departamento,id_rol,idEstatus,telefono_celular", "'$nom_complete_save', '$nom_usu_save', '$pass_save', '$email_save',$depa," . 4046 ." ,$estatus,$cel")){
       echo '
            <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="text-center">ADMINISTRADOR REGISTRADO</h4>
                <p class="text-center">
                    El usuario se registro con éxito en el sistema
                </p>
            </div>
        ';
   }else{
       echo '
            <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                <p class="text-center">
                    No hemos podido registrar el administrador
                </p>
            </div>
        ';
   } 
}


    
    
   /* Actualizar cuenta admin */
   if(isset($_POST['nombre']) && isset($_POST['nombre_usuario']) && isset($_POST['email_usuario'])){
    if(MysqlQuery::RequestPost('newclave')!=""){
      $newclave=md5(MysqlQuery::RequestPost('newclave'));
    } else
    $newclave = ".";

    if(MysqlQuery::RequestPost('newclave1')!=""){
      $newclave1=md5(MysqlQuery::RequestPost('newclave1'));
    } else
    $newclave1 = "";

    $CargarName = MysqlQuery::RequestPost('nombre_usuario');
    $CargarClave =md5( MysqlQuery::RequestPost('clave'));

    $nombre=MysqlQuery::RequestPost('nombre');
    $usuario=MysqlQuery::RequestPost('nombre_usuario'); 
    $clave=md5(MysqlQuery::RequestPost('clave'));
    $email=MysqlQuery::RequestPost('email_usuario');
    $celular=MysqlQuery::RequestPost('telefono');



    $id = $_SESSION['id'];
    $todo = Mysql::Consulta("SELECT * FROM cliente where id_cliente = $id");
    $todo1 = mysqli_fetch_array($todo, MYSQLI_ASSOC);
    $cccc = $todo1['nombre_usuario'];

    $cd= Mysql:: consulta("SELECT * FROM cliente WHERE (email_cliente = '$email' OR nombre_usuario='$CargarName') AND id_cliente<>$id");
    $sql=Mysql::consulta("SELECT * FROM cliente WHERE (nombre_usuario= '$CargarName' OR  email_cliente= '$email' ) AND clave='$CargarClave'");
    if(mysqli_num_rows($sql)>0 && mysqli_num_rows($cd)<=0)
    {

   

                  if($newclave == $newclave1)
                  {
                       $cadena = "telefono_celular='$celular', nombre_completo='$nombre', nombre_usuario='$usuario', clave='$newclave', email_cliente='$email'";
                        $cadena2= "nombre_usuario='$cccc' and clave='$CargarClave'";
                       if(MysqlQuery::Actualizar("cliente", "$cadena", "$cadena2"))
                      {
                        $id = $_SESSION['id'];                            
                        if(MysqlQuery::ProcedimientoAlmacenado("registro_alteracionesCliente","$id,'Actualizar','".date("Y-m-d H:i:s") ."','cliente'"))
                   


                          
                            $_SESSION['nombre']=$usuario;
                            $_SESSION['clave']=$newclave;
                            echo '
                                <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="text-center">DATOS ACTUALIZADOS</h4>
                                    <p class="text-center">
                                        Datos y contraseña actualizados con exito
                                    </p>
                                </div>
                            ';
                      }
                      else
                      {
                        echo '
                            <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                                <p class="text-center">
                                    No hemos podido actualizar tus datos y contraseña
                                </p>
                            </div>
                        ';
                      }
                  }
                  else if( $newclave=="." && $newclave1==""){
                     if( MysqlQuery::Actualizar("cliente", "telefono_celular='$celular',nombre_completo='$nombre', nombre_usuario='$usuario',email_cliente='$email'", "nombre_usuario='$cccc' and clave='$CargarClave'"))
                     {
                      $id = $_SESSION['id'];                            
                      if(MysqlQuery::ProcedimientoAlmacenado("registro_alteracionesCliente","$id,'Actualizar','".date("Y-m-d H:i:s") ."','cliente'"))
                 
                            $_SESSION['nombre']=$usuario;
                            
                            echo '
                                <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="text-center"> ACTUALIZADO</h4>
                                    <p class="text-center">
                                     Datos actualizados con éxito
                                    </p>
                                </div>
                            ';
                      }
                      else
                      {
                        echo '
                            <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                                <p class="text-center">
                                    No hemos podido actualizar tus datos
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
                                   Las contraseñas no coinciden
                                </p>
                            </div>
                        '; 

                  }
   }
  else
  {
                echo '
                    <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                        <p class="text-center">
                        Este error puede ocurrir por las siguientes razones:  clave incorrecta o correo ya existente en el sistema 
                        </p>
                    </div>
                ';
  }
}
    /*Script para eliminar cuenta*/
     if(isset($_POST['nom_admin_delete']) && isset($_POST['admin_clave__delete'])){
         $nom_admin_delete=MysqlQuery::RequestPost('nom_admin_delete');
         $clave_admin_delete=md5(MysqlQuery::RequestPost('admin_clave__delete'));
         $sql=Mysql::consulta("SELECT * FROM cliente WHERE nombre_usuario= '$nom_admin_delete' AND clave='$clave_admin_delete'");
         if(mysqli_num_rows($sql)>=1){
            if(MysqlQuery::Eliminar("cliente", "nombre_usuario='$nom_admin_delete' and clave='$clave_admin_delete'")){
                echo '<script type="text/javascript"> window.location="eliminar.php"; </script>';
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
         }else{
            echo '
                <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                    <p class="text-center">
                        Usuario y clave incorrectos
                    </p>
                </div>
            ';
         }
     }
    ?>
    <div class="container">
      <div class="row">
        <div class="col-sm-3">
          <img src="./img/config.png" alt="Image" class="img-responsive">
        </div>
        <div class="col-sm-9">
          <p class="lead text-info">Bienvenido administrador, aqui podra agregar nuevos administradores, actualizar sus datos de cuenta y podra eliminar su cuenta si lo desea.</p>
        </div>
      </div><!--fin row-->
      
      <br><br>        
      
      <div class="row">
          <di class="col-sm-8">
              <div class="row">
                  <div class="col-sm-12">
                    <div class="panel panel-success">
                    <div class="panel-heading text-center"><i class="fa fa-plus"></i>&nbsp;<strong>Agregar nuevo administrador</strong></div>
                    <div class="panel-body">
                        <form role="form" action="" method="post">
                        <div class="form-group">
                          <label><i class="fa fa-male"></i>&nbsp;Nombre completo</label>
                          <input type="text" class="form-control" name="nom_admin_reg" placeholder="Nombre completo" required="" pattern="[a-zA-Z ]{1,40}" title="Nombre Apellido" maxlength="40">
                        </div>
                        <div class="form-group has-success has-feedback">
                          <label class="control-label"><i class="fa fa-user"></i>&nbsp;Nombre de administrador</label>
                          <input type="text" id="input_user" class="form-control" name="admin_reg" placeholder="Nombre de usuario" required="" pattern="[a-zA-Z0-9]{1,15}" title="Ejemplo7 maximo 15 caracteres" maxlength="15">
                          <div id="com_form"></div>
                        </div>
                        <div class="form-group">
                          <label><i class="fa fa-shield"></i>&nbsp;Contraseña</label>
                          <input type="password" minlength="8" class="form-control" name="admin_clave_reg" placeholder="Contraseña" required="">
                        </div>
                        <div class="form-group">
                          <label><i class="fa fa-envelope"></i>&nbsp;Email</label>
                          <input type="email" class="form-control"  name="admin_email_reg"  placeholder="Email administrador" required="">
                        </div>
                      


                        <div class="form-group">
                          <label><i class="fa fa-user"></i>&nbsp;Departamento</label>
                          <select class="form-control" name="Departamento">
                                  <?php 
                                    $sql = Mysql::consulta("SELECT * FROM departamento");
                                    while( $d=mysqli_fetch_array($sql, MYSQLI_ASSOC)){
                                    echo "
                                        <option value='" . $d['idDepartamento'] . "'>";  echo  $d['nombre'];?>  
                                        </option>
                                        <?php
                                      }
                                    ?> 
                                    
                                
                                    
                                  </select>
                            </div>
                        <div class="form-group">
                          <label><i class="fa fa-info"></i>&nbsp;Estatus</label>
                            <select class= "form-control" name="Estatus">
                            <?php $sql = Mysql::consulta("SELECT * FROM ESTATUS  WHERE idEstatus<>94574 AND (idEstatus<>94575 AND idEstatus <>94576)");
                             while($e= mysqli_fetch_array($sql,MYSQLI_ASSOC)){
                              echo "<option value='" . $e['idEstatus'] .  "' >";
                              echo $e['Nombre']. "
                                </option>";
                             } 
                             ?>
                            </select>


                        </div>
                        <div class="form-group">
                          <label><i class="fa fa-phone"></i>&nbsp;Teléfono</label>
                          <input type="phone" maxlength="10" class="form-control"  name="Telefono"  placeholder="Teléfono celular" required="">
                        </div>
                            <center><button type="submit" class="btn btn-success">Agregar administrador</button></center>
                      </form>
                    </div>
                  </div>
                </div>  
              </div><!--Fin row 1 agregar-->
              
              <div class="row"> 
                  <div class="col-sm-12">
                    <div class="panel panel-danger">
                      <div class="panel-heading text-center"><i class="fa fa-trash-o"></i>&nbsp;<strong>Eliminar cuenta</strong></div>
                      <div class="panel-body">
                          <center><img class="img-responsive" src="./img/delete_user.png"></center><br>
                          <center><button class="btn btn-danger btn-sm" data-toggle="modal" data-target=".bs-example-modal-sm">Eliminar cuenta</button></center>

                            <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-sm">
                                <div class="modal-content">

                                     <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                       <h4 class="modal-title text-center text-danger" id="myModalLabel">¿Deseas eliminar tu cuenta?</h4>
                                    </div>
                                  <form action="" method="post" role="form" style="padding:20px;">
                                    <div class="input-group input-group-sm">
                                      <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                      <input type="text" class="form-control" name="nom_admin_delete" placeholder="Nombre de administrador" required="">
                                    </div><br>
                                    <div class="input-group input-group-sm">
                                      <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                      <input type="password" class="form-control" name="admin_clave__delete" placeholder="Contraseña" required="">
                                    </div><br>

                                    <center>
                                      <button type="submit" class="btn btn-danger btn-sm">Eliminar cuenta</button>
                                      <button type="button" class="btn btn-success btn-sm" data-dismiss="modal">Cancelar</button>
                                    </center>
                                  </form>

                                </div>
                              </div>
                            </div>
                      </div>
                    </div>
                  </div> 
              </div><!--Fin row 2 eliminar-->
          </di><!--Fin class col-md-8-->
          
          <div class="col-sm-4">
              <div class="row">
                  <div class="col-sm-12">
                    <div class="panel panel-info">
                     <div class="panel-heading text-center"><i class="fa fa-refresh"></i>&nbsp;<strong>Actualizar datos de cuenta</strong></div>
                     <div class="panel-body">
                        <?php
                            $idad=$_SESSION['id'];
                            $sql1=Mysql::consulta("SELECT * FROM cliente WHERE id_cliente='$idad'");
                            $reg1=mysqli_fetch_array($sql1, MYSQLI_ASSOC);
                        ?>
                         <form role="form" action="" method="POST">
                         <div class="form-group">
                           <label><i class="fa fa-male"></i>&nbsp;Nombre completo</label>
                           <input type="text" class="form-control" value="<?php echo $reg1['nombre_completo']; ?>" name="nombre" placeholder="Nombre completo" required="" pattern="[a-zA-Z ]{1,40}" title="Nombre Apellido" maxlength="40">
                         </div>
                         <div class="form-group">
                           <label><i class="fa fa-user"></i>&nbsp;Nombre de Usuario</label>
                           <input type="text" class="form-control" value="<?php echo $reg1['nombre_usuario']; ?>" name="nombre_usuario" placeholder="Nombre anterior de administrador" required="" pattern="[a-zA-Z0-9]{1,15}" title="Ejemplo7 maximo 15 caracteres" maxlength="15">
                         </div>
                     
                         <div class="form-group">
                           <label><i class="fa fa-shield"></i>&nbsp;Contraseña anterior</label>
                           <input type="password" minlength="8" class="form-control" name="clave" placeholder="Contraseña anterior" required="">
                         </div>
                             <div class="form-group">
                           <label><i class="fa fa-key"></i>&nbsp;Nueva contraseña</label>
                           <input type="password" minlength="8" class="form-control" name="newclave" placeholder="Nueva contraseña"  >
                         </div>
                           <div class="form-group">
                           <label><i class="fa fa-key"></i>&nbsp;Confirmar contraseña</label>
                           <input type="password" minlength="8" class="form-control" name="newclave1" placeholder="Confirmar contraseña"  >
                         </div>
                         <div class="form-group">
                           <label><i class="fa fa-envelope"></i>&nbsp;Email</label>
                           <input type="email" class="form-control" value="<?php echo $reg1['email_cliente']; ?>" name="email_usuario"  placeholder="Email administrador" required="">
                         </div>
                         
                         <div class="form-group">
                            <label ><i class="fa fa-phone"></i>&nbsp;&nbsp;Teléfono</label>
                            <input type="tel" class="form-control" value="<?php echo $reg1['telefono_celular'] ?>" placeholder="Escriba su número celular" name="telefono" required="">
                          </div>
                         
                         <button type="submit" class="btn btn-info">Actualizar datos</button>
                             
                        </form>
                     </div>
                   </div>
                   </div>
              </div><!--Fin row-->
          </div><!--Fin class col-md-4-->
      </div><!-- Fin row-->
      
    </div>
<?php
}else{
?>
<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <img src="./img/Stop.png" alt="Image" class="img-responsive animated slideInDown"/><br>
            <img src="./img/transp_ALCOMEX.png" alt="Image" class="img-responsive"/>
            
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