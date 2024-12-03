<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      text-align: center;
      background: #ffffff; /* Gradiente suave */
    }
    h1 {
      font-size: 2.5em;
      color: #4CAF50;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
    }
    h2 {
      font-size: 2em;
      color: #4CAF50;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
    }

    p {
      font-size: 1.2em;
      color: #333;
    }
  
  /* Estilos para la barra de navegación */
    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 20px;
      background-color:#ffffff;
      color: white;
    }
    .navbar .links a {
      margin: 0 15px;
      color: black;
      text-decoration: none;
      font-size: 1.1em;
    }
    .navbar .links a:hover {
      text-decoration: underline;
    }
    .navbar .auth-buttons button {
      background-color: #333;
      color: white;
      border: none;
      padding: 8px 12px;
      margin-left: 10px;
      cursor: pointer;
      border-radius: 4px;
    }
    .navbar .auth-buttons button:hover {
      background-color: #555;
    }


    /* Estilos de las tarjetas */
    .card-container {
      display: flex;
      flex-wrap: wrap; /* Permite que las tarjetas se ajusten en varias filas */
      justify-content: center; /* Centra las tarjetas en el contenedor */
      padding: 20px;
    }
    .card {
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      margin: 10px;
      padding: 15px;
      width: 300px; /* Ancho fijo de las tarjetas */
      transition: transform 0.2s;
    }
    .card img {
      width: 100%; /* Imagen ocupa el 100% del ancho de la tarjeta */
      border-radius: 8px;
      height: auto; /* Mantiene proporciones */
    }
    .card:hover {
      transform: scale(1.05); /* Efecto al pasar el mouse sobre la tarjeta */
    }

    /* Estilos del formulario */
.login-container {
  width: 300px;
  padding: 20px;
  margin: 50px auto;
  background-color: #f4f4f4;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

h2 {
  text-align: center;
  margin-bottom: 20px;
}

.input-group {
  margin-bottom: 15px;
}

.input-group label {
  display: block;
  margin-bottom: 5px;
  font-size: 14px;
}

.input-group input {
  width: 100%;
  padding: 8px;
  border: 1px solid #ddd;
  border-radius: 4px;
}

button.btn {
  width: 100%;
  padding: 10px;
  background-color: #4CAF50;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

button.btn:hover {
  background-color: #45a049;
}
footer {
  background-color: #fff;
  color: #fff;
  padding: 20px 0;
  text-align: center;
}

.footer-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 15px;
}

.logo {
  max-width: 150px;
}

.links-section, .social-section {
  display: flex;
  gap: 15px;
}

.links-section a, .social-section a {
  color: #333;
  text-decoration: none;
}

.links-section a:hover, .social-section a:hover {
  text-decoration: underline;
}
  </style>
</head>

<body>
 <!-- Barra de navegación -->
  <div class="navbar">
    <div class="links">
      <a href="inicio.php">Inicio</a>
      <a href="servicio1.php">Servicio 1</a>
     
    </div>
    <div class="auth-buttons">
      <button onclick="location.href='login.php'">Iniciar sesión</button>
      <button onclick="location.href='register.php'">Registrarse</button>
    </div>
  </div>
<?php
echo "<img src='NAVIERA.webp' alt='Esta es una descripcion alternativa de la imagen para cuando no se pueda mostrar' width='1350' height='400' align='center'/>";
?>
<?php
$servername = "localhost";  // Servidor de la base de datos
$username = "root";         // Tu usuario de la base de datos
$password = "";             // Tu contraseña
$dbname = "naviera";  // Nombre de la base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}
?>
<?php
// Al recibir el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $ID_Usuario = $_POST['ID_Usuario'];
  $Nombre_Usuario = $_POST['Nombre_Usuario'];
  $Contraseña = $_POST['Contraseña'];
 $Rol = $_POST['Rol']; // Captura el tipo de usuario

  // Consultar si el usuario existe
  $sql = "SELECT * FROM usuario WHERE ID_Usuario = '$ID_Usuario' AND Nombre_Usuario = '$Nombre_Usuario' AND Contraseña = '$Contraseña' AND Rol = '$Rol'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
       if ($Rol == 'Empleado') {
        header("Location: interfaz_empleado.php"); // Redirige a la página de empleados
    } elseif ($Rol == 'usuario') {
        header("Location: interfaz_cliente.php"); // Redirige a la página de clientes
    }
    exit();
  } else {
    // Usuario no encontrado
    echo "Usuario o contraseña incorrectos.";
  }
}
?>
<div class="login-container">
  <h2>Iniciar Sesión</h2>
  <form action="login.php" method="POST">
    <div class="input-group">
      <label for="ID_Usuario">Numero ID</label>
      <input type="text" id="ID_Usuario" name="ID_Usuario" required>
    </div>
    <div class="input-group">
      <label for="Nombre_Usuario">Nombre Usuario</label>
      <input type="text" id="Nombre_Usuario" name="Nombre_Usuario" required>
    </div>
    <div class="input-group">
      <label for="Contraseña">Contraseña</label>
      <input type="password" id="Contraseña" name="Contraseña" required>
    </div>
<div class="input-group">
  <label>Tipo de Usuario</label>
  <label>
    <input type="radio" name="Rol" value="Empleado" required> Empleado
  </label>
  <label>
    <input type="radio" name="Rol" value="usuario" required> Usuario
  </label>
</div>
    <button type="submit" class="btn">Iniciar Sesión</button>
  </form>
</div>
<footer>
  <div class="footer-container">
    <div class="logo-section">
      <img src="logoAtlantisNav.png" alt="Logo" class="logo">
    </div>
    <div class="links-section">
      <a href="sobre-nosotros.html">Sobre Nosotros</a>
      <a href="privacidad.html">Política de Privacidad</a>
      <a href="contacto.html">Contacto</a>
    </div>
    <div class="social-section">
      <a href="https://facebook.com" target="_blank">Facebook</a>
      <a href="https://instagram.com" target="_blank">Instagram</a>
      <a href="https://twitter.com" target="_blank">Twitter</a>
    </div>
  </div>
</footer>


