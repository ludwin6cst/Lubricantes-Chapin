<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Administradores - Lubricantes Chapin</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="//cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script> <!-- Asegúrate de que esta línea esté aquí -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> 

    <!-- Custom CSS -->
    <link href="css/business-casual.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700" rel="stylesheet">

    <!-- Verificación de inicio de sesión del usuario -->
    <?php
    $Username = null;
    if (!empty($_SESSION["Username"])) {
        $Username = $_SESSION["Username"];
    }
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
            text-decoration: none;
            font-weight: bold;
        }

        .action-links .btn {
            margin: 0 5px;
        }

        .btn-edit {
            background-color: #5bc0de;
            color: white;
        }

        .btn-edit:hover {
            background-color: #31b0d5;
        }

        .btn-delete {
            background-color: #d9534f;
            color: white;
        }

        .btn-delete:hover {
            background-color: #c9302c;
        }

        footer {
            background-color: #2c3e50;
            padding: 20px 0;
            color: white;
            text-align: center;
        }

        /* Estilos para el icono de cerrar sesión */
        .logout-icon {
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 20px;
            color: white;
            cursor: pointer;
        }

        .logout-icon:hover {
            color: #f0ad4e;
        }
    </style>
</head>

<body>
    <!-- Icono de cerrar sesión -->
    <!-- Marca y dirección -->
    <div class="brand">Lubricantes Chapin</div>
    <div class="address-bar"><strong>La mejor tienda de Lubricantes en Cedros</strong></div>

    <!-- Navegación -->
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
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
                            if ($Username == null) {
                                echo '<li><a href="register.php?ActionType=Register">Registrar administradores</a></li>';
                            }
                            ?>
                        </ul>
                        <!-- Icono de cerrar sesión a la derecha -->
                        <div class="logout-icon" id="logout-link">
                            <i class="fa fa-sign-out"></i>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Estilos adicionales -->
    <style>
        /* Estilo general de la barra de navegación */
        .navbar {
            background-color: #2c3e50;
            /* Azul oscuro */
            border: none;
            border-radius: 0;
            font-size: 15px;
            /* Tamaño de fuente más grande */
            padding: 20px 0;
            /* Más padding para hacer la barra más alta */
        }

        /* Aumenta el tamaño de los enlaces */
        .navbar-nav>li>a {
            color: #2c3e50;
            font-weight: bold;
            font-size: 15px;
            /* Texto más grande */
            padding: 20px;
            justify-content: center;
            /* Aumenta el espacio alrededor de los enlaces */
        }

        /* Estilo cuando pasas el cursor por los enlaces */
        .navbar-nav>li>a:hover {
            background-color: #2c3e50;
            /* Azul más claro */
            color: white;
        }

        /* Menú desplegable en hover */
        #admin-dropdown:hover .dropdown-menu {
            display: block;
            background-color: #2c3e50;
            /* Azul medio */
            border-radius: 0;
        }

        /* Estilo de los elementos del menú desplegable */
        .dropdown-menu>li>a {
            color: #fff;
            padding: 15px 30px;
            /* Aumenta el espacio en los elementos del menú */
            font-size: 10px;
            /* Tamaño de texto del dropdown */
        }

        .dropdown-menu>li>a:hover {
            background-color: #0052a3;
            /* Azul más oscuro */
        }

        /* Centra el contenido del navbar */
        .navbar-nav {
            display: flex;
            justify-content: center;
            /* Centra horizontalmente */
        }

        /* Centra el caret (flecha) del menú desplegable */
        .caret {
            border-top: 6px solid white;
            /* Hace el caret más grande */
        }

        /* Menú desplegable con animación */
        .dropdown-menu {
            transition: all 0.3s ease-in-out;
            margin-top: 0;
        }

        /* Estilos para el icono de cerrar sesión */
        .logout-icon {
            position: absolute;
            top: 15px;
            /* Ajusta la posición vertical según sea necesario */
            left: 750px;
            font-size: 20px;
            color: white;
            cursor: pointer;
        }

        .logout-icon:hover {
            color: #f0ad4e;
        }
    </style>



    <!-- Tabla de Administradores -->
    <div class="container">
        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Administradores</h2>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID Cliente</th>
                                    <th>Usuario</th>
                                    <th>Contraseña</th>
                                    <th>Primer Nombre</th>
                                    <th>Primer Apellido</th>
                                    <th>Segundo Apellido</th>
                                    <th>Dirección</th>
                                    <th>Correo Electrónico</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- PHP para obtener los datos de administradores -->
                                <?php
                                require 'Connection.php';
                                $sql = "SELECT CustomerID, Username, Password, Firstname, Middlename, Lastname, Address, EmailAddress FROM administradores";
                                $Resulta = mysqli_query($Conn, $sql);

                                if (mysqli_num_rows($Resulta) > 0) {
                                    while ($Rows = mysqli_fetch_array($Resulta)):
                                        ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($Rows['CustomerID']); ?></td>
                                            <td><?php echo htmlspecialchars($Rows['Username']); ?></td>
                                            <td><?php echo htmlspecialchars($Rows['Password']); ?></td>
                                            <td><?php echo htmlspecialchars($Rows['Firstname']); ?></td>
                                            <td><?php echo htmlspecialchars($Rows['Middlename']); ?></td>
                                            <td><?php echo htmlspecialchars($Rows['Lastname']); ?></td>
                                            <td><?php echo htmlspecialchars($Rows['Address']); ?></td>
                                            <td><?php echo htmlspecialchars($Rows['EmailAddress']); ?></td>
                                            <!-- Agrega un formulario oculto para la acción de eliminación -->
                                            <form id="deleteForm" action="Management_Customers_Action.php" method="POST"
                                                style="display:none;">
                                                <input type="hidden" name="action" value="delete">
                                                <input type="hidden" name="CustomerID" id="customerID">
                                            </form>
                                            <form id="editForm" action="Management_Customers_Action.php" method="POST"
                                                style="display:none;">
                                                <input type="hidden" name="action" value="edit">
                                                <input type="hidden" name="CustomerID" id="customerID">
                                            </form>

                                            <td class="action-links">
                                            <button class="btn btn-edit" onclick="confirmEdit(<?php echo $Rows['CustomerID']; ?>)">Editar</button>
                                            <button class="btn btn-delete" onclick="confirmDelete(<?php echo $Rows['CustomerID']; ?>)">Eliminar</button>

                                        </tr>
                                    <?php
                                    endwhile;
                                } else {
                                    echo "<tr><td colspan='9' style='text-align: center;'>No hay administradores disponibles.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pie de página -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Lubricantes Chapin 2024</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts necesarios -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.getElementById('logout-link').onclick = function () {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡Quieres cerrar sesión!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, cerrar sesión!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'logout.php'; // Ajusta la ruta según tu archivo de cierre de sesión
                }
            });
        }

        function confirmDelete(customerID) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Establece el valor del CustomerID en el formulario oculto
                document.getElementById('customerID').value = customerID;
                // Envía el formulario
                document.getElementById('deleteForm').submit();
            }
        });
    }

    function confirmEdit(customerID) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¿Quieres editar al administrador?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, editar!',
    }).then((result) => {
        if (result.isConfirmed) {
            // Redirige a la página de edición
            window.location.href = 'Editar_Customer.php?EditID=' + customerID;
        }
    });
}

    </script>

<script>
    $(document).ready(function() {
        <?php if (isset($_SESSION['message'])): ?>
            Swal.fire({
                title: 'Éxito',
                text: '<?php echo $_SESSION['message']; ?>',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            });
            <?php unset($_SESSION['message']); // Limpia el mensaje después de mostrarlo ?>
        <?php endif; ?>
    });
</script>

</body>

</html>