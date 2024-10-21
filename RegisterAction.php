<?php
require 'Connection.php';

$ActionType = $_GET['ActionType'];
$Location = isset($_GET["Loc"]) ? $_GET["Loc"] : null;
$Username = $_POST['Username'];
$Password = $_POST['Password'];
$Firstname = $_POST['Firstname'];
$Middlename = $_POST['Middlename'];
$Lastname = $_POST['Lastname'];
$Address = $_POST['Address'];
$EmailAddress = $_POST['EmailAddress'];

if (empty($Username) || empty($Password) || empty($Firstname) || empty($Middlename) || empty($Lastname) || empty($Address) || empty($EmailAddress)) {
    echo '<script>window.alert("No se pueden dejar campos vacíos"); window.open("register.php","_self",null,true);</script>';
} else {
    if ($ActionType == "Register") {
        // Validar si el usuario ya está registrado
        $checkUserSql = "SELECT * FROM `administradores` WHERE `Username`='$Username'";
        $checkUserRes = mysqli_query($Conn, $checkUserSql);
        
        if (mysqli_num_rows($checkUserRes) > 0) {
            // Usuario ya registrado, redirigir y mostrar error
            header("Location: register.php?error=usuario_existente");
            exit;
        } else {
            // Insertar nuevo usuario
            $sql = "INSERT INTO `administradores`(`Username`,`Password`,`Role`,`Firstname`, `Middlename`, `Lastname`, `Address`, `EmailAddress`)" .
                   " VALUES ('$Username','$Password','Admin','$Firstname','$Middlename','$Lastname','$Address','$EmailAddress')";
            $res = mysqli_query($Conn, $sql);
            if ($res) {
                // Registro exitoso
                header("Location: register.php?success=true");
                exit; 
            } else {
                echo "Error: " . mysqli_error($Conn);
            }
        }
    }
}
?>
