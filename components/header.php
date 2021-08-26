<?php
  session_start();
  error_reporting(0);
?>
<!-- ======= Header ======= -->
<header id="header" class="fixed-top d-flex align-items-center">
    <div class="container">
      <div class="header-container d-flex align-items-center justify-content-between">
        <div class="logo">
          <h1 class="text-light"><a href="./index.php"><span>MiCasitaYa</span></a></h1>
        </div>
        <nav id="navbar" class="navbar">
          <ul>
            <?php 
              if($_SESSION["s_usuario"] === null){
                echo '
                <li><a class="nav-link scrollto" href="./index.php">Inicio</a></li>
                <li><a class="nav-link scrollto" href="./about.php">Acerca de</a></li>
                <li><a class="nav-link scrollto" href="./services.php">Nuestros Servicios</a></li>
                <li><a class="nav-link scrollto " href="./inmuebles.php">Inmuebles</a></li>
                <li><a class="nav-link scrollto" href="./contact.php">Contacto</a></li>
                <li><a class="getstarted scrollto" href="./login.php">Login</a></li>
                ';
              }else{
                echo '
                <li><a class="nav-link scrollto" href="./index.php">Inicio</a></li>
                <li><a class="nav-link scrollto" href="./about.php">Acerca de</a></li>
                <li><a class="nav-link scrollto" href="./services.php">Nuestros Servicios</a></li>
                <li><a class="nav-link scrollto " href="./inmuebles.php">Inmuebles</a></li>
                <li><a class="nav-link scrollto" href="./contact.php">Contacto</a></li>
                <li><a class="nav-link scrollto" href="./dashboard/">Dashboard</a></li>
                <li><a class="getstarted scrollto" href="./conexion/logout.php">Logout</a></li>
                ';
              }
            ?>
          </ul>
          <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->
      </div><!-- End Header Container -->
    </div>
</header>
<!-- End Header -->