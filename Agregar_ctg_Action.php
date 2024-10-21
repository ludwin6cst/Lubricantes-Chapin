<?php
session_start();
require 'Connection.php'; // Asegúrate de que este archivo contenga la conexión a la base de datos

$mensaje = '';
$tipo = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_categoria = $_POST['nombre_categoria'];
    $estado = $_POST['estado'];
    
    // Manejo de la imagen
    $imagen = $_FILES['imagen'];
    $imagen_nombre = $imagen['name'];
    $imagen_temporal = $imagen['tmp_name'];
    $ruta_destino = 'imagenes/' . $imagen_nombre;

    // Mueve la imagen a la carpeta de destino
    if (move_uploaded_file($imagen_temporal, $ruta_destino)) {
        // Insertar datos en la base de datos
        $sql = "INSERT INTO categorias (nombre_categoria, imagen, estado) VALUES ('$nombre_categoria', '$ruta_destino', '$estado')";
        if (mysqli_query($Conn, $sql)) {
            // Almacena el mensaje de éxito
            $mensaje = 'Categoría agregada exitosamente';
            $tipo = 'success';
        } else {
            // Almacena el mensaje de error
            $mensaje = 'Error al agregar categoría: ' . mysqli_error($Conn);
            $tipo = 'error';
        }
    } else {
        // Almacena el mensaje de error de imagen
        $mensaje = 'Error al subir la imagen.';
        $tipo = 'error';
    }
}
?>
