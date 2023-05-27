<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Latin Food Delivery</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
  <link href="styles.css" rel="stylesheet" />
  <link rel="shortcut icon" type="image/x-icon" sizes="64x64" href="Imagenes/favicon.ico" />
</head>

<body>
  <?php $conexion = pg_connect("host=127.0.0.1 dbname=LFD user=postgres password=usuario") or die("No se pudo conectar a la base de datos"); ?>
  <section class="h-100 h-custom" style="background-color: #eee; color: black;">
    <div id="productos" class="container-fluid backgroundOfertas">
      <h1 class="fs-1 fw-bolder text-white texto py-5 mb-5 mx-auto">Administrar Productos</h1>
      <div id="identifi">
        <?php
        // Verificar si la cookie "id_usuario" está presente
        if (isset($_COOKIE['id_usuario'])) {
          // Obtener el valor de la cookie
          $idUsuario = $_COOKIE['id_usuario'];
          $query_usuario = "SELECT * FROM hostelero WHERE id_usuario = $1";
          $result_usuario = pg_query_params($conexion, $query_usuario, array($idUsuario));
          $usuario = pg_fetch_assoc($result_usuario);
          $nombre = $usuario['nombre'];
          $id_restaurante = $usuario['id_restaurante'];

          // Serializar el array a una cadena JSON
          $usuario_serializado = json_encode($usuario);

          // Establecer la cookie con el valor serializado
          setcookie('usuario', $usuario_serializado, time() + 3600, '/'); // La cookie expirará en 1 hora
        
          ?>
          <button type="button" class="btn btn-primary mx-5">
            <a class="navbar-brand px-3 mx-auto text-light" href="userhostelero.php">
              <?= $nombre ?>
            </a>
          </button>
          <?php
        } else {
          ?><button type="button" class="btn btn-warning mx-5">
            <a class="navbar-brand text-dark px-3 mx-auto" href="login.php">Identifícate</a>
          </button>
          <?php
        }
        if (isset($_POST['eliminar_producto'])) {
          // Obtener el ID del producto a eliminar
          $id_producto = $_POST['id_producto'];

          // Conectar a la base de datos
          $conn = pg_connect("host=127.0.0.1 dbname=LFD user=postgres password=usuario") or die("No se pudo conectar a la base de datos");

          // Borrar el producto de la tabla "producto"
          $query = "DELETE FROM producto WHERE id_producto = $1";
          $result = pg_query_params($conn, $query, array($id_producto));

          if ($result !== false) {
            header("Location: indexhostelero.php");
            exit;
          } else {
            // Error al ejecutar la consulta SQL
            echo "Error al ejecutar la consulta SQL.";
          }

          // Cerrar la conexión a la base de datos
          pg_close($conn);
        }

        if (isset($_POST['agregar_producto'])) {
          // Obtener los datos del formulario
          $id_pais = $_POST['id_pais'];
          $nombre = $_POST['nombre'];
          $descripcion = $_POST['descripcion'];
          $precio = $_POST['precio'];


          // Carpeta donde se guardarán las imágenes
          $carpetaDestino = 'Imagenes/';

          // Verificar si se ha enviado una imagen
          if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            // Obtener información del archivo
            $nombreArchivo = $_FILES['imagen']['name'];
            $tipoArchivo = $_FILES['imagen']['type'];
            $rutaArchivo = $_FILES['imagen']['tmp_name'];

            // Generar un nombre único para la imagen
            $nombreUnico = uniqid() . '_' . $nombreArchivo;

            // Mover la imagen a la carpeta de destino
            $rutaDestino = $carpetaDestino . $nombreUnico;
            move_uploaded_file($rutaArchivo, $rutaDestino);

            // Insertar la ruta de la imagen en la base de datos
            $rutaImagenBD = $rutaDestino; // Ruta de la imagen como texto
          }
          // Conectar a la base de datos
          $conn = pg_connect("host=127.0.0.1 dbname=LFD user=postgres password=usuario") or die("No se pudo conectar a la base de datos");

          // Obtener el máximo id_producto existente
          $query_max_id = "SELECT MAX(id_producto) AS max_id FROM producto";
          $result_max_id = pg_query($conn, $query_max_id);
          $row_max_id = pg_fetch_assoc($result_max_id);
          $max_id = $row_max_id['max_id'];
          $new_id_producto = $max_id + 1;

          // Obtener el id_restaurante del usuario actual
          $id_restaurante = $usuario['id_restaurante'];

          // Insertar el producto en la tabla "producto"
          $query = "INSERT INTO producto (id_producto, imagen, id_pais, nombre, descripcion, precio, id_restaurante) VALUES ($1, $2, $3, $4, $5, $6, $7)";
          $result = pg_query_params($conn, $query, array($new_id_producto, $rutaImagenBD, $id_pais, $nombre, $descripcion, $precio, $id_restaurante));

          if ($result !== false) {
            // Producto agregado exitosamente
            header("Location: indexhostelero.php");
            exit;
          } else {
            // Error al ejecutar la consulta SQL
            echo "Error al agregar el producto.";
          }

          // Cerrar la conexión a la base de datos
          pg_close($conn);
        }
        ?>


      </div>
      <div class="container">
        <div class="row">
          <?php


          // Obtener el número total de resultados
          $total_resultados_resultado = "SELECT COUNT(*) AS total FROM producto WHERE id_restaurante = $1";
          $params = array($id_restaurante);
          $total_filtrado = pg_query_params($conexion, $total_resultados_resultado, $params);
          $total_resultados_fila = pg_fetch_assoc($total_filtrado);
          $total_resultados = $total_resultados_fila['total'];

          // Realizar la consulta a la base de datos con límite y desplazamiento
          $query = pg_query_params($conexion, "SELECT * FROM producto WHERE id_restaurante = $1", array($id_restaurante));

            // Iterar sobre cada fila del resultado
            while ($fila = pg_fetch_assoc($query)) {
              // Obtener los datos de la fila
              $nombre = $fila['nombre'];
              $descripcion = $fila['descripcion'];
              $precio = $fila['precio'];
              $img_producto = $fila['imagen'];
              $id_pais = $fila['id_pais'];
              $id_restaurante = $fila['id_restaurante'];
              $id_producto = $fila['id_producto'];

              // Obtener la información del país a partir de su ID
              $pais_resultado = pg_query_params($conexion, "SELECT * FROM pais WHERE id_pais = $1", array($id_pais));
              $pais_fila = pg_fetch_assoc($pais_resultado);
              $bandera = $pais_fila['bandera'];

              // Obtener la información del restaurante a partir de su ID
              $restaurante_resultado = pg_query_params($conexion, "SELECT * FROM restaurante WHERE id_restaurante = $1", array($id_restaurante));
              $restaurante_fila = pg_fetch_assoc($restaurante_resultado);
              $nombre_restaurante = $restaurante_fila['nombre'];

              // Mostrar la card del producto
              echo '<div class="col-md-4">';
              echo '<div class="card mx-auto"> ';
              echo '<form action="editar_producto.php" method="POST">';
              echo '<div class="card-body">';
              echo '<div class="imagenProducto mx-auto m-3">';
              echo '<img src="' . $img_producto . '" class="img-fluid" alt="">';
              echo '</div>';
              echo '<img src="' . $bandera . '" class="bandera-pequena mx-3 my-2" alt="Bandera del país">';
              echo '<input type="hidden" name="id_producto" value="' . $id_producto . '">';
              echo '<input type="text" name="nombre" class="form-control my-3" placeholder="Introduce nombre" value="' . $nombre . '" />';
              echo '<input type="text" name="descripcion" class="form-control my-3" placeholder="Introduce descripción" value="' . $descripcion . '" />';
              echo '<input type="number" name="precio" class="form-control my-3" placeholder="Introduce precio" value="' . $precio . '" />';
              echo '<div class="d-flex justify-content-start">';
              echo '<button type="submit" class="btn btn-warning mx-2" data-id="' . $id_producto . '">Editar</button>';
              echo '</form>';
              echo '<form action="" method="POST">';
              echo '<input type="hidden" name="id_producto" value="' . $id_producto . '">';
              echo '<button type="submit" name="eliminar_producto" class="btn btn-danger mx-3" style="width: 200px;">Eliminar Producto</button>';
              echo '</div>';
              echo '</form>';
              echo '</div>';
              echo '</div>';
              echo '</div>';
            }
          ?>
          <div class="mx-auto">
            <div class="card mx-auto">
              <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                  <input type="file" class="py-3" name="imagen" required />
                  <div class="form-outline mb-4">
                    <select name="id_pais" class="form-control" required>
                      <?php
                      $queryBandera = "SELECT nombre, id_pais FROM pais";
                      $resultBandera = pg_query($conexion, $queryBandera);

                      // Verificar si hay resultados
                      if (pg_num_rows($resultBandera) > 0) {
                        // Generar las opciones del select
                        while ($row = pg_fetch_assoc($resultBandera)) {
                          $nombre = $row['nombre'];
                          $id_pais = $row['id_pais'];
                          echo '<option value="' . $id_pais . '">' . $nombre . '</option>';
                        }
                      } else {
                        echo '<option value="">No se encontraron países</option>';
                      }
                      ?>
                    </select>
                  </div>
                  <input type="text" name="nombre" class="form-control my-3" placeholder="Introduce nombre" required />
                  <input type="text" name="descripcion" class="form-control my-3" placeholder="Introduce descripción"
                    required />
                  <input type="number" name="precio" class="form-control my-3" placeholder="Introduce precio"
                    required />
                  <input type="hidden" name="id_producto" value="<?php echo $new_id_producto; ?>">
                  <button type="submit" name="agregar_producto" class="btn btn-success mx-3"
                    style="width: 200px;">Agregar Producto</button>
                </form>
              </div>
            </div>
          </div>

          <?php
          pg_close($conexion);
          ?>
        </div>
      </div>
    </div>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>
</body>

</html>