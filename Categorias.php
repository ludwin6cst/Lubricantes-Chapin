<?php session_start(); ?>

<?php
if (isset($_SESSION['message'])): ?>
    <div class="alert alert-info text-center">
        <?php echo $_SESSION['message']; ?>
    </div>
    <?php
    // Elimina el mensaje de la sesión después de mostrarlo
    unset($_SESSION['message']);
endif;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Categorías - Lubricantes Chapin</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/business-casual.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700" rel="stylesheet">

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
        .btn {
            border: none; /* Sin bordes */
            padding: 10px 15px; /* Espaciado interno */
            font-size: 14px; /* Tamaño de fuente */
            cursor: pointer; /* Cambia el cursor al pasar sobre el botón */
            border-radius: 4px; /* Bordes redondeados */
        }

        .btn-edit {
            background-color: #5bc0de; /* Color para editar */
            color: white;
        }

        .btn-edit:hover {
            background-color: #31b0d5; /* Color hover para editar */
        }

        .btn-delete {
            background-color: #d9534f; /* Color para eliminar */
            color: white;
        }

        .btn-delete:hover {
            background-color: #c9302c; /* Color hover para eliminar */
        }


        footer {
            background-color: #2c3e50;
            padding: 20px 0;
            color: white;
            text-align: center;
        }

        .img-category {
            max-width: 90px; 
            height: auto;
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
                    <li><a href="Categorias.php">Categorias</a></li>

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
                    <h2 class="intro-text text-center">Categorías</h2>
                    <hr>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr style="text-align: center; color: Black; font-weight: bold;">
                                    <th>ID Categoría</th>
                                    <th>Nombre Categoría</th>
                                    <th>Imagen</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                require 'Connection.php';

                                // Consulta para obtener las categorías
                                $sql = "SELECT categoria_id, nombre_categoria, imagen, estado FROM categorias ORDER BY categoria_id";
                                $result = mysqli_query($Conn, $sql);

                                if (!$result) {
                                    die('Query Failed: ' . mysqli_error($Conn)); // Manejo de errores
                                }

                                while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr style="color: black">
                                        <td><?php echo htmlspecialchars($row['categoria_id']); ?></td>
                                        <td><?php echo htmlspecialchars($row['nombre_categoria']); ?></td>
                                        <td>
                                            <img src="<?php echo htmlspecialchars($row['imagen']); ?>"
                                                 alt="<?php echo htmlspecialchars($row['nombre_categoria']); ?>"
                                                 class="img-category">
                                        </td>
                                        <td><?php echo $row['estado'] ? 'Activo' : 'Inactivo'; ?></td>
                                        <td class="action-links">
                                            <button class="btn btn-edit" onclick="confirmEdit(<?php echo $row['categoria_id']; ?>)">Editar</button>
                                            <button class="btn btn-delete" onclick="confirmDeletion(<?php echo $row['categoria_id']; ?>)">Eliminar</button>
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
    function confirmDeletion(categoriaId) {
        // Mostrar la alerta de SweetAlert2 para eliminar
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás deshacer esta acción!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redireccionar al script de eliminación
                window.location.href = 'Eliminar_categoria.php?id=' + categoriaId;
            }
        });
    }

    function confirmEdit(categoriaId) {
        // Mostrar la alerta de SweetAlert2 para editar
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Vas a editar esta categoría",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, editar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redireccionar a la página de edición
                window.location.href = 'Editar_categoria.php?id=' + categoriaId;
            }
        });
    }
    </script>

</body>

</html>
