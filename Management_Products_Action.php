<?php
session_start();

// Obtener la acción del producto desde la URL
$ProductAction = isset($_GET["ProductAction"]) ? trim($_GET["ProductAction"]) : '';

// Incluir la conexión a la base de datos
require 'Connection.php';

// Función para manejar la carga de imagen
function uploadImage($file) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($file["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validar los tipos de archivos permitidos
    $valid_extensions = array("jpg", "jpeg", "png", "gif");
    if (!in_array($imageFileType, $valid_extensions)) {
        return array(false, "Formato de imagen no permitido.");
    }

    // Intentar mover la imagen subida
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        return array(true, $target_file);
    } else {
        return array(false, "Hubo un error al subir la imagen.");
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos - Lubricantes Chapin</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/business-casual.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">Lubricantes Chapin</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="Management_Orders.php">Pedidos</a></li>
                    <li><a href="Management_Products.php?ProductAction=Add">Agregar Producto</a></li>
                    <li><a href="Management_ProductsList.php">Lista de Productos</a></li>
                    <li><a href="Management_Customers.php">Administradores</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container" style="margin-top: 100px;">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <h3>Gestión de Productos</h3>
                    </div>
                    <div class="panel-body">
                        <?php
                        if ($ProductAction == "Add") {
                            if (!empty($_POST["ProductName"]) && !empty($_POST["ProductDescription"]) && 
                                !empty($_POST["ProductPrice"]) && !empty($_POST["ProductStock"]) && 
                                !empty($_POST["ProductCategory"]) && !empty($_POST["ProductEstado"]) && 
                                !empty($_POST["ProductMarca"]) && !empty($_POST["ProductFechaAgregado"])) { // Añadir campo de fecha

                                $_ProductName = $_POST["ProductName"];
                                $_ProductDescription = $_POST["ProductDescription"];
                                $_ProductPrice = $_POST["ProductPrice"];
                                $_ProductStock = $_POST["ProductStock"]; 
                                $_ProductCategory = $_POST["ProductCategory"];
                                $_ProductEstado = $_POST["ProductEstado"];
                                $Productmarca = $_POST["ProductMarca"]; 
                                $_ProductFechaAgregado = $_POST["ProductFechaAgregado"]; // Nuevo campo

                                if (!empty($_FILES['ProductImage']['tmp_name'])) {
                                    list($uploadSuccess, $uploadMessage) = uploadImage($_FILES["ProductImage"]);

                                    if ($uploadSuccess) {
                                        $imagePath = $uploadMessage;
                                        $sql = "INSERT INTO `tbl_products` (`nombre`, `descripcion`, `precio`, `stock`, `id_categoria`, `imagen`, `estado`, `marca`, `fecha_agregado`) 
                                                VALUES ('$_ProductName', '$_ProductDescription', '$_ProductPrice', '$_ProductStock', '$_ProductCategory', '$imagePath', '$_ProductEstado', '$Productmarca', '$_ProductFechaAgregado')";

                                        if (mysqli_query($Conn, $sql)) {
                                            echo '<div class="alert alert-success">¡Producto añadido con éxito!</div>';
                                            echo '<script>window.open("Management_ProductsList.php","_self",null,true);</script>';
                                        } else {
                                            echo '<div class="alert alert-danger">Error al insertar el producto: ' . mysqli_error($Conn) . '</div>';
                                        }
                                    } else {
                                        echo '<div class="alert alert-danger">' . $uploadMessage . '</div>';
                                    }
                                } else {
                                    echo '<div class="alert alert-danger">¡La imagen es obligatoria!</div>';
                                }
                            } else {
                                echo '<div class="alert alert-danger">¡Todos los campos son obligatorios!</div>';
                            }

                        } else if ($ProductAction == "Edit") {
                            if (!empty($_POST["ProductName"]) && !empty($_POST["ProductDescription"]) && 
                                !empty($_POST["ProductPrice"]) && !empty($_POST["ProductStock"]) && 
                                !empty($_POST["ProductCategory"]) && !empty($_POST["ProductEstado"]) && 
                                !empty($_POST["ProductMarca"]) && !empty($_POST["ProductFechaAgregado"])) { 

                                $_ProductName = $_POST["ProductName"];
                                $_ProductDescription = $_POST["ProductDescription"];
                                $_ProductPrice = $_POST["ProductPrice"];
                                $_ProductStock = $_POST["ProductStock"]; 
                                $_ProductCategory = $_POST["ProductCategory"];
                                $_ProductEstado = $_POST["ProductEstado"];
                                $Productmarca = $_POST["ProductMarca"];  
                                $_ProductID = $_GET["ProductID"];
                                $_ProductFechaAgregado = $_POST["ProductFechaAgregado"]; 

                                if (empty($_FILES['ProductImage']['tmp_name'])) {
                                    $sql = "UPDATE `tbl_products` 
                                            SET `nombre`='$_ProductName', `descripcion`='$_ProductDescription', `precio`='$_ProductPrice', 
                                            `stock`='$_ProductStock', `id_categoria`='$_ProductCategory', `estado`='$_ProductEstado', 
                                            `marca`='$Productmarca', `fecha_agregado`='$_ProductFechaAgregado' 
                                            WHERE `id` = $_ProductID"; 
                                } else {
                                    list($uploadSuccess, $uploadMessage) = uploadImage($_FILES["ProductImage"]);

                                    if ($uploadSuccess) {
                                        $imagePath = $uploadMessage;
                                        $sql = "UPDATE `tbl_products` 
                                                SET `nombre`='$_ProductName', `descripcion`='$_ProductDescription', `precio`='$_ProductPrice', 
                                                `stock`='$_ProductStock', `id_categoria`='$_ProductCategory', `imagen`='$imagePath', `estado`='$_ProductEstado', 
                                                `marca`='$Productmarca', `fecha_agregado`='$_ProductFechaAgregado' 
                                                WHERE `id` = $_ProductID"; 
                                    } else {
                                        echo '<div class="alert alert-danger">' . $uploadMessage . '</div>';
                                        exit;
                                    }
                                }

                                if (mysqli_query($Conn, $sql)) {
                                    echo '<div class="alert alert-success">¡Producto actualizado correctamente!</div>';
                                    echo '<script>window.open("Management_ProductsList.php","_self",null,true);</script>';
                                } else {
                                    echo '<div class="alert alert-danger">Error al actualizar el producto: ' . mysqli_error($Conn) . '</div>';
                                }
                            } else {
                                echo '<div class="alert alert-danger">¡Todos los campos son obligatorios!</div>';
                            }

                        } else if ($ProductAction == "Delete") {
                            $_ProductID = $_GET["ProdID"];
                            $sql = "DELETE FROM `tbl_products` WHERE `id` = $_ProductID";

                            if (mysqli_query($Conn, $sql)) {
                                echo '<div class="alert alert-success">¡Producto eliminado correctamente!</div>';
                                echo '<script>window.open("Management_ProductsList.php","_self",null,true);</script>';
                            } else {
                                echo '<div class="alert alert-danger">Error al eliminar el producto: ' . mysqli_error($Conn) . '</div>';
                            }
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p class="text-muted">Lubricantes Chapin - Todos los derechos reservados © <?php echo date("Y"); ?></p>
        </div>
    </footer>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
