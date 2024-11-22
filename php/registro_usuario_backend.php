<?php
    include 'conexion_backend.php'; //incluimos el archivo para tener acceso a la conexion a la bd

    $nombre_completo = $_POST['nombre_completo'];
    $correo = $_POST['correo'];
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    $contrasena = hash('sha512', $contrasena); //encriptamos la contraseña para seguridad
    
    // Creamos una query para almacenar los datos en la tabla usuarios
    $query = "INSERT INTO usuarios(nombre_completo, correo, usuario, contrasena) 
              VALUES ('$nombre_completo', '$correo', '$usuario', '$contrasena') ";

    //Verificar que el correo no se repita en la base de datos
    $verificar_correo = mysqli_query($conexion,"SELECT * FROM usuarios WHERE correo = '$correo'");
    
    //Si esta variable una fila que coincida con el correo ingresado me dará error y no se guardará
    if(mysqli_num_rows($verificar_correo) > 0){
        echo '
            <script>
                alert("El correo ya se encuentra registrado, por favor ingrese otro correo");
                window.location ="../html/login.php";
            </script>
        ';
        exit();
    }
    
    //Verificar que el usuario no se repita en la base de datos
    $verificar_usuario = mysqli_query($conexion,"SELECT * FROM usuarios WHERE usuario = '$usuario'");
    
    //Si esta variable una fila que coincida con el correo ingresado me dará error y no se guardará
    if(mysqli_num_rows($verificar_usuario) > 0){
        echo '
            <script>
                alert("El usuario ya se encuentra registrado, por favor ingrese otro usuario");
                window.location.href="../html/login.php";
            </script>
        ';
        exit();
    }
    

    $ejecutar = mysqli_query($conexion, $query);

    if($ejecutar){
        echo '
            <script>
                alert("Usuario almacenado exitosamente");
                window.location= "../html/login.php";
            </script>
        ';
    }else{
        echo '
            <script>
                alert("Inténtenlo de nuevo, hubo un error");
                window.location= "../html/login.php";
            </script>
        ';
    }

    mysqli_close($conexion);
?>