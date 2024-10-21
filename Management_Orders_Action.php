<?php
session_start();
require 'Connection.php'; // Conexión a la base de datos

// Verificar si hay un 'id' en la URL para manejar la eliminación de pedidos
if (isset($_GET['id']) && isset($_GET['action'])) {
    $id_pedido = $_GET['id']; // Obtener el ID del pedido desde la URL

    if ($_GET['action'] == 'delete') {
        // Lógica para eliminar el pedido
        $sqlDelete = "DELETE FROM pedidos WHERE id_pedido = ?";
        if ($stmtDelete = mysqli_prepare($Conn, $sqlDelete)) {
            mysqli_stmt_bind_param($stmtDelete, 'i', $id_pedido);

            if (mysqli_stmt_execute($stmtDelete)) {
                header("Location: Management_Orders.php?success=true"); // Redirigir a la página de gestión de pedidos
                exit;
            } else {
                // Manejo de errores, puede ser útil registrar esto en un log
                echo "Error al ejecutar la consulta: " . mysqli_stmt_error($stmtDelete) . "<br>"; // Mostrar el error de la consulta
            }

            // Cerrar la declaración
            mysqli_stmt_close($stmtDelete);
        } else {
            echo "Error en la preparación de la consulta: " . mysqli_error($Conn) . "<br>"; // Mostrar error de preparación
        }
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_pedido = $_POST['id_pedido'];
    $nombre_producto = $_POST['nombre_producto'];
    $categoria_id = $_POST['categoria_id'];
    $CustomerID = $_POST['CustomerID'];

    // Preparar la consulta para actualizar el pedido
    $sqlUpdate = "UPDATE pedidos SET nombre_producto = ?, categoria_id = ?, CustomerID = ? WHERE id_pedido = ?";
    if ($stmtUpdate = mysqli_prepare($Conn, $sqlUpdate)) {
        mysqli_stmt_bind_param($stmtUpdate, 'siii', $nombre_producto, $categoria_id, $CustomerID, $id_pedido);
        if (mysqli_stmt_execute($stmtUpdate)) {
            // Redirigir a la página con un mensaje de éxito
            header("Location: Management_Orders.php?updated=true");
            exit;
        } else {
            echo "Error al actualizar el pedido: " . mysqli_error($Conn);
        }
        mysqli_stmt_close($stmtUpdate);
    } else {
        echo "Error en la preparación de la consulta: " . mysqli_error($Conn);
    }
}

// Cerrar la conexión
$Conn->close();
?>