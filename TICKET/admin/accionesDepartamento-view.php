<?php
include ('../lib/class_mysql.php');
include('../lib/config.php');
date_default_timezone_set('America/Mexico_City');
setlocale(LC_TIME, 'spanish');
if($_POST['nombre']!="" && $_POST['rol']==4046 && $_POST['id']){ 
    

    $user= $_POST['id'];
  //ELIMINAR TICKETS
    if(@$_POST['Eliminar'])
    {

        if(@$_POST['Depas']!=null)
        {
            foreach ($_POST['Depas'] as  $IdDepa)
            {        
                $llamar=MysqlQuery:: ProcedimientoAlmacenado("Depa","$IdDepa");
                MysqlQuery::ProcedimientoAlmacenado("registro_alteracionesCliente","$user,'Eliminar','".date("Y-m-d H:i:s") ."','departamento'");
            }

            if($llamar)
            {
            echo "<script>alert('Departamentos eliminados');
            window.history.go(-1);
            </script>";
            }
            else  
            {
                echo "<script>alert('Algo falló, revisa tu conexión a Internet');</script>";
            }
        }
        else  if(@$_POST['Depas']==null) {
            ?>
            <script>
             alert("No haz seleccionado ningún departamento");
             window.history.go(-1);
            </script>
            <?php
        }
    }   
}

?>