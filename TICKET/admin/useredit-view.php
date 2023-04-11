<?php
if(isset($_POST['id_edit']) && isset($_POST['nombre_completo']) && isset($_POST['email_cliente'])){
		$id_edit=MysqlQuery::RequestPost('id_edit');
    $estado = MysqlQuery::RequestPost('estado_cliente');
    $departamento = MysqlQuery:: RequestPost('departamento_cliente');
	 $rol= MysqlQuery::RequestPost('rol_cliente');
   $correo = MysqlQuery::RequestPost('email_cliente');
	 
		if(MysqlQuery::Actualizar("cliente", "email_cliente='$correo',id_departamento = '$departamento', id_rol='$rol', idEstatus= '$estado'", "id_cliente='$id_edit'")){
      $id = $_SESSION['id'];                            
      if(MysqlQuery::ProcedimientoAlmacenado("registro_alteracionesCliente","$id,'Actualizar','".date("Y-m-d H:i:s") ."','cliente'")){
 
      echo '
                <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="text-center">Usuario Actualizado</h4>
                    <p class="text-center">
                        El usuario fue actualizado con exito
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
                        No hemos podido actualizar el usuario
                    </p>
                </div>
            '; 
		}
	}     
	$id = MysqlQuery::RequestGet('id');
	$sql = Mysql::consulta("SELECT DISTINCT  r.idRol, r.Nombre as Nrol,c.telefono_celular, c.Fecha_creacion,c.id_cliente,c.nombre_completo,c.email_cliente, c.nombre_usuario,e.Nombre AS NombreE, e.idEstatus, d.nombre, d.idDepartamento FROM cliente c INNER JOIN estatus e ON c.idEstatus = e.idEstatus INNER JOIN departamento d ON d.idDepartamento = c.id_departamento INNER JOIN rol r ON c.id_rol= r.idRol  WHERE c.id_cliente= $id");
	$reg=mysqli_fetch_array($sql, MYSQLI_ASSOC);
?>
        <!--************************************ Page content******************************-->
        <div class="container">
          <div class="row">
            <div class="col-sm-3">
                <img src="./img/Edit.png" alt="Image" class="img-responsive animated tada">
            </div>
            <div class="col-sm-9">
                <a href="./admin.php?view=users" class="btn btn-warning btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Volver administrar usuarios</a>
            </div>
          </div>
        </div>
          <div class="container">
            <div class="col-sm-12">
                <form class="form-horizontal" role="form" action="" method="POST">
                		<input type="hidden" name="id_edit" value="<?php echo $reg['id_cliente']?>">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Fecha:</label>
                            <div class='col-sm-10'>
                                <div class="input-group">
                                    <input class="form-control" readonly="" type="text" name="fecha" readonly="" value="<?php echo $reg['Fecha_creacion']?>">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nombre:</label>
                            <div class='col-sm-10'>
                                <div class="input-group">
                                    <input class="form-control"   type="text" name="nombre_completo"  readonly=""  value="<?php echo $reg['nombre_completo']?>">
                                    <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Correo:</label>
                            <div class='col-sm-10'>
                                <div class="input-group">
                                    <input class="form-control"   type="text" name="email_cliente"    value="<?php echo $reg['email_cliente']?>">
                                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nombre de usuario:</label>
                            <div class='col-sm-10'>
                                <div class="input-group">
                                    <input class="form-control" readonly=""   type="text" name="nombre"   value="<?php echo $reg['nombre_usuario']?>">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                </div>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Estado:</label>
                            <div class='col-sm-10'>
                                <div class="input-group">                            
                                    <select class="form-control" name="estado_cliente">
                                    <option  value=" <?php echo $reg['idEstatus']; ?>"> <?php echo $reg['NombreE']; ?>   </option> 
                                      <?php 
                                        $sql = Mysql::consulta("SELECT * FROM estatus WHERE Nombre <> '".  $reg['NombreE'] . "'" . " AND ((idEstatus <> 94574 and idEstatus <> 94575) and idEstatus <> 94576 );");
                                        while( $reg1=mysqli_fetch_array($sql, MYSQLI_ASSOC)){
                                          echo "
                                            <option value='" . $reg1['idEstatus']  . "'>" .
                                             $reg1['Nombre'] ."
                                            </option>";
                                          }
                                        ?> 
                                      </select>
                                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                                </div>
                            </div>
                        </div>




                        <div class="form-group">
                            <label class="col-sm-2 control-label">Departamento:</label>
                            <div class='col-sm-10'>
                                <div class="input-group">                            
                                    <select class="form-control" name="departamento_cliente">
                                    <option  value=" <?php echo $reg['idDepartamento']; ?>"> <?php echo $reg['nombre']; ?>   </option> 
                                      <?php 
                                        $sql = Mysql::consulta("SELECT * FROM departamento WHERE nombre <> '".  $reg['nombre'] . "'");
                                        while( $reg1=mysqli_fetch_array($sql, MYSQLI_ASSOC)){
                                          echo "
                                            <option value='" . $reg1['idDepartamento']  . "'>" .
                                             $reg1['nombre'] ."
                                            </option>";
                                          }
                                        ?> 
                                      </select>
                                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                </div>
                            </div>
                        </div>



                        <div class="form-group">
                            <label class="col-sm-2 control-label">Rol:</label>
                            <div class='col-sm-10'>
                                <div class="input-group">                            
                                    <select class="form-control" name="rol_cliente">
                                    <option  value=" <?php echo $reg['idRol']; ?>"> <?php echo $reg['Nrol']; ?>   </option> 
                                      <?php 
                                        $sql = Mysql::consulta("SELECT * FROM rol WHERE Nombre <> '".  $reg['Nrol'] . "'");
                                        while( $reg1=mysqli_fetch_array($sql, MYSQLI_ASSOC)){
                                          echo "
                                            <option value='" . $reg1['idRol']  . "'>" .
                                             $reg1['Nombre'] ."
                                            </option>";
                                          }
                                        ?> 
                                      </select>
                                    <span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
                                </div>
                            </div>
                        </div>

                     <div class="form-group">
                          <label for="inputEmail3" class="col-sm-2 control-label">Teléfono:</label>
                          <div class="col-sm-10">
                              <div class='input-group'>
                                  <input type="email" readonly="" class="form-control"  name="telefono" readonly="" value="<?php echo $reg['telefono_celular']?>">
                                <span class="input-group-addon"><i class="fa fa-phone-square"></i></span>
                              </div> 
                          </div>
                        </div>

                        
                    <br>
                        <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10 text-center">
                              <form action="" method="POST">

                              <button type="submit" class="btn btn-warning">Actualizar usuario</button>
                                </form>
                            </div>
                        </div>
                      </form>
            </div><!--col-md-12-->
          </div><!--container-->