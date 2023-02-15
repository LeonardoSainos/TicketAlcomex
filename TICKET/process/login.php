<?php 
    $nombre=MysqlQuery::RequestPost("nombre_login");
    $contra=md5(MysqlQuery::RequestPost("contrasena_login"));
    $radio=MysqlQuery::RequestPost('optionsRadios');
    if($nombre!="" && $contra!="" && $radio!=""){
        if($radio=="admin"){
            $sql=Mysql::consulta("SELECT * FROM cliente WHERE ((nombre_usuario= '$nombre' OR email_cliente='$nombre') AND clave='$contra') and id_rol = 4046");
            if(mysqli_num_rows($sql)>0){
                $reg=mysqli_fetch_array($sql, MYSQLI_ASSOC);
                $_SESSION['nombre']=$reg['nombre_usuario'];
                $_SESSION['id']=$reg['id_cliente'];
                $_SESSION['nombre_completo']=$reg['nombre_completo'];
                $_SESSION['email']=$reg['email_cliente'];
                $_SESSION['clave']=$contra;
                $_SESSION['rol'] = $reg['id_rol'];
//                $_SESSION['tipo']="admin";
            }else{
               echo '
                    <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                        <p class="text-center">
                            Nombre de usuario o contraseña incorrectos
                        </p>
                    </div>
                '; 
            }
        }elseif($radio=="user"){
            $sql=Mysql::consulta("SELECT * FROM cliente WHERE ((nombre_usuario = '$nombre' OR email_cliente  = '$nombre') AND clave='$contra' ) and id_rol = 9947");
            if(mysqli_num_rows($sql)>0){
                $reg=mysqli_fetch_array($sql, MYSQLI_ASSOC);
                $_SESSION['nombre']=$reg['nombre_usuario'];
                $_SESSION['id']=$reg['id_cliente'];           
                $_SESSION['nombre_completo']=$reg['nombre_completo'];
                $_SESSION['email']=$reg['email_cliente'];
                $_SESSION['clave']=$contra;
                $_SESSION['rol'] = $reg['id_rol'];
               // $_SESSION['tipo']="user";
            }
            else{
                echo '
                    <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                        <p class="text-center">
                            Nombre de usuario o contraseña incorrectos
                        </p>
                    </div>
                '; 
            }



        }
        elseif($radio=="tec" ){
            $sql=Mysql::consulta("SELECT * FROM cliente WHERE ((nombre_usuario = '$nombre' OR email_cliente  = '$nombre') AND clave='$contra' ) and id_rol = 5267");
            if(mysqli_num_rows($sql)>0){
                $reg=mysqli_fetch_array($sql, MYSQLI_ASSOC);
                $_SESSION['nombre']=$reg['nombre_usuario'];
                $_SESSION['id']=$reg['id_cliente'];           
                $_SESSION['nombre_completo']=$reg['nombre_completo'];
                $_SESSION['email']=$reg['email_cliente'];
                $_SESSION['clave']=$contra;
                $_SESSION['rol'] = $reg['id_rol'];
               // $_SESSION['tipo']="user";
            }
            else{
                echo '
                    <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                        <p class="text-center">
                            Nombre de usuario o contraseña incorrectos
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
                        No has seleccionado un usuario valido
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
                    No puedes dejar ningún campo vacío
                </p>
            </div>
        ';
    }