<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Latin Food Delivery</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
  <link href="styles2.css" rel="stylesheet" />
  <link rel="shortcut icon" type="image/x-icon" sizes="64x64" href="Imagenes/favicon.ico" />
</head>

<body>
  <section class="h-100 h-custom" style="background-color: #eee; color: black;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col">
          <div class="card">
            <div class="card-body p-4">

              <div class="row">

                <div class="col-lg-7">
                  <h5 class="mb-3"><a href="index.php" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>
                      ← Continuar con la Compra</a></h5>
                  <hr>

                  <?php
                  // Conectarse a la base de datos
                  $conexion = pg_connect("host=127.0.0.1 dbname=LFD user=postgres password=usuario") or die("No se pudo conectar a la base de datos");
                  $subtotal = 0;
                  $envio = 3;
                  $total = 0;

                  // Verificar si se ha definido la cookie "productos_pedidos"
                  if (isset($_COOKIE['productos_pedidos'])) {
                    // Obtener el contenido de la cookie y decodificarlo como un arreglo
                    $productos = json_decode($_COOKIE['productos_pedidos'], true);

                    // Verificar si $productos es un arreglo antes de iterar sobre él
                    if (is_array($productos)) {
                      $num_productos = count($productos); // Obtener el número de productos en el carrito
                  
                      // Mostrar el número de productos en el carrito
                      echo '<div class="d-flex justify-content-between align-items-center mb-4">';
                      echo '<div>';
                      echo '<p class="mb-0">Tienes ' . $num_productos . ' producto(s) en el carrito</p>';
                      echo '</div>';
                      echo '</div>';

                      // Iterar sobre los productos y mostrar su información
                      foreach ($productos as $id_producto) {
                        // Código para recuperar los detalles del producto para $id_producto
                        $producto_carrito = pg_query($conexion, "SELECT * FROM producto WHERE id_producto = $id_producto");
                        $resultado_producto = pg_fetch_assoc($producto_carrito);

                        // Sumar el precio del producto al subtotal
                        $subtotal += $resultado_producto['precio'];
                      }

                      $total = $subtotal + $envio;

                      // Obtener los productos únicos
                      $productos_unicos = array_unique($productos);

                      // Iterar sobre los productos únicos y mostrar su información
                      foreach ($productos_unicos as $id_producto) {
                        // Código para recuperar los detalles del producto para $id_producto
                        $producto_carrito = pg_query($conexion, "SELECT * FROM producto WHERE id_producto = $id_producto");
                        $resultado_producto = pg_fetch_assoc($producto_carrito);


                        // Mostrar los detalles del producto en una tarjeta
                        echo '<div class="card mb-3">';
                        echo '<div class="card-body">';
                        echo '<div class="d-flex justify-content-between">';
                        echo '<div class="d-flex flex-row align-items-center">';
                        echo '<div>';
                        echo '<img src="' . $resultado_producto['imagen'] . '" class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">';
                        echo '</div>';
                        echo '<div class="ms-3">';
                        echo '<h5>' . $resultado_producto['nombre'] . '</h5>';
                        echo '<p class="small mb-0">' . $resultado_producto['descripcion'] . '</p>';
                        echo '</div>';
                        echo '</div>';
                        echo '<div class="d-flex flex-row align-items-center">';
                        echo '<div style="width: 50px;">';
                        echo '<h5 class="fw-normal mb-0">' . array_count_values($productos)[$id_producto] . '</h5>';
                        echo '</div>';
                        echo '<div style="width: 80px;">';
                        echo '<h5 class="mb-0">' . ($resultado_producto['precio'] * array_count_values($productos)[$id_producto]) . '€</h5>';
                        echo '</div>';
                        echo '<a href="añadir_unidad.php?id=' . $id_producto . '" style="color: #000000;"><button type="button" class="btn btn-primary mx-2">+</button></a>';
                        echo '<a href="eliminar_producto.php?id=' . $id_producto . '" style="color: #000000;"><button type="button" class="btn btn-danger">x</button></a>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                      }
                    } else {
                      echo 'Error: $productos no es un array.';
                    }
                  } else {
                    echo '<div class="d-flex justify-content-between align-items-center mb-4">';
                    echo '<div>';
                    echo '<p class="mb-0">Tienes 0 productos en el carrito</p>';
                    echo '</div>';
                    echo '</div>';
                  }

                  // Cerrar la conexión a la base de datos
                  pg_close($conexion);
                  ?>

                </div>
                <div class="col-lg-5">

                  <div class="card bg-warning text-black rounded-3">
                    <div class="card-body">
                      <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="mb-0">Detalles del Pedido</h5>
                      </div>
                      <?php
                      // Verificar si se ha enviado el formulario
                      if (isset($_POST['pedir'])) {
                        // Obtener los valores del formulario
                        $titular = $_POST['titular'];
                        $numero_tarjeta = $_POST['numero_tarjeta'];
                        $fecha_exp = $_POST['fecha_exp'];
                        $cvv = $_POST['cvv'];

                        // Validar los datos del formulario
                        if (empty($titular) || empty($numero_tarjeta) || empty($fecha_exp) || empty($cvv)) {
                          // Mostrar mensaje de error si algún campo está vacío
                          echo '<div class="alert alert-danger mt-4" role="alert">Por favor, completa todos los campos del formulario.</div>';
                        } else {
                          // Verificar si hay al menos un producto en la cesta
                          if (!isset($productos) || $num_productos == 0) {
                            echo '<div class="alert alert-danger mt-4" role="alert">No hay productos en la cesta. Por favor, añade al menos un producto antes de realizar el pedido.</div>';
                          } else {
                            // Todos los campos del formulario están completados y hay al menos un producto en la cesta
                      
                            // Conectarse a la base de datos
                            $conexion = pg_connect("host=127.0.0.1 dbname=LFD user=postgres password=usuario") or die("No se pudo conectar a la base de datos");

                            // Obtener el próximo valor de la secuencia para el ID de pedido
                            $id_max_query = "SELECT MAX(id_pedido) FROM pedido";
                            $id_max_result = pg_query($conexion, $id_max_query);
                            $id_max_row = pg_fetch_assoc($id_max_result);
                            $id_max = $id_max_row['max'];
                            $new_id = $id_max + 1;

                            // Obtener la fecha actual
                            $fecha = date('Y-m-d');
                            $id_usuario = $_COOKIE['id_usuario'];
                            // Insertar el pedido en la tabla
                            $query_insert_pedido = pg_query($conexion, "INSERT INTO pedido (id_pedido, fecha, id_usuario, precio) VALUES ($new_id, '$fecha', $id_usuario, $total)");

                            // Verificar si el INSERT fue exitoso
                            if ($query_insert_pedido) {
                              // El pedido se insertó correctamente en la base de datos
                              echo '<div class="alert alert-success mt-4" role="alert">¡El pedido se ha realizado correctamente!</div>';

                              setcookie('productos_pedidos', '', time() - 3600, '/');
                              $productos = [];

                              // Redireccionar a cart.php
                              header('Location: cart.php');
                              exit();
                            } else {
                              // Mostrar mensaje de error
                              echo '<div class="alert alert-danger mt-4" role="alert">Ha ocurrido un error al realizar el pedido. Por favor, inténtalo de nuevo.</div>';
                            }

                            // Cerrar la conexión a la base de datos
                            pg_close($conexion);
                          }
                        }
                      }
                      ?>
                      <form class="mt-4" method="POST">
                        <div class="form-outline form-white mb-4">
                          <input type="text" name="titular" id="typeName" class="form-control form-control-lg" size="17"
                            placeholder="Titular de la Tarjeta" />
                        </div>

                        <div class="form-outline form-white mb-4">
                          <input type="text" name="numero_tarjeta" id="typeText" class="form-control form-control-lg"
                            size="17" placeholder="1234 5678 9012 3457" minlength="19" maxlength="19" />
                          <label class="form-label" for="typeText">Número Tarjeta</label>
                        </div>

                        <div class="row mb-4">
                          <div class="col-md-6">
                            <div class="form-outline form-white">
                              <input type="text" name="fecha_exp" id="typeExp" class="form-control form-control-lg"
                                placeholder="MM/YYYY" size="7" id="exp" minlength="7" maxlength="7" />
                              <label class="form-label" for="typeExp">Fecha EXP</label>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-outline form-white">
                              <input type="password" name="cvv" id="typeText" class="form-control form-control-lg"
                                placeholder="123" size="1" minlength="3" maxlength="3" />
                              <label class="form-label" for="typeText">CVV</label>
                            </div>
                          </div>
                        </div>

                        <hr class="my-4">
                        <?php
                        // Mostrar subtotal, envío y total
                        echo '<div class="d-flex justify-content-between">';
                        echo '<p class="mb-2">Subtotal</p>';
                        echo '<p class="mb-2">' . $subtotal . ' €</p>';
                        echo '</div>';

                        echo '<div class="d-flex justify-content-between">';
                        echo '<p class="mb-2">Envío</p>';
                        echo '<p class="mb-2">3.00 €</p>';
                        echo '</div>';

                        echo '<div class="d-flex justify-content-between mb-4">';
                        echo '<p class="mb-2">Total</p>';
                        echo '<p class="mb-2">' . $total . ' €</p>';
                        echo '</div>';
                        ?>
                        <button type="submit" name="pedir" class="btn btn-dark btn-block btn-lg"
                          data-mdb-ripple-color="dark">Pedir
                          <?php echo $total; ?> €
                        </button>
                      </form>
                    </div>
                  </div>

                </div>

              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>
</body>

</html>