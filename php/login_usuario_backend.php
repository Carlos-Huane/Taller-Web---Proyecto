<?php
    //
    session_start(); //inicializar la sesion

    include 'conexion_be.php';

    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    //creamos la variable para validar el usuario
    $validar_login = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo = '$correo' AND contrasena = '$contrasena'");

    //Reedirigir a la página de inicio
    if(mysqli_num_rows($validar_login) > 0){
        $_SESSION['usuario'] = $correo;
        header("location: ../html/homepage.html");
    }else{
        echo '
            <script>
                alert("Usuario o contraseña incorrectos");
                window.location.href = "../php/login.php";
            </script>
        ';
        exit;
    }


?>