<?php
session_start();
require 'Connection.php'; // Incluye la conexión a la base de datos

// Verifica si se ha pasado un ID válido
if (isset($_GET['id'])) {
    $categoria_id = intval($_GET['id']); // Asegurarse de que el ID sea un número entero

    // Consulta SQL para eliminar la categoría
    $sql = "DELETE FROM categorias WHERE categoria_id = ?";

    if ($stmt = mysqli_prepare($Conn, $sql)) {
        // Vincula el parámetro
        mysqli_stmt_bind_param($stmt, "i", $categoria_id);

        // Ejecuta la consulta
        if (mysqli_stmt_execute($stmt)) {
            // Redirigir al usuario de vuelta a la página de categorías con un mensaje de éxito
            $_SESSION['message'] = "Categoría eliminada correctamente.";
            header("Location: Categorias.php");
            exit();
        } else {
            // Si falla, mostrar un mensaje de error
            $_SESSION['message'] = "Error al eliminar la categoría.";
            header("Location: Categorias.php");
            exit();
        }
    } else {
        // Error al preparar la consulta
        $_SESSION['message'] = "Error de conexión.";
        header("Location: Categorias.php");
        exit();
    }
} else {
    // Si no se proporciona un ID válido, redirigir a la página de categorías
    $_SESSION['message'] = "ID de categoría no válido.";
    header("Location: Categorias.php");
    exit();
}
?>