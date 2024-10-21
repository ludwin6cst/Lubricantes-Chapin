<?php session_start(); ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Proveedor - Lubricantes Chapin</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/business-casual.css" rel="stylesheet">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

        .form-control {
            margin-bottom: 15px;
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
                        <li><a href="Proveedores.php">Proveedores</a></li>

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

    <!-- Formulario de agregar proveedor -->
    <div class="container">
        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Agregar Proveedor</h2>
                    <hr>
                </div>

                <div class="col-md-12">
                    <form role="form" method="POST" action="Agregar_prv_Action.php">
                        <div class="col-md-6">
                            <!-- Campo Proveedor ID (bloqueado) -->
                            <div class="form-group">
                                <label for="proveedor_id">Proveedor ID:</label>
                                <input type="text" id="proveedor_id" name="proveedor_id" class="form-control" value="Generado Automaticamente" disabled>
                            </div>

                            <!-- Campo Nombre del Proveedor -->
                            <div class="form-group">
                                <label for="nombre_proveedor">Nombre del Proveedor:</label>
                                <input type="text" id="nombre_proveedor" name="nombre_proveedor" class="form-control" placeholder="Ingresa el nombre del proveedor" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Campo Teléfono -->
                            <div class="form-group">
                                <label for="telefono">Teléfono:</label>
                                <input type="text" id="telefono" name="telefono" class="form-control" placeholder="Ingresa el teléfono" required>
                            </div>

                            <!-- Campo Email -->
                            <div class="form-group">
                                <label for="contacto_email">Email:</label>
                                <input type="email" id="contacto_email" name="contacto_email" class="form-control" placeholder="Ingresa el email" required>
                            </div>

                            <!-- Campo Fecha del Registro -->
                            <div class="form-group">
                                <label for="fecha_registro">Fecha del Registro:</label>
                                <input type="date" id="fecha_registro" name="fecha_registro" class="form-control" required>
                            </div>

                            <!-- Botón para enviar -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Agregar Proveedor</button>
                            </div>
                        </div>
                    </form>
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

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <!-- SweetAlert2 Alertas -->
    <script>
    <?php 
    if (isset($_SESSION['status'])) {
        $status = $_SESSION['status'];
        $message = $_SESSION['message'];

        // SweetAlert2 con redirección
        if ($status === 'success') {
            echo "
            Swal.fire({
                icon: 'success',
                title: 'Proveedor agregado exitosamente',
                text: '$message',
                showConfirmButton: true
            }).then(function() {
                window.location.href = 'proveedores.php';
            });
            ";
        } else {
            // En caso de error, mostrar el mensaje de error
            echo "
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '$message',
                showConfirmButton: true
            });
            ";
        }

        // Limpiar el estado de la sesión
        unset($_SESSION['status']);
        unset($_SESSION['message']);
    }
    ?>
</script>
<script>
// Formato automático del teléfono mientras se escribe
document.getElementById('telefono').addEventListener('input', function(event) {
    let telefono = event.target.value.replace(/\D/g, ''); // Eliminar todo lo que no sea dígito
    if (telefono.length > 4) {
        telefono = telefono.slice(0, 4) + '-' + telefono.slice(4, 8); // Insertar guion después de los primeros 4 dígitos
    }
    event.target.value = telefono; // Actualizar el campo con el formato
});

document.querySelector('form').addEventListener('submit', function(event) {
    const fechaPedido = document.getElementById('fecha_registro').value;
    const telefono = document.getElementById('telefono').value;
    const email = document.getElementById('contacto_email').value;
    const today = new Date();
    const inputDate = new Date(fechaPedido);
    const nombreProveedor = document.getElementById('nombre_proveedor').value;

    // Comprobar si la fecha del pedido es mayor que la fecha actual
    if (inputDate > today) {
        event.preventDefault(); // Evita que se envíe el formulario
        Swal.fire({
            icon: 'error',
            title: 'Fecha inválida',
            text: 'La fecha del agregado no puede ser mayor que la fecha actual.',
            confirmButtonText: 'Aceptar'
        });
        return; // Evitar que continúe con las otras validaciones
    }

    // Validar que el teléfono tenga exactamente 8 dígitos con el guion
    const telefonoRegex = /^\d{4}-\d{4}$/;
    if (!telefonoRegex.test(telefono)) {
        event.preventDefault(); // Evita que se envíe el formulario
        Swal.fire({
            icon: 'error',
            title: 'Teléfono inválido',
            text: 'El teléfono debe tener el formato 1234-5678.',
            confirmButtonText: 'Aceptar'
        });
        return;
    }

    // Validar el formato de correo electrónico
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        event.preventDefault(); // Evita que se envíe el formulario
        Swal.fire({
            icon: 'error',
            title: 'Email inválido',
            text: 'Por favor, ingresa un correo electrónico válido.',
            confirmButtonText: 'Aceptar'
        });
        return;
    }

    const nombreProveedorRegex = /^[A-Za-zÁÉÍÓÚáéíóúÑñ ]+$/; // Acepta letras y espacios
    if (!nombreProveedorRegex.test(nombreProveedor)) {
        event.preventDefault(); // Evita que se envíe el formulario
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Solo se permiten letras en el campo "Nombre del Proveedor".',
            confirmButtonText: 'Aceptar'
        });
        return;
    }
});
</script>

</body>

</html>