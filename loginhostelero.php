<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Latin Food Delivery</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
  <link href="styles2.css" rel="stylesheet" />
  <link rel="shortcut icon" type="image/x-icon" sizes="64x64" href="Imagenes/favicon.ico" />
</head>

<body style="background-color: #eee;">
  <section class="h-100 gradient-form" style="background-color: #eee;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-xl-10">
          <div class="card rounded-3 text-black">
            <div class="row g-0">
              <div class="col-lg-6">
                <div class="card-body p-md-5 mx-md-4">

                  <div class="text-center">
                    <a href="index.php">
                      <img src="Imagenes/favicon.png" style="width: 225px; margin: 50px" alt="logo">
                    </a>
                  </div>

                  <?php
                  //Obtener los datos del formulario
                  $correo = $_POST['correo'] ?? '';
                  $password = $_POST['password'] ?? '';

                  if ($correo && $password) {
                    //Conectar a la base de datos
                    $conn = pg_connect("host=127.0.0.1 dbname=LFD user=postgres password=usuario") or die("No se pudo conectar a la base de datos");

                    //Consulta para verificar si el usuario y contraseña existen en la tabla "cliente"
                    $query = "SELECT COUNT(*) FROM hostelero WHERE correo = $1 AND password = $2";
                    $query_id = "SELECT id_usuario FROM hostelero WHERE correo = $1 AND password = $2";
                    $result = pg_query_params($conn, $query, array($correo, $password));
                    $result_id = pg_query_params($conn, $query_id, array($correo, $password));

                    if ($result !== false) {
                      $count = pg_fetch_result($result, 0, 0);
                      
                      //Comprobar si el usuario y contraseña existen en la tabla "cliente"
                      if ($count > 0) {
                         //El usuario y contraseña existen, establecer una cookie con el nombre de usuario
                      $idUsuario = pg_fetch_result($result_id, 0, 0);
                      setcookie('id_usuario', $idUsuario, time() + (86400 * 30), '/'); // La cookie expirará después de 30 días

                        //El usuario y contraseña existen, redireccionar a la página de inicio
                        header("Location: indexhostelero.php");
                        exit;
                      } else {
                        //El usuario y contraseña no existen, mostrar un mensaje de error
                        echo '<script>alert("Usuario o contraseña incorrectos.");</script>';
                      }
                    } else {
                      //Error al ejecutar la consulta SQL
                      echo "Error al ejecutar la consulta SQL.";
                    }

                    //Cerrar la conexión a la base de datos
                    pg_close($conn);
                  }
                  ?>

                  <form method="post">
                    <div class="form-outline mb-4">
                      <input type="text" id="form2Example11" class="form-control" name="correo" placeholder="Introduce tu correo coorporativo" />
                    </div>

                    <div class="form-outline mb-4">
                      <input type="password" id="form2Example22" class="form-control" name="password" placeholder="Introduce tu contraseña" />
                    </div>

                    <div class="text-center pt-1 mb-5 pb-1">
                      <button class="btn btn-warning mx-5 my-4" type="submit" style="width: 300px;">Inicia Sesión</button>
                      <a class="mb-0 me-2 text-muted" href="login.php">Soy Cliente</a>
                    </div>
                  </form>


                  <div class="d-flex align-items-center justify-content-center pb-4">
                    <p class="mb-0 me-2">¿No tienes cuenta?</p>
                    <button type="button" class="btn btn-warning mx-3" style="width: 200px;"><a style="text-decoration: none;" class="text-black" href="registerhostelero.php">Crear una cuenta</a></button>
                  </div>

                  </form>

                </div>
              </div>
              <div class="col-lg-6 d-flex align-items-center gradient-custom-3">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>