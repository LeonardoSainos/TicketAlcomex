<?php if(!$_SESSION['nombre']=="" && ($_SESSION['rol']==9947)){ 
        
        /*Script para eliminar cuenta*/
        if(isset($_POST['usuario_delete']) && isset($_POST['clave_delete'])){
          $usuario_delete=MysqlQuery::RequestPost('usuario_delete');
          $clave_delete=md5(MysqlQuery::RequestPost('clave_delete'));
         
          $sql=Mysql::consulta("SELECT * FROM cliente WHERE nombre_usuario= '$usuario_delete' AND clave='$clave_delete'");

          if(mysqli_num_rows($sql)>=1){
             MysqlQuery::Eliminar("cliente", "nombre_usuario='$usuario_delete' and clave='$clave_delete'");
             echo '<script type="text/javascript"> window.location="eliminar.php"; </script>';
          }else{
            echo '
                <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                    <p class="text-center">
                        No hemos podido eliminar la cuenta por que los datos son incorrectos
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
        ?>
        <div class="container">
          <div class="row well">
            <div class="col-sm-3">
              <img src="img/settings.png" alt="Image" class="img-responsive">
            </div>
            <div class="col-sm-9 lead">
              <h2 class="text-info">Bienvenido a la configuración de cuenta Alcomex</h2>
              <p>Puedes <strong>actualizar los datos</strong> de tu cuenta ó puedes <strong>eliminar tu cuenta</strong> permanentemente si ya no deseas ser usuario del sistema de asistencia Alcomex</p>
            </div>
          </div><!--Fin row well-->
          <?php
                            $idad=$_SESSION['id'];
                            $sql1=Mysql::consulta("SELECT * FROM cliente WHERE id_cliente='$idad'");
                            $reg1=mysqli_fetch_array($sql1, MYSQLI_ASSOC);
                        ?>
          <div class="row">
            <div class="col-sm-8">
              <div class="panel panel-info">
                <div class="panel-heading text-center"><i class="fa fa-retweet"></i>&nbsp;&nbsp;<strong>Actualizar datos de cuenta</strong></div>
                <div class="panel-body">
                    <form action="" method="post" role="form">
                    <div class="form-group">
                      <label class="text-primary"><i class="fa fa-male"></i>&nbsp;&nbsp;Nombre completo</label>
                      <input value="<?php echo $reg1['nombre_completo'] ?>" type="text" class="form-control" placeholder="Nombre completo" name="nombre" required="" pattern="[a-zA-Z ]{1,40}" title="Nombre Apellido" maxlength="40">
                    </div>
                    <div class="form-group">
                      <label class="text-danger"><i class="fa fa-user"></i>&nbsp;&nbsp;Nombre de usuario actual</label>
                      <input value="<?php echo $reg1['nombre_usuario'] ?>" type="text" class="form-control" placeholder="Nombre de usuario actual" name="nombre_usuario" required="" pattern="[a-zA-Z0-9 ]{1,30}" title="Ejemplo7" maxlength="20">
                    </div>
                   
                    <div class="form-group">
                      <label class="text-danger"><i class="fa fa-key"></i>&nbsp;&nbsp;Contraseña actual</label>
                      <input type="password" class="form-control" placeholder="Contraseña actual" name="clave" required="">
                    </div>
                    <div class="form-group">
                      <label class="text-primary"><i class="fa fa-unlock-alt"></i>&nbsp;&nbsp;Contraseña nueva</label>
                      <input type="password" class="form-control" placeholder="Nueva Contraseña" name="newclave" >
                    </div>
                    <div class="form-group">
                      <label class="text-primary"><i class="fa fa-unlock-alt"></i>&nbsp;&nbsp;Confirmar contraseña</label>
                      <input type="password" class="form-control" placeholder="Nueva Contraseña" name="newclave1"  >
                    </div>
                    <div class="form-group">
                      <label class="text-primary"><i class="fa fa-envelope-o"></i>&nbsp;&nbsp;Email</label>
                      <input type="email" class="form-control" value="<?php echo $reg1['email_cliente'] ?>" placeholder="Escriba su email" name="email_usuario" required="">
                    </div>
                    <div class="form-group">
                      <label class="text-primary"><i class="fa fa-phone"></i>&nbsp;&nbsp;Teléfono</label>
                      <input type="tel" class="form-control" value="<?php echo $reg1['telefono_celular'] ?>" placeholder="Escriba su número celular" name="telefono" required="">
                    </div>
                    <button type="submit" class="btn btn-info">Actualizar datos</button>
                  </form>
                </div>
              </div>
            </div><!--Fin col 8-->
            <div class="col-sm-4 text-center well">
              <br><br><br><br><br><br><br><br>
              <img src="img/delete_user.png" alt="Image"><br><br><br>
              <button class="btn btn-danger" data-toggle="modal" data-target=".bs-example-modal-sm">Eliminar cuenta</button>
              <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                  <div class="modal-content">
                      <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title text-center text-danger" id="myModalLabel">¿Deseas eliminar tu cuenta?</h4>
                    </div>
                    <form action="" method="post" role="form" style="padding:20px;">
                      <p class="text-warning">Si estas seguro que deseas eliminar tu cuenta por favor introduce tu nombre de usuario y contraseña</p>
                      <div class="input-group input-group-sm">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                        <input type="text" class="form-control" name="usuario_delete" placeholder="Nombre de usuario" required="">
                      </div><br>
                      <div class="input-group input-group-sm">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                        <input type="password" class="form-control" name="clave_delete" placeholder="Contraseña" required="">
                      </div><br>
                      
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar cuenta</button>
                        <button type="button" class="btn btn-success btn-sm" data-dismiss="modal">Cancelar</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <br><br><br><br><br><br><br>
            </div>
          </div>
        </div>
<?php
}else{
?>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <img src="img/Stop.png" alt="Image" class="img-responsive animated slideInDown"/><br>
                <img src="img/Transp_Alcomex.png" alt="Image" class="img-responsive"/>
                
            </div>
            <div class="col-sm-7 animated flip">
                <h1 class="text-danger">Lo sentimos esta página es solamente para usuarios registrados en Alcomex</h1>
                <h3 class="text-info text-center">Inicia sesión para poder acceder</h3>
            </div>
            <div class="col-sm-1">&nbsp;</div>
        </div>
    </div>
<?php
}
?>
<script>
    $(document).ready(function(){
        $("#input_user").keyup(function(){
          $.ajax({
            url:"./process/val.php?id="+$(this).val(),
            success:function(data){
              $("#com_form").html(data);
            }
          });
        });
    });
</script>