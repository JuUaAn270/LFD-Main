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

                            <div class="card-body p-md-5 mx-md-4">

                                <div class="text-center">
                                    <a href="indexhostelero.php">
                                        <img src="Imagenes/favicon.png" style="width: 225px; margin: 50px" alt="logo">
                                    </a>
                                </div>
                                <?php
                                $usuario_serializado = $_COOKIE['usuario'] ?? '';
                                $usuario = json_decode($usuario_serializado, true);

                                if (isset($_POST['editar_datos'])) {
                                    // Obtener los datos del formulario
                                    $nombre = $_POST['nombre'] ?? '';
                                    $apellidos = $_POST['apellidos'] ?? '';
                                    $correo = $_POST['correo'] ?? '';
                                    $contrasena = $_POST['contrasena'] ?? '';
                                    $repetir_contrasena = $_POST['repetir_contrasena'] ?? '';
                                    $id_usuario = $usuario['id_usuario'] ?? '';


                                        $conn = pg_connect("host=127.0.0.1 dbname=LFD user=postgres password=usuario") or die("No se pudo conectar a la base de datos");

                                        // Actualizar los datos del usuario en la tabla "cliente"
                                        $query = "UPDATE hostelero SET nombre = $1, apellidos = $2, correo = $3, password = $4 WHERE id_usuario = $5";
                                        $result = pg_query_params($conn, $query, array($nombre, $apellidos, $correo, $contrasena, $id_usuario));

                                        if ($result !== false) {
                                            // Redireccionar a la página de inicio
                                            header("Location: indexhostelero.php");
                                            exit;
                                        } else {
                                            // Error al ejecutar la consulta SQL
                                            echo "Error al ejecutar la consulta SQL.";
                                        }

                                        // Cerrar la conexión a la base de datos
                                        pg_close($conn);
                                    }


                                if (isset($_POST['eliminar_cuenta'])) {
                                    // Conectar a la base de datos
                                    $conn = pg_connect("host=127.0.0.1 dbname=LFD user=postgres password=usuario") or die("No se pudo conectar a la base de datos");

                                    // Borrar la cuenta del usuario de la tabla "cliente"
                                    $query = "DELETE FROM hostelero WHERE id_usuario = $1";
                                    $result = pg_query_params($conn, $query, array($usuario['id_usuario']));

                                    if ($result !== false) {
                                        // Borrar todas las cookies existentes
                                        $cookies = $_COOKIE;
                                        foreach ($cookies as $cookie_name => $cookie_value) {
                                            setcookie($cookie_name, '', time() - 3600, '/');
                                        }
                                        // Redireccionar a la página de inicio de sesión
                                        header("Location: loginhostelero.php");
                                        exit;
                                    } else {
                                        // Error al ejecutar la consulta SQL
                                        echo "Error al ejecutar la consulta SQL.";
                                    }

                                    // Cerrar la conexión a la base de datos
                                    pg_close($conn);
                                }
                                ?>
                                <form method="post">

                                    <div class="form-outline mb-4">
                                        <input type="text" name="nombre" class="form-control" placeholder="Introduce tu nombre" value="<?php echo $usuario['nombre'] ?? ''; ?>" />
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="text" name="apellidos" class="form-control" placeholder="Introduce tus apellidos" value="<?php echo $usuario['apellidos'] ?? ''; ?>" />
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="email" name="correo" class="form-control" placeholder="Introduce un correo" value="<?php echo $usuario['correo'] ?? ''; ?>" />
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="password" name="contrasena" class="form-control" placeholder="Introduce tu contraseña" value="<?php echo $usuario['password'] ?? ''; ?>" />
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="password" name="repetir_contrasena" class="form-control" placeholder="Repite tu contraseña" value="<?php echo $usuario['password'] ?? ''; ?>" />
                                    </div>

                                    <div class="d-flex align-items-center justify-content-center pb-4">
                                        <?php
                                        if (isset($_POST['cerrar_sesion'])) {
                                            // Borrar todas las cookies existentes
                                            $cookies = $_COOKIE;
                                            foreach ($cookies as $cookie_name => $cookie_value) {
                                                setcookie($cookie_name, '', time() - 3600, '/');
                                            }
                                            // Redireccionar a la página de inicio de sesión
                                            header("Location: login.php");
                                            exit;
                                        }
                                        ?>
                                        <button type="submit" name="cerrar_sesion" class="btn btn-primary mx-3" style="width: 200px;">Cerrar Sesión</button>
                                        <button type="submit" name="editar_datos" class="btn btn-warning mx-3" style="width: 200px;">Editar Datos</button>
                                        <button type="submit" name="eliminar_cuenta" class="btn btn-danger mx-3" style="width: 200px;">Eliminar Cuenta</button>
                                    </div>
                                </form>
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