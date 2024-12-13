<?php
    session_start();
    $isLoggedIn = isset($_SESSION['usuario']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- BOOTSTRAP ICONS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css">
    <!-- BOOTSTRAP JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <title>Silver Heart's</title>
</head>
<body>
    <!-- HEADER -->
    <header class="bg-light border-bottom border-secondary shadow-sm">
        <div class="container py-3">
            <div class="d-flex justify-content-between align-items-center">
                <!-- Título centrado -->
                <div class="flex-grow-1 text-center">
                    <a href="homepage.php" class="text-decoration-none">
                        <h2 class="text-secondary fw-bold fs-1 m-0">Silver Heart's</h2>
                    </a>
                </div>
                <!-- Iconos de usuario y login -->
                <div class="d-flex align-items-center">
                    <?php if ($isLoggedIn): ?>
                        <a href="usuario.php" class="btn btn-outline-secondary me-3 d-flex align-items-center">
                            <i class="bi bi-person me-2"></i> Usuario
                        </a>
                        <a href="../php/cerrar_sesion.php" class="btn btn-outline-secondary d-flex align-items-center">
                            <i class="bi bi-box-arrow-right me-2"></i> Cerrar sesión
                        </a>
                    <?php else: ?>
                        <a href="login.php" class="btn btn-outline-secondary me-3 d-flex align-items-center">
                            <i class="bi bi-person me-2"></i> Login
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!-- Navegación -->
        <nav class="bg-light py-2">
            <div class="container d-flex justify-content-center">
                <a href="homepage.php" class="nav-link text-secondary mx-3 fs-5">Inicio</a>
                <a href="anillos.php" class="nav-link text-secondary mx-3 fs-5">Anillos</a>
                <a href="cadenas.php" class="nav-link text-secondary mx-3 fs-5">Cadenas</a>
                <a href="pulseras.php" class="nav-link text-secondary mx-3 fs-5">Pulseras</a>
                <a href="personalizado.php" class="nav-link text-secondary mx-3 fs-5">Personalizados</a>
                <a href="contactanos.php" class="nav-link text-secondary mx-3 fs-5">Contáctanos</a>
            </div>
        </nav>
    </header>

    <!-- MAIN SECTION -->
    <main class="container mt-4">
        <div class="d-flex">
            <!-- Botón desplegable de orden -->
            <div class="dropdown">
                <button class="btn btn-light dropdown-toggle" type="button" id="ordenarDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    Ordenar
                </button>
                <ul class="dropdown-menu" aria-labelledby="ordenarDropdown">
                    <li><a class="dropdown-item" href="#">Fecha, nuevo a antiguo</a></li>
                    <li><a class="dropdown-item" href="#">Fecha, antiguo a nuevo</a></li>
                    <li><a class="dropdown-item" href="#">Precio, menor a mayor</a></li>
                    <li><a class="dropdown-item" href="#">Precio, mayor a menor</a></li>
                    <li><a class="dropdown-item" href="#">Alfabéticamente, A-Z</a></li>
                    <li><a class="dropdown-item" href="#">Alfabéticamente, Z-A</a></li>
                </ul>
            </div>
        </div>
        <!-- Tarjetas de productos -->
        <div class="row mt-3" id="cardsContainer"></div>
    </main>
    <!-- Modal -->
    <div class="modal fade" id="purchaseModal" tabindex="-1" aria-labelledby="purchaseModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="purchaseModalLabel">Detalles de la Compra</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img id="modalImage" src="" alt="Imagen del producto" class="img-fluid">
                        </div>
                        <div class="col-md-6">
                            <h5 id="modalName"></h5>
                            <p id="modalPrice"></p>
                            <p id="modalTalla"></p>
                            <p>Cantidad: <span id="modalQuantity"></span></p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h6>Dirección de envío</h6>
                        <textarea class="form-control" id="address" rows="3" placeholder="Ingresa tu dirección"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="confirmPurchaseButton">Confirmar Compra</button>
                </div>
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

    <!-- Incluir el archivo JavaScript -->
    <script src="../js/anillos.js"></script>
    
</body>
</html>
