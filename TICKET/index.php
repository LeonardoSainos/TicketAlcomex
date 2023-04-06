<?php
session_start();
include './lib/class_mysql.php';
include './lib/config.php';   
$ViewDiferent=["searchTicket","filterTicket"];
$WhiteList=["index","productos","soporte","ticket","ticketcon","registro","configuracion","ticketClient",""];

if(isset($_GET['view'])){

  $content=$_GET['view'];


if(isset($_GET['view']) && in_array($_GET['view'],$WhiteList) && is_file("./user/". $_GET['view'] . "-view.php"))
{
                      ?>
                      <!DOCTYPE html>
                      <html>
                          <head>
                              <meta charset="UTF8"/>
                              <title>Alcomex soporte técnico</title>
                              <link rel="icon" href="favicon.png">
                              <?php include "./inc/links.php"; ?>        
                          </head>
                          <body style="background-image:'/img/Transp_ALCOMEX.png';" >   
                              <?php include "./inc/navbar.php"; ?>
                              <div class="container">
                                <div class="row">
                                  <div class="col-sm-12">
                                    <div class="page-header">
                                      <h1 class="animated lightSpeedIn">Alcomex <small>México</small></h1>
                                      <span class="label label-warning">Transporte de logística S.A de C.V</span>
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
                      </html> </html><?php include "./user/".$_GET['view']."-view.php";
                       include './inc/footer.php'; ?>
        <?php



} else if(isset($_GET['view']) && in_array($_GET['view'],$ViewDiferent) && is_file("./user/". $_GET['view']."-view.php")){
         ?>
          <!DOCTYPE html>
                <html>
                    <head>
                        <title>Alcomex soporte técnico</title>
                          </head>
                    <body>   
                        <?php include "./inc/navbar.php"; ?>
                        <div class="container">
                       
                        </div>
                    </body>
                </html><?php include "./user/".$_GET['view']."-view.php";
} 
          else {
            ?>
            
            <!DOCTYPE html>
                    <html>
                        <head>
                            <title>Alcomex soporte técnico</title>
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

 }
 else{
  ?>

<!DOCTYPE html>
<html>
    <head>
         <meta charset="UTF8"/>
         <title>Alcomex soporte técnico</title>
        <link rel="icon" href="favicon.png">
        <?php include "./inc/links.php"; ?>        
    </head>
    <body style="background-image:'/img/Transpo_ALCOMEX.png';" >   
        <?php include "./inc/navbar.php"; ?>
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <div class="page-header">
                <h1 class="animated lightSpeedIn">Alcomex <small>México</small></h1>
             

          
                <span class="label label-warning">Transporte de logística S.A de C.V</span>
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
                      </html> </html><?php 
                include "./user/index-view.php";
                include './inc/footer.php';
                ?>

                
  <?php
 
}
              
         ?>
           

