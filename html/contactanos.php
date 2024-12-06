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
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mb-4">CONTÁCTANOS</h2>
                <form id="contactForm">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="name" placeholder="Ingresa tu nombre">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" placeholder="Ingresa tu correo">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Número de teléfono</label>
                        <input type="tel" class="form-control" id="phone" placeholder="Ingresa tu número de teléfono">
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Mensaje</label>
                        <textarea class="form-control" id="message" rows="5" placeholder="Escribe tu mensaje"></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-dark">ENVIAR</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- MODAL -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Mensaje Enviado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Tu mensaje ha sido enviado correctamente.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    

    <!-- FOOTER -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row text-center text-md-start">
                <!-- 1 COLUMNA -->
                <div class="col-md-4 mb-3">
                    <h3>Silver Heart's</h3>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">CONÓCENOS</a></li>
                        <li><a href="#" class="text-white">CONTÁCTANOS</a></li>
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
                            <i class="bi bi-telephone-fill me-2"></i> +51 999999999
                        </li>
                        <li class="d-flex align-items-center justify-content-center justify-content-md-start">
                            <i class="bi bi-facebook me-2"></i> Facebook
                        </li>
                        <li class="d-flex align-items-center justify-content-center justify-content-md-start">
                            <i class="bi bi-instagram me-2"></i> Instagram
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Función que se ejecuta cuando el formulario es enviado
        document.getElementById('contactForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Evitar que se recargue la página

            // Mostrar el modal de éxito
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();

            // Aquí puedes agregar lógica para enviar los datos del formulario si es necesario
        });
    </script>
    <script>
    document.getElementById('contactForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Evitar que se recargue la página

        // Obtener los valores del formulario
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const phone = document.getElementById('phone').value;
        const message = document.getElementById('message').value;

        // Crear el contenido del correo
        const subject = `Contacto de ${name}`;
        const body = `
            Nombre: ${name}
            Correo Electrónico: ${email}
            Teléfono: ${phone}
            
            Mensaje:
            ${message}
        `;

        // Generar el enlace mailto
        const mailtoLink = `mailto:silverhearts@gmail.com?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;

        // Abrir Gmail con el enlace generado
        window.location.href = mailtoLink;
    });
</script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
