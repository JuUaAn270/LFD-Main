<?php
// Establecer la conexión
$conn = pg_connect("host=127.0.0.1 dbname=LFD user=postgres password=usuario");

// Verificar si la conexión fue exitosa
if (!$conn) {
    die("La conexión falló");
}

// Ejecutar la consulta
$result = pg_query($conn, "SELECT bandera FROM pais WHERE nombre = 'Argentina'");
$result2 = pg_query($conn, "SELECT * FROM producto WHERE nombre = 'Guacamole'");


// Verificar si la consulta fue exitosa
if (!$result) {
    die("La consulta falló");
}

// Obtener el resultado de la consulta
$row = pg_fetch_assoc($result);
$row2 = pg_fetch_assoc($result2);


// Mostrar la imagen de la bandera de Argentina
echo "<img src='" . $row['bandera'] . "' alt='Bandera de Argentina'>";
echo "<p>El producto ".$row2['nombre']." es un ".$row2['descripcion']." y cuesta ".$row2['precio']." dólares. Aquí tienes una imagen del producto: <br><img src='".$row2['imagen']."'></p>";

// Cerrar la conexión
pg_close($conn);
?>