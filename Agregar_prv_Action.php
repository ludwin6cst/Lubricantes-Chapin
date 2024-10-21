<?php 
session_start(); 

// Conexión a la base de datos MySQL
$servername = "localhost";  // Cambia esto si es necesario
$username = "root";         // Usuario de la base de datos
$password = "";             // Contraseña del usuario
$dbname = "smss_db";        // Nombre de tu base de datos

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Procesar formulario cuando se envíen los datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_proveedor = $_POST['nombre_proveedor'];
    $telefono = $_POST['telefono'];
    $contacto_email = $_POST['contacto_email'];
    $fecha_registro = $_POST['fecha_registro'];

    // Insertar los datos en la tabla 'proveedores'
    $sql = "INSERT INTO proveedores (nombre_proveedor, telefono, contacto_email, fecha_registro) VALUES ('$nombre_proveedor', '$telefono', '$contacto_email', '$fecha_registro')";

    if ($conn->query($sql) === TRUE) {
        // Si la inserción fue exitosa, guardar en sesión el estado
        $_SESSION['status'] = "success";
        $_SESSION['message'] = "Proveedor agregado exitosamente.";
    } else {
        // Si hay error, guardar el error en sesión
        $_SESSION['status'] = "error";
        $_SESSION['message'] = "Error al agregar el proveedor: " . $conn->error;
    }

    // Cerrar conexión
    $conn->close();

    // Redirigir después de procesar
    header("Location: Agregar_prv.php");
    exit();
}
?>
