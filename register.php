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

  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">
  <link rel="stylesheet" type="text/css" href="fuentes/iconic/css/material-design-iconic-font.min.css">

  <!-- Template Main CSS File -->
  <link href="assets/css/login.css" rel="stylesheet">

</head>

<body>

    <div class="container-login">
        <div class="wrap-login">
            <form class="login-form validate-form" id="formLogin" action="" method="post">
                <span class="login-form-title">Register</span>
                
                <div class="wrap-input100" data-validate="Usuario incorrecto">
                    <input class="input100" type="text" id="usuario" name="usuario" placeholder="Usuario">
                    <span class="focus-efecto"></span>
                </div>
                
                <div class="wrap-input100" data-validate="Password incorrecto">
                    <input class="input100" type="password" id="password" name="password" placeholder="Password">
                    <span class="focus-efecto"></span>
                </div>

                
                <div class="container-login-form-btn">
                    <div class="wrap-login-form-btn">
                        <div class="login-form-bgbtn"></div>
                        <button type="submit" name="submit" class="login-form-btn">Registrarse</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
    
    

  <!-- Other JS Scripts -->
  <script src="jquery/jquery-3.3.1.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstraps.min.js"></script>
  <script src="popper/popper.min.js"></script>
  <script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>

  <!-- Template Main JS File -->
  <script src="register.js"></script>

</body>
</html>