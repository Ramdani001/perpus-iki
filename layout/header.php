<!DOCTYPE html>
<html lang="en">
<?php session_start(); ?>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Perpus SMA 7 PASUNDAN</title>

  <!-- icon -->
  <link rel="shortcut icon" href="assets/images/logoSMA.png">

  <!-- Bootstrap -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="assets/css/font-awesome.min.css" rel="stylesheet">
  <link href="assets/fontawesome/css/all.css" rel="stylesheet">
  <link href="assets/fontawesome/css/all.min.css" rel="stylesheet">
  <!-- dataTable -->
  <link href="assets/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/responsive.bootstrap.min.css" rel="stylesheet">
  <!-- datepicker -->
  <link href="assets/css/datepicker.css" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="assets/css/custom.css" rel="stylesheet">
  <style type="text/css" media="screen">
    .modal-wide .modal-dialog {
      width: 40%;
    }

    .dropdown-menu {
      z-index: 2000 !important;
    }
  </style>
</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">


          <div class="clearfix"></div>

          <!-- menu profile quick info -->
          <div class="profile">
            <div class="profile_pic">
              <img src="assets/FtAdmin/<?php echo $_SESSION['admin']['gambar'] ?>" alt="..." class="img-circle profile_img" style="height: 50px;">
            </div>
            <div class="profile_info">
              <span>Welcome To Perpus</span>
              <h2><?php
                  
                  if (isset($_SESSION['admin'])) {
                    echo $_SESSION['admin']['nama'];
                  } ?>
              </h2>
              <h6 style="font-size: 8px;">
                   <?php if($_SESSION['admin']['status'] == "superAdmin") {?>
                     SUPER ADMINISTRATOR
                   <?php }else{?>
                     ADMINISTRATOR
                   <?php }?>
               </h6>
            </div>
          </div>
          <!-- /menu profile quick info -->

          <br />