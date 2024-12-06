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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- BOOTSTRAP ICONS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css">
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
    <section class="container my-5">
        <div class="row align-items-center">
            <!-- Texto descriptivo -->
            <div class="col-md-6 text-center text-md-start py-4">
                <h2 class="fw-bold mb-4 text-secondary">Conecta con tu pareja a través de detalles únicos</h2>
                <p class="mb-5 text-muted">Pulseras y collares personalizados para momentos inolvidables, creados con amor y dedicación.</p>
                <div>
                    <button class="btn btn-secondary text-white mb-3 px-4 py-2" ><a href="#sobreNosotros" style="color: white; text-decoration: none;">Descubre la colección</a></button>
                    <button class="btn btn-outline-secondary mx-3 mb-3 px-4 py-2"><a href="./personalizado.php" style="color: gray; text-decoration: none;">Personaliza ahora</a></button>
                </div>
            </div>
            <!-- Imagen alineada a la derecha con tamaño reducido -->
            <div class="col-md-6 text-center">
                <img src="../images/probando.webp" 
                     alt="Imagen de pulseras y collares" 
                     class="img-fluid rounded shadow-sm w-75">
            </div>
        </div>
    </section>
    

   
    <!-- PRODUCT CATALOG -->
<div class="container-fluid my-5 bg-dark text-white py-5">
    <div class="container">
        <h3 class="text-center fw-bold text-secondary mb-5">Catálogo de Productos</h3>
        <div class="row g-4">
            <!-- Pulseras Personalizadas -->
            <div class="col-md-4">
                <div class="card bg-light text-dark border-0 shadow-sm">
                    <img src="../images/anillosPersonalizables.webp" alt="Pulseras Personalizadas" class="card-img-top rounded">
                    <div class="card-body text-center">
                        <h4 class="fw-bold text-secondary">Anillos Personalizadas</h4>
                        <p class="text-muted">Encuentra el diseño perfecto para ti y tu pareja.</p>
                    </div>
                </div>
            </div>
            <!-- Collares Únicos -->
            <div class="col-md-4">
                <div class="card bg-light text-dark border-0 shadow-sm">
                    <img src="../images/collaresUnicos.webp" alt="Collares Únicos" class="card-img-top rounded">
                    <div class="card-body text-center">
                        <h4 class="fw-bold text-secondary">Collares Únicos</h4>
                        <p class="text-muted">Cada collar es una obra de arte, hecho a la medida.</p>
                    </div>
                </div>
            </div>
            <!-- Accesorios Especiales -->
            <div class="col-md-4">
                <div class="card bg-light text-dark border-0 shadow-sm">
                    <img src="../images/accesoriosEspeciales.webp" alt="Accesorios Especiales" class="card-img-top rounded">
                    <div class="card-body text-center">
                        <h4 class="fw-bold text-secondary">Accesorios Especiales</h4>
                        <p class="text-muted">Detalles únicos para complementar tu estilo.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    <!-- DESIGN SECTION -->
    <div class="container my-5">
        <h3 class="text-center mb-5">Diseño Romántico y Elegante</h3>
        <div class="row">
            <!-- 1 COLUMNA -->
            <div class="col-md-4 d-flex align-items-start">
                <div class="bg-dark text-white d-flex justify-content-center align-items-center p-3 me-3">
                    <h3 class="mb-0">1</h3>
                </div>
                <div>
                    <h4>Elegancia Atemporal</h4>
                    <p>Nuestras joyas combinan diseños clásicos con toques modernos.</p>
                    <img src="../images/eleganciaAtemporal.webp" alt="Elegancia Atemporal" class="img-fluid">
                </div>
            </div>

            <!-- 2 COLUMNA -->
            <div class="col-md-4 d-flex align-items-start">
                <div class="bg-dark text-white d-flex justify-content-center align-items-center p-3 me-3">
                    <h3 class="mb-0">2</h3>
                </div>
                <div>
                    <h4>Detalles Refinados</h4>
                    <p>Cada pieza está cuidadosamente elaborada con materiales de alta calidad.</p>
                    <img src="../images/detallesRefinados.webp" alt="Detalles Refinados" class="img-fluid">
                </div>
            </div>

            <!-- 3 COLUMNA -->
            <div class="col-md-4 d-flex align-items-start">
                <div class="bg-dark text-white d-flex justify-content-center align-items-center p-3 me-3">
                    <h3 class="mb-0">3</h3>
                </div>
                <div>
                    <h4>Inspiración Romántica</h4>
                    <p>Nuestras creaciones reflejan el amor y la conexión entre parejas.</p>
                    <img src="../images/inspiracionRomantica.webp" alt="Inspiración Romántica" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <!-- ABOUT US -->
    <section class="about-us bg-light py-5" id="sobreNosotros">
        <div class="container">
            <h2 class="text-center mb-4">Sobre Nosotros</h2>
            <div class="row align-items-center">
                <!-- Texto -->
                <div class="col-md-6 mb-3 mb-md-0">
                    <p>Proin at scelerisque libero, vitae sagittis felis. Mauris gravida dolor vitae finibus bibendum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam bibendum faucibus nibh ullamcorper ultricies. Duis sit amet massa sed dui dignissim sollicitudin. Mauris euismod, massa vitae fermentum semper, ante turpis iaculis orci, ut ultrices libero quam ac est. Sed et dignissim tellus. Cras dapibus, nulla et finibus dictum, elit elit facilisis magna, sed iaculis urna lacus ut mauris. Nunc mattis porttitor sagittis. Proin porttitor efficitur turpis. Suspendisse non ultricies nibh. Etiam volutpat fermentum tortor accumsan consequat. Quisque commodo lacus et neque finibus pharetra. Praesent dignissim feugiat sem, sed semper ante accumsan at.</p>
                </div>
                <!-- Imagen -->
                <div class="col-md-6 text-center">
                    <img src="../images/sobreNosotros.webp" alt="Grupo de personas trabajando" class="img-fluid rounded w-75">
                </div>
            </div>
        </div>
    </section>


    <!-- FOOTER -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row text-center text-md-start">
                <!-- 1 COLUMNA -->
                <div class="col-md-4 mb-3">
                    <h3>Silver Heart's</h3>
                    <ul class="list-unstyled">
                        <li><a href="#sobreNosotros" class="text-white">CONÓCENOS</a></li>
                        <li><a href="contactanos.php" class="text-white">CONTÁCTANOS</a></li>
                    </ul>
                </div>
                <!-- 2 COLUMNA -->
                <div class="col-md-4 mb-3">
                    <h3>ENLACES</h3>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">POLÍTICAS DE ENVÍO</a></li>
                        <li><a href="#" class="text-white">CAMBIOS Y DEVOLUCIONES</a></li>
                    </ul>
                </div>
                <!-- 3 COLUMNA -->
                <div class="col-md-4 mb-3">
                    <h3>REDES SOCIALES</h3>
                    <ul class="list-unstyled">
                        <li class="d-flex align-items-center justify-content-center justify-content-md-start">
                            <i class="bi bi-telephone-fill me-2"></i>
                            <a href="https://wa.me/51999999999" target="_blank" class="text-white">+51 999999999</a>
                        </li>
                        <li class="d-flex align-items-center justify-content-center justify-content-md-start">
                            <i class="bi bi-facebook me-2"></i>
                            <a href="https://www.facebook.com/tu-pagina" target="_blank" class="text-white">Facebook</a>
                        </li>
                        <li class="d-flex align-items-center justify-content-center justify-content-md-start">
                            <i class="bi bi-instagram me-2"></i>
                            <a href="https://www.instagram.com/tu-usuario" target="_blank" class="text-white">Instagram</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
