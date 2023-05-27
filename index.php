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
  <?php
  $conexion = pg_connect("host=127.0.0.1 dbname=LFD user=postgres password=usuario") or die("No se pudo conectar a la base de datos");
  ?>
  <div class="container-fluid g-0">
    <nav class="navbar navbar-expand-md navbar-dark">
      <div class="container-fluid">
        <a class="navbar-brand mx-auto px-auto m-0 p-0" href="index.php">
          <img src="Imagenes/favicon.png" class="m-3" height="90px" width="220px" />
        </a>
        <button class="navbar-toggler bg-warning" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mynavbar">
          <ul class="navbar-nav me-auto mx-auto">
            <li class="nav-item">
              <a class="nav-item">
                <div id="identifi">
                  <?php
                  // Verificar si la cookie "id_usuario" está presente
                  if (isset($_COOKIE['id_usuario'])) {
                    // Obtener el valor de la cookie
                    $idUsuario = $_COOKIE['id_usuario'];
                    $query_usuario = "SELECT * FROM cliente WHERE id_usuario = $1";
                    $result_usuario = pg_query_params($conexion, $query_usuario, array($idUsuario));
                    $usuario = pg_fetch_assoc($result_usuario);
                    $nombre = $usuario['nombre'];

                    // Serializar el array a una cadena JSON
                    $usuario_serializado = json_encode($usuario);

                    // Establecer la cookie con el valor serializado
                    setcookie('usuario', $usuario_serializado, time() + 3600, '/'); // La cookie expirará en 1 hora
                  
                    ?>
                    <button type="button" class="btn btn-primary mx-5">
                      <a class="navbar-brand px-3 mx-auto text-light" href="user.php">
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
                  ?>
                </div>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-5 text-dark" href="#productos">Productos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-5 text-dark" href="#ofertas">Promociones</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-5 text-dark" href="#restaurantesAfiliados">Restaurantes Afiliados</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-2 text-dark" href="#Contacto">Contáctenos</a>
            </li>
          </ul>
          <div class="d-flex">
            <a href="https://es-es.facebook.com/"><img class="logo mx-3"
                src="Imagenes/icons8-facebook-nuevo-50.png" /></a>
            <a href="https://www.instagram.com/"><img class="logo mx-3" src="Imagenes/icons8-instagram-50.png" /></a>
            <a href="https://twitter.com/?lang=es"><img class="logo mx-3" src="Imagenes/icons8-twitter-50.png" /></a>
            <a href="https://es-es.facebook.com/"><img class="logo mx-3"
                src="Imagenes/icons8-youtube-play-50.png" /></a>
            <a href="https://www.instagram.com/"><img class="logo mx-3" src="Imagenes/logogit.png" /></a>
          </div>
          <?php
          // Verificar si la cookie "id_usuario" está presente
          if (!isset($_COOKIE['id_usuario'])) {
            ?>
            <div class="d-flex float-end p-3">
              <a href="login.php"><button class="btn btn-warning position-relative">
                  <img class="logo mx-2" src="Imagenes/carrito.png" />
                  <?php

                  if (!isset($_COOKIE['productos_pedidos'])) {
                    echo '<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">0</span>';
                  } else {
                    $numero_productos = json_decode($_COOKIE['productos_pedidos'], true);
                    if (is_array($numero_productos)) {
                      $num_productos = count($numero_productos); // Obtener el número de productos en el carrito
                      echo '<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">' . $num_productos . '</span>';
                    }
                  }
                  ?>
                </button>
            </div></a>
            <?php
          } else {
            ?>
            <div class="d-flex float-end p-3">
              <form id="cart-form" action="cart.php" method="post">
                <input type="hidden" name="productos">
                <button type="submit" class="btn btn-warning position-relative">
                  <img class="logo mx-2" src="Imagenes/carrito.png" />
                  <?php

                  if (!isset($_COOKIE['productos_pedidos'])) {
                    echo '<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">0</span>';
                  } else {
                    $numero_productos = json_decode($_COOKIE['productos_pedidos'], true);
                    if (is_array($numero_productos)) {
                      $num_productos = count($numero_productos); // Obtener el número de productos en el carrito
                      echo '<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">' . $num_productos . '</span>';
                    }
                  }
                  ?>
                </button>
              </form>
            </div>
            <?php
          }
          ?>
        </div>
      </div>
    </nav>
    <div id="carouselExampleIndicators" class="carousel slide g-0" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>
      <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
            aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
            aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
            aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <video class="img-fluid d-block w-100" autoplay loop muted>
              <source src="Imagenes/tacosVideo.mp4" type="video/mp4" />
            </video>
          </div>
          <div class="carousel-item">
            <video class="img-fluid d-block w-100" autoplay loop muted>
              <source src="Imagenes/VideodeProductoGastronomico.mp4" type="video/mp4" />
            </video>
          </div>
          <div class="carousel-item">
            <video class="img-fluid d-block w-100" autoplay loop muted>
              <source src="Imagenes/VideoDelivery.mp4" type="video/mp4" />
            </video>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
          data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
          data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>
      </div>
    </div>
    <div id="ofertas" class="container-fluid backgroundOfertas">
      <div class="row justify-content-center">
        <h1 class="fs-1 fw-bolder text-white texto m-5 mb-5">Promociones</h1>
        <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-6 my-3">
          <div class="position-relative">
            <img src="Imagenes/50.png" alt="Imagen" class="img-fluid">
            <button class="btn btn-warning position-absolute bottom-0 end-0 m-3">Más Información</button>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-6 my-3">
          <div class="position-relative">
            <img src="Imagenes/familiar.png" alt="Imagen" class="img-fluid">
            <button class="btn btn-warning position-absolute bottom-0 end-0 m-3">Más Información</button>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-6 my-3">
          <div class="position-relative">
            <img src="Imagenes/Bebidas.png" alt="Imagen" class="img-fluid">
            <button class="btn btn-warning position-absolute bottom-0 end-0 m-3">Más Información</button>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-6 my-3">
          <div class="position-relative">
            <img src="Imagenes/pareja.png" alt="Imagen" class="img-fluid">
            <button class="btn btn-warning position-absolute bottom-0 end-0 m-3">Más Información</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <div id="restaurantesAfiliados" class="container-fluid my-5 py-5" style="background-color: rgb(221, 217, 217)">
    <h1 class="texto mb-5">Restaurantes Afiliados</h1>
    <div id="carouselExampleIndicators" class="carousel slide g-0" data-ride="carousel">
      <ol class="carousel-indicators">
        <?php

        // Obtener el número de restaurantes
        $query_slides1 = "SELECT COUNT(*) AS total FROM restaurante";
        $result_slides1 = pg_query($conexion, $query_slides1);
        $row_slides1 = pg_fetch_assoc($result_slides1);
        $totalSlides = ceil($row_slides1['total'] / 3);

        // Generar los indicadores del carrusel
        for ($i = 0; $i < $totalSlides; $i++) {
          if ($i === 0) {
            echo '<li data-target="#carouselExampleIndicators" data-slide-to="' . $i . '" class="active"></li>';
          } else {
            echo '<li data-target="#carouselExampleIndicators" data-slide-to="' . $i . '"></li>';
          }
        }
        ?>
      </ol>
      <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <?php
          // Generar los botones de navegación del carrusel
          for ($i = 0; $i < $totalSlides; $i++) {
            if ($i === 0) {
              echo '<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="' . $i . '" class="active" aria-current="true" aria-label="Slide ' . ($i + 1) . '"></button>';
            } else {
              echo '<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="' . $i . '" aria-label="Slide ' . ($i + 1) . '"></button>';
            }
          }
          ?>
        </div>
        <div class="carousel-inner">
          <?php
          // Obtener los restaurantes de la base de datos
          $query_restaurante = "SELECT * FROM restaurante";
          $result_restaurante = pg_query($conexion, $query_restaurante);

          // Contador para el índice del carrusel
          $counter = 0;

          while ($row = pg_fetch_assoc($result_restaurante)) {
            // Comprobar si se debe iniciar un nuevo carrusel item
            if ($counter % 3 === 0) {
              if ($counter === 0) {
                echo '<div class="carousel-item active">';
              } else {
                echo '<div class="carousel-item">';
              }
              echo '<div class="row row-cols-1 row-cols-md-3 g-4">';
            }

            // Mostrar el restaurante actual en un carrusel item
            echo '<div class="col">';
            echo '<div class="card h-100">';
            echo '<img src="' . $row['imagen'] . '" class="card-img-top imagenRestaurante img-fluid" alt="..." />';
            echo '<div class="card-body" style="width: 325px; height: 88px;">';
            echo '<h5 class="card-title">' . $row['nombre'] . '</h5>';
            echo '<p class="card-text">' . $row['direccion'] . '</p>';
            echo '</div>';
            echo '<div class="card-footer text-center">';
            echo '<button class="btn btn-warning" style="margin-bottom: 50px;" ><a style="text-decoration: none; color: black;" href="?id_restaurante=' . $row['id_restaurante'] . '#productos">';
            echo 'Ver Productos<a/>';
            echo '</button>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            // Comprobar si se debe cerrar el carrusel item actual
            if ($counter % 3 === 2) {
              echo '</div>';
              echo '</div>';
            }

            $counter++;
          }

          // Comprobar si queda algún carrusel item abierto
          if ($counter % 3 !== 0) {
            echo '</div>';
            echo '</div>';
          }
          ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
          data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
          data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
  </div>
  <div id="productos" class="container-fluid backgroundOfertas">
    <h1 class="fs-1 fw-bolder text-white texto py-5 mb-5 mx-auto">Productos</h1>
    <?php
    echo '<a class="btn btn-danger" href="?pagina=1#productos">Quitar Filtros</a>';

    // Verificar si se ha seleccionado un país para filtrar los productos
    $id_pais = 0;
    if (isset($_GET['id_pais'])) {
      $id_pais = $_GET['id_pais'];
    } ?>

    <div class="container">
      <div class="row">
        <?php
        // Número de resultados por página
        $resultados_por_pagina = 6;

        // Obtener el número total de resultados
        $total_resultados_resultado = pg_query($conexion, "SELECT COUNT(*) AS total FROM producto");
        $total_resultados_fila = pg_fetch_assoc($total_resultados_resultado);
        $total_resultados = $total_resultados_fila['total'];

        // Obtener el ID del restaurante seleccionado (si hay uno)
        $id_restaurante = null;
        if (isset($_GET['id_restaurante'])) {
          $id_restaurante = $_GET['id_restaurante'];
        }

        // Construir la consulta SQL con los filtros de país y restaurante (si están definidos)
        $consulta_sql = "SELECT * FROM producto";
        if ($id_pais) {
          $consulta_sql .= " WHERE id_pais = $id_pais";
          if ($id_restaurante) {
            $consulta_sql .= " AND id_restaurante = $id_restaurante";
          }
        } else if ($id_restaurante) {
          $consulta_sql .= " WHERE id_restaurante = $id_restaurante";
        }

        // Realizar la consulta a la base de datos
        $query = pg_query($conexion, $consulta_sql);

        // Obtener el número total de resultados después de aplicar los filtros
        $total_resultados_filtrados = pg_num_rows($query);

        // Calcular el número total de páginas después de aplicar los filtros
        $total_paginas = ceil($total_resultados_filtrados / $resultados_por_pagina);

        // Obtener el número de la página actual
        if (!isset($_GET['pagina'])) {
          $pagina_actual = 1;
        } else {
          $pagina_actual = $_GET['pagina'];
        }

        // Calcular el índice del primer resultado de la página actual
        $indice_primer_resultado = ($pagina_actual - 1) * $resultados_por_pagina;

        // Construir la consulta SQL con los filtros de país, restaurante y el límite y desplazamiento para la paginación
        $consulta_sql .= " LIMIT $resultados_por_pagina OFFSET $indice_primer_resultado";
        $query = pg_query($conexion, $consulta_sql);

        // Inicializar o recuperar la matriz de IDs de productos pedidos
        $productos_pedidos = [];
        if (isset($_SESSION['productos_pedidos'])) {
          $productos_pedidos = $_SESSION['productos_pedidos'];
        }

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
          $pais_resultado = pg_query($conexion, "SELECT * FROM pais WHERE id_pais = $id_pais");
          $pais_fila = pg_fetch_assoc($pais_resultado);
          $bandera = $pais_fila['bandera'];

          // Obtener la información del restaurante a partir de su ID
          $restaurante_resultado = pg_query($conexion, "SELECT * FROM restaurante WHERE id_restaurante = $id_restaurante");
          $restaurante_fila = pg_fetch_assoc($restaurante_resultado);
          $nombre_restaurante = $restaurante_fila['nombre'];

          // Mostrar la card del producto
          echo '<div class="col-md-4">';
          echo '<div class="card mx-auto"> ';
          echo '<div class="card-body">';
          echo '<div class="imagenProducto mx-auto m-3">';
          echo '<img src="' . $img_producto . '" class="img-fluid" alt="">';
          echo '</div>';
          echo '<h4 class="card-title my-3" style="display: inline-block;">' . $nombre . '</h4><img src="' . $bandera . '" class="bandera-pequena mx-3 my-2" alt="Bandera del país">';
          echo '<p class="card-text">' . $descripcion . '</p>';
          echo '<p class="card-text">' . $nombre_restaurante . '</p>';
          echo '<p class="card-text">' . $precio . '€</p>';
          echo '<form method="POST" action="agregar_pedido.php">';
          echo '<input type="hidden" name="id_producto" value="' . $id_producto . '">';
          echo '<button type="submit" class="btn btn-warning">Pedir</button>';
          echo '</form>';
          echo '</div>';
          echo '</div>';
          echo '</div>';
        }

        // Mostrar la paginación
        echo '<div class="d-none d-sm-block py-5 text-center mx-auto" aria-label="Page navigation example">';
        echo '<ul class="pagination text-center">';
        for ($i = 1; $i <= $total_paginas; $i++) {
          echo '<li class="page-item ';
          if ($i == $pagina_actual) {
            echo 'active';
          }
          echo '"><a class="page-link px-5 mx-auto" href="?pagina=' . $i . '#productos">' . $i . '</a></li>';
        }
        echo '</ul>';
        echo '</div>';

        // Cerrar la conexión a la base de datos
        pg_close($conexion);
        ?>
      </div>
    </div>
  </div>
  </div>
  <div id="Contacto" class="container-fluid my-5 py-5" style="background-color: rgb(221, 217, 217)">
    <section class="text-center">

      <div class="row">
        <div class="col-lg-5">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d50724.31444442145!2d-6.012081841264932!3d37.383454790537435!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1scomida%20sudamericana!5e0!3m2!1ses!2ses!4v1678651010668!5m2!1ses!2ses"
            class="h-100 w-100" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>

        <div class="col-lg-7">
          <form class="row g-3" method="post" action="">
            <h1 class="texto mb-5">Formulario de Contacto</h1>
            <div class="col-md-6">
              <label for="validationUsername" class="form-label">Nombre de usuario</label>
              <div class="input-group">
                <span class="input-group-text" id="inputGroup">@</span>
                <input type="text" class="form-control" id="validationUsername" name="username"
                  aria-describedby="inputGroup" required />
              </div>
            </div>
            <div class="col-md-6">
              <label for="validationEMAIL" class="form-label">Correo Electrónico</label>
              <input type="email" class="form-control" id="validationEMAIL" name="email" required />
            </div>
            <div class="col-md-6">
              <label for="validationCITY" class="form-label">Ciudad</label>
              <input type="text" class="form-control" id="validationCITY" name="city" required />
            </div>
            <div class="col-md-3">
              <label for="validationPROV" class="form-label">Provincia</label>
              <select class="form-select" id="validationPROV" name="province" required>
                <option selected disabled value="">Elige...</option>
                <option value="Álava/Araba">Álava/Araba</option>
                <option value="Albacete">Albacete</option>
                <option value="Alicante">Alicante</option>
                <option value="Almería">Almería</option>
                <option value="Asturias">Asturias</option>
                <option value="Ávila">Ávila</option>
                <option value="Badajoz">Badajoz</option>
                <option value="Baleares">Baleares</option>
                <option value="Barcelona">Barcelona</option>
                <option value="Burgos">Burgos</option>
                <option value="Cáceres">Cáceres</option>
                <option value="Cádiz">Cádiz</option>
                <option value="Cantabria">Cantabria</option>
                <option value="Castellón">Castellón</option>
                <option value="Ceuta">Ceuta</option>
                <option value="Ciudad Real">Ciudad Real</option>
                <option value="Córdoba">Córdoba</option>
                <option value="Cuenca">Cuenca</option>
                <option value="Gerona/Girona">Gerona/Girona</option>
                <option value="Granada">Granada</option>
                <option value="Guadalajara">Guadalajara</option>
                <option value="Guipúzcoa/Gipuzkoa">Guipúzcoa/Gipuzkoa</option>
                <option value="Huelva">Huelva</option>
                <option value="Huesca">Huesca</option>
                <option value="Jaén">Jaén</option>
                <option value="La Coruña/A Coruña">La Coruña/A Coruña</option>
                <option value="La Rioja">La Rioja</option>
                <option value="Las Palmas">Las Palmas</option>
                <option value="León">León</option>
                <option value="Lérida/Lleida">Lérida/Lleida</option>
                <option value="Lugo">Lugo</option>
                <option value="Madrid">Madrid</option>
                <option value="Málaga">Málaga</option>
                <option value="Melilla">Melilla</option>
                <option value="Murcia">Murcia</option>
                <option value="Navarra">Navarra</option>
                <option value="Orense/Ourense">Orense/Ourense</option>
                <option value="Palencia">Palencia</option>
                <option value="Pontevedra">Pontevedra</option>
                <option value="Salamanca">Salamanca</option>
                <option value="Segovia">Segovia</option>
                <option value="Sevilla">Sevilla</option>
                <option value="Soria">Soria</option>
                <option value="Tarragona">Tarragona</option>
                <option value="Tenerife">Tenerife</option>
                <option value="Teruel">Teruel</option>
                <option value="Toledo">Toledo</option>
                <option value="Valencia">Valencia</option>
                <option value="Valladolid">Valladolid</option>
                <option value="Vizcaya/Bizkaia">Vizcaya/Bizkaia</option>
                <option value="Zamora">Zamora</option>
                <option value="Zaragoza">Zaragoza</option>
              </select>
              </select>
            </div>
            <div class="col-md-3">
              <label for="CP" class="form-label">Código postal</label>
              <input type="text" class="form-control" id="CP" name="postal_code" required />
            </div>
            <div class="col-md-12">
              <textarea class="form-control" id="validationTextarea" name="message" placeholder="Escribe Aquí..."
                required></textarea>
              <div id="validationTextareaFeedback" class="invalid-feedback">
                Por favor ingresa un mensaje en el área de texto.
              </div>
            </div>
            <div class="col-12">
              <button class="btn bg-warning" type="submit">Enviar</button>
            </div>
          </form>

        </div>
      </div>
    </section>
  </div>
  <div class="container">
    <footer class="py-5">
      <div class="row">
        <div class="col-6 col-md-3 mb-3">
          <ul class="nav flex-column">
            <li class="nav-item mb-2">
              <a href="#productos" class="nav-link p-0 text-muted">Productos</a>
            </li>
            <li class="nav-item mb-2">
              <a href="#ofertas" class="nav-link p-0 text-muted">Promociones</a>
            </li>
            <li class="nav-item mb-2">
              <a href="#restaurantesAfiliados" class="nav-link p-0 text-muted">Restaurantes Afiliados</a>
            </li>
            <li class="nav-item mb-2">
              <a href="#Contacto" class="nav-link p-0 text-muted">Contáctenos</a>
            </li>
          </ul>
        </div>

        <div class="col-6 col-md-3 mb-3">
          <ul class="nav flex-column">
            <li class="nav-item mb-2">
              <a href="https://es-es.facebook.com/"><img class="logo mx-3"
                  src="Imagenes//icons8-facebook-nuevo-50.png" /></a>
            </li>
            <li class="nav-item mb-2">
              <a href="https://www.instagram.com/"><img class="logo mx-3" src="Imagenes/icons8-instagram-50.png" /></a>
            </li>
            <li class="nav-item mb-2">
              <a href="https://twitter.com/?lang=es"><img class="logo mx-3" src="Imagenes/icons8-twitter-50.png" /></a>
            </li>
            <li class="nav-item mb-2">
              <a href="https://www.youtube.com/"><img class="logo mx-3" src="Imagenes/icons8-youtube-play-50.png" /></a>
            </li>
          </ul>
        </div>

        <div class="col-md-5 offset-md-1 mb-3">
          <div class="d-flex flex-column flex-sm-row w-100 gap-2">
            <a class="mx-auto px-auto" href="index.php">
              <img src="Imagenes/favicon.png" height="90px" width="220px" />
            </a>
          </div>
        </div>
      </div>

      <div class="d-flex flex-column flex-sm-row justify-content-between py-4 my-4 border-top">
        <p>&copy; 2023 Latin Food Delivery. Todos los derechos reservados.</p>
      </div>
    </footer>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
    integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"
    integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ"
    crossorigin="anonymous"></script>
</body>

</html>