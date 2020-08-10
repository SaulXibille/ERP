<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- BOOTSTRAP -->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-grid.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-reboot.min.css'); ?>">
  <!-- ESTILOS PERSONALIZADOS -->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/login.css'); ?>">
  <!-- FONT AWESOME -->
  <script src="https://kit.fontawesome.com/5aa15e27e7.js" crossorigin="anonymous"></script>
  <title>Inicio de sesion</title>
  <link rel="icon"  type="image/png" href="<?php echo base_url('assets/imagenes/Logo.png'); ?>">
</head>
<body>
  <div class="container">
    <div class="card card-container">
        <i class="fas fa-crow logo"></i>
        <form class="form-signin" id="form_login" name="form_login">
            <span id="reauth-email" class="reauth-email"></span>
            <input type="email" id="correo" name="correo" class="form-control" placeholder="Correo Electronico" required>
            <input type="password" id="contraseña" name="contraseña" class="form-control" placeholder="Contraseña" required>
            <div class="alert alert-danger" role="alert" id="error">
              Usuario Invalido!
            </div>
            <div class="alert alert-danger" role="alert" id="vacio">
              Completar Campos!
            </div>
            <div class="alert alert-danger" role="alert" id="e_correo">
              Ingrese un correo valido!
            </div>
            <button class="btn btn-lg btn-block btn-signin" id="btn_login">Iniciar Sesion</button>
        </form>
    </div>
  </div>


  <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-3.5.1.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.bundle.min.js'); ?>"></script>

  <script>
    $('#btn_login').click(function(e){
      e.preventDefault();
      if($('#correo').val() != "" && $('#contraseña').val() != "" ){

        if($("#correo").val().indexOf('@', 0) == -1 || $("#correo").val().indexOf('.', 0) == -1){
          $('#e_correo').show();
          $('#e_correo').delay(4500).hide(600);
          return false;
        } else {
          var formData = new FormData($("#form_login")[0]);
          $.ajax({
            url: "<?php echo base_url();?>Login/ingresar",
            type : "POST",
            data:formData,
            cache:false,
            contentType:false,
            processData:false,
            success:function(res) {
              console.log(res);
              if(res == "error") {
                $('#error').show();
                $('#error').delay(4500).hide(600);
              } else {
                window.location.href = "<?php echo base_url(); ?>Inicio";
              }
            } 
          });
        }
			} else {
        $('#vacio').show();
        $('#vacio').delay(4500).hide(600);
      }
    });
  </script>

</body>
</html>