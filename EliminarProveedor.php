<?php
session_start();

// Verificar si el administrador ha iniciado sesión
if (!isset($_SESSION["AdminID"])) {
    header("Location: login.php");
    exit;
}

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smss_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se ha recibido un 'id' de proveedor para eliminar
if (isset($_GET['id'])) {
    $proveedorId = $_GET['id']; // Obtener el ID del proveedor desde la URL

    // Preparar la consulta SQL para eliminar el proveedor
    $sqlDelete = "DELETE FROM proveedores WHERE proveedor_id = ?";

    // Preparar la declaración
    if ($stmt = $conn->prepare($sqlDelete)) {
        // Vincular el ID del proveedor a la consulta
        $stmt->bind_param("i", $proveedorId);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            // Redirigir a la página de proveedores con un mensaje de éxito
            header("Location: Proveedores.php?success=true");
        } else {
            echo "Error al ejecutar la consulta: " . $stmt->error;
        }

        // Cerrar la declaración
        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $conn->error;
    }
} else {
    echo "ID de proveedor no especificado.";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>