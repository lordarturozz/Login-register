<?php
session_start();
include 'conexion_be.php'; // Asegúrate de que este archivo se incluya correctamente

// Verifica si el formulario se envió
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener y sanitizar datos del formulario
    $correo = mysqli_real_escape_string($conexion, $_POST['correo']);
    $contrasena = mysqli_real_escape_string($conexion, $_POST['contrasena']);

    // Consulta para verificar el usuario
    $query = "SELECT * FROM usuarios WHERE correo = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Verificar si el usuario existe
    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();
        
        // Verificar la contraseña
        if (password_verify($contrasena, $usuario['contrasena'])) {
            // Almacenar el correo en la sesión
            $_SESSION['usuario'] = $usuario['correo']; // Cambiar a $_SESSION['usuario'] = $usuario['usuario']; si prefieres guardar el nombre de usuario
            header("Location: ../bienvenida.php");
            exit();
        } else {
            echo '
            <script>
            alert("Contraseña incorrecta. Por favor, verifique los datos introducidos.");
            window.location = "../index.php";
            </script>
            ';
            exit();
        }
    } else {
        echo '
        <script>
        alert("Usuario no existe. Por favor, verifique los datos introducidos.");
        window.location = "../index.php";
        </script>
        ';
        exit();
    }

    $stmt->close();
} else {
    header("Location: ../index.php"); // Redirigir si no se envió el formulario
}
$conexion->close();
?>
