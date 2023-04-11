<?php
include ('../lib/class_mysql.php');
include('../lib/config.php');
date_default_timezone_set('America/Mexico_City');
setlocale(LC_TIME, 'spanish');


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception; 
require '/xampp/htdocs/TL11EST.github.io/vendor/autoload.php';



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
            foreach ($_POST['Usuarios'] as  $idBorrar)
            {        
                  // $eliminar= "email_cliente='$id_user'";                               
                  $cr = Mysql:: consulta(" SELECT * FROM ticket WHERE idUsuario = $idBorrar");
                  $creados = mysqli_num_rows($cr);
                  $re= Mysql:: consulta(" SELECT * FROM ticket WHERE id_Atiende = $idBorrar AND idStatus = 94576");
                  $resueltos= mysqli_num_rows($re); 
                  $pen= Mysql:: consulta  ("SELECT * FROM ticket WHERE id_Atiende = $idBorrar AND idStatus = 94574 ");
                  $pendientes = mysqli_num_rows($pen);
                  $pro = Mysql:: consulta ("SELECT * FROM  ticket WHERE id_Atiende = $idBorrar AND idStatus = 94575");
                  $proceso = mysqli_num_rows($pro);

                  if($llamar=MysqlQuery::ProcedimientoAlmacenado("EliminarUsuario","$idBorrar,'". date("Y-m-d")  ."','" . date("Y-m-d") . "',$pendientes, $creados, $resueltos, $proceso")){
                    MysqlQuery::ProcedimientoAlmacenado("registro_alteracionesCliente","$user,'EliminarU','".date("Y-m-d H:i:s") ."','cliente'");
                    MysqlQuery::ProcedimientoAlmacenado("registro_alteracionesCliente","$user,'EliminarU','".date("Y-m-d H:i:s") ."','ticket'");
                    MysqlQuery::ProcedimientoAlmacenado("registro_alteracionesCliente","$user,'EliminarU','".date("Y-m-d H:i:s") ."','departamento'");
                  }      
            }

            if($llamar)
            {
            echo "<script>alert('Usuarios eliminados');
            window.history.go(-1);
            </script>";
            }
            else  
            {
                echo "<script>alert('Algo falló, revisa tu conexión a Internet');</script>";
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
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $cifrado=(substr(str_shuffle($permitted_chars), 0, 16));   
             $update=MysqlQuery::Actualizar("cliente"," clave=MD5('$cifrado')","id_cliente=$Resetea");
             MysqlQuery::ProcedimientoAlmacenado("registro_alteracionesCliente","$user,'Actualizar','".date("Y-m-d H:i:s") ."','cliente'");                  
                 $DESTINO=Mysql::consulta("SELECT c.email_cliente,c.nombre_completo, c.id_cliente, d.nombre as Depa FROM cliente c INNER JOIN departamento d ON c.id_departamento = d.idDepartamento WHERE c.id_cliente=$Resetea");
                 if($DESTINO)
                {
                    $Datos=mysqli_fetch_array($DESTINO,MYSQLI_ASSOC);
                    $Correo=$Datos['email_cliente'];
                    $Nombre=$Datos['nombre_completo'];
                    $n=$Datos['id_cliente'];
                    $depa = $Datos['Depa'];
                    $mail = new PHPMailer(true);
                            try {
                                //Server settings
                                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                    //Enable verbose debug output
                                $mail->isSMTP();                                            //Send using SMTP
                                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                                $mail->Username   = 'correodepruebasutp@gmail.com';                     //SMTP username
                                $mail->Password   = 'ikezrnpsjnzipfha';                               //SMTP password
                                $mail->SMTPSecure =  PHPMailer:: ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                                //Recipients
                                $mail->setFrom('correodepruebasutp@gmail.com', 'Soporte técnico ' . $depa. ' Alcomex');
                                $mail->addAddress($Correo, $Nombre);     //Add a recipient
                                //Content
                                $mail->isHTML(true);       
                                $mail->CharSet = 'UTF-8';                           //Set email format to HTML
                                $mail->Subject = 'Reseteo de contraseña';
                                $mail->Body= '<p style="text-align:justify;">Estimado usuario <strong> ' . $Nombre . ': </strong> <br> Hemos reseteado su contraseña como lo solicitó. <br> Su nueva contraseña para acceder a su usuario de soporte técnico es: <b> <strong>' .$cifrado. '</strong></b><br><br><br>'.
            
                                '<img width="250px" height="auto" src="https://scontent.fpbc1-1.fna.fbcdn.net/v/t39.30808-6/340835079_219065740720635_4950595825896346541_n.jpg?_nc_cat=106&ccb=1-7&_nc_sid=dbeb18&_nc_ohc=luxwI7hBcLoAX966O2M&_nc_ht=scontent.fpbc1-1.fna&oh=00_AfD9I8W2OeZ8hANUKlp9wcDfCd6mrA5fshIMCbP6tlaRmQ&oe=6438D9D3" />'  .'
                                  <br>
                                  <br>
                                  <br>
                                  <p style="text-align:justify;">
                                  Atentamente Soporte técnico Alcomex
                                  <br>
                                  <hr>
                                  Esperamos haber atendido satisfactoriamente su problema.
                                  </p>' ;
                                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                                $mail->send();
                                echo "<script>
                                alert('Contraseña de " . $Nombre . " reseteada correctamente');
                                window.history.go(-1);
                                </script>";
                            } catch (Exception $e) {
                                echo "  {$mail->ErrorInfo}";
                            }
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
        }
                 
  }

}
?>