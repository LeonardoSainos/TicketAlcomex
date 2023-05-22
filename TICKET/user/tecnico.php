<?php 
include '../lib/class_mysql.php';
include '../lib/config.php';
$idDepartamento = MysqlQuery::RequestPost('id_departamento');
if(isset($idDepartamento)){
    $t = Mysql::consulta("SELECT * FROM cliente WHERE ((id_rol = 5267 OR id_rol=4046)AND  idEstatus=31448 ) AND id_departamento= $idDepartamento ORDER BY nombre_completo");

    if(mysqli_num_rows($t)>0){
        $tecnicos = mysqli_fetch_all($t, MYSQLI_ASSOC);
        shuffle($tecnicos); // Mezcla los resultados de la consulta
        $num = 1;
        for($i=0; $i<count($tecnicos); $i++){
            $c=  Mysql:: consulta("SELECT * FROM ticket WHERE (fecha BETWEEN '" . date('Y-m-d') . " 00:00:00' AND '" .  date('Y-m-d'). " 23:59:59' ) AND id_atiende=" . $tecnicos[$i]['id_cliente']);
            if(mysqli_num_rows($c)<=20){
                echo "<option selected='selected' value='" . $tecnicos[$i]['id_cliente'] . "'>" .
                " Técnico " . $num . "</option>";
                $num++;
            }
        }
    }
    else{
        echo "<option value=''>No hay técnicos disponibles</option>";
    }
}

?>