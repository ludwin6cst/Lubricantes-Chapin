<?php
session_start();
require 'Connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];
    $customerID = mysqli_real_escape_string($Conn, $_POST['CustomerID']);

    if ($action == 'delete') {
        $sql = "DELETE FROM administradores WHERE CustomerID = '$customerID'";
        if (mysqli_query($Conn, $sql)) {
            $_SESSION['message'] = "Administrador eliminado correctamente.";
        } else {
            $_SESSION['message'] = "Error al eliminar el administrador: " . mysqli_error($Conn);
        }
    } elseif ($action == 'edit') {
        // Verifica si todos los campos necesarios están presentes
        if (isset($_POST['Username'], $_POST['Firstname'], $_POST['Middlename'], $_POST['Lastname'], $_POST['Address'], $_POST['EmailAddress'])) {
            $username = mysqli_real_escape_string($Conn, $_POST['Username']);
            $firstname = mysqli_real_escape_string($Conn, $_POST['Firstname']);
            $middlename = mysqli_real_escape_string($Conn, $_POST['Middlename']);
            $lastname = mysqli_real_escape_string($Conn, $_POST['Lastname']);
            $address = mysqli_real_escape_string($Conn, $_POST['Address']);
            $email = mysqli_real_escape_string($Conn, $_POST['EmailAddress']);

            $sql = "UPDATE administradores 
                    SET Username = '$username', Firstname = '$firstname', Middlename = '$middlename', Lastname = '$lastname', Address = '$address', EmailAddress = '$email' 
                    WHERE CustomerID = '$customerID'";
            if (mysqli_query($Conn, $sql)) {
                $_SESSION['message'] = "Administrador editado correctamente.";
            } else {
                $_SESSION['message'] = "Error al editar el administrador: " . mysqli_error($Conn);
            }
        } else {
            $_SESSION['message'] = "Datos incompletos para la edición.";
        }
    } else {
        $_SESSION['message'] = "Acción no válida.";
    }
} else {
    $_SESSION['message'] = "Falta acción o ID.";
}

mysqli_close($Conn);

// Redirigir con un script
echo '<script>
        window.location.href = "Management_Customers.php";
      </script>';
exit();
?>
