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
                                    <h5 class="mb-3"><a href="user.php" class="text-body"><i
                                                class="fas fa-long-arrow-alt-left me-2"></i> ← Volver</a></h5>
                                    <hr>
                                    <?php

                                    $conn = pg_connect("host=127.0.0.1 dbname=LFD user=postgres password=usuario") or die("No se pudo conectar a la base de datos");

                                    // Verificar la conexión
                                    if (!$conn) {
                                        die("Error en la conexión a la base de datos: " . pg_last_error());
                                    }

                                    // Obtener el valor de la cookie "id_usuario"
                                    $id_usuario = $_COOKIE['id_usuario'];

                                    // Realizar la consulta a la tabla "pedido"
                                    $query = "SELECT * FROM pedido WHERE id_usuario = '$id_usuario'";
                                    $result = pg_query($conn, $query);

                                    // Verificar si hay resultados
                                    if (pg_num_rows($result) > 0) {
                                        // Mostrar los pedidos en un bucle
                                        while ($row = pg_fetch_assoc($result)) {
                                            echo '<div class="card mb-3">';
                                            echo '<div class="card-body">';
                                            echo '<div class="d-flex justify-content-between">';
                                            echo '<div class="d-flex flex-row align-items-center">';
                                            echo '<div>';
                                            echo '<img src="Imagenes/lista-de-verificacion.png" class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">';
                                            echo '</div>';
                                            echo '<div class="ms-3">';
                                            echo '<h5> Pedido#' . $row['id_pedido'] . '</h5>';
                                            echo '<p class="small mb-0">' . $row['fecha'] . '</p>';
                                            echo '</div>';
                                            echo '</div>';
                                            echo '<div class="d-flex flex-row align-items-center">';
                                            echo '<div style="width: 80px;">';
                                            echo '<h5 class="mb-0">' . $row['precio'] . '€</h5>';
                                            echo '</div>';
                                            echo '</div>';
                                            echo '</div>';
                                            echo '</div>';
                                            echo '</div>';
                                        }
                                    } else {
                                        echo "Todavía no has realizado ningún pedido.";
                                    }

                                    // Cerrar la conexión a la base de datos
                                    pg_close($conn);
                                    ?>
                                </div>
                                <div class="col-lg-5 d-flex align-items-center">
                                    <img src="Imagenes/repartidor-divertido-conducir-scooter-amarillo-mientras-sostiene-cajas-pizza.jpg">
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