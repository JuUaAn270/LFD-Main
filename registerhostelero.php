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

<body style="background-color: #eee;">
    <section class="h-100 gradient-form" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">

                            <div class="card-body p-md-5 mx-md-4">

                                <div class="text-center">
                                    <a href="index.php">
                                        <img src="Imagenes/favicon.png" style="width: 225px; margin: 50px" alt="logo">
                                    </a>
                                </div>
                                <?php
                                // Conexión a la base de datos
                                $conn = pg_connect("host=127.0.0.1 dbname=LFD user=postgres password=usuario") or die("No se pudo conectar a la base de datos");

                                // Verificar si se ha enviado el formulario
                                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                    // Recuperación de los datos del formulario
                                    $nombre = $_POST['nombre'] ?? '';
                                    $apellidos = $_POST['apellidos'] ?? '';
                                    $correo = $_POST['correo'] ?? '';
                                    $contrasena = $_POST['contrasena'] ?? '';
                                    $repetir_contrasena = $_POST['repetir_contrasena'] ?? '';
                                    $id_restaurante = $_POST['id_restaurante'] ?? '';

                                    if ($nombre && $apellidos && $correo && $contrasena && $repetir_contrasena) {
                                        if ($contrasena != $repetir_contrasena) {
                                            echo "<script>alert('Las contraseñas no coinciden')</script>";
                                        } elseif (!preg_match('/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[^\w\d\s:])([^\s]){8,}$/', $contrasena)) {
                                            echo "<script>alert('La contraseña no cumple los requisitos mínimos')</script>";
                                        } else {
                                            // Insert en la tabla cliente
                                            $id_max_query = "SELECT MAX(id_usuario) FROM hostelero";
                                            $id_max_result = pg_query($conn, $id_max_query);
                                            $id_max_row = pg_fetch_assoc($id_max_result);
                                            $id_max = $id_max_row['max'];
                                            $new_id = $id_max + 1;

                                            $query = "INSERT INTO hostelero (id_usuario, nombre, apellidos, correo, password, id_restaurante) VALUES ($1, $2, $3, $4, $5, $6)";
                                            $prepared_query = pg_prepare($conn, "insert_query", $query);
                                            $result = pg_execute($conn, "insert_query", array($new_id, $nombre, $apellidos, $correo, $contrasena, $id_restaurante));

                                            if (!$result) {
                                                echo "<script>alert('Error al crear el hostelero')</script>";
                                            } else {
                                                echo "<script>alert('Hostelero creado correctamente')</script>";
                                                header("Location: loginhostelero.php");
                                            }
                                        }
                                    }
                                }

                                // Cierre de la conexión a la base de datos
                                pg_close($conn);
                                ?>
                                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

                                    <div class="form-outline mb-4">
                                        <input type="text" name="nombre" class="form-control"
                                            placeholder="Introduce tu nombre" />
                                        <p class="text-muted">Ej: Juan</p>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="text" name="apellidos" class="form-control"
                                            placeholder="Introduce tus apellidos" />
                                        <p class="text-muted">Ej: Pérez</p>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <select name="id_restaurante" class="form-control">
                                            <?php
                                            // Conexión a la base de datos
                                            $conn = pg_connect("host=127.0.0.1 dbname=LFD user=postgres password=usuario") or die("No se pudo conectar a la base de datos");

                                            // Consulta para obtener los datos de la tabla restaurante
                                            $query = "SELECT id_restaurante, nombre FROM restaurante";
                                            $result = pg_query($conn, $query);

                                            // Verificar si hay resultados
                                            if (pg_num_rows($result) > 0) {
                                                // Generar las opciones del select
                                                while ($row = pg_fetch_assoc($result)) {
                                                    $idRestaurante = $row['id_restaurante'];
                                                    $nombreRestaurante = $row['nombre'];
                                                    echo '<option value="' . $idRestaurante . '">' . $nombreRestaurante . '</option>';
                                                }
                                            } else {
                                                echo '<option value="">No se encontraron restaurantes</option>';
                                            }

                                            // Cierre de la conexión a la base de datos
                                            pg_close($conn);
                                            ?>
                                        </select>
                                        <p class="text-muted">Selecciona tu restaurante</p>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="email" name="correo" class="form-control"
                                            placeholder="Introduce tu correo coorporativo" />
                                        <p class="text-muted">Ej: jperez@example.com</p>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="password" name="contrasena" class="form-control"
                                            placeholder="Introduce tu contraseña" />
                                        <p class="text-muted">Debe tener una longitud de mayor a 8 carácteres con
                                            números, símbolos y
                                            mayúsculas</p>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="password" name="repetir_contrasena" class="form-control"
                                            placeholder="Repite tu contraseña" />
                                    </div>

                                    <div class="d-flex align-items-center justify-content-center pb-4">
                                        <button type="submit" class="btn btn-warning mx-3" style="width: 200px;">Crear
                                            una cuenta</button>
                                    </div>
                                </form>
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