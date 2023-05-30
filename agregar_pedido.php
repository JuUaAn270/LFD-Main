<?php
session_start();

// Obtener la ID del producto enviada desde el formulario
$id_producto = $_POST['id_producto'];

// Verificar si la cookie "productos_pedidos" ya existe
if (isset($_COOKIE['productos_pedidos'])) {
  // Obtener el contenido de la cookie y decodificarlo como un arreglo
  $productos = json_decode($_COOKIE['productos_pedidos'], true);

  // Agregar la nueva ID de producto al arreglo
  $productos[] = $id_producto;

  // Codificar el array como JSON y almacenarlo en la cookie
  setcookie('productos_pedidos', json_encode($productos), time() + 86400, '/');
} else {
  // Si la cookie no existe, crear un nuevo arreglo con la ID de producto
  $productos = array($id_producto);

  // Codificar el arreglo como JSON y almacenarlo en la cookie
  setcookie('productos_pedidos', json_encode($productos), time() + 86400, '/');
}

// Redirigir al archivo de la lista de productos
header('Location: index.php#productos');
exit();
?>