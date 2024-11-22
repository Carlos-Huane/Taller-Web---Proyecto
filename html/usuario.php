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
        <title>Perfil de Usuario - Silver Heart's</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <header class="bg-light border-bottom border-secondary shadow-sm">
            <div class="container py-3 d-flex justify-content-between align-items-center">
                <div class="flex-grow-1 text-center">
                    <a href="homepage.php" class="text-decoration-none">
                        <h2 class="text-secondary fw-bold fs-1 m-0">Silver Heart's</h2>
                    </a>
                </div>
                <div>
                    <a href="../php/cerrar_sesion.php" class="btn btn-outline-danger">Cerrar sesión</a>
                </div>
            </div>
        </header>

        <main class="container my-5">
            <h3 class="text-center mb-4">Perfil de Usuario</h3>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Información Personal</h5>
                    <p><strong>Nombre:</strong> <?php echo htmlspecialchars($usuario['nombre_completo']); ?></p>
                    <p><strong>Correo:</strong> <?php echo htmlspecialchars($usuario['correo']); ?></p>
                    <p><strong>Contraseña:</strong> ****</p>
                    <h5 class="mt-4">Historial de Compras</h5>
                    <ul id="historialCompras">
                        <!-- Aquí se pueden listar las compras del usuario -->
                    </ul>
                </div>
            </div>
        </main>

        <footer class="bg-dark text-white text-center py-4">
            <div class="container">
                <p class="mb-0">© 2024 Silver Heart's. Todos los derechos reservados.</p>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>