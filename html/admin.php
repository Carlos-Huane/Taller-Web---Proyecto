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
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Silver Heart's - Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/estilosAdmin.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container-fluid">
        <header class="text-center p-3 bg-secondary text-white">
            <h1>Silver Heart's - Administrador</h1>
        </header>

        <div class="row justify-content-center mt-4">
            <div class="col-lg-3 col-md-4 col-sm-6 d-flex flex-column justify-content-center align-items-center">
                <div class="profile">
                    <h2>Administrador</h2>
                </div>
            </div>
            
            <div class="col-lg-6 col-md-8 col-sm-12">
                <div class="inventory-section">
                    <h3 class=" text-center">Gestión de inventario</h3>
                    <div class="text-center mb-4">
                        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addProductModal">Agregar Producto</button>
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteProductModal">Eliminar Producto</button>
                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modifyProductModal">Modificar Producto</button>
                    </div>

                    <!-- Modal de Agregar Producto -->
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
                                                <option value="ropa">Ropa</option ```php
                                                <option value="accesorios">Accesorios</option>
                                                <option value="calzado">Calzado</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Agregar</button>
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
                                    <h6>Lista de Productos</h6>
                                    <ul class="list-group" id="productList">
                                        <?php
                                        // Decodificar los arreglos de productos y mostrarlos en la lista
                                        $productos = array_merge(json_decode($anillos, true), json_decode($cadenas, true), json_decode($pulseras, true));
                                        foreach ($productos as $index => $producto) {
                                            echo "<li class='list-group-item'>
                                                    <input type='checkbox' class='product-checkbox' data-product-name='{$producto['nombre']}' data-product-price='{$producto['precio']}'>
                                                    {$producto['nombre']} - \${$producto['precio']}
                                                </li>";
                                        }
                                        ?>
                                    </ul>
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
                                    <h6>Lista de Productos</h6>
                                    <ul class="list-group" id="productListToModify">
                                        <?php
                                        // Decodificar los arreglos de productos y mostrarlos en la lista
                                        $productos = array_merge(json_decode($anillos, true), json_decode($cadenas, true), json_decode($pulseras, true));
                                        foreach ($productos as $index => $producto) {
                                            $nombre = isset($producto['nombre']) ? $producto['nombre'] : 'Nombre no disponible';
                                            $precio = isset($producto['precio']) ? $producto['precio'] : 'Precio no disponible';
                                            $talla = isset($producto['talla']) ? $producto['talla'] : 'Talla no disponible'; // En caso los productos tengan 'talla'
                                            $imagen = isset($producto['imagen']) ? $producto['imagen'] : 'URL de imagen no disponible';

                                            echo "<li class='list-group-item' data-product-name='{$nombre}' data-product-price='{$precio}' data-product-talla='{$talla}' data-product-imagen='{$imagen}'>
                                                    <button class='btn btn-link modify-product-button'>{$nombre}</button>
                                                </li>";
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal de Edición de Producto -->
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
                                            <label for="editProductTalla" class="form-label">Talla</label>
                                            <input type="text" class="form-control" id="editProductTalla" name="talla" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="editProductImage" class="form-label">URL de Imagen</label>
                                            <input type="text" class="form-control" id="editProductImage" name="imagen" required>
                                        </div>
                                        <button type="button" class="btn btn-primary" id="saveChangesButton">Guardar Cambios</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                    // Manejar el clic en el botón de modificar producto
                    document.querySelectorAll('.modify-product-button').forEach(button => {
                        button.addEventListener('click', function() {
                            const productName = this.parentElement.getAttribute('data-product-name');
                            const productPrice = this.parentElement.getAttribute('data-product-price');
                            const productTalla = this.parentElement.getAttribute('data-product-talla');
                            const productImage = this.parentElement.getAttribute('data-product-imagen');

                            // Cargar la información del producto en el formulario de edición
                            document.getElementById('editProductName').value = productName;
                            document.getElementById('editProductPrice').value = productPrice;
                            document.getElementById('editProductTalla').value = productTalla;
                            document.getElementById('editProductImage').value = productImage;

                            // Mostrar el modal de edición
                            $('#editProductModal').modal('show');
                        });
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/admin.js"></script>
    <script src="../agregar_producto.php"> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="../js/anillos.js"></script>
    <script src="../js/cadenas.js"></script>
    <script src="../js/pulseras.js"></script>
    <script src="../js/personalizado.js"></script>
</body>
</html>
