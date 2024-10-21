<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Lista de Productos - Lubricantes Chapin</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Custom CSS -->
    <link href="css/business-casual.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700" rel="stylesheet">

    <!-- Verificación de inicio de sesión del usuario -->
    <?php
        if (empty($_SESSION['Admin'])) {
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

        th, td {
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

        img {
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .action-links a {
            color: #e74c3c;
            text-decoration: none;
            font-weight: bold;
        }

        .action-links a:hover {
            color: #c0392b;
        }
        .btn-edit {
            background-color: #5bc0de; /* Color para editar */
            color: white; /* Texto blanco */
            border: none; /* Sin bordes */
            padding: 10px 20px; /* Tamaño del botón */
            border-radius: 5px; /* Bordes redondeados */
            cursor: pointer; /* Cursor en forma de mano */
            font-size: 14px; /* Tamaño de la fuente */
            margin-right: 5px; /* Espacio entre los botones */
        }

        .btn-edit:hover {
            background-color: #31b0d5; /* Color hover para editar */
        }

        .btn-delete {
            background-color: #d9534f; /* Color para eliminar */
            color: white; /* Texto blanco */
            border: none; /* Sin bordes */
            padding: 10px 20px; /* Tamaño del botón */
            border-radius: 5px; /* Bordes redondeados */
            cursor: pointer; /* Cursor en forma de mano */
            font-size: 14px; /* Tamaño de la fuente */
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

    </style>
</head>

<body>

    <!-- Marca y dirección -->
    <div class="brand">Lubricantes Chapin</div>
    <div class="address-bar"><strong>La mejor tienda de Lubricantes en Cedros</strong></div>

    <!-- Navegación -->
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
                        <li><a href="Management_ProductsList.php">Lista de Productos</a></li>

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

    <!-- Lista de Productos -->
    <div class="container">
        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Lista de Productos</h2>
                    <hr>

                    <!-- Botón para exportar a PDF -->
                <div class="text-right">
                    <a href="export_pdf.php" class="btn btn-success" style="margin-bottom: 20px;">Exportar PDF</a>
                </div>

                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Imagen</th>
                                        <th>ID de Producto</th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Precio</th>
                                        <th>Stock</th>
                                        <th>Categoría</th>
                                        <th>Estado</th>
                                        <th>Marca</th>
                                        <th>Fecha Agregado</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <!-- PHP para obtener los datos de productos de la base de datos -->
                                <?php 
                                    require 'Connection.php';
                                    $sql = "SELECT * FROM tbl_products";
                                    $Resulta = mysqli_query($Conn, $sql);

                                    if (mysqli_num_rows($Resulta) > 0) {
                                        while($Rows = mysqli_fetch_array($Resulta)): 
                                ?>
                                    <tr>
                                        <td><img style="width: 100px; height: 100px;" src="<?php echo $Rows['imagen']; ?>" alt=""></td>
                                        <td><?php echo htmlspecialchars($Rows['id']); ?></td>
                                        <td><?php echo htmlspecialchars($Rows['nombre']); ?></td>
                                        <td><?php echo htmlspecialchars($Rows['descripcion']); ?></td>
                                        <td><?php echo htmlspecialchars($Rows['precio']); ?></td>
                                        <td><?php echo htmlspecialchars($Rows['stock']); ?></td>
                                        <td><?php echo htmlspecialchars($Rows['id_categoria']); ?></td>
                                        <td><?php echo htmlspecialchars($Rows['estado'] ? 'Disponible' : 'Agotado'); ?></td>
                                        <td><?php echo htmlspecialchars($Rows['marca']); ?></td>
                                        <td><?php echo htmlspecialchars($Rows['fecha_agregado']); ?></td> <!-- Nuevo campo -->
                                        <td class="action-links">
                                        <button onclick="ProductOnclick('Edit', <?php echo $Rows['id']; ?>);" class="btn-edit">Editar</button>
                                            <button onclick="ProductOnclick('Delete', <?php echo $Rows['id']; ?>);" class="btn-delete">Eliminar</button>
                                        </td>
                                    </tr>
                                <?php 
                                        endwhile; 
                                    } else {
                                        echo "<tr><td colspan='10' style='text-align: center;'>No hay productos disponibles.</td></tr>";
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pie de página -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>Copyright &copy; Lubricantes Chapin</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- Función para manejar acciones de Editar/Eliminar -->
    <script>
    function ProductOnclick(action, pid) {
        if (action === "Edit") {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Deseas editar este producto",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, editar',
                cancelButtonText: 'No, cancelar',
                backdrop: true, // Activa el fondo
                allowOutsideClick: false, // No permitir cerrar al hacer clic afuera
                position: 'center', // Centrar la alerta
                customClass: {
                    popup: 'animated bounce' // Clase CSS para la animación
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: '¡Editando!',
                        text: "Redirigiendo a la página de edición...",
                        icon: 'info',
                        timer: 1500,
                        showConfirmButton: false,
                        backdrop: true,
                        customClass: {
                            popup: 'animated fadeIn' // Clase CSS para la animación
                        }
                    }).then(() => {
                        // Redirigir en la misma ventana
                        window.location.href = "Edit_Product.php?id=" + pid;
                    });
                } else {
                    Swal.fire({
                        title: 'Edición cancelada',
                        icon: 'info',
                        timer: 1500,
                        showConfirmButton: false,
                        backdrop: true,
                        customClass: {
                            popup: 'animated fadeOut' // Clase CSS para la animación
                        }
                    });
                }
            });
        } else if (action === "Delete") {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Deseas eliminar este producto",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'No, cancelar',
                backdrop: true, // Activa el fondo
                allowOutsideClick: false, // No permitir cerrar al hacer clic afuera
                position: 'center', // Centrar la alerta
                customClass: {
                    popup: 'animated bounce' // Clase CSS para la animación
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: '¡Eliminando!',
                        text: "Redirigiendo a la página de eliminación...",
                        icon: 'info',
                        timer: 1500,
                        showConfirmButton: false,
                        backdrop: true,
                        customClass: {
                            popup: 'animated fadeIn' // Clase CSS para la animación
                        }
                    }).then(() => {
                        window.open("Management_Products_Action.php?ProdID=" + pid + "&ProductAction=" + action, "_self");
                    });
                } else {
                    Swal.fire({
                        title: 'Eliminación cancelada',
                        icon: 'info',
                        timer: 1500,
                        showConfirmButton: false,
                        backdrop: true,
                        customClass: {
                            popup: 'animated fadeOut' 
                        }
                    });
                }
            });
        }
    }
</script>

</body>

</html>
