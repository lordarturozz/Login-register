<?php
    session_start();

    if(!isset($_SESSION['usuario'])){
        echo '
            <script>
            alert("Por favor, inicia sesión");
            window.location = "../index.php";
            </script>
        ';
        session_destroy();
        die();
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenida - RareSocial</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        /* Header */
        header {
            background-color: steelblue;
            padding: 20px;
            text-align: center;
            color: white;
            font-size: 1.5rem;
        }

        /* Estructura principal */
        .main-container {
            display: flex;
            justify-content: space-between;
            padding: 20px;
        }

        /* Barra lateral izquierda: Menú */
        .sidebar {
            flex: 1;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            height: 80vh;
            position: sticky;
            top: 20px;
        }

        .sidebar ul {
            list-style-type: none;
        }

        .sidebar ul li {
            margin-bottom: 15px;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        .sidebar ul li a:hover {
            color: steelblue;
        }

        /* Sección de publicaciones */
        .posts {
            flex: 3;
            margin-right: 20px;
        }

        .post {
            background-color: #fff;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .post h2 {
            margin-bottom: 10px;
            color: steelblue;
        }

        .post p {
            color: #666;
        }

        /* Sección de mensajes */
        .messages {
            flex: 2;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .message {
            margin-bottom: 15px;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 5px;
        }

        .message strong {
            color: steelblue;
        }

        /* Preloader */
        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: steelblue;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        #preloader .spinner {
            border: 5px solid rgba(255, 255, 255, 0.3);
            border-top: 5px solid #fff;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Ocultar contenido antes de que se cargue la página */
        .main-container {
            display: none;
        }
    </style>
</head>
<body>

    <!-- Preloader -->
    <div id="preloader">
        <div class="spinner"></div>
    </div>

    <!-- Header -->
    <header>
        Bienvenido a RareSocial
    </header>

    <!-- Estructura principal -->
    <div class="main-container">
        <!-- Menú lateral -->
        <div class="sidebar">
            <ul>
                <li><a href="#">Inicio</a></li>
                <li><a href="#">Perfil</a></li>
                <li><a href="#">Mensajes</a></li>
                <li><a href="#">Amigos</a></li>
                <li><a href="php/cerrar_sesion.php">Cerrar sesión</a></li>
            </ul>
        </div>

        <!-- Publicaciones -->
        <div class="posts">
            <div class="post">
                <h2>Publicación de ejemplo</h2>
                <p>Este es el contenido de una publicación. Puedes añadir más contenido aquí para simular el feed de publicaciones.</p>
            </div>
            <div class="post">
                <h2>Otra publicación</h2>
                <p>Este es otro ejemplo de una publicación en la red social. Añade imágenes, videos o enlaces para hacerlo más interactivo.</p>
            </div>
        </div>

        <!-- Mensajes -->
        <div class="messages">
            <div class="message">
                <strong>Usuario1:</strong> ¡Hola! ¿Cómo estás?
            </div>
            <div class="message">
                <strong>Usuario2:</strong> Todo bien, ¿y tú? 
            </div>
            <div class="message">
                <strong>Usuario1:</strong> Aquí, probando esta nueva red social.
            </div>
        </div>
    </div>

    <script>
        // Ocultar el preloader y mostrar el contenido cuando la página esté completamente cargada
        window.addEventListener("load", function() {
            document.getElementById("preloader").style.display = "none";
            document.querySelector(".main-container").style.display = "flex";
        });
    </script>
</body>
</html>
