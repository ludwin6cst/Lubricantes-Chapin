<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "smss_db");
if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}
$_un = $_POST['Username'];
$_pass = $_POST['Password'];
$_Role = $_GET['Role'];

$query = "SELECT * FROM administradores WHERE Username = '" . mysqli_real_escape_string($conn, $_un) . "' AND Password = '" . mysqli_real_escape_string($conn, $_pass) . "' AND Role = '" . mysqli_real_escape_string($conn, $_Role) . "'";
$res = mysqli_query($conn, $query);
if ($res === false) {
    die("Error: " . mysqli_error($conn));
}
$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
if ($row) {
    // Obtener el ID del administrador
    $admin_id = $row['CustomerID'];  // Cambia esto al nombre correcto del campo

    // Establecer las variables de sesión
    $_SESSION["Username"] = $_un;  // Nombre del usuario
    $_SESSION["Password"] = $_pass; // No se recomienda almacenar la contraseña en la sesión
    if ($_Role == "User") {
        echo "<script>window.open('index.php', '_self', null, true)</script>";
        die("Logged in as User");
    } else if ($_Role == "Admin") {
        $_SESSION['AdminID'] = $admin_id;  // ID del administrador
        $_SESSION['Admin'] = true;  // Establecer la variable de sesión Admin
        $_SESSION['Role'] = 'Admin';    // Establece el rol de usuario
        echo "<script>window.open('Management_Customers.php', '_self', null, true)</script>";
        die("Logged in as Admin");
    }
} else {
    die("Usuario invalido, usted no es un administrator");
}
?>
