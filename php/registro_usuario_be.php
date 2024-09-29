<?php
include 'conexion_be.php';

// Verifica si el formulario se envió
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener y sanitizar los datos del formulario
    $nombre_completo = mysqli_real_escape_string($conexion, $_POST['nombre_completo']);
    $correo = mysqli_real_escape_string($conexion, $_POST['correo']);
    $usuario = mysqli_real_escape_string($conexion, $_POST['usuario']);
    $dia = mysqli_real_escape_string($conexion, $_POST['dia']);
    $mes = mysqli_real_escape_string($conexion, $_POST['mes']);
    $anio = mysqli_real_escape_string($conexion, $_POST['anio']);
    $nacimiento = $anio . '-' . $mes . '-' . $dia; // Formato YYYY-MM-DD
    $sexo = mysqli_real_escape_string($conexion, $_POST['sexo']);
    $contrasena = mysqli_real_escape_string($conexion, $_POST['contrasena']);

    // Encriptar la contraseña
    $contrasena_hash = password_hash($contrasena, PASSWORD_BCRYPT);

    // Verificar si el correo o el usuario ya existen
    $query_verificar = "SELECT * FROM usuarios WHERE correo = ? OR usuario = ?";
    $stmt = $conexion->prepare($query_verificar);
    
    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $conexion->error);
    }
    
    $stmt->bind_param("ss", $correo, $usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        
        if ($fila['correo'] === $correo) {
            echo '<script>alert("Este correo ya está registrado, intenta con otro diferente"); window.location = "../index.php";</script>';
            exit();
        }
        
        if ($fila['usuario'] === $usuario) {
            echo '<script>alert("Este usuario ya está registrado, intenta con otro diferente"); window.location = "../index.php";</script>';
            exit();
        }
    }

    // Insertar el nuevo usuario en la base de datos
    $query_insertar = "INSERT INTO usuarios (nombre_completo, correo, usuario, nacimiento, contrasena, sexo) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($query_insertar);
    
    if (!$stmt) {
        die("Error en la preparación de la consulta de inserción: " . $conexion->error);
    }

    // Bind parameters
    $stmt->bind_param("ssssss", $nombre_completo, $correo, $usuario, $nacimiento, $contrasena_hash, $sexo);

    if ($stmt->execute()) {
        echo '<script>alert("Usuario almacenado exitosamente"); window.location = "../index.php";</script>';
    } else {
        echo '<script>alert("Inténtalo de nuevo, usuario no almacenado"); window.location = "../index.php";</script>';
    }

    $stmt->close();
} else {
    header("Location: ../index.php"); // Redirigir si no se envió el formulario
}
$conexion->close();
?>

