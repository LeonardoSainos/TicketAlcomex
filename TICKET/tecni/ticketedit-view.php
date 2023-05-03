<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception; 
require '/xampp/htdocs/TicketAlcomex/vendor/autoload.php';

$id = MysqlQuery::RequestGet('id');
$sql = Mysql::consulta("SELECT t.foto,t.respuestafoto,t.id_atiende as atender,t.id, t.fecha, t.serie, t.asunto, t.mensaje, t.solucion, c.nombre_completo , c.email_cliente, d.nombre as departamento, e.Nombre, e.idEstatus FROM ticket t INNER JOIN cliente c ON t.idUsuario = c.id_cliente INNER JOIN departamento d ON d.idDepartamento = t.idDepartamento INNER JOIN estatus e ON t.idStatus = e.idEstatus  WHERE t.id= $id");
$reg=mysqli_fetch_array($sql, MYSQLI_ASSOC);
$iid = $_SESSION['id'];   
$fotoR = $reg['respuestafoto'];

if(isset($_POST['id_edit']) && isset($_POST['solucion_ticket']) && isset($_POST['estado_ticket']) && isset($_SESSION['id'])){
		$id_edit=MysqlQuery::RequestPost('id_edit');
		$estado_edit=  MysqlQuery::RequestPost('estado_ticket');
		$solucion_edit=  MysqlQuery::RequestPost('solucion_ticket');
		$radio_email=  MysqlQuery::RequestPost('optionsRadios');
     
    
    $resultado = Imagen::procesar_imagen("../TICKET/tecni/Respuesta", "respuesta");
		if($resultado['autoriza']==true){
      if($fotoR==""){  
      MysqlQuery::Actualizar("ticket", "respuestafoto= '". $resultado['imagen_ticket'] . "',idStatus='$estado_edit', solucion='$solucion_edit',fecha_actualizacion= '" . date("Y-m-d H:i:s"). "'", "id='$id_edit'");
      }              
      else{
        MysqlQuery::Actualizar("ticket", "idStatus='$estado_edit', solucion='$solucion_edit',fecha_actualizacion= '" . date("Y-m-d H:i:s"). "'", "id='$id_edit'");
     
      }      
      if(MysqlQuery::ProcedimientoAlmacenado("registro_alteracionesCliente","$iid,'Actualizar','".date("Y-m-d H:i:s") ."','ticket'"))
 
      echo '
                <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="text-center">TICKET Actualizado</h4>
                    <p class="text-center">
                        El ticket fue actualizado con exito
                    </p>
                </div>
            ';
			if($radio_email=="option2"){
             

        $sqly = Mysql::consulta("SELECT t.foto,t.id_atiende as atender,t.id, t.fecha, t.serie, t.asunto, t.mensaje, t.solucion, c.nombre_completo , c.email_cliente, d.nombre as departamento, e.Nombre as Esta, e.idEstatus FROM ticket t INNER JOIN cliente c ON t.idUsuario = c.id_cliente INNER JOIN departamento d ON d.idDepartamento = t.idDepartamento INNER JOIN estatus e ON t.idStatus = e.idEstatus  WHERE t.id= $id");
        $regy=mysqli_fetch_array($sqly, MYSQLI_ASSOC);
   
          $Aserie = $regy['serie'];
          $ANombre= $regy['nombre_completo'];
          $AEstatus= $regy['Esta'];
          $Asolucion=$regy['solucion'];
          $Acorreo = $regy['email_cliente'];
          $Aserie = $regy['serie'];

          $segunda= Mysql :: consulta("SELECT c.nombre_completo, c.email_cliente, d.nombre as depa FROM cliente c INNER JOIN departamento d ON c.id_departamento = d.idDepartamento WHERE c.id_cliente = $iid");
          $segundaa= mysqli_fetch_array($segunda,MYSQLI_ASSOC);
          $depa = $segundaa['depa'];
          $NombreEmisor= $segundaa['nombre_completo'];
          $CorreoEmisor = $segundaa['email_cliente'];

       $send = Mysql:: consulta("SELECT cast(aes_decrypt(e.contraseña, 'AES') as char) as RECUPERAR ,d.correo FROM enviocorreo e INNER JOIN departamento d ON e.correo = d.idDepartamento WHERE e.id = 2");
      $sendd = mysqli_fetch_array($send,MYSQLI_ASSOC);
      $esend = $sendd['correo'];
              $ep= $sendd['RECUPERAR'];
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                    //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = $esend;                     //SMTP username
            $mail->Password   = $ep;                               //SMTP password
            $mail->SMTPSecure =  PHPMailer:: ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            //Recipients
            $mail->setFrom($esend, 'Soporte Técnico ' . $depa . ' Alcomex');
          $mail->addAddress($Acorreo, $ANombre);     //Add a recipient
          //Content
          $mail->isHTML(true);       
          $mail->CharSet = 'UTF-8';                           //Set email format to HTML
          $mail->Subject = 'Actualización de ticket #' . $Aserie;
          $mail->Body=  '<h2 style="text-align:center; color: #fb5d14;">
          ¡Hola <strong> ' . $ANombre . ' ! </strong> </h2><br>
          <p style="text-align:center;" ><b>Se ha actualizado el estatus de tu Ticket:</b><br>
      </p>
      <p style="text-align:center;">
          Actualizado: ' .  date("Y-m-d H:i:s").  ' <br>
          Ticket : ' . $Aserie . '<br>
          Atiende : '. $NombreEmisor.' <br>
          Correo : '. $CorreoEmisor .' <br> 
          Estatus : <strong style="color:red;">'.$AEstatus .' </strong><br>
          Solución : <strong style="color:red;">'.$solucion_edit. '</strong><br>

      </p>
         <br> '.
          '
          <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
          <center>
          <img style="align-items: center; justify-content: center;" width="250px" height="auto" src="https://i.pinimg.com/564x/bd/e3/f8/bde3f81141a064e60a231874c29ddd6e.jpg" />
          </center>
          <br>
          <p style="text-align:center;">
          Atentamente Soporte Técnico Alcomex
          <br>
          <hr>
          </p>
          <p style="text-align:center;">
          Esperamos haber atendido satisfactoriamente su problema.
          </p>
      </div>'  
            ;
          $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
          $mail->send();
          echo "<script>
       
          window.history.go(-1);
          </script>";
      } catch (Exception $e) {
          echo " <script> alert( {$mail->ErrorInfo}); </scripyt>";
      }


			}
		}else{
			echo '
                <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                    <p class="text-center">
                        No hemos podido actualizar el ticket
                    </p>
                </div>
            '; 
		}
	}     

	     
	 

