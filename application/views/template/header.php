<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $titulo;?></title>
  <link rel="icon"  type="image/png" href="<?php echo base_url('assets/imagenes/Logo.png'); ?>">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  
<!-- BOOTSTRAP -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
  <!-- ESTILOS PERSONALIZADOS -->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/menu.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/styles.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/tablas.css'); ?>">

  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url('assets/datatables/datatables.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/datatables/DataTables-1.10.21/css/dataTables.bootstrap4.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/datatables/Responsive-2.2.5/css/responsive.bootstrap4.min.css'); ?>">

  <!-- FONT AWESOME -->
  <!-- <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css"> -->
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

</head>
<body>
  <header>
    <div class="logout"><p>Administrador - <?php echo $this->session->userdata('s_nombreUsuario');?></p><a href="<?php echo base_url()?>Login/logout" title="Cerrar Sesion"><i class="fas fa-power-off"></i></a></div>
  </header>
