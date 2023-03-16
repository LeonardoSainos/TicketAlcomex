<?php

if(isset($_POST['id_edit']) && isset($_POST['solucion_ticket']) && isset($_POST['estado_ticket'])){
		$id_edit=MysqlQuery::RequestPost('id_edit');
		$estado_edit=  MysqlQuery::RequestPost('estado_ticket');
		$solucion_edit=  MysqlQuery::RequestPost('solucion_ticket');
		$radio_email=  MysqlQuery::RequestPost('optionsRadios');
    $Atiende_edit = MysqlQuery :: RequestPost('id_atiende');
    $fecha = MysqlQuery :: RequestPost('fecha_ticket');


		$cabecera="From: alcomex<correodepruebasutp@gmail.com>";
		$mensaje_mail="Estimado usuario la solución a su problema es la siguiente : ".$solucion_edit;
		$mensaje_mail=wordwrap($mensaje_mail, 70, "\r\n");
//  echo "<script> alert('" . $estado_edit . "' ); </script>";
		if(MysqlQuery::Actualizar("ticket", "fecha='$fecha',id_atiende='$Atiende_edit', idStatus='$estado_edit', solucion='$solucion_edit',fecha_actualizacion= '" . date("Y-m-d H:i:s"). "'", "id='$id_edit'")){
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
				mail($email_edit, $asunto_edit, $mensaje_mail, $cabecera);
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

	     
	$id = MysqlQuery::RequestGet('id');
	$sql = Mysql::consulta("SELECT t.id_atiende as atender,t.id, t.fecha, t.serie, t.asunto, t.mensaje, t.solucion, c.nombre_completo , c.email_cliente, d.nombre as departamento, e.Nombre, e.idEstatus FROM ticket t INNER JOIN cliente c ON t.idUsuario = c.id_cliente INNER JOIN departamento d ON d.idDepartamento = t.idDepartamento INNER JOIN estatus e ON t.idStatus = e.idEstatus  WHERE t.id= $id");
	$reg=mysqli_fetch_array($sql, MYSQLI_ASSOC);

?>


        <!--************************************ Page content******************************-->
        <div class="container">
          <div class="row">
            <div class="col-sm-3">
                <img src="./img/Edit.png" alt="Image" class="img-responsive animated tada">
            </div>
            <div class="col-sm-9">
                <a href="./admin.php?view=ticketadmin" class="btn btn-warning btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Volver administrar Tickets</a>
            </div>
          </div>
        </div>
          <div class="container">
            <div class="col-sm-12">
                <form class="form-horizontal" role="form" action="" method="POST">
                		<input type="hidden" name="id_edit" value="<?php echo $reg['id']?>">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Fecha:</label>
                            <div class='col-sm-10'>
                                <div class="input-group">
                                    <input class="form-control"  title="El formato debe contener fecha y hora"    pattern="[0-9]{4}-[0-9]{2}-[0-9]{2} [0-2]{1}[0-9]{1}:[0-5]{1}[0-9]{1}:[0-5]{1}[0-9]{1}" type="text" name="fecha_ticket"  value="<?php echo $reg['fecha']?>">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Serie:</label>
                            <div class='col-sm-10'>
                                <div class="input-group">
                                    <input class="form-control" readonly="" type="text" name="serie_ticket" readonly="" value="<?php echo $reg['serie']?>">
                                    <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                </div>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Estado:</label>
                            <div class='col-sm-10'>
                                <div class="input-group">


                            
                                    <select class="form-control" name="estado_ticket">
                                 
                                    <option  value=" <?php echo $reg['idEstatus']; ?>"> <?php echo $reg['Nombre']; ?>   </option> 
                                      <?php 
                                        $sql = Mysql::consulta("SELECT * FROM estatus WHERE Nombre <> '".  $reg['Nombre'] . "'" . "  AND ((idEstatus <> 31448 AND idEstatus <> 94573 ) AND   (idEstatus <> 19231 AND idEstatus<>   25542 ) ) ");
                                        while( $reg1=mysqli_fetch_array($sql, MYSQLI_ASSOC)){
                                          echo "
                                            <option value='" . $reg1['idEstatus']  . "'>" .
                                             $reg1['Nombre'] ."
                                            </option>";
                                          }
                                        ?> 
                                   
                                      </select>


                                      
                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">  
                          <label  class="col-sm-2 control-label">Nombre:</label>
                          <div class="col-sm-10">
                              <div class='input-group'>
                                  <input type="text" readonly="" class="form-control"  name="name_ticket" readonly="" value="<?php echo $reg['nombre_completo']?>">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                              </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="inputEmail3" class="col-sm-2 control-label">Email:</label>
                          <div class="col-sm-10">
                              <div class='input-group'>
                                  <input type="email" readonly="" class="form-control"  name="email_ticket" readonly="" value="<?php echo $reg['email_cliente']?>">
                                <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                              </div> 
                          </div>
                        </div>

                        <div class="form-group">
                          <label  class="col-sm-2 control-label">Departamento:</label>
                          <div class="col-sm-10">
                              <div class='input-group'>
                                  <input type="text" readonly="" class="form-control"  name="departamento_ticket" readonly="" value="<?php echo $reg['departamento']?>">
                                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                              </div> 
                          </div>
                        </div>

                        <div class="form-group">
                          <label  class="col-sm-2 control-label">Asunto:</label>
                          <div class="col-sm-10">
                              <div class='input-group'>
                                  <input type="text" readonly="" class="form-control"  name="asunto_ticket" readonly="" value="<?php echo $reg['asunto']?>">
                                <span class="input-group-addon"><i class="fa fa-paperclip"></i></span>
                              </div> 
                          </div>
                        </div>
                        <div class="form-group">
                          <label  class="col-sm-2 control-label">Atiende</label>
                          <div class="col-sm-10">
                              <div class='input-group'>
                              <select class="form-control" name="id_atiende">

                                        <?php $a= Mysql ::consulta("SELECT * FROM cliente where id_cliente=  " . $reg['atender'] . ""    ); 
                                        $atiende = mysqli_fetch_array($a, MYSQLI_ASSOC); ?>
    


                                    <option  value=" <?php echo $reg['atender']; ?>"> <?php echo $atiende['nombre_completo']; ?>   </option> 
                                      <?php 
                                        $t1 = Mysql::consulta("SELECT * FROM cliente WHERE id_rol= 5267 AND id_cliente<>'" . $reg['atender']. "'");
                                        while( $t2=mysqli_fetch_array($t1, MYSQLI_ASSOC)){
                                          echo "
                                            <option value='" . $t2['id_cliente']  . "'>" .
                                             $t2['nombre_completo'];?>  
                                            </option>
                                            <?php
                                          }
                                        ?> 
                                       
                                      </select>
     
                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                   
                              </div> 
                          </div>
                        </div>

                        <div class="form-group">
                          <label  class="col-sm-2 control-label">Mensaje:</label>
                          <div class="col-sm-10">
                              <textarea class="form-control" readonly="" rows="3"  name="mensaje_ticket" readonly=""><?php echo $reg['mensaje']?></textarea>
                          </div>
                        </div>
                    
                        <div class="form-group">
                          <label  class="col-sm-2 control-label">Solución:</label>
                          <div class="col-sm-10">
                            <textarea class="form-control" rows="3"  name="solucion_ticket" required=""><?php echo $reg['solucion'];?></textarea>
                          </div>
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
                              <button type="submit" class="btn btn-warning">Actualizar ticket</button>
                          </div>
                        </div>

                      </form>
            </div><!--col-md-12-->
          </div><!--container-->



       