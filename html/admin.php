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
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Silver Heart's - Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/estilosAdmin.css">
</head>
<body>

    <div class="container-fluid">
        <header class="text-center p-3 bg-secondary text-white">
            <h1>Silver heart's - Administrador</h1>
        </header>

        <div class="row justify-content-center mt-4">
            <div class="col-lg-3 col-md-4 col-sm-6 d-flex flex-column justify-content-center align-items-center">
                <div class="profile">
                    <!-- Imagenes que se mostrarán según el tamaño de pantalla profile d-flex flex-column justify-content-center align-items-center-->
                    <!-- Para pantallas grandes (mayores a 940px) -->
                    <img src="" class="img-fluid rounded-circle d-none d-lg-block " alt="Imagen de Chris calato" width="300">
                    
                    <!-- Para pantallas medianas (entre 940px y 780px) -->
                    <img src="" class="img-fluid rounded-circle d-none d-md-block d-lg-none" alt="Imagen de Chris calato" width="150">
                    
                    <!-- Para pantallas pequeñas (menores a 780px) -->
                    <img src="" class="img-fluid rounded-circle d-block d-md-none" alt="Imagen de Chris calato" width="150">

                    <h2>Administrador Christopher</h2>
                </div>
            </div>
            
            <div class="col-lg-6 col-md-8 col-sm-12">
                <div class="inventory-section">
                    <h3 class="text-center">Gestión de inventario</h3>
                    <div class="row inventory-item mb-3">
                        <div class="row inventory-item mb-3">
                            <div class="row inventory-item mb-3 align-items-center">
                                <div class="col-md-6 d-flex justify-content-center">Anillos</div>
                                <div class="col-md-3">
                                    <img src="../images/ring-image.jpg" class="img-fluid" alt="Anillos">
                                </div>
                                <div class="col-md-3 d-flex flex-column align-items-end">
                                    <!-- Botón Agregar -->
                                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#addProductModal">Agregar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row inventory-item mb-3">
                        <div class="row inventory-item mb-3">
                            <div class="row inventory-item mb-3 align-items-center">
                                <div class="col-md-6 d-flex justify-content-center">Pulseras</div>
                                <div class="col-md-3">
                                    <img src="../images/bracelet-img.jpg" class="img-fluid" alt="Pulseras">
                                </div>
                                <div class="col-md-3 d-flex flex-column align-items-end">
                                    <button class="btn btn-danger btn-sm mb-2">Eliminar</button>
                                    <button class="btn btn-warning btn-sm mb-2">Actualizar</button>
                                    <button class="btn btn-info btn-sm">Modificar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row inventory-item mb-3">
                        <div class="row inventory-item mb-3">
                            <div class="row inventory-item mb-3 align-items-center">
                                <div class="col-md-6 d-flex justify-content-center">Cadenas</div>
                                <div class="col-md-3">
                                    <img src="../images/chain-image.jpg" class="img-fluid" alt="Cadenas">
                                </div>
                                <div class="col-md-3 d-flex flex-column align-items-end">
                                    <button class="btn btn-danger btn-sm mb-2">Eliminar</button>
                                    <button class="btn btn-warning btn-sm mb-2">Actualizar</button>
                                    <button class="btn btn-info btn-sm">Modificar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row inventory-item mb-3">
                        <div class="row inventory-item mb-3">
                            <div class="row inventory-item mb-3 align-items-center">
                                <div class="col-md-6 d-flex justify-content-center">Personalizados</div>
                                <div class="col-md-3">
                                    <img src="../images/custom-image.jpg" class="img-fluid" alt="Personalizados">
                                </div>
                                <div class="col-md-3 d-flex flex-column align-items-end">
                                    <button class="btn btn-danger btn-sm mb-2">Eliminar</button>
                                    <button class="btn btn-warning btn-sm mb-2">Actualizar</button>
                                    <button class="btn btn-info btn-sm">Modificar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="text-center mt-4">
            <p>© 2024 Silver heart's. Todos los derechos reservados.</p>
        </footer>
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
                                    <option value="anillos">Anillos</option>
                                    <option value="cadenas">Cadenas</option>
                                    <option value="personalizado">Personalizado</option>
                                    <option value="pulseras">Pulseras</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Agregar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/admin.js"></script>
    <script src="../agregar_producto.php"> 
</body>
</html>
