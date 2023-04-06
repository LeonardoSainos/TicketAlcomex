<?php
session_start();
include './lib/class_mysql.php';
include './lib/config.php';
header('Content-Type: text/html; charset=UTF8');
if($_SESSION['rol']!=5267){
    session_start(); 
    session_unset();
    session_destroy();
    header("Location: ./index.php"); 
}
?>
        <?php
            $ViewDiferent=["searchUsers","searchDepa","searchTicket","filterDepa","filterTicket","filterUser"];
            $WhiteList=["ticketTecni","ticketedit","users","tecni","config","tec","useredit"];
            if(isset($_GET['view']) && in_array($_GET['view'], $WhiteList) && is_file("./tecni/".$_GET['view']."-view.php")){
              ?>            
                    <!DOCTYPE html>
                    <html>
                        <head>
                            <title>Administracion</title>
                            <?php include "./inc/links.php"; ?>        
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
                    </html><?php include "./tecni/".$_GET['view']."-view.php";
                     include './inc/footer.php';        
            }
            else if(isset($_GET['view']) && in_array($_GET['view'],$ViewDiferent) && is_file("./tecni/". $_GET['view']."-view.php")){
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
                </html><?php include "./tecni/".$_GET['view']."-view.php";
            }
            else{
?>  
                    <!DOCTYPE html>
                    <html>
                        <head>
                            <title>Técnico</title>
                            <?php include "./inc/links.php"; ?>        
                        </head>
                        <body>   
                            <?php include "./inc/navbar.php"; ?>
                            <div class="container">
                            <div class="row">
                                <div class="col-sm-12">
                                <div class="page-header">
                                    <h1 class="animated lightSpeedIn">Panel técnico</h1>
                                    <span class="label label-warning">Alcomex S.A de C.V</span>
                                    <p class="pull-right text-primary">
                                    <strong>
                                    <?php include "./inc/timezone.php"; ?>
                                    </strong>
                                </p>
                                </div>
                                </div>
                                <h1 class="text-center">Lo sentimos,la opción que ha seleccionado no se encuentra disponible</h1>

                            </div>
                            </div>
                          <br><br><br><br><br><br><br><br><br><br><br><br><br><br>   <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                            <?php   include './inc/footer.php'; ?>
                            </body>
                        </html>
                 <?php
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
 