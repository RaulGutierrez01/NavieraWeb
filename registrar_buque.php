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
      <a href="inicio.php">Inicio</a>
<a href=fags.php">Preguntas Frecuentes</a>
    </div>
    <div class="auth-buttons">
       <button onclick="location.href='registrar_cliente.php'">Registrar Cliente</button>
      <button onclick="location.href='registrar_buque.php'">Registrar Buque</button>
      <button onclick="location.href='registrar_carga.php'">Registrar Carga</button>
     <button onclick="location.href='registrar_ruta.php'">Registrar Ruta</button>
     <button onclick="location.href='registrar_mantenimiento.php'">Registrar Mantenimiento</button>
    <button onclick="location.href='rastrear_buque.php'">Ratrear Buque</button>
  <button onclick="location.href='rastrear_carga.php'">Ratrear Carga</button>
    </div>
  </div>
 <?php
  echo "<img src='NAVIERA.webp' alt='Esta es una descripcion alternativa de la imagen para cuando no se pueda mostrar' width='1350' height='400' align='center'/>";
  ?>

<!-- Título y Formulario -->
<div class="login-container">
  <h2>Registrar Buque</h2>
  <form action="registrar_buque.php" method="POST">
    <div class="input-group">
      <label for="ID_Buque">ID Buque</label>
      <input type="text" id="ID_Buque" name="ID_Buque" value="<?php echo strtoupper(substr(uniqid(), -4) . substr(md5(rand()), 0, 2)); ?>" readonly>
    </div>
    
    <div class="input-group">
      <label for="Nombre">Nombre del Buque</label>
      <input type="text" id="Nombre" name="Nombre" required>
    </div>

    <div class="input-group">
      <label for="Estado">Estado</label>
      <input type="text" id="Estado" name="Estado" required>
    </div>

    <div class="input-group">
      <label for="Capacidad">Capacidad</label>
      <input type="number" id="Capacidad" name="Capacidad" required>
    </div>

    <div class="input-group">
      <label for="ID_Tipo_Buque">Tipo de Buque</label>
      <select id="ID_Tipo_Buque" name="ID_Tipo_Buque" required>
        <option value="1">Tipo 1</option>
        <option value="2">Tipo 2</option>
        <option value="3">Tipo 3</option>
      </select>
    </div>

    <button type="submit" class="btn">Registrar Buque</button>
  </form>
</div>

<?php
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $ID_Buque = $_POST['ID_Buque'];
  $Nombre = $_POST['Nombre'];
  $Estado = $_POST['Estado'];
  $Capacidad = $_POST['Capacidad'];
  $ID_Tipo_Buque = $_POST['ID_Tipo_Buque'];

  // Insertar el nuevo buque en la base de datos
  $sql = "INSERT INTO buque (ID_Buque, Nombre, Estado, Capacidad, ID_Tipo_Buque) 
          VALUES ('$ID_Buque', '$Nombre', '$Estado', '$Capacidad', '$ID_Tipo_Buque')";

  if ($conn->query($sql) === TRUE) {
    echo "Nuevo buque registrado exitosamente";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

$conn->close();
?>
<div class="auth-buttons">
       <button onclick="location.href='consultar_buque.php'">Consultar Buque</button>
  <button onclick="location.href='actualizar_buque.php'">Actualizar Buque</button>
</div>
</body>
</html>
<footer>
  <div class="footer-container">
    <div class="logo-section">
      <img src="logoAtlantisNav.png" alt="Logo" class="logo">
    </div>
    <div class="links-section">
      <a href="sobre_nosotros.php">Sobre Nosotros</a>
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
