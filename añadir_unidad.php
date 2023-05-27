<?php
if (isset($_GET['id'])) {
  $producto_id = $_GET['id']; // Obtener el ID del producto a añadir

  // Verificar si se ha definido la cookie "productos_pedidos"
  if (isset($_COOKIE['productos_pedidos'])) {
    // Obtener el contenido de la cookie y decodificarlo como un arreglo
    $productos = json_decode($_COOKIE['productos_pedidos'], true);

    // Verificar si $productos es un arreglo antes de añadir el producto
    if (is_array($productos)) {
      // Añadir otra unidad del producto al arreglo
      $productos[] = $producto_id;

      // Codificar el arreglo actualizado como JSON
      $productos_actualizados = json_encode($productos);

      // Actualizar la cookie con el arreglo actualizado de productos
      setcookie('productos_pedidos', $productos_actualizados, time() + 3600, '/');

      // Redireccionar de vuelta a la página del carrito
      header('Location: cart.php');
      exit();
    }
  }
}

// Si no se pudo añadir el producto o hubo algún error, redireccionar de vuelta a la página del carrito
header('Location: cart.php');
exit();
?>