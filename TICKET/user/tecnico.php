<?php 
include '../lib/class_mysql.php';
include '../lib/config.php';

$idDepartamento = MysqlQuery::RequestPost('id_departamento');
if(isset($idDepartamento)){


    
$t = Mysql::consulta("SELECT * FROM cliente WHERE (id_rol = 5267 AND  idEstatus<> 25542 ) AND id_departamento= $idDepartamento");
//  $tecnicos = mysqli_fetch_array($t, MYSQLI_ASSOC);
   if(mysqli_num_rows($t)>0){
    $num = 1;
    while($tecnicos = mysqli_fetch_array($t)){
           $c=  Mysql:: consulta("SELECT * FROM ticket WHERE (fecha BETWEEN '" . date('Y-m-d') . " 00:00:00' AND '" .  date('Y-m-d'). " 23:59:59' ) AND id_atiende=" . $tecnicos['id_cliente']);
           if(mysqli_num_rows($c)<=20){

              echo "<option selected = 'selected' value= '" . $tecnicos['id_cliente'] .  " '>".
             " Técnico " .  $num;
              //$tecnicos['nombre_usuario'] .
               "</option>
              ";
        $num++;
            }
         }
  }
  else{
    echo "<option>No hay técnicos dispobiles</option>";
  }
}



?>