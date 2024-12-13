<?php
session_start(); // Iniciar la sesión

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("location: login.php"); // Redirigir a la página de login si no está autenticado
    exit();
}

// Incluir el archivo de conexión a la base de datos
include '../php/conexion_backend.php';

// Obtener el correo del usuario desde la sesión
$correo = $_SESSION['usuario'];

// Consultar los datos del usuario en la base de datos
$query = "SELECT nombre_completo, correo FROM usuarios WHERE correo = '$correo'";
$result = mysqli_query($conexion, $query);

// Verificar si se encontró el usuario
if (mysqli_num_rows($result) > 0) {
    $usuario = mysqli_fetch_assoc($result); // Obtener los datos del usuario
} else {
    echo "No se encontraron datos del usuario.";
    exit();
}

mysqli_close($conexion); // Cerrar la conexión a la base de datos

// Productos de los archivos de JavaScript
$anillos = json_encode([
    ["nombre" => "Anillo con corazón grabado", "precio" => 35.00],
    ["nombre" => "Anillo de oro clásico", "precio" => 150.00],
    ["nombre" => "Anillo de plata con piedras", "precio" => 80.00],
    ["nombre" => "Anillo minimalista", "precio" => 45.00],
    ["nombre" => "Anillo doble banda", "precio" => 120.00],
    ["nombre" => "Anillo personalizado", "precio" => 90.00],
    ["nombre" => "Anillo vintage", "precio" => 75.00],
    ["nombre" => "Anillo romántico", "precio" => 60.00],
]);

$cadenas = json_encode([
    ["nombre" => "Cadena de Plata", "precio" => 29.99],
    ["nombre" => "Cadena de Oro", "precio" => 49.99],
    ["nombre" => "Cadena Personalizada", "precio" => 39.99],
    ["nombre" => "Cadena de Acero Inoxidable", "precio" => 24.99],
    ["nombre" => "Cadena con Colgante de Corazón", "precio" => 34.99],
    ["nombre" => "Cadena de perlas", "precio" => 59.99],
]);

$pulseras = json_encode([
    ["nombre" => "Pulsera de Cuero", "precio" => 24.99],
    ["nombre" => "Pulsera de Plata", "precio" => 34.99],
    ["nombre" => "Pulsera Personalizada", "precio" => 44.99],
    ["nombre" => "Pulsera de Beads", "precio" => 19.99],
    ["nombre" => "Pulsera con Charm", "precio" => 29.99],
    ["nombre" => "Pulsera de Acero Inoxidable", "precio" => 39.99],
]);

