<?php
if($_SESSION['nombre']!="" && $_SESSION['rol']==4046){ 

if(@$_POST['Bloquear'])
    {
        
        if(@$_POST['Usuarios']!=null)
        {
            foreach ($_POST['Usuarios'] as  $IdAlumno) {
                $Actualizar = MysqlQuery::Actualizar("cliente", "idEstatus=25542","id_cliente= $IdAlumno");
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
}

?>