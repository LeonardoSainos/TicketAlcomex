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

        if(@$_POST['Tickets']!=null)
        {
            foreach ($_POST['Tickets'] as  $IdTicket)
            {     
            
                 $llamar=MysqlQuery::Eliminar("ticket", "id=$IdTicket");
                 MysqlQuery::ProcedimientoAlmacenado("registro_alteracionesCliente","$user,'Eliminar','".date("Y-m-d H:i:s") ."','ticket'");
            }
            if($llamar)
            {
            echo "<script>alert('Tickets eliminados');
            window.history.go(-1);
            </script>";
            }
            else  
            {
                echo "<script>alert('Algo falló, revisa tu conexión a Internet');</script>";
            }
        }
        else  if(@$_POST['Tickets']==null) {
            ?>
            <script>
             alert("No haz seleccionado ningún ticket");
             window.history.go(-1);
            </script>
            <?php
        }
    }   
}

?>