<?php
    if(isset($_POST['nombre_usuario']) && isset($_POST['clave']) && isset($_POST['nombre'])){
        $nombre=MysqlQuery::RequestPost('nombre');
        $usuario=MysqlQuery::RequestPost('nombre_usuario');
        $clave=md5(MysqlQuery::RequestPost('clave'));
        $clave1=md5(MysqlQuery::RequestPost('clave1'));
        $email=MysqlQuery::RequestPost('email_cliente');
        $telefono=MysqlQuery::RequestPost('telefono');
     
          $asunto="Registro de cuenta en LinuxStore";
        $cabecera="From: LinuxStore El Salvador<linuxstore@hifenix.com>";
        $mensaje_mail="Hola ".$nombre.", Gracias por registrarte en LinuxStore El Salvador. Los datos de cuenta son los siguientes:\nNombre Completo: ".$nombre."\nNombre de usuario: ".$usuario."\nClave: ".$clave."\nEmail: ".$email."\n Página principal: http://www.linuxstore.com/index.php";
        
        $correo= Mysql::consulta("SELECT * FROM cliente where email_cliente = '$email' or telefono_celular = '$telefono'");
          
        if(mysqli_num_rows($correo)<=0){

        if($clave == $clave1){



          if(MysqlQuery::Guardar("cliente", "nombre_completo, nombre_usuario, email_cliente, clave, id_departamento,id_rol,idEstatus,telefono_celular", "'$nombre', '$usuario', '$email', '$clave',2505, 9947,31448," . $telefono)){

            /*----------  Enviar correo con los datos de la cuenta 
                mail($email, $asunto, $mensaje_mail, $cabecera);
            ----------*/

            echo '
                <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="text-center">REGISTRO EXITOSO</h4>
                    <p class="text-center">
                        Cuenta creada exitosamente, ahora puedes iniciar sesión, ya eres usuario de soporte técnico Alcomex.
                    </p>
                </div>
            ';
        }else{
            echo '
                <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                    <p class="text-center">
                        ERROR AL REGISTRARSE: Por favor intente nuevamente.
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
                  LAS CONTRASEÑAS NO COINCIDEN.
              </p>
          </div>
      '; 
        }
      }

      else if (mysqli_num_rows($correo)>=1){
        echo '
        <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="text-center">OCURRIÓ UN ERROR</h4>
            <p class="text-center">
                ESTE CORREO  O NÚMERO DE TELÉFONO YA HA SIDO REGISTRADO.
            </p>
        </div>
    '; 
      }
         
    }
?>
<div class="container">
  <div class="row">
    <div class="col-sm-8">
      <div class="panel panel-success">
        <div class="panel-heading text-center"><strong>Para poder registrarte debes de llenar todos los campos de este formulario</strong></div>
        <div class="panel-body">
            <form role="form" action="" method="POST">
            <div class="form-group">
              <label><i class="fa fa-male"></i>&nbsp;Nombre completo</label>
              <input type="text" class="form-control" name="nombre" placeholder="Nombre completo" required="" pattern="[a-zA-Z ]{1,40}" title="Nombre Apellido" maxlength="40">
            </div>
            <div class="form-group has-success has-feedback">
              <label class="control-label"><i class="fa fa-user"></i>&nbsp;Nombre de usuario</label>
              <input type="text" id="input_user" class="form-control" name="nombre_usuario" placeholder="Nombre de usuario" required="" pattern="[a-zA-Z0-9]{1,15}" title="Ejemplo7 maximo 15 caracteres" maxlength="20">
              <div id="com_form"></div>
            </div>
            <div class="form-group">
              <label><i class="fa fa-key"></i>&nbsp;Contraseña</label>
              <input type="password" class="form-control" minlength="8" name="clave" placeholder="Contraseña" required="">
            </div>
            <div class="form-group">
              <label><i class="fa fa-key"></i>&nbsp;Confirmar contraseña</label>
              <input type="password" class="form-control" minlength="8" name="clave1" placeholder="Contraseña" required="">
            </div>
            <div class="form-group">
              <label><i class="fa fa-envelope"></i>&nbsp;Email</label>
              <input type="email" class="form-control"  name="email_cliente"  placeholder="Escriba su email" required="">
            </div>
            <div class="form-group">
              <label><i class="fa fa-phone"></i>&nbsp;Teléfono</label>
              <input type="tel" maxlength="10" class="form-control"  name="telefono"  placeholder="Escriba su número de teléfono" required="">
            </div>
            <button type="submit" class="btn btn-danger">Crear cuenta</button>
          </form>
        </div>
      </div>
    </div>

    <div class="col-sm-4 text-center hidden-xs">
      <img src="img/Transp_ALCOMEX.png" height="auto" class="img-responsive" alt="Image">
 
    </div>

  </div>
</div>

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