<?php
// Connection.php

// Datos de conexión
$host = 'localhost';
$user = 'root'; // Cambia esto si tienes un nombre de usuario diferente
$password = ''; // Cambia esto si tienes una contraseña
$database = 'smss_db'; // Cambia esto si tu base de datos tiene un nombre diferente

// Crear la conexión
$Conn = mysqli_connect($host, $user, $password, $database);

// Verificar la conexión
if (!$Conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
