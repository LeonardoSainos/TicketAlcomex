<?php
    if(isset($_POST['nombre_usuario']) && isset($_POST['clave']) && isset($_POST['nombre'])){
        $nombre=mb_strtoupper(MysqlQuery::RequestPost('nombre'));
        $usuario=MysqlQuery::RequestPost('nombre_usuario');
        $clave=md5(MysqlQuery::RequestPost('clave'));
        $clave1=md5(MysqlQuery::RequestPost('clave1'));
        $email=strtolower(MysqlQuery::RequestPost('email_cliente'));
        $telefono=MysqlQuery::RequestPost('telefono');
         
        $correo= Mysql::consulta("SELECT * FROM cliente WHERE email_cliente = '$email' OR telefono_celular = '$telefono'");
          
        if(mysqli_num_rows($correo)<=0){

        if($clave == $clave1){



          if(MysqlQuery::Guardar("cliente", "nombre_completo, nombre_usuario, email_cliente, clave, id_departamento,id_rol,idEstatus,telefono_celular", "'$nombre', '$usuario', '$email', '$clave',2505,9947,31448," . $telefono)){
                $nuevo = Mysql::consulta("SELECT * FROM cliente WHERE  Fecha_creacion = '" . date("Y-m-d H:i:s") . "'");
 
                $nuevo1 = mysqli_fetch_array($nuevo,MYSQLI_ASSOC);
                $newFecha = $nuevo1['Fecha_creacion'];
                $newid = $nuevo1['id_cliente'];
            
                MysqlQuery::ProcedimientoAlmacenado("NuevoUsuario","$newid,'Insertar','".date("Y-m-d H:i:s") ."','cliente'");

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
              <input type="text" class="form-control" id="nombre_completo" name="nombre" placeholder="Nombre completo" required=""   title="Nombre Apellido" maxlength="65">
            </div>
            <div class="form-group has-success has-feedback">
              <label class="control-label"><i class="fa fa-user"></i>&nbsp;Nombre de usuario</label>
              <input type="text" id="input_user" class="form-control" name="nombre_usuario" placeholder="Nombre de usuario" required="" pattern="[a-zA-Z0-9]{1,15}" title="Máximo 15 caracteres" maxlength="20">
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
              <input type="email" class="form-control" id="email_usuario" name="email_cliente"  placeholder="Escriba su email" required="">
            </div>
            <div class="form-group">
              <label><i class="fa fa-phone"></i>&nbsp;Teléfono</label>
              <input type="tel" maxlength="10" minlength="10" class="form-control"  name="telefono"  placeholder="Escriba su número de teléfono" required="">
            </div>
            <button type="submit" class="btn btn-warning">Crear cuenta</button>
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


function convertir(){

  
let nombre = document.getElementById("nombre_completo");
let correo = document.getElementById("email_usuario");

let n2 = nombre.toUpperCase();
let c2 = correo.toLowerCase();


console.log(n2 " nombre " + c2 + "correo");
}


convertir();

</script>