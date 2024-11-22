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
    
    <title>Silver Heart's - Personalizados</title>
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

    <!-- FOOTER -->
    <footer class="bg-secondary text-white text-center py-4">
        <div class="container">
            <p class="mb-0">© 2024 Silver Heart's. Todos los derechos reservados.</p>
        </div>
    </footer>

    <!-- Incluir el archivo JavaScript -->
    <script src="../js/personalizado.js"></script>
</body>
</html>
