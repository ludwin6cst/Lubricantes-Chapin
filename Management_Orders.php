<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Órdenes - Lubricantes Chapin</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/business-casual.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- Verificación de inicio de sesión del usuario -->
    <?php
    $Username = null;
    $isAdmin = false; // Variable para verificar si es administrador

    if (!empty($_SESSION["Username"])) {
        $Username = $_SESSION["Username"];
    }

    if (!empty($_SESSION['Admin'])) {
        $isAdmin = true; // Verifica si el usuario es un administrador
    } else {
        echo '<script>window.open("index.php","_self",null,true);</script>';
    }
    ?>

    <!-- Estilos adicionales para un mejor diseño -->
    <style>
        body {
            background-color: #f4f4f9;
            color: #333;
        }

        .brand {
            font-size: 3em;
            font-family: 'Josefin Slab', serif;
            color: white;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .address-bar {
            font-size: 1.5em;
            color: white;
            margin-bottom: 20px;
        }

        .navbar {
            background-color: #2c3e50;
        }

        .navbar a {
            color: white !important;
            font-weight: bold;
        }

        .navbar a:hover {
            background-color: #3498db;
        }

        .intro-text {
            color: #2980b9;
            font-weight: bold;
        }

        .table-responsive {
            margin-top: 30px;
        }

        table {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
        }

        th,
        td {
            padding: 15px;
            text-align: center;
        }

        th {
            background-color: #3498db;
            color: white;
            font-weight: bold;
        }

        td {
            background-color: #ecf0f1;
        }

        .action-links a {
            color: #e74c3c;
            text-decoration: none;
            font-weight: bold;
        }

        .action-links a:hover {
            color: #c0392b;
        }

        footer {
            background-color: #2c3e50;
            padding: 20px 0;
            color: white;
            text-align: center;
        }

    .btn-edit {
        background-color: #5bc0de; 
        color: white;
        border: none;
        padding: 10px 20px; 
        border-radius: 5px; 
        cursor: pointer; 
        font-size: 12px; 
    }

    .btn-edit:hover {
        background-color: #31b0d5;  
    }

    .btn-delete {
        background-color: #d9534f;
        color: white;
        border: none;
        padding: 10px 20px; 
        border-radius: 5px; 
        cursor: pointer; 
        font-size: 12px; 
    }

    .btn-delete:hover {
        background-color: #c9302c; 
    }

    </style>

</head>

<body>

    <div class="brand">Lubricantes Chapin</div>
    <div class="address-bar"><strong>La mejor tienda de Lubricantes en Cedros</strong></div>

    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Alternar navegación</span>
                    <span class="icon-bar"></s>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                    <a class="navbar-brand" href="index.php">Lubricantes Chapin</a>
            </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-center">
                        <li><a href="Management_Orders.php">Pedidos</a></li>

                        <!-- Menú desplegable con hover -->
                        <li class="dropdown" id="admin-dropdown">
                            <a href="#" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false">
                            Administradores <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                                <li><a href="Management_Customers.php">Administradores</a></li>
                                <li><a href="Management_ProductsList.php">Lista de Productos</a></li>
                                <li><a href="pedidos.php">Realizar pedido</a></li>
                                <li><a href="Management_Orders.php">Pedidos</a></li>
                                <li><a href="Agregar_ctg.php">Agregar Categoría</a></li>
                                <li><a href="Categorias.php">Categorias</a></li>
                                <li><a href="Agregar_prv.php">Agregar Proveedor</a></li>
                                <li><a href="Proveedores.php">Proveedores</a></li>
                                <li><a href="register.php">Registrar Administrador</a></li>
                                <li><a href="Management_Products.php?ProductAction=Add">Agregar Productos</a></li>
                                <?php 
                                    $Username = isset($_SESSION['Username']) ? $_SESSION['Username'] : null;
                                    if($Username == null) { 
                                        echo '<li><a href="register.php?ActionType=Register">Registrar administradores</a></li>'; 
                                    } 
                                ?>
                            </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

<!-- Estilos adicionales -->
<style>
    /* Estilo general de la barra de navegación */
    .navbar {
        background-color: #2c3e50; /* Azul oscuro */
        border: none;
        border-radius: 0;
        font-size: 15px; /* Tamaño de fuente más grande */
        padding: 20px 0; /* Más padding para hacer la barra más alta */
    }

    /* Aumenta el tamaño de los enlaces */
    .navbar-nav > li > a {
        color: #2c3e50;
        font-weight: bold;
        font-size: 15px; /* Texto más grande */
        padding: 20px;
        justify-content: center; /* Aumenta el espacio alrededor de los enlaces */
    }

    /* Estilo cuando pasas el cursor por los enlaces */
    .navbar-nav > li > a:hover {
        background-color: #2c3e50; /* Azul más claro */
        color: white;
    }

    /* Menú desplegable en hover */
    #admin-dropdown:hover .dropdown-menu {
        display: block;
        background-color: #2c3e50; /* Azul medio */
        border-radius: 0;
    }

    /* Estilo de los elementos del menú desplegable */
    .dropdown-menu > li > a {
        color: #fff;
        padding: 15px 30px; /* Aumenta el espacio en los elementos del menú */
        font-size: 10px; /* Tamaño de texto del dropdown */
    }

    .dropdown-menu > li > a:hover {
        background-color: #0052a3; /* Azul más oscuro */
    }

    /* Centra el contenido del navbar */
    .navbar-nav {
        display: flex;
        justify-content: center; /* Centra horizontalmente */
    }

    /* Centra el caret (flecha) del menú desplegable */
    .caret {
        border-top: 6px solid white; /* Hace el caret más grande */
    }

    /* Menú desplegable con animación */
    .dropdown-menu {
        transition: all 0.3s ease-in-out;
        margin-top: 0;
    }
