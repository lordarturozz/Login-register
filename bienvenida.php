<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    echo '
        <script>
        alert("Por favor, inicia sesión");
        window.location = "../login-register/index.php";
        </script>
    ';
    session_destroy();
    die();
}

// Conectar con la base de datos
$mysqli = new mysqli("localhost", "root", "", "login_register_db");

if ($mysqli->connect_error) {
    die("Conexión fallida: " . $mysqli->connect_error);
}

// Obtener el correo del usuario desde la sesión
$correo = $_SESSION['usuario'];

// Obtener el nombre y el ID del usuario
$sql = "SELECT id, nombre_completo FROM usuarios WHERE correo=?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $correo);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();
$nombreCompleto = $usuario['nombre_completo'];
$usuarioId = $usuario['id'];
$stmt->close();

// Manejo de comentarios
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['comentario'])) {
    $comentario = $mysqli->real_escape_string($_POST['comentario']);

    // Insertar el comentario en la base de datos
    $sql = "INSERT INTO comentarios (usuario_id, comentario) VALUES (?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("is", $usuarioId, $comentario);
    $stmt->execute();
    $stmt->close();
}

// Obtener comentarios
$sql = "SELECT c.comentario, u.nombre_completo FROM comentarios c JOIN usuarios u ON c.usuario_id = u.id";
$resultadoComentarios = $mysqli->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comentarios</title>
</head>
<body>
    <!-- Caja de comentarios -->
    <div class="comments-section">
        <h3>Deja un comentario</h3>
        <form action="" method="POST">
            <textarea name="comentario" placeholder="Escribe un comentario..." required></textarea>
            <button type="submit">Comentar</button>
        </form>

        <h3>Comentarios</h3>
        <div class="comentarios">
            <?php while ($comentario = $resultadoComentarios->fetch_assoc()): ?>
                <div class="comentario">
                    <h4><?php echo htmlspecialchars($comentario['nombre_completo'], ENT_QUOTES, 'UTF-8'); ?></h4>
                    <p><?php echo htmlspecialchars($comentario['comentario'], ENT_QUOTES, 'UTF-8'); ?></p>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>
