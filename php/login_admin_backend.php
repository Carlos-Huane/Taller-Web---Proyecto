<?php
session_start(); // Iniciar la sesión

include 'conexion_backend.php'; // Incluir el archivo de conexión a la base de datos

// Obtener los datos enviados por el formulario
$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];
$contrasena = hash('sha512', $contrasena); // Encriptar la contraseña

// Crear una consulta para validar el usuario
$validar_login = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo = '$correo' AND contrasena = '$contrasena'");

// Verificar si se encontró un usuario
if (mysqli_num_rows($validar_login) > 0) {
    // Si el usuario existe, iniciar sesión
    $_SESSION['usuario'] = $correo; // Guardar el correo en la sesión
    header("location: ../html/homepage.php"); // Redirigir a la página de inicio
} else {
    // Verificar credenciales predefinidas
    if ($correo === 'adminisitrador@gmail.com' && $contrasena === hash('sha512', '1234')) {
        $_SESSION['usuario'] = $correo; // Guardar el correo en la sesión
        header("location: ../html/homepage.php"); // Redirigir a la página de inicio
    } else {
        // Si no se encuentra el usuario, mostrar un mensaje de error
        echo '
            <script>
                alert("Usuario o contraseña incorrectos");
                window.location.href = "../html/login.php"; // Redirigir al formulario de inicio de sesión
            </script>
        ';
        exit;
    }
}

mysqli_close($conexion); // Cerrar la conexión a la base de datos
?>