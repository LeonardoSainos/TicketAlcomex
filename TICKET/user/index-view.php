<!--************ Imagen que reemplaza el carousel para dispositivos moviles ********-->
<div id="img-linux-tux" class="container hidden-lg hidden-md hidden-sm">
    <center><img src="img/trailers/3T.jpg" class="img-responsive img-rounded" alt="Image"></center>
</div>

<!--************************************Carousel******************************-->
<div class="container hidden-xs">
  <div class="col-xs-12">
    <div id="carousel-example-generic" class="carousel slide">
      <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        <li data-target="#carousel-example-generic" data-slide-to="3"></li>
           </ol>
      <div class="carousel-inner">
        <div class="item active">
          <img class="img-fluid d-block" src="img/trailers/2T.jpg" alt="">
          <div class="carousel-caption">
          </div>
        </div>
        <div class="item">
          <img class="img-fluid d-block" src="img/Trailers/track1.jpg" alt="">
          <div class="carousel-caption">
          </div>
        </div>
        <div class="item">
          <img class="img-fluid d-block" src="img/Trailers/1T.jpg" alt="">
          <div class="carousel-caption">
          </div>
        </div>
        <div class="item ">
          <img class="img-fluid d-block" src="img/Trailers/3T.jpg" alt="">
          <div class="carousel-caption">
          </div>
        </div>
        
      </div>
      <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
        <span class="icon-prev"></span>
      </a>
      <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
        <span class="icon-next"></span>
      </a>
    </div>
  </div>
  <div class="col-sm-2">&nbsp;</div>
</div>

<!--************************************ Fin Carousel******************************-->

 <hr class="hidden-xs">

<div class="container">
  <div class="row">
    <div class="col-md-12">
         <strong>  <h1 class="text-center" style="color:#fb5d14;">¡BIENVENIDO AL CENTRO DE SOPORTE !</h1></strong>
    </div>
  </div>
</div>
<br>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-12 thumbnail">
            <h3 class="text-center">Sistema de Tickets Soporte Técnico Alcomex</h3>
            <img  src="img/TransP_ALCOMEX.png"  class="img-fluid d-block" alt="Image">
             <h4 style="text-align:center; padding:10px;">
             El objetivo del sistema de Centro de Soporte es llevar un registro detallado de las problemáticas y solicitudes de los usuarios de <strong> Transporte y Logística Alcomex </strong>, como parte del soporte técnico que brindan cada una de las áreas que la integran, para ofrecer una respuesta y/o solución de ellos a la brevedad posible o en su defecto gestionar su solución con la persona responsable del tema en cuestión.
            </h4>
        </div>
        <div class="col-xs-12 col-md-12 thumbnail">
          <h3 class="text-center">¿Quiénes somos? </h3>
            <img src="img/trailers/lupa.jpg" class="img-responsive " alt="Image">
            <h4  style="text-align:center; padding:10px;">
            Empresa Poblana, creada en 2016, ante la necesidad de satisfacer el flujo óptimo de mercancías en distintas zonas del país.
            Con unidades tipo Trailers y remolques de 48 y 53 pies de capacidad e iniciando en rutas del Sureste, Sur Oeste, Occidente y Norte de
            nuestra República Mexicana.<br>
            Hemos generado nuestra propia plataforma de rastreo, la cual otorga ubicación fidedigna y
            tiempo de respuesta acelerado.
            Hoy en día, contamos con unidades tipo Trailers, Thorton, Rabones, Camioneta de 3.5 Toneladas y Camionetas tipo VAN </h4>
        </div>
        <div class="col-xs-12 col-md-6 thumbnail">
            <h3 class="text-center">Misión</h3>
            <img src="img/trailers/mapa.jpg" class="xp" alt="Image">
            <h4  style="text-align:center; padding:10px;">
            Ofrecer servicios de transporte de carga con mayor capacidad de respuesta y dominio en todo México, aprovechando la experiencia, conocimiento y estrategias
            de negocios que nos amparan, cumpliendo con los servicios ofrecidos para la satisfacción de nuestros clientes implementando los estándares de Calidad,
            Medio Ambiente y Seguridad en el trabajo.
            </h4>
        </div>
        <div class="col-xs-12 col-md-6 thumbnail">
            <h3 class="text-center">Visión</h3>
            <img src="img/trailers/rentame.jpg" class="xp" alt="Image">
             <h4  style="text-align:center; padding:10px;">
                    Consolidarnos como una de las mejores empresas de Transporte y Logística en el país, expandiendo nuestros servicios en toda la República, satisfaciendo las expectativas de todo cliente y dando como resultado una
                    rentabilidad para las organizaciones que contraten nuestro servicio y una estabilidad laboral a nuestros colaboradores.
            </h4>
        </div>
        <div class="col-xs-12 col-md-12 thumbnail text-center">
           <strong> <h4> Ellos confian en nosotros</h4></strong>
             <img src="img/Empresas4.jpg" class="img-responsive" alt="Image">
        </div>
         
    </div>
</div>

<style>
    .carousel-inner .item img {
  width: 1200px;
  height: 500px;
}

.xp{

width: 600px;
height: 250px;

}

</style>

<script>
    $(document).ready(function(){
        $("#carousel-example-generic").carousel({
            interval: 2500,
        });
    });
</script>