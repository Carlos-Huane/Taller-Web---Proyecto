<?php

    include 'conexion_backend.php'; //incluimos el archivo para tener acceso a la conexion a la bd

    $nombre_completo = $_POST['nombre_completo'];
    $correo = $_POST['correo'];
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // Creamos una query para almacenar los datos en la tabla usuarios
    $query = "INSERT INTO usuarios(nombre_completo, correo, usuario, contrasena) 
              VALUES ('$nombre_completo', '$correo', '$usuario', '$contrasena') ";
    
    $ejecutar = mysqli_query($conexion, $query);

    if($ejecutar){
        echo '
            <script>
                alert("Usuario almacenado exitosamente");
                window.location= "../index.php";
            </script>
        ';
    }else{
        echo '
            <script>
                alert("Inténtenlo de nuevo, hubo un error");
                window.location= "../index.php";
            </script>
        ';
    }

    mysqli_close($conexion);
?>