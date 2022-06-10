<?php 
  session_start();
  if (!isset($_SESSION['user']) || $_SESSION['userType'] != 2)
    header("Location: ../index.php");

  include '../services/helper.php';
  include '../services/connection.php';

  $id_usuario = $_SESSION['user'];
  $user_type = $_SESSION['userType'];

  $data = [
    "idUsuario" => $id_usuario,
  ];
  
  $sucursal = json_decode(POST("Administrador/services/getSucursal.php", $data), true);
  $sucursal = $sucursal[0];

  $data = [
    "sucursal" => $sucursal,
  ];
  $region_iva =  json_decode(POST("Administrador/services/getRegionSucursal.php", $data), true);
  $region_iva = $region_iva[0];

  $categorias = json_decode(POST("Administrador/services/getCategories.php", $data), true);
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Evita reenviar el formulario cuando se recarga la página-->
    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>  
    <meta charset="UTF-8">                      
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" >

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../css/estilos.css">
    <script src="js/jsAdmin.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/charts.css/dist/charts.min.css">

  </head>
  <body >
    <div class="container-fluid" >
        <?php include 'inc/header.php' ?>


        <div class="row" >
          <div class="col-2" style="height: 90vh; ">
            <?php 
              // $user_type = 'vendedor';
              include 'inc/sidenavbar.php' 
            ?>
          </div>
            <div class="col ">
              <?php
                if (isset($_GET['recibos'])){
                  include 'inc/recibos.php';
                }else if (isset($_GET['reportes'])){
                  include 'inc/reportes.php';
                }else if (isset($_GET['inventario'])){
                  include 'inc/inventario.php';
                }else if (isset($_GET['configuracion'])){
                  include 'inc/configuracion.php';
                }else if (isset($_GET['ayuda_y_soporte'])){
                  include 'inc/ayuda_y_soporte.php';
                }
              ?>
            </div>
        </div>
        <?php  include 'inc/footer.php'; ?>
      </div>
  </body>
</html>