<?php
// Conexión a la base de datos y otras configuraciones
$conexion = pg_connect("host=127.0.0.1 dbname=LFD user=postgres password=usuario") or die("No se pudo conectar a la base de datos");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Obtener los datos del formulario
  $id_producto = $_POST['id_producto'];
  $nombre = $_POST['nombre'];
  $descripcion = $_POST['descripcion'];
  $precio = $_POST['precio'];

  // Realizar la actualización en la base de datos
  $query = pg_query_params($conexion, "UPDATE producto SET nombre = $1, descripcion = $2, precio = $3 WHERE id_producto = $4", array($nombre, $descripcion, $precio, $id_producto));

  // Verificar si la actualización fue exitosa
  if ($query) {
    // Redirigir al usuario a la página de visualización de productos actualizada
    header('Location: indexhostelero.php');
    exit();
  } else {
    // Mostrar un mensaje de error en caso de fallo en la actualización
    echo '<div class="alert alert-danger mt-4" role="alert">Ha ocurrido un error, inténtalo de nuevo.</div>';
  }
}
pg_close($conexion);
?>