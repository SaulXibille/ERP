<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- BOOTSTRAP -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <!-- ESTILOS PERSONALIZADOS -->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/login.css'); ?>">
  <!-- FONT AWESOME -->
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
  <script src="https://kit.fontawesome.com/5aa15e27e7.js" crossorigin="anonymous"></script>
  <title>Inicio de sesion</title>
</head>
<body>
  <div class="container">
    <div class="card card-container">
        <i class="fas fa-crow logo"></i>
        <p id="profile-name" class="profile-name-card"></p>
        <form class="form-signin" method="POST" action="<?php echo base_url(); ?>Login/ingresar" id="form_login">
            <span id="reauth-email" class="reauth-email"></span>
            <input type="email" id="correo" name="correo" class="form-control" placeholder="Correo Electronico" required autofocus>
            <input type="password" id="contraseña" name="contraseña" class="form-control" placeholder="Contraseña" required>
            <?php 
              if($mensaje == ''){

              }else {
                echo '<div class="alert alert-danger"><strong>'.$mensaje.'</strong> </div>'; 
              }
            ?>
            <button class="btn btn-lg btn-block btn-signin" type="submit">Iniciar Sesion</button>
        </form>
    </div>
  </div>
</body>
</html>