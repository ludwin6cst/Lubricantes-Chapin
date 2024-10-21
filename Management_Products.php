<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gestión de Productos - Lubricantes Chapin</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Custom CSS -->
    <link href="css/business-casual.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700" rel="stylesheet">

    <?php
    // Conectar a la base de datos (ajusta los detalles de conexión)
    $conn = new mysqli('localhost', 'root', '', 'smss_db');

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error en la conexión: " . $conn->connect_error);
    }

    // Consulta para obtener las categorías
    $sql = "SELECT categoria_id, nombre_categoria FROM categorias";
    $result = $conn->query($sql);

    // Array para almacenar las categorías
    $categorias = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $categorias[] = $row;
        }
    }

    $conn->close();

    $Username = null;
    if (!empty($_SESSION["Username"])) {
        $Username = $_SESSION["Username"];
    }
    $ProductAction = $_GET["ProductAction"] ?? 'Add'; // Default to 'Add' if not set
    $ProductID = $_GET['ProdID'] ?? null; // Get product ID if exists
    
    // Iniciar las variables
    $_ProductName = '';
    $_ProductDescription = '';
    $_ProductPrice = '';
    $_ProductStock = '';
    $_ProductCategory = '';
    $_ProductEstado = 'Activo';
    $_ProductCantidad = '';
    $_ProductImage = '';

    if ($ProductAction == 'Edit' && !is_null($ProductID)) {
        // Aquí deberías realizar la consulta a la base de datos para obtener los detalles del producto
    }

    if (empty($_SESSION['Admin'])) {
        echo '<script>window.open("index.php","_self",null,true);</script>';
    }
    ?>

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
            text-align: center;
            margin-top: 20px;
        }

        .address-bar {
            font-size: 1.5em;
            color: white;
            margin-bottom: 20px;
            text-align: center;
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

        .form-control {
            margin-bottom: 15px;
        }

        footer {
            background-color: #2c3e50;
            padding: 20px 0;
            color: white;
            text-align: center;
        }

        /* Mejorar el diseño del formulario */
        .form-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 700px;
            margin: 0 auto;
            padding: 30px;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
            color: #2c3e50;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .btn-primary {
            width: 100%;
        }

        .product-image-preview {
            display: block;
            margin: 10px 0;
            text-align: center;
        }
    </style>
    <script>
        function confirmSubmit(event) {
            event.preventDefault(); // Evitar el envío del formulario inicialmente

            // Determinar si es una acción de agregar o editar producto
            var actionType = "<?php echo $ProductAction; ?>";
            var confirmMessage = (actionType === 'Edit')
                ? '¿Seguro que quieres editar este producto?'
                : '¿Seguro que quieres agregar este producto?';

            var confirmButtonText = (actionType === 'Edit')
                ? 'Sí, editar producto!'
                : 'Sí, agregar producto!';

            Swal.fire({
                title: confirmMessage,
                text: "No podrás revertir esta acción!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: confirmButtonText,
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.submit();
                }
            });
        }
    </script>


</head>

<body>
    <div class="brand">Lubricantes Chapin</div>
    <div class="address-bar"><strong>La mejor tienda de Lubricantes en Cedros</strong></div>

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
    </style>

    <div class="container">
        <div class="form-container">
            <div class="panel-heading text-center">
                <h3><?php echo $ProductAction == "Edit" ? "Editar Producto" : "Agregar Producto"; ?></h3>
            </div>
            <form role="form" action="Management_Products_Action.php?ProductAction=<?php echo $ProductAction;
            if ($ProductAction == 'Edit') {
                echo '&ProductID=' . $_GET['ProdID'];
            } ?>" method="POST" enctype="multipart/form-data" onsubmit="confirmSubmit(event);">

                <div class="form-group">
                    <label for="ProductName">Nombre del Producto</label>
                    <input type="text" class="form-control" name="ProductName" value="<?php echo $_ProductName; ?>"
                        required>
                </div>

                <div class="form-group">
                    <label for="ProductDescription">Descripción del Producto</label>
                    <textarea class="form-control" name="ProductDescription"
                        required><?php echo $_ProductDescription; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="ProductPrice">Precio</label>
                    <input type="number" class="form-control" step="0.01" min="0" name="ProductPrice" value="<?php echo $_ProductPrice; ?>"
                        required>
                </div>

                <div class="form-group">
                    <label for="ProductStock">Stock</label>
                    <input type="number" class="form-control" name="ProductStock" min="0" value="<?php echo $_ProductStock; ?>"
                        required>
                </div>

                <div class="form-group">
                    <label for="ProductCategory">Categoría</label>
                    <select class="form-control" name="ProductCategory" required>
                        <option value="">Seleccione una categoría</option>
                        <?php foreach ($categorias as $categoria): ?>
                            <option value="<?php echo $categoria['categoria_id']; ?>" <?php if ($_ProductCategory == $categoria['categoria_id'])
                                   echo 'selected'; ?>>
                                <?php echo $categoria['nombre_categoria']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="ProductEstado">Estado:</label>
                    <select name="ProductEstado" id="ProductEstado" class="form-control">
                        <option value="1">Activo</option>
                        <option value="0">Agotado</option>
                    </select>
                </div>


                <!-- Campo para Marca -->
                <div class="form-group">
                    <label for="ProductMarca">Marca:</label>
                    <input type="text" class="form-control" id="ProductMarca" name="ProductMarca" required>
                </div>

                <div class="form-group">
                    <label for="ProductImage">Imagen del Producto</label>
                    <input type="file" class="form-control" name="ProductImage">
                    <?php if ($_ProductImage): ?>
                        <div class="product-image-preview">
                            <img src="<?php echo $_ProductImage; ?>" alt="Imagen actual" style="width: 100px;">
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Campo para Fecha de Agregado -->
                <div class="form-group">
                    <label for="ProductFechaAgregado">Fecha de Agregado:</label>
                    <input type="date" class="form-control" id="ProductFechaAgregado" name="ProductFechaAgregado"
                        required>
                </div>

                <button type="submit" class="btn btn-primary">
                    <?php echo ($ProductAction == 'Edit') ? 'Editar Producto' : 'Agregar Producto'; ?>
                </button>
            </form>
        </div>
    </div>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>Copyright &copy; Lubricantes Chapin</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script>
        document.querySelector('form').addEventListener('submit', function (event) {
            const fechaPedido = document.getElementById('ProductFechaAgregado').value;
            const today = new Date();
            const inputDate = new Date(fechaPedido);

            // Validación de fecha de agregado
            if (inputDate > today) {
                event.preventDefault(); // Evita que se envíe el formulario
                Swal.fire({
                    icon: 'error',
                    title: 'Fecha inválida',
                    text: 'La fecha de agregado no puede ser mayor que la fecha actual.',
                    confirmButtonText: 'Aceptar'
                });
                return; // Salir de la función
            }

            // Validación del campo Marca (solo letras)
            const marca = document.getElementById('ProductMarca').value;
            const regex = /^[A-Za-z\s]+$/; // Solo letras y espacios permitidos
            if (!regex.test(marca)) {
                event.preventDefault(); // Evita que se envíe el formulario
                Swal.fire({
                    icon: 'error',
                    title: 'Marca inválida',
                    text: 'El campo "Marca" solo puede contener letras.',
                    confirmButtonText: 'Aceptar'
                });
                return; // Salir de la función
            }
        });

    </script>

</body>

</html>