<?php
session_start();
include './lib/class_mysql.php';
include './lib/config.php';
header('Content-Type: text/html; charset=UTF8');
if($_SESSION['rol']!=4046){
    session_start(); 
    session_unset();
    session_destroy();
    header("Location: ./index.php"); 
}
?>
        <?php
            $ViewDiferent=["searchUsers","searchDepa","searchTicket","filterDepa","filterTicket","filterUsers"];
            $WhiteList=["ticketadmin","ticketedit","users","admin","config","tec","depa","depaedit","useredit","acciones"];
            if(isset($_GET['view']) && in_array($_GET['view'], $WhiteList) && is_file("./admin/".$_GET['view']."-view.php")){
              ?>            
                    <!DOCTYPE html>
                    <html>
                        <head>
                        <?php include "./inc/links.php"; ?>  
                            <title>Administracion</title>
                          
                        </head>
                        <body>   
                            <?php include "./inc/navbar.php"; ?>
                            <div class="container">
                            <div class="row">
                                <div class="col-sm-12">
                                <div class="page-header">
                                    <h1 class="animated lightSpeedIn">Panel Administrativo</h1>
                                    <span class="label label-warning">Alcomex S.A de C.V</span>
                                    <p class="pull-right text-primary">
                                    <strong>
                                    <?php include "./inc/timezone.php"; ?>
                                    </strong>
                                </p>
                                </div>
                                </div>
                            </div>
                            </div>
                        </body>
                    
                    </html><?php include "./admin/".$_GET['view']."-view.php";
                     include './inc/footer.php';             }
            else if(isset($_GET['view']) && in_array($_GET['view'],$ViewDiferent) && is_file("./admin/". $_GET['view']."-view.php")){
              ?>
                <!DOCTYPE html>
                <html>
                    <head>
                        <title>Administracion</title>
                       </head>
                    <body>   
                        <?php include "./inc/navbar.php"; ?>
                        <div class="container">
                       
                        </div>
                    </body>
                </html><?php include "./admin/".$_GET['view']."-view.php";
            }
            else{
                echo '<h2 class="text-center">Lo sentimos,la opción que ha seleccionado no se encuentra disponible</h2>';
            }
        ?>
        
        <script>
        $(document).ready(function (){
            $("#input_user").keyup(function(){
                $.ajax({
                    url:"./process/val_admin.php?id="+$(this).val(),
                    success:function(data){
                        $("#com_form").html(data);
                    }
                });
            });
            $("#input_user2").keyup(function(){
                $.ajax({
                    url:"./process/val_admin.php?id="+$(this).val(),
                    success:function(data){
                        $("#com_form2").html(data);
                    }
                });
            });
        });
        </script>
 