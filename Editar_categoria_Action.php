<?php
require 'Connection.php';

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $categoria_id = $_POST['categoria_id'];
    $nombre_categoria = $_POST['nombre_categoria'];
    $estado = $_POST['estado'];

    // Manejar el archivo de imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $imagen = 'uploads/' . basename($_FILES['imagen']['name']);
        move_uploaded_file($_FILES['imagen']['tmp_name'], $imagen);
    } else {
        // Si no se sube una nueva imagen, mantener la actual
        $imagen = null;
    }

    // Actualizar la categoría
    $sql = "UPDATE categorias SET nombre_categoria = ?, estado = ?". ($imagen ? ", imagen = ?" : "") ." WHERE categoria_id = ?";
    $stmt = $Conn->prepare($sql);

    if ($imagen) {
        $stmt->bind_param('sisi', $nombre_categoria, $estado, $imagen, $categoria_id);
    } else {
        $stmt->bind_param('sii', $nombre_categoria, $estado, $categoria_id);
    }

    // Asegúrate de que las cabeceras están configuradas correctamente
    header("Content-Type: text/html; charset=UTF-8");
    
    if ($stmt->execute()) {
        // Mensaje de éxito y redirección usando SweetAlert2
        echo "<!DOCTYPE html>
              <html lang='es'>
              <head>
                  <meta charset='UTF-8'>
                  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css'>
                  <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js'></script>
              </head>
              <body>
                  <script>
                      Swal.fire({
                          title: 'Éxito!',
                          text: 'Categoría actualizada correctamente.',
                          icon: 'success',
                          confirmButtonText: 'Aceptar'
                      }).then((result) => {
                          if (result.isConfirmed) {
                              window.location.href = 'Categorias.php'; // Redirigir a Categorias.php
                          }
                      });
                  </script>
              </body>
              </html>";
    } else {
        // Mensaje de error y redirección
        echo "<!DOCTYPE html>
              <html lang='es'>
              <head>
                  <meta charset='UTF-8'>
                  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css'>
                  <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js'></script>
              </head>
              <body>
                  <script>
                      Swal.fire({
                          title: 'Error!',
                          text: 'Error al actualizar la categoría.',
                          icon: 'error',
                          confirmButtonText: 'Aceptar'
                      }).then((result) => {
                          if (result.isConfirmed) {
                              window.location.href = 'Editar_categoria.php?id=$categoria_id'; // Redirigir de vuelta
                          }
                      });
                  </script>
              </body>
              </html>";
    }
}
?>