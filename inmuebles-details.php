<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>MiCasitaYa</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

  <?php
      include 'components/header.php';
  ?>

  <?php 
      include_once './conexion/conexion.php';
      $id = $_GET['id'];
      $objeto = new Conexion();
      $conexion = $objeto->Conectar();

      $consulta = "SELECT * FROM inmuebles WHERE id='$id' ";
      $resultado = $conexion->prepare($consulta);
      $resultado->execute();
      $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

      $consulta = "SELECT * FROM categorias";
      $resultado = $conexion->prepare($consulta);
      $resultado->execute();
      $categorias=$resultado->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="mt-5 portfolio-details">
    <br>
      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-8">
            <div class="portfolio-details-slider swiper-container">
              <div class="swiper-wrapper align-items-center">

                <?php 
                  $imgs = explode(",", $data[0]["url_imgs"]);
                  $c_imgs = count($imgs);
                  for($i = 0; $i < $c_imgs; $i++){
                    echo '
                    <div class="swiper-slide">
                      <img src="'.$imgs[$i].'" alt="">
                    </div>
                    ';
                  }
                ?>

              </div>
              <div class="swiper-pagination"></div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="portfolio-info">
              <h3>Información Inmueble:</h3>
              <ul>
                <li><strong>Titulo</strong>: <?php echo $data[0]['titulo'];  ?> </li>
                <li><strong>Categoria</strong>: <?php echo $categorias[$data[0]['categoria'] - 1]['name'];  ?> </li>
                <li><strong>Area</strong>: <?php echo $data[0]['area'];  ?> </li>
                <li><strong>Precio</strong>: <?php echo '$'.number_format($data[0]['precio']); ?> </li>
                <li><strong>Contacto</strong>: <?php echo $data[0]['contacto']; ?> </li>
              </ul>
            </div>
            <div class="portfolio-description">
              <h2>Descripción</h2>
              <p>
                <?php echo $data[0]['descripcion']; ?>
              </p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Portfolio Details Section -->

    <?php 
        include 'components/footer.php'  
    ?>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/purecounter/purecounter.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>
</html>