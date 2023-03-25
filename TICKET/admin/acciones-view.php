<?php
include ('../lib/class_mysql.php');
include('../lib/config.php');
date_default_timezone_set('America/Mexico_City');
setlocale(LC_TIME, 'spanish');

if($_POST['nombre']!="" && $_POST['rol']==4046 && $_POST['id']){ 
    
    $user= $_POST['id'];
    //BLOQUEAR
if(@$_POST['Bloquear'])
{
        if(@$_POST['Usuarios']!=null)
        { 
            foreach ($_POST['Usuarios'] as  $IdAlumno) {
                $Actualizar = MysqlQuery::Actualizar("cliente", "idEstatus=25542","id_cliente= $IdAlumno");
                 MysqlQuery::ProcedimientoAlmacenado("registro_alteracionesCliente","$user,'Actualizar','".date("Y-m-d H:i:s") ."','cliente'");                  
            }
            echo "<script>alert('Usuario bloqueado');
            window.history.go(-1);
            </script>";
         }
         else  if(@$_POST['Usuarios']==null) {
             ?>
             <script>
              alert("No haz seleccionado ningún usuario");
              window.history.go(-1);
             </script>
             <?php
         }
}
 //DESBLOQUEAR 
if(@$_POST['Desbloquear'])
    {
       if(@$_POST['Usuarios']!=null)
       {
            foreach ($_POST['Usuarios'] as  $IdAlumno) {
                    $Actualizar = MysqlQuery::Actualizar("cliente", "idEstatus=31448","id_cliente= $IdAlumno");
                     MysqlQuery::ProcedimientoAlmacenado("registro_alteracionesCliente","$user,'Actualizar','".date("Y-m-d H:i:s") ."','cliente'");                  
            }
                echo "<script>alert('Usuario desbloqueado');
                window.history.go(-1);
                
                </script>";
        }
        else  if(@$_POST['Usuarios']==null) {
            ?>
            <script>
             alert("No haz seleccionado ningún usuario");
             window.history.go(-1);
            </script>
            <?php
        }
    }
  //ELIMINAR USUARIO 
    if(@$_POST['Eliminar'])
    {

        if(@$_POST['Usuarios']!=null)
        {
            foreach ($_POST['Usuarios'] as  $IdAlumno) {        

                $llamar="CALL Borrar($IdAlumno)";
                 $procedimiento_almacenado= mysqli_query($conexion,$llamar);
                
            }
            if($procedimiento_almacenado)
            {
            echo "<script>alert('Usuario eliminado');
            window.history.go(-1);
            </script>";
            }
            else if($procedimiento_almacenado==null)
            {
                echo "<script>alert('Algo falló, revisa que el usuario no este agregado en un equipo, rol , categoria , departamento, etc ');</script>";
            }
        }


    

        else  if(@$_POST['Usuarios']==null) {
            ?>
            <script>
             alert("No haz seleccionado ningún usuario");
             window.history.go(-1);
            </script>
            <?php
        }
    }   

    //RESETEAR CONTRASEÑA 
    if(@$_POST['Resetear'])
    {
        if(@$_POST['Usuarios']!=null)
       {   
         foreach($_POST['Usuarios'] as $Resetea)
         {
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz!@#$%&/()=+?[]~-^.';
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%&/()=+?[]~-^.';
            $cifrado=(substr(str_shuffle($permitted_chars), 0, 16));   
             $update=MysqlQuery::Actualizar("cliente"," clave=MD5('$cifrado')","id_cliente=$Resetea");
             MysqlQuery::ProcedimientoAlmacenado("registro_alteracionesCliente","$user,'Actualizar','".date("Y-m-d H:i:s") ."','cliente'");                  
                 $DESTINO=Mysql::consulta("SELECT * FROM cliente WHERE id_cliente=$Resetea");
                 if($DESTINO)
                {
                    $Datos=mysqli_fetch_array($DESTINO,MYSQLI_ASSOC);
                    $Correo=$Datos['email_cliente'];
                    $Nombre=$Datos['nombre_completo'];
                     $n=$Datos['id_cliente'];
                }
         }
            echo "<script>
            alert('Contraseña reseteada correctamente');
            window.history.go(-1);
            </script>";

        }
        else  if(@$_POST['Usuarios']==null) {
            ?>
            <script>
             alert("No haz seleccionado ningún usuario");
             window.history.go(-1);
            </script>
            <?php
        }
                  /*                                   
                        
                        $mail = new PHPMailer(true);
                        $consulta= mysqli_query($conexion, "SELECT correo, (aes_decrypt(contraseña,'AES')) AS  RECUPERAR FROM enviocorreo;");
                        if ($consulta) {
                            $c3=mysqli_fetch_assoc($consulta);
                            $zc=$c3['correo'];
                            $zcc=$c3['RECUPERAR'];
                        }
                        try {
                            //Server settings
                            $mail->SMTPDebug = 0;                      //Enable verbose debug output
                            $mail->isSMTP();                                            //Send using SMTP
                            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                            $mail->Username   = "$zc";                     //SMTP username
                            $mail->Password   = "$zcc";                                //SMTP password
                            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                            //Recipients
                            $mail->setFrom("$zc", 'Subdirección de educación a distancia');
                            $mail->addAddress($Correo, $Completo);     //Add a recipient                             
                            //Content
                            $mail->isHTML(true);                                  //Set email format to HTML
                            $mail->CharSet='UTF-8';
                            $mail->Subject = 'Reseteo de contraseña';
                            $mail->Body    = '<p style="text-align:justify;">Estimado usuario : ' . $Completo . '.<br> Hemos reseteado su contraseña como lo solicitó. <br> Su nueva contraseña es : <b>' .$cifrado. '</b><br><br><br>'.
                          '  <img src="https://mir-s3-cdn-cf.behance.net/projects/404/7a3bbf33243463.Y3JvcCw4NDYsNjYyLDE5Miww.jpg">'  .'
                            <br> <br><br>
                            <p style="text-align:justify;">
                            Atentamente Centro de Soporte, Subdirección de Educación a Distancia 
                            <br>
                            <hr>
                            Esperamos haber atendido satisfactoriamente a su duda. De lo contrario, responda al ticket que tiene abierto.Ingrese a su cuenta.
                            </p>' ;
                            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                            $mail->send();
                          ?>
                          <script>
                                                 
                                                 alert("Contraseña reseteada correctamente");
                                                 window.history.go(-1);
                                                
                          </script>
                          <?php
                        }
                        catch (Exception $e) {
                            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                            ?>
                                <script>
                                                 
                                                 alert("Correo no enviado");
                                                 window.history.go(-2);                           
                          </script>
                            <?php
                        }        
             }
              else{
                 echo "<script>alert('Algo falló, revisa tu conexión y vuelve a intentarlo ');
                 window.history.go(-1);
                 
                 </script>";
              }
        }
       }

    else  if(@$_POST['Usuarios']==null) {
        ?>
        <script>
         alert("No haz seleccionado ningún usuario");
         window.history.go(-1);
        </script>
        <?php
    } */
  }

}
?>