?>


        <!--************************************ Page content******************************-->
        <div class="container">
          <div class="row">
            <div class="col-sm-3">
                <img src="./img/Edit.png" alt="Image" class="img-responsive animated tada">
            </div>
            <div class="col-sm-9">
                <a href="./tecni.php?view=ticketTecni" class="btn btn-warning btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Volver administrar Tickets</a>
            </div>
          </div>
        </div>
          <div class="container">
            <div class="col-sm-12">
                <form class="form-horizontal" role="form" action="" method="POST" enctype="multipart/form-data" >
                		<input type="hidden" name="id_edit" value="<?php echo $reg['id']?>">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Fecha</label>
                            <div class='col-sm-10'>
                                <div class="input-group">
                                    <input class="form-control" readonly="" type="text" name="fecha_ticket" readonly="" value="<?php echo $reg['fecha']?>">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Serie</label>
                            <div class='col-sm-10'>
                                <div class="input-group">
                                    <input class="form-control" readonly="" type="text" name="serie_ticket" readonly="" value="<?php echo $reg['serie']?>">
                                    <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                </div>
                            </div>
                        </div>
                    
                       

                        <div class="form-group">  
                          <label  class="col-sm-2 control-label">Nombre</label>
                          <div class="col-sm-10">
                              <div class='input-group'>
                                  <input type="text" readonly="" class="form-control"  name="name_ticket" readonly="" value="<?php echo $reg['nombre_completo']?>">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                              </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                          <div class="col-sm-10">
                              <div class='input-group'>
                                  <input type="email" readonly="" class="form-control"  name="email_ticket" readonly="" value="<?php echo $reg['email_cliente']?>">
                                <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                              </div> 
                          </div>
                        </div>

                        <div class="form-group">
                          <label  class="col-sm-2 control-label">Departamento</label>
                          <div class="col-sm-10">
                              <div class='input-group'>
                                  <input type="text" readonly="" class="form-control"  name="departamento_ticket" readonly="" value="<?php echo $reg['departamento']?>">
                                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                              </div> 
                          </div>
                        </div>

                        <div class="form-group">
                          <label  class="col-sm-2 control-label">Asunto</label>
                          <div class="col-sm-10">
                              <div class='input-group'>
                                  <input type="text" readonly="" class="form-control"  name="asunto_ticket" readonly="" value="<?php echo $reg['asunto']?>">
                                <span class="input-group-addon"><i class="fa fa-paperclip"></i></span>
                              </div> 
                          </div>
                        </div>

                        <div class="form-group">
                          <label  class="col-sm-2 control-label">Mensaje</label>
                          <div class="col-sm-10">
                              <textarea class="form-control" readonly="" rows="3"  name="mensaje_ticket" readonly=""><?php echo $reg['mensaje']?></textarea>
                          </div>
                        </div>
                       
                        <div class="form-group">
                          <label  class="col-sm-2 control-label">Solución</label>
                          <div class="col-sm-10">
                            <textarea class="form-control" rows="3"  name="solucion_ticket" ><?php echo $reg['solucion']?></textarea>
                          </div>
                        </div>
                        <div class="form-group">
                            <label style="color:red; "class="col-sm-2 control-label">Estado:</label>
                            <div class='col-sm-10'>
                                <div class="input-group">

                                
                                    <select class="form-control" name="estado_ticket">
                                    <option  value=" <?php echo $reg['idEstatus']; ?>"> <?php echo $reg['Nombre']; ?>   </option> 
                                      <?php 
                                        $sql = Mysql::consulta("SELECT * FROM estatus WHERE Nombre <> '".  $reg['Nombre'] . "'" . "  AND ((idEstatus <> 31448 AND idEstatus <> 94573 ) AND   (idEstatus <> 19231 AND idEstatus<>   25542 ) ) ");
                                        while( $reg1=mysqli_fetch_array($sql, MYSQLI_ASSOC)){
                                          echo "
                                            <option value='" . $reg1['idEstatus']  . "'>" .
                                             $reg1['Nombre'];?>  
                                            </option>
                                            <?php
                                          }
                                        ?> 
                                       
                                      </select>


                                      
                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-center">
                          <label  class="col-sm-2 control-label">Foto:</label>
                          <div class="col-sm-10">
                                        <img class="imagen-modal" style="margin:5px; text-shadow: 0 0 30px #fb5d14; box-shadow: 0 0 20px #fb5d14;" src='<?php echo"./user/". $reg['foto'] ?>' alt='Sin imagen' width="10%" height="auto">                                           
                          </div>
                        </div>

                        <div class="form-group">
                          <label  class="col-sm-2 control-label">Evidencia solución:</label>
                          <center>
                          <div class="col-sm-10">
                              <div class='input-group text-center'>                            
                                   <img width="25%" height="50%" style=" margin:15px;  text-shadow: 0 0 30px #33FF71; box-shadow: 0 0 20px #33FF71;" class="sombra" id="output"/>
                                   <br>
                                    <label for="imageUpload"  class="btn btn-success btn-block btn-outlined"style=" padding:7px; text-shadow: 0 0 20px #33FF71; box-shadow: 0 0 10px #33FF71;">Añadir foto o imagen</label>  
                                     <br>
                                     
                                  <input type="file" accept="image/*" name="respuesta"  id="imageUpload"  style="display: none; text-shadow: 0 0 30px rgb(48, 26, 241); box-shadow: 0 0 20px rgb(19, 70, 238);" onchange="loadFile(event)">
                                    
                                </div>
                          </div>
                          </center>
                        </div>
                 
                    
                        <div class="row">
                            <div class="col-sm-offset-5">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="optionsRadios" value="option1" checked>
                                        No enviar solución al email del usuario
                                    </label>
                                 </div>


                                <div class="radio">
                                    <label>
                                        <input type="radio" name="optionsRadios" value="option2">
                                         Enviar solución al email del usuario
                                    </label>
                                 </div>
                            </div>
                        </div>
                    
                    <br>
                    
                        <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10 text-center">
                              <button type="submit" class="btn btn-info">Actualizar ticket</button>
                          </div>
                        </div>

                      </form>
            </div><!--col-md-12-->
          </div><!--container-->
<!--MODAL PARA MOSTRAR IMAGEN -->
          <div class="modal fade" id="mi-modal" tabindex="-1" role="dialog" aria-labelledby="mi-modal-label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header" >
                        <h5 class="modal-title" id="mi-modal-label">Imagen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img id="imagen-modal" src="" alt="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
      </div>

          
      <script> // Cuando se hace clic en una imagen con la clase .imagen-modal
$('.imagen-modal').on('click', function() {
    // Obtener la URL de la imagen a mostrar
    var src = $(this).attr('src');
    
    // Asignar la URL al elemento img del modal
    $('#imagen-modal').attr('src', src);
    
    // Mostrar el modal
    $('#mi-modal').modal('show');

    
    // Establecer la altura y ancho máximos del 100% y el margen automático
    $('#imagen-modal').css({
        'max-height': '100%',
        'max-width': '100%',
        'margin': 'auto'
    });
});
</script>