</style>

    <div class="container">
        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Pedidos</h2>
                    <hr>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr style="text-align: center; color: Black; font-weight: bold;">
                                    <th>ID de Pedido</th>
                                    <th>ID de Administrador</th>
                                    <th>Nombre de Producto</th>
                                    <th>Fecha de Pedido</th>
                                    <th>ID Categoría</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php 
                            require 'Connection.php';

                            // Modificar la consulta SQL para obtener los campos de la tabla 'pedidos'
                            $sqlI = "SELECT pedidos.id_pedido, pedidos.CustomerID, pedidos.nombre_producto, pedidos.fecha_pedido, pedidos.categoria_id 
                                      FROM pedidos 
                                      ORDER BY pedidos.id_pedido";

                            $Resulta = mysqli_query($Conn, $sqlI);

                            if (!$Resulta) {
                                die('Query Failed: ' . mysqli_error($Conn)); // Manejo de errores
                            }

                            while ($Rows = mysqli_fetch_array($Resulta)): 
                            ?>
                            <tr style="color: black">
                                <td><?php echo htmlspecialchars($Rows['id_pedido']); ?></td>
                                <td><?php echo htmlspecialchars($Rows['CustomerID']); ?></td>
                                <td><?php echo htmlspecialchars($Rows['nombre_producto']); ?></td>
                                <td><?php echo htmlspecialchars($Rows['fecha_pedido']); ?></td>
                                <td><?php echo htmlspecialchars($Rows['categoria_id']); ?></td>
                                <td class="action-links">
                                    <button class="btn-edit" onclick="EditOrderOnclick(<?php echo $Rows['id_pedido']; ?>);">Editar</button>
                                    <button class="btn-delete" onclick="CancelOrderOnclick(<?php echo $Rows['id_pedido']; ?>);">Eliminar</button>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container -->

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>Copyright &copy; ConfiguroWeb</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>

        function EditOrderOnclick(ID) {
            Swal.fire({
                title: '¿Está seguro?',
                text: "¿Deseas editar este pedido?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, editarlo',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "Edit_Order.php?id=" + ID;
                }
            });
        }


    function CancelOrderOnclick(ID) {
    Swal.fire({
        title: '¿Está seguro?',
        text: "¡No podrás revertir esta acción!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminarlo',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Redirigir a la acción de eliminar el pedido con el parámetro action
            window.location.href = "Management_Orders_Action.php?id=" + ID + "&action=delete";
        }
    });
}

<?php if (isset($_GET['success']) && $_GET['success'] == 'true'): ?>
    Swal.fire({
        title: 'Eliminado',
        text: 'Pedido eliminado con éxito.',
        icon: 'success',
        confirmButtonText: 'Ok'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "Management_Orders.php";
        }
    });
<?php endif; ?>

<?php if (isset($_GET['updated']) && $_GET['updated'] == 'true'): ?>
        Swal.fire({
            title: 'Actualizado',
            text: 'Pedido editado con éxito.',
            icon: 'success',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "Management_Orders.php"; 
            }
        });
    <?php endif; ?>


</script>

</body>
</html>