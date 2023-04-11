<?php
if(isset($_POST['id_edit']) && isset($_POST['nombre']) && isset($_POST['correo'])){
  
		$id_edit=MysqlQuery::RequestPost('id_edit');
        $nombre = MysqlQuery::RequestPost('nombre');
        $correo = MysqlQuery::RequestPost('correo');
        $estado = MysqlQuery::RequestPost('estado_departamento');
        $lider = MysqlQuery::RequestPost('lider');
        $descripcion = MysqlQuery::RequestPost('descripcion');
	   
	 
		if(MysqlQuery::Actualizar("departamento", "nombre='$nombre', correo='$correo', descripcion= '$descripcion',idEstatus='$estado',idJefe='$lider'", "idDepartamento='$id_edit'")){
      $id = $_SESSION['id'];                            
      MysqlQuery::ProcedimientoAlmacenado("registro_alteracionesCliente","$id,'Actualizar','".date("Y-m-d H:i:s") ."','departamento'");
 
    
      echo '
                <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="text-center">Departamento Actualizado</h4>
                    <p class="text-center">
                        El departamento fue actualizado con exito
                    </p>
                </div>
            ';
			 
		}else{
			echo '
                <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                    <p class="text-center">
                        No hemos podido actualizar el departamento
                    </p>
                </div>
            '; 
		}
	}     
	$id = MysqlQuery::RequestGet('id');
	$sql = Mysql::consulta("SELECT DISTINCT d.fecha,d.idDepartamento,d.nombre,d.correo,d.descripcion, e.Nombre,e.idEstatus, c.id_cliente, c.nombre_completo, c.email_cliente FROM departamento d INNER JOIN estatus e ON d.idEstatus = e.idEstatus INNER JOIN cliente c ON d.idJefe = c.id_cliente  WHERE d.idDepartamento= $id");
	$reg=mysqli_fetch_array($sql, MYSQLI_ASSOC);
?>
        <!--************************************ Page content******************************-->
        <div class="container">
          <div class="row">
            <div class="col-sm-3">
                <img src="./img/Edit.png" alt="Image" class="img-responsive animated tada">
            </div>
            <div class="col-sm-9">
                <a href="./admin.php?view=depa" class="btn btn-warning btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Volver administrar departamentos</a>
            </div>
          </div>
        </div>
          <div class="container">
            <div class="col-sm-12">
                <form class="form-horizontal" role="form" action="" method="POST">
                		<input type="hidden" name="id_edit" value="<?php echo $reg['idDepartamento'];?>">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Fecha:</label>
                            <div class='col-sm-10'>
                                <div class="input-group">
                                    <input class="form-control" readonly="" type="text" name="fecha_ticket" value="<?php echo $reg['fecha'];?>">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nombre:</label>
                            <div class='col-sm-10'>
                                <div class="input-group">
                                    <input class="form-control"   type="text" name="nombre"   value="<?php echo $reg['nombre'];?>">
                                    <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Correo:</label>
                            <div class='col-sm-10'>
                                <div class="input-group">
                                    <input class="form-control"   type="text" name="correo"  value="<?php echo $reg['correo'];?>">
                                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                </div>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Estado:</label>
                            <div class='col-sm-10'>
                                <div class="input-group">


                            
                                    <select class="form-control" name="estado_departamento">
                                 
                                    <option  value=" <?php echo $reg['idEstatus']; ?>"> <?php echo $reg['Nombre']; ?>   </option> 
                                      <?php 
                                        $sql = Mysql::consulta("SELECT * FROM estatus WHERE Nombre <> '".  $reg['Nombre'] . "'" . " AND ((idEstatus <> 94574 and idEstatus <> 94575) and idEstatus <> 94576 );");
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
                          <label  class="col-sm-2 control-label">Líder:</label>
                          <div class="col-sm-10">
                              <div class='input-group'>

                              <select class="form-control" name="lider">
                                 <option  value=" <?php echo $reg['id_cliente']; ?>"> <?php echo $reg['nombre_completo']; ?>   </option> 
                                   <?php 
                                     $sql = Mysql::consulta("SELECT * FROM cliente WHERE  nombre_completo<> '" . $reg['nombre_completo'] . "' ORDER BY nombre_completo");
                                     while( $reg1=mysqli_fetch_array($sql, MYSQLI_ASSOC)){
                                       echo "
                                         <option value='" . $reg1['id_cliente']  . "'>" .
                                          $reg1['nombre_completo'] ."
                                         </option>";
                                       }
                                     ?>    
                              </select>
                              <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            
                              </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="inputEmail3" class="col-sm-2 control-label">Contacto:</label>
                          <div class="col-sm-10">
                              <div class='input-group'>
                                  <input type="email"   class="form-control"  name="email_contacto" readonly="" value="<?php echo $reg['email_cliente'];?>">
                                <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                              </div> 
                          </div>
                        </div>

                        <div class="form-group">
                          <label  class="col-sm-2 control-label">Descripción:</label>
                          <div class="col-sm-10">
                              <div class='input-group'>
                                  <input type="text"  class="form-control"  name="descripcion"  value="<?php echo $reg['descripcion'];?>">
                                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                              </div> 
                          </div>
                        </div>
                    <br>
                        <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10 text-center">
                              <form action="" method="post">

                              <button type="submit" class="btn btn-warning">Actualizar Departamento</button>
                                </form>
                            </div>
                        </div>
                      </form>
            </div><!--col-md-12-->
          </div><!--container-->