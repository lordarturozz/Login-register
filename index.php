<?php
    session_start();

    if(isset($_SESSION['usuario'])){
        header("location: ../login-register/bienvenida.php");
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RareSocial</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>

    <main>
        <div class="contenedor__todo">
            <div class="caja__trasera">
                <div class="caja__trasera-login">
                    <h3>¿Ya tienes una cuenta?</h3>
                    <p>Inicia sesión para entrar en la página</p>
                    <button id="btn__iniciar-sesion">Iniciar Sesión</button>
                </div>
                <div class="caja__trasera-register">
                    <h3>¿Aún no tienes una cuenta?</h3>
                    <p>Regístrate para que puedas iniciar sesión</p>
                    <button id="btn__registrarse">Registrarse</button>
                </div>
            </div>

            <!--Formulario de Login y Registro-->
            <div class="contenedor__login-register">
                <!--Login-->
                <form action="php/login_usuario_be.php" method="POST" class="formulario__login">
                    <h2>Iniciar Sesión</h2>
                    <input type="text" placeholder="Correo Electrónico" name="correo" required>
                    <input type="password" placeholder="Contraseña" name="contrasena" required>
                    <button>Entrar</button>
                </form>

                <!--Register-->
                <form action="php/registro_usuario_be.php" method="POST" class="formulario__register">
                    <h2>Registrarse</h2>
                    
                    <input type="text" placeholder="Nombre completo" name="nombre_completo" required>
                    <input type="email" placeholder="Correo Electrónico" name="correo" required>
                    <input type="text" placeholder="Usuario" name="usuario" required>

                    <!-- Fecha de nacimiento segmentada -->
                    <label for="nacimiento">Fecha de nacimiento:</label>
                    <div class="fecha-nacimiento">
                        <select name="dia" required>
                            <option value="">Día</option>
                            <!-- Opciones de 1 a 31 -->
                            <?php for($i=1; $i<=31; $i++) { echo "<option value='$i'>$i</option>"; } ?>
                        </select>

                        <select name="mes" required>
                            <option value="">Mes</option>
                            <option value="01">Enero</option>
                            <option value="02">Febrero</option>
                            <option value="03">Marzo</option>
                            <option value="04">Abril</option>
                            <option value="05">Mayo</option>
                            <option value="06">Junio</option>
                            <option value="07">Julio</option>
                            <option value="08">Agosto</option>
                            <option value="09">Septiembre</option>
                            <option value="10">Octubre</option>
                            <option value="11">Noviembre</option>
                            <option value="12">Diciembre</option>
                        </select>

                        <select name="anio" required>
                            <option value="">Año</option>
                            <!-- Opciones de año -->
                            <?php 
                                $year = date("Y");
                                for($i=$year; $i>=1900; $i--) { 
                                    echo "<option value='$i'>$i</option>"; 
                                } 
                            ?>
                        </select>
                    </div>

                    <!-- Género -->
                    <div class="sexo">
                        <label>Género:</label><br>
                        <input type="radio" id="masculino" name="sexo" value="masculino" required>
                        <label for="masculino">Masculino</label>
                        
                        <input type="radio" id="femenino" name="sexo" value="femenino" required>
                        <label for="femenino">Femenino</label>
                        
                        <input type="radio" id="otro" name="sexo" value="otro" required>
                        <label for="otro">Otro</label>
                    </div>
                    
                    <input type="password" placeholder="Contraseña" name="contrasena" required>
                    
                    <button type="submit">Registrarse</button>
                </form>
            </div>
        </div>
    </main>

    <script src="assets/js/script.js"></script>
</body>
</html>