$personalizados = json_encode([
    ["nombre" => "Anillo con grabado personalizado", "precio" => 40.00],
    ["nombre" => "Pulsera grabada", "precio" => 50.00],
    ["nombre" => "Cadena personalizada", "precio" => 100.00],
    ["nombre" => "Anillo doble personalizado", "precio" => 60.00],
    ["nombre" => "Pulsera con iniciales grabadas", "precio" => 45.00],
    ["nombre" => "Cadena con nombre grabado", "precio" => 120.00],
    ["nombre" => "Anillo con fecha especial", "precio" => 55.00],
    ["nombre" => "Pulsera con grabado de amor", "precio" => 70.00],
    ]);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Silver Heart's - Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/estilosAdmin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa; /* Color de fondo suave */
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Asegura que el footer esté al final */
        }
        header {
            background-color: #343a40; /* Color de encabezado */
        }
        .card {
            transition: transform 0.2s;
            cursor: pointer; /* Cambia el cursor al pasar sobre la tarjeta */
        }
        .card:hover {
            transform: scale(1.05);
        }
        .btn-lg {
            padding: 15px 30px; /* Aumentar el tamaño de los botones */
            font-size: 1.2rem; /* Aumentar el tamaño de la fuente */
        }
        footer {
            background-color: #343a40; /* Color de fondo del footer */
            color: white; /* Color del texto del footer */
            padding: 20px 0; /* Espaciado del footer */
            text-align: center; /* Centrar el texto */
            margin-top: auto; /* Empuja el footer hacia abajo */
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <header class="text-center p-3 text-white">
            <h1>Silver Heart's - Administrador</h1>
        </header>

        <div class="row justify-content-center mt-4">
            <div class="col-lg-3 col-md-4 col-sm-6 d-flex flex-column justify-content-center align-items-center">
                <div class="profile text-center">
                    <img src="../images/Profile.png" alt="Perfil" class="img-fluid rounded-circle">
                    <h2>Administrador</h2>
                </div>
            </div>
            
            <div class="col-lg-6 col-md-8 col-sm-12">
                <div class="inventory-section">
                    <h3 class="text-center">Gestión de Inventario</h3>
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="card text-center mb-4" data-bs-toggle="modal" data-bs-target="#addProductModal">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-plus"></i> Agregar Producto</h5>
                                    <p class="card-text">Haz clic aquí para agregar un nuevo producto al inventario.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-center mb-4" data-bs-toggle="modal" data-bs-target="#deleteProductModal">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-trash"></i> Eliminar Producto</h5>
                                    <p class="card-text">Haz clic aquí para eliminar un producto del inventario.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-center mb-4" data-bs-toggle="modal" data-bs-target="#modifyProductModal">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-edit"></i> Modificar Producto</h5>
                                    <p class="card-text">Haz clic aquí para modificar un producto existente.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contenido del modal Agregar Producto -->
                    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addProductModalLabel">Agregar Producto</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="addProductForm" action="../php/agregar_producto.php" method="POST">
                                        <div class="mb-3">
                                            <label for="addProductName" class="form-label">Nombre</label>
                                            <input type="text" class="form-control" id="addProductName" name="nombre" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="addProductPrice" class="form-label">Precio</label>
                                            <input type="number" class="form-control" id="addProductPrice" name="precio" required step="0.01">
                                        </div>
                                        <div class="mb-3">
                                            <label for="addProductTalla" class="form-label">Talla</label>
                                            <input type="text" class="form-control" id="addProductTalla" name="talla" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="addProductImage" class="form-label">URL de Imagen</label>
                                            <input type="text" class="form-control" id="addProductImage" name="imagen" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="addProductCategory" class="form-label">Categoría</label>
                                            <select class="form-select" id="addProductCategory" name="categoria" required>
                                                <option value="" disabled selected>Selecciona una categoría</option>
                                                <option value="anillos">Anillos</option>
                                                <option value="cadenas">Cadenas</option>
                                                <option value="pulseras">Pulseras</option>
                                                <option value="personalizados">Personalizados</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary" id="addProductButton">Agregar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal de Eliminar Producto -->
                    <div class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="deleteProductModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteProductModalLabel">Eliminar Producto</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h6 class="text-center">Lista de Productos</h6>
                                    <div class="row">
                                        <div class="col">
                                            <h6>Anillos</h6>
                                            <ul class="list-group" id="anillosList">
                                                <?php
                                                $anillosArray = json_decode($anillos, true);
                                                foreach ($anillosArray as $producto) {
                                                    echo "<li class='list-group-item'>
                                                            <input type='checkbox' class='product-checkbox' data-product-name='{$producto['nombre']}' data-product-price='{$producto['precio']}'>
                                                            {$producto['nombre']} - S/.{$producto['precio']}
                                                        </li>";
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                        <div class="col">
                                            <h6>Cadenas</h6>
                                            <ul class="list-group" id="cadenasList">
                                                <?php
                                                $cadenasArray = json_decode($cadenas, true);
                                                foreach ($cadenasArray as $producto) {
                                                    echo "<li class='list-group-item'>
                                                            <input type='checkbox' class='product-checkbox' data-product-name='{$producto['nombre']}' data-product-price='{$producto['precio']}'>
                                                            {$producto['nombre']} - S/.{$producto['precio']}
                                                        </li>";
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                        <div class="col">
                                            <h6>Pulseras</h6>
                                            <ul class="list-group" id="pulserasList">
                                                <?php
                                                $pulserasArray = json_decode($pulseras, true);
                                                foreach ($pulserasArray as $producto) {
                                                    echo "<li class='list-group-item'>
                                                            <input type='checkbox' class='product-checkbox' data-product-name='{$producto['nombre']}' data-product-price='{$producto['precio']}'>
                                                            {$producto['nombre']} - S/.{$producto['precio']}
                                                        </li>";
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                        <div class="col">
                                            <h6>Personalizados</h6>
                                            <ul class="list-group" id="personalizadosList">
                                                <?php
                                                $personalizadosArray = json_decode($personalizados, true);
                                                foreach ($personalizadosArray as $producto) {
                                                    echo "<li class='list-group-item'>
                                                            <input type='checkbox' class='product-checkbox' data-product-name='{$producto['nombre']}' data-product-price='{$producto['precio']}'>
                                                            {$producto['nombre']} - S/.{$producto['precio']}
                                                        </li>";
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <p class="mt-3">Selecciona un producto para eliminar.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" id="confirmDeleteButton">Eliminar Producto</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal de Modificar Producto -->
                    <div class="modal fade" id="modifyProductModal" tabindex="-1" aria-labelledby="modifyProductModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modifyProductModalLabel">Modificar Producto</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h6 class="text-center">Selecciona un Producto para Modificar</h6>
                                    <div class="row">
                                        <div class="col">
                                            <h6>Anillos</h6>
                                            <div id="anillosButtons">
                                                <?php
                                                $anillosArray = json_decode($anillos, true);
                                                foreach ($anillosArray as $producto) {
                                                    echo "<button class='btn btn-outline-primary m-1 modify-product-button' data-product-name='{$producto['nombre']}' data-product-price='{$producto['precio']}' data-product-category='anillos'>{$producto['nombre']}</button>";
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <h6>Cadenas</h6>
                                            <div id="cadenasButtons">
                                                <?php
                                                $cadenasArray = json_decode($cadenas, true);
                                                foreach ($cadenasArray as $producto) {
                                                    echo "<button class='btn btn-outline-primary m-1 modify-product-button' data-product-name='{$producto['nombre']}' data-product-price='{$producto['precio']}' data-product-category='cadenas'>{$producto['nombre']}</button>";
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <h6>Pulseras</h6>
                                            <div id="pulserasButtons">
                                                <?php
                                                $pulserasArray = json_decode($pulseras, true);
                                                foreach ($pulserasArray as $producto) {
                                                    echo "<button class='btn btn-outline-primary m-1 modify-product-button' data-product-name='{$producto['nombre']}' data-product-price='{$producto['precio']}' data-product-category='pulseras'>{$producto['nombre']}</button>";
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <h6>Personalizados</h6>
                                            <div id="personalizadosButtons">
                                                <?php
                                                $personalizadosArray = json_decode($personalizados, true);
                                                foreach ($personalizadosArray as $producto) {
                                                    echo "<button class='btn btn-outline-primary m-1 modify-product-button' data-product-name='{$producto['nombre']}' data-product-price='{$producto['precio']}' data-product-category='personalizados'>{$producto['nombre']}</button>";
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal para Editar Atributos del Producto -->
                    <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editProductModalLabel">Editar Producto</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="editProductForm">
                                        <div class="mb-3">
                                            <label for="editProductName" class="form-label">Nombre</label>
                                            <input type="text" class="form-control" id="editProductName" name="nombre" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="editProductPrice" class="form-label">Precio</label>
                                            <input type="number" class="form-control" id="editProductPrice" name="precio" required step="0.01">
                                        </div>
                                        <div class="mb-3">
                                            <label for="editProductCategory" class="form-label">Categoría</label>
                                            <input type="text" class="form-control" id="editProductCategory" name="categoria" readonly>
                                        </div>
                                        <button type=" submit" class="btn btn-primary" id="saveChangesButton">Guardar Cambios</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        // Manejar el clic en los botones de modificar producto
                        document.querySelectorAll('.modify-product-button').forEach(button => {
                            button.addEventListener('click', function() {
                                // Obtener los datos del producto
                                const productName = this.getAttribute('data-product-name');
                                const productPrice = this.getAttribute('data-product-price');
                                const productCategory = this.getAttribute('data-product-category');

                                // Llenar el formulario de edición con los datos del producto
                                document.getElementById('editProductName').value = productName;
                                document.getElementById('editProductPrice').value = productPrice;
                                document.getElementById('editProductCategory').value = productCategory;

                                // Mostrar el modal de edición
                                $('#editProductModal').modal('show');
                            });
                        });

                        // Manejar el envío del formulario de edición
                        document.getElementById('editProductForm').addEventListener('submit', function(event) {
                            event.preventDefault(); // Evitar el envío del formulario para mostrar el alert

                            // Aquí puedes agregar la lógica para enviar el formulario si es necesario

                            // Mostrar el alert
                            alert("Producto modificado con éxito");

                            // Cerrar el modal
                            $('#editProductModal').modal('hide');

                            // Reiniciar el formulario
                            this.reset();
                        });
                    </script>
                    <script>
                         // Manejar el envío del formulario de agregar producto
                        document.getElementById('addProductForm').addEventListener('submit', function(event) {
                        event.preventDefault(); // Evitar el envío del formulario para mostrar el alert

                        // Aquí puedes agregar la lógica para enviar el formulario si es necesario

                        // Mostrar el alert
                        alert("Producto agregado con éxito");

                        // Cerrar el modal
                        $('#addProductModal').modal('hide');

                        // Reiniciar el formulario
                        this.reset();
                    });   

                    // Manejar el clic en el botón de guardar cambios
                    document.getElementById('saveChangesButton').addEventListener('click', function() {
                        // Aquí puedes agregar la lógica para guardar los cambios en la base de datos
                        // Por ejemplo, hacer una llamada AJAX para actualizar el producto en el servidor

                        // Mostrar un mensaje de confirmación
                        alert("Los cambios han sido guardados.");

                        // Cerrar el modal de edición
                        $('#editProductModal').modal('hide');
                    });
                </script>
            </div>
        </div>
    </div>
    <!-- FOOTER -->
    <footer class="bg-dark text-white py-5">
        <div class="container">
            <div class="row text-center text-md-start">
                <!-- 1 COLUMNA -->
                <div class="col-md-4 mb-4">
                    <h3 class="text-uppercase fw-bold mb-3">Silver Heart's</h3>
                    <p class="text-white">Creando joyas personalizadas para momentos inolvidables.</p>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#sobreNosotros" class="text-white text-decoration-none">CONÓCENOS</a></li>
                        <li><a href="contactanos.php" class="text-white text-decoration-none">CONTÁCTANOS</a></li>
                    </ul>
                </div>
                <!-- 2 COLUMNA -->
                <div class="col-md-4 mb-4">
                    <h3 class="text-uppercase fw-bold mb-3">Enlaces</h3>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none">POLÍTICAS DE ENVÍO</a></li>
                        <li><a href="#" class="text-white text-decoration-none">CAMBIOS Y DEVOLUCIONES</a></li>
                    </ul>
                </div>
                <!-- 3 COLUMNA -->
                <div class="col-md-4 mb-4">
                    <h3 class="text-uppercase fw-bold">Redes Sociales</h3>
                    <ul class="list-unstyled">
                        <li class="d-flex align-items-center justify-content-center justify-content-md-start">
                            <i class="bi bi-telephone-fill me-2"></i>
                            <a href="https://wa.me/51999999999" target="_blank" class="text-white text-decoration-none">+51 999999999</a>
                        </li>
                        <li class="d-flex align-items-center justify-content-center justify-content-md-start">
                            <i class="bi bi-facebook me-2"></i>
                            <a href="https://www.facebook.com/tu-pagina" target="_blank" class="text-white text-decoration-none">Facebook</a>
                        </li>
                        <li class="d-flex align-items-center justify-content-center justify-content-md-start">
                            <i class="bi bi-instagram me-2"></i>
                            <a href="https://www.instagram.com/tu-usuario" target="_blank" class="text-white text-decoration-none">Instagram</a>
                        </li>
                    </ul>
                </div>
            </div>
            <hr class="my-4" style="border-color: rgba(255, 255, 255, 0.2);">
            <div class="text-center">
                <p class="mb-0">&copy; 2024 Silver Heart's. Todos los derechos reservados.</p>
                <p class="mb-0"><a href="#" class="text-white text-decoration-none">Política de Privacidad</a> | <a href="#" class="text-white text-decoration-none">Términos de Servicio</a></p>
            </div>
        </div>
    </footer>
                 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="../js/admin.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="../js/anillos.js"></script>
    <script src="../js/cadenas.js"></script>
    <script src="../js/pulseras.js"></script>
    <script src="../js/personalizado.js"></script>
</body>
</html>
