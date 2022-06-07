<?php

$errores = false;

// * ==========================================================================================================================
// *                                                PROVEEDORES CRUD                                                          |
// * ==========================================================================================================================

if(isset($_POST['editProveedor'])){
  // var_dump($_POST);
  $data = [
    'idProveedor' => $_POST['id_proveedor'],
    'nombre' => $_POST['nombre'],
    'telefono' => $_POST['telefono'],
    'correo' => $_POST['correo']
  ];
  
}

// * ==========================================================================================================================
// *                                                SUCURSALES CRUD                                                           |
// * ==========================================================================================================================

if(isset($_POST['updateSucursal'])){
  $data = [
    'fkUsuario' => $_POST['id_usuario'],
    'idSucursal' => $_POST['sucursal']
  ];
  $status = json_decode(POST('SuperAdministrador/services/updateSucursalUsuario.php', $data), true);
  if($status[0] != '¡Error!'){
    echo ('
      <script>
        alertSucursalAsignada()
      </script>
    ');
  }
}


// * ==========================================================================================================================
// *                                                  USUARIOS CRUD                                                           |
// * ==========================================================================================================================

if (isset($_POST['agregarUsuario'])){
  $nombre = $_POST['nombre'];
  $apellidoP = $_POST['apellidoP'];
  $apellidoM = $_POST['apellidoM'];
  $usuario = $_POST['usuario'];
  $correo = $_POST['correo'];
  $telefono = $_POST['telefono'];
  $pass = $_POST['password'];
  $pass2 = $_POST['password2'];
  $rol = $_POST['rol'];

  if(empty($nombre) || empty($apellidoP) || empty($apellidoM) || empty($usuario) || empty($correo) 
      || empty($telefono) || empty($pass) || empty($pass2) || empty($rol))
    echo('
      <script>
        alertCamposVacios()
      </script>
    ');
  else {
    $stmt = $pdo->prepare('SELECT * FROM usuario WHERE usuario = :usuario LIMIT 1;');
    $stmt->execute(array(':usuario' => $_POST['usuario']));
    $resultado = $stmt->fetch(); 
  
    if($resultado != false){
      echo('
        <script>
          alertUsuarioExistente()
        </script>
      ');
      $errores = true;
    }
      
      if($pass != $pass2){
        echo('
          <script>
            alertPassDiferente()
          </script>
        ');
        $errores = true;
      }

      if(!$errores){
        $data = [
          'nombre' => $nombre,
          'apellidoP' => $apellidoP,
          'apellidoM' => $apellidoM,
          'usuario' => $usuario,
          'correo' => $correo,
          'telefono' => $telefono,
          'password' => $pass,
          'rol' => $rol,
        ];

        $insertarUsuario = json_decode(POST("SuperAdministrador/services/addUser.php",$data), true);
        if($insertarUsuario[0] != "¡Error!")
          echo('
            <script>
              alertAgregarUsuario()
            </script>
          ');
          else
            echo('
              <script>
                $msg = "Error al agregar el usuario"
                alertError($msg)
              </script>
            ');
      }
  }
}

if(isset($_GET["id_usuario"])){
  $data = [
    'idUsuario' => $_GET["id_usuario"]
  ];

  $eliminar = json_decode(POST("SuperAdministrador/services/deleteUser.php",$data), true);
  if($eliminar[0] = 'Success')
  echo "<script>Swal.fire({
    title: 'Usuario eliminado!',
    icon: 'success',
      confirmButtonText: 'Ok'
    }).then((result)=>{
      if(result.isConfirmed){
        window.location.href='index.php?configuracion=true';
      }
    }) </script>";
}
?>

<div class="row" style="margin-top: 5px;font-size: 19px;">
  <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="?recibos=true">Recibos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Configuraci&oacuten</li>
  </ol>
  </nav>
</div>    
      
<div style="font-size: 20px;">
  <div class="row" style="font-size: 25px;">
    <div class="col">
      Usuarios
    </div>
    <div class="col">
      <button type="button" class="btn btn-outline-dark" style="float: right; margin-left:5px" data-bs-toggle="modal"
        data-bs-target="#agregarProveedor"></i>Agregar proveedor</button>
      <button type="button" class="btn btn-outline-dark" style="float: right;" data-bs-toggle="modal"
        data-bs-target="#agregarUsuario"></i>Agregar usuario</button>
    </div>
  </div>
</div>
<div class="row-1" style="margin-top: 5px; font-size: 17px;">
  <div class="wrapper"  style="height:28vh;">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Nombre</th>
          <th scope="col">Correo</th>
          <th scope="col">Telefono</th>
          <th scope="col">Usuario</th>
          <th scope="col">Sucursal</th>
          <th scope="col">Rol</th>
          <th scope="col">Eliminar</th>
          <th scope="col">Editar</th>
        </tr>
      </thead>
      <tbody>
          <?php
            $data_from_db = json_decode(POST("SuperAdministrador/services/getUsers.php",''), true);
            foreach($data_from_db as $value){
              echo('
                <tr>
                  <th scope="row">'.$value[1].'</td>
                  <td>'.$value[2].'</td>
                  <td>'.$value[3].'</td>
                  <td>'.$value[4].'</td>');
                  // <td>'.$value[5].'</td>
                  if($value[5] == null)
                    echo '<td></td>';
                  else
                    echo '<td>'.$value[5].'</td>';
                  echo('<td>'.strtolower($value[6]).'</td>
                  <td><button type="button" class="btn btn-danger" id="'.$value[0].'" onclick="alertEliminarUsuario(this.id)" style="float: center;"><i class="fa fa-minus-circle"></i></button></td>
                  <td><button type="button" class="btn btn-success" style="float: center;" data-bs-toggle="modal" data-bs-target="#editarUsuario'.$value[0].'"><i class="fa fa-pencil" aria-hidden="true"></i></button></td>
                  </tr>
                ');
            }
          ?>
      </tbody>
    </table>
  </div>
</div>
<hr>
<div class="row" style="margin-top: 15px; font-size: 25px;">
  <div class="col">
    Proveedores
  </div>
</div>
<div class="row-1" style="margin-top: 5px; font-size: 17px;">
    <div class="wrapper"  style="height:28vh;">   
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Telefono</th>
            <th scope="col">Correo</th>
            <th scope="col">Eliminar</th>
            <th scope="col">Editar</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $input_from_db = json_decode(POST("SuperAdministrador/services/getProveedores.php",''), true);
            foreach($input_from_db as $value){
              echo('
              <tr>
                <th scope="row">'.$value[1].'</th>
                <td>'.$value[2].'</td>
                <td>'.$value[3].'</td>
                <td><button type="button" class="btn btn-danger" id="'.$value[0].'" onclick="alertEliminarProveedor(this.id)" style="float: center;"><i class="fa fa-minus-circle"></i></button></td>
                <td><button type="button" class="btn btn-success" style="float: center;" data-bs-toggle="modal" data-bs-target="#editarProveedor'.$value[0].'"><i class="fa fa-pencil" aria-hidden="true"></i></button></td>
              </tr>
              ');
            }
          
          ?>
        </tbody>
      </table>
    </div>
</div>
        
<!-- Modal Agregar Usuario-->
<div class="modal fade bd-example-modal-xl" id="agregarUsuario" data-bs-backdrop="static"
  data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Agregar usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']).'?configuracion=true'?>" method="POST">
        <?php
          if($errores){
            echo('        
            <div class="mb-3">
              <label for="nombre" class="col-form-label">Nombre:</label>
              <input type="text" class="form-control" id="nombre" name="nombre" value="'. $nombre .'" required>
            </div>
            <div class="mb-3">
              <label for="apellidoP" class="col-form-label">Apellido paterno:</label>
              <input type="text" class="form-control" id="apellidoP" name="apellidoP" value="'. $apellidoP .'" required>
            </div>
            <div class="mb-3">
              <label for="apellidoM" class="col-form-label">Apellido materno:</label>
              <input type="text" class="form-control" id="apellidoM" name="apellidoM" value="'. $apellidoM .'" required>
            </div>
            <div class="mb-3">
              <label for="usuario" class="col-form-label">Usuario:</label>
              <input type="text" class="form-control" id="usuario" name="usuario" value="'. $usuario .'" required>
            </div>
            <div class="mb-3">
              <label for="correo" class="col-form-label">Correo:</label>
              <input type="email" class="form-control" id="correo" name="correo" value="'. $correo .'" required>
            </div>
            <div class="mb-3">
              <label for="telefono" class="col-form-label">Tel&eacutefono:</label>
              <input type="text" class="form-control" id="teleforno" name="telefono" value="'. $telefono .'" minlength="10" maxlength="10" required>
            </div>
            <div class="mb-3">
              <label for="contrasena" class="col-form-label">Contraseña:</label>
              <input type="password" class="form-control" id="contrasena" name="password" minlength="8" required>
            </div>
            <div class="mb-3">
              <label for="contrasena2" class="col-form-label">Confirmar contraseña:</label>
              <input type="password" class="form-control" id="contrasena2" name="password2" minlength="8" required>
            </div>
            <div class="mb-3">
              <label for="rol" class="col-form-label">Rol:</label>
              <select name="rol" id="rol">');
                $input_from_db = json_decode(POST("SuperAdministrador/services/getRoles.php",''), true);

                foreach($input_from_db as $value){
                  echo('
                      <option value="'.$value[0].'">'.strtolower($value[1]).'</option>
                  ');
                }
            echo('
              </select>
            </div>
          </div>
        ');
      } else{
          echo('        
            <div class="mb-3">
              <label for="nombre" class="col-form-label">Nombre:</label>
              <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
              <label for="apellidoP" class="col-form-label">Apellido paterno:</label>
              <input type="text" class="form-control" id="apellidoP" name="apellidoP" required>
            </div>
            <div class="mb-3">
              <label for="apellidoM" class="col-form-label">Apellido materno:</label>
              <input type="text" class="form-control" id="apellidoM" name="apellidoM" required>
            </div>
            <div class="mb-3">
              <label for="usuario" class="col-form-label">Usuario:</label>
              <input type="text" class="form-control" id="usuario" name="usuario" required>
            </div>
            <div class="mb-3">
              <label for="correo" class="col-form-label">Correo:</label>
              <input type="email" class="form-control" id="correo" name="correo" required>
            </div>
            <div class="mb-3">
              <label for="telefono" class="col-form-label">Tel&eacutefono:</label>
              <input type="text" class="form-control" id="teleforno" name="telefono" minlength="10" maxlength="10" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required>
            </div>
            <div class="mb-3">
              <label for="contrasena" class="col-form-label">Contraseña:</label>
              <input type="password" class="form-control" id="contrasena" name="password" minlength="8" required>
            </div>
            <div class="mb-3">
              <label for="contrasena2" class="col-form-label">Confirmar contraseña:</label>
              <input type="password" class="form-control" id="contrasena2" name="password2" minlength="8" required>
            </div>
            <div class="mb-3">
              <label for="rol" class="col-form-label">Rol:</label>
              <select name="rol" id="rol">');
                $input_from_db = json_decode(POST("SuperAdministrador/services/getRoles.php",''), true);

                foreach($input_from_db as $value){
                  echo('
                      <option value="'.$value[0].'">'.strtolower($value[1]).'</option>
                  ');
                }
            echo('
              </select>
            </div>
          </div>
        ');
      }
      ?>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-success" name="agregarUsuario">Agregar</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Agregar Proveedor-->
<div class="modal fade bd-example-modal-xl" id="agregarProveedor" data-bs-backdrop="static"
  data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Agregar proveedor</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="rfc" class="col-form-label">Nombre:</label>
            <input type="text" class="form-control" id="nombre">
          </div>
          <div class="mb-3">
            <label for="nombre" class="col-form-label">Telefono:</label>
            <input type="text" class="form-control" id="usuario">
          </div>
          <div class="mb-3">
            <label for="nombre" class="col-form-label">Correo:</label>
            <input type="email" class="form-control" id="correo">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success" data-bs-dismiss="modal"
          onclick="alertAgregarProveedor()">Agregar</button>
      </div>
    </div>
  </div>
</div>

  <!-- Modal Editar Usuario-->
  <?php
    $input_from_db = json_decode(POST("SuperAdministrador/services/getInfoUsers.php",''), true);
    foreach($input_from_db as  $value){
      echo('
        <div class="modal fade bd-example-modal-xl" id="editarUsuario'.$value[0].'" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Editar usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="'. htmlspecialchars($_SERVER['PHP_SELF']). '?configuracion=true" method="POST">
                  <input type="hidden" name="id_usuario" value="'.$value[0].'">
                  <div class="row">
                    <div class="mb-3 col">
                      <label for="nombre" class="col-form-label">Nombre:</label>
                      <input type="text" class="form-control" id="nombre'.$value[0].'" value="'. $value[1] .'" disabled>
                    </div>
                    <div class="mb-3 col">
                      <label for="apellidoP" class="col-form-label">Apellido paterno:</label>
                      <input type="text" class="form-control" id="apellidoP'.$value[0].'" value="'. $value[2] .'" disabled>
                    </div>
                    <div class="mb-3 col">
                      <label for="apellidoM" class="col-form-label">Apellido materno:</label>
                      <input type="text" class="form-control" id="apellidoM'.$value[0].'" value="'. $value[3] .'" disabled>
                    </div>
                  </div>
                  <div class="row">
                    <div class="mb-3 col">
                      <label for="usuario" class="col-form-label">Usuario:</label>
                      <input type="text" class="form-control" id="usuario'.$value[0].'" value="'. $value[4] .'" disabled>
                    </div>
                    <div class="mb-3 col">
                      <label for="rol" class="col-form-label">Rol:</label>
                      <input type="text" class="form-control" id="rol'.$value[0].'" value="'. strtolower($value[5]) .'" disabled>
                    </div>
                  </div>
                  <div class="row">
                    <div class="mb-3 col">
                      <label for="correo" class="col-form-label">Correo:</label>
                      <input type="email" class="form-control" id="correo'.$value[0].'" name="correo" value="'. $value[6] .'" required>
                    </div>
                    <div class="mb-3 col">
                      <label for="telefono" class="col-form-label">Tel&eacutefono:</label>
                      <input type="text" class="form-control" id="telefono'.$value[0].'" name="telefono" value="'. $value[7] .'" minlength="10" maxlength="10" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required">
                    </div>
                  </div>
                  <div class="row">
                    <div class="mb-3">
                      <label for="password" class="col-form-label">Contraseña:</label>
                      <input type="password" class="form-control" name="pass" id="contrasena'.$value[0].'" minlength="8">
                    </div>
                    <div class="mb-3">
                      <label for="pass2" class="col-form-label">Confirmar contraseña:</label>
                      <input type="password" class="form-control" name="pass2" id="contrasena'.$value[0].'" minlength="8">
                    </div>
                  </div>');
                  if(strtolower($value[5]) == "admin")
                    echo('
                    <div class="btn-group">
                      <label for="puntodeventa" class="col-form-label">Sucursal:</label>
                      <button type="button" class="btn btn-outline-secondary" style="margin-left: 5px;" data-bs-toggle="modal" data-bs-target="#sucursal'. $value[0] .'" aria-expanded="false"><i class="fa fa-arrow-right"></i></button>
                    </div>
                    ');
                echo('
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-success" name="updateUser">Aceptar</button>
                </div>
              </form>
            </div>
          </div>
        </div>');

        if(strtolower($value[5]) == "admin"){
          $data = [
            'fkUsuario' => $value[0]
          ];
          $sucursal_usuario = json_decode(POST("SuperAdministrador/services/getUserSucursal.php", $data), true);
          echo('
        <!-- Modal Sucursales -->
        <div class="modal fade" id="sucursal'. $value[0] .'" tabindex="-1" aria-labelledby="sucursalesLabel" aria-hidden="true">
          <div class="modal-dialog">
          <form action="'. htmlspecialchars($_SERVER['PHP_SELF']). '?configuracion=true" method="POST">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="sucursalesLabel">Sucursal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <input type="hidden" name="id_usuario" value="'.$value[0].'">
                <label for="sucursal" class="col-form-label">Sucursal:</label>
                <select class="form-control" name="sucursal" id="sucursal'. $value[0] .'" required>
                  <option value="">Seleccione una sucursal</option>');                  
                  foreach($sucursales as $sucursal){
                    if($sucursal[0] == $sucursal_usuario[0])
                      echo('
                      <option value="'. $sucursal[0] .'" selected>'. $sucursal[1] .'</option>');
                    else if($sucursal[2] == null)
                      echo('
                      <option value="'. $sucursal[0] .'">'. $sucursal[1] .'</option>');
                  }
                  echo('
                </select>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                  <button type="submit" name="updateSucursal" class="btn btn-success">Guardar</button>
                </div>
                </div>
              </div>
            </form>
          </div>
          ');
        }
    }
  ?>

<!-- Editar Proveedor-->
<?php
  $input_from_db = json_decode(POST("SuperAdministrador/services/getProveedores.php", ''), true);
  foreach($input_from_db as $value){
    echo('
      <div class="modal fade bd-example-modal-xl" id="editarProveedor'.$value[0].'" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Editar proveedor</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="'. htmlspecialchars($_SERVER['PHP_SELF']). '?configuracion=true" method="POST">
              <input type="hidden" name="id_proveedor" value="'.$value[0].'">
              <div class="mb-3">
                  <label for="nombre" class="col-form-label">Nombre:</label>
                  <input type="text" class="form-control" name="nombre" id="nombre'.$value[0].'" value="'.$value[1].'" required>
              </div>
              <div class="mb-3">
                  <label for="nombre" class="col-form-label">Telefono:</label>
                  <input type="text" class="form-control" id="telefono'.$value[0].'" name="telefono" value="'.$value[2].'">
              </div>
              <div class="mb-3">
                  <label for="nombre" class="col-form-label">Correo:</label>
                  <input type="text" class="form-control" id="correo'.$value[0].'" name="correo" value="'.$value[3].'">
              </div>        
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-success" name="editProveedor">Aceptar</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    ');
  }

?>
