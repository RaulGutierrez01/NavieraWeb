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
      background: #ffffff;
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

  <div class="navbar">
    <div class="links">
      <a href="hola2.php">Inicio</a>
      <a href="servicio1.php">Servicio 1</a>
      <a href="servicio2.php">Servicio 2</a>
      <a href="servicio3.php">Servicio 3</a>
    </div>
    <div class="auth-buttons">
      <button onclick="location.href='login.php'">Iniciar sesión</button>
      <button onclick="location.href='register.php'">Registrarse</button>
    </div>
  </div>

  <?php
  echo "<img src='NAVIERA.webp' alt='Esta es una descripcion alternativa de la imagen para cuando no se pueda mostrar' width='1350' height='400' align='center'/>";
  ?>

  <div class="login-container">
    <h2>Registro de Usuario</h2>
    <form action="registrar.php" method="POST">
      <div class="input-group">
        <label for="ID_Usuario">Número ID</label>
        <input type="int" id="ID_Usuario" name="ID_Usuario" required>
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
      <button type="submit" class="btn">Registrarse</button>
    </form>
  </div>

  <?php
  // Conexión con la base de datos
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "naviera";

  // Crear la conexión
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Verificar la conexión
  if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
  }

  // Al recibir el formulario
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ID_Usuario = $_POST['ID_Usuario'];
    $Nombre_Usuario = $_POST['Nombre_Usuario'];
    $Contraseña = $_POST['Contraseña'];
    $Rol = $_POST['Rol'];

    // Insertar nuevo usuario
    $sql = "INSERT INTO usuario (ID_Usuario, Nombre_Usuario, Contraseña, Rol) VALUES ('$ID_Usuario', '$Nombre_Usuario', '$Contraseña', '$Rol')";
    
    if ($conn->query($sql) === TRUE) {
      echo "Nuevo registro creado con éxito.";
      header("Location: login.php"); // Redirige a la página de login
      exit();
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }

  // Cerrar la conexión
  $conn->close();
  ?>

</body>
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
</html>
