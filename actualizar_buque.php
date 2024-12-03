<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['ID_Buque']) && !empty($_POST['ID_Buque'])) {
    // Paso 1: Buscar el buque por ID
    $ID_Buque = $_POST['ID_Buque'];

    // Conectar a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "naviera";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
      die("Conexión fallida: " . $conn->connect_error);
    }

    // Buscar el buque por ID_Buque
    $sql = "SELECT * FROM buque WHERE ID_Buque = '$ID_Buque'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // Si existe el buque, mostrar el formulario con los datos actuales
      $buque = $result->fetch_assoc();
      $Nombre = $buque['Nombre'];
      $Estado = $buque['Estado'];
      $Capacidad = $buque['Capacidad'];
      $ID_Tipo_Buque = $buque['ID_Tipo_Buque'];
    } else {
      $error_message = "Buque no encontrado.";
    }

    // Si se está actualizando, se procesará el formulario
    if (isset($_POST['actualizar'])) {
      $Nombre = $_POST['Nombre'];
      $Estado = $_POST['Estado'];
      $Capacidad = $_POST['Capacidad'];
      $ID_Tipo_Buque = $_POST['ID_Tipo_Buque'];

      // Actualizar el buque en la base de datos
      $sql_update = "UPDATE buque SET Nombre='$Nombre', Estado='$Estado', Capacidad='$Capacidad', ID_Tipo_Buque='$ID_Tipo_Buque' WHERE ID_Buque='$ID_Buque'";

      if ($conn->query($sql_update) === TRUE) {
        $success_message = "Buque actualizado correctamente.";
      } else {
        $error_message = "Error al actualizar el buque: " . $conn->error;
      }
    }

    $conn->close();
  }
}
?>

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
    h1, h2 {
      font-size: 2.5em;
      color: #4CAF50;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
    }
    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 20px;
      background-color: #ffffff;
    }
    .navbar .links a {
      margin: 0 15px;
      color: black;
      text-decoration: none;
      font-size: 1.1em;
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
    .input-group {
      margin-bottom: 15px;
    }
    .input-group label {
      display: block;
      margin-bottom: 5px;
      font-size: 14px;
    }
    .input-group input, .input-group select {
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
  <a href="fags.php">Preguntas Frecuentes</a>
    </div>
    <div class="auth-buttons">
      <button onclick="location.href='registrar_cliente.php'">Registrar Cliente</button>
      <button onclick="location.href='registrar_buque.php'">Registrar Buque</button>
      <button onclick="location.href='registrar_carga.php'">Registrar Carga</button>
      <button onclick="location.href='registrar_ruta.php'">Registrar Ruta</button>
      <button onclick="location.href='registrar_mantenimiento.php'">Registrar Mantenimiento</button>
      <button onclick="location.href='rastrear_buque.php'">Rastrear Buque</button>
      <button onclick="location.href='rastrear_carga.php'">Rastrear Carga</button>
    </div>
  </div>
 <?php
  echo "<img src='NAVIERA.webp' alt='Esta es una descripcion alternativa de la imagen para cuando no se pueda mostrar' width='1350' height='400' align='center'/>";
  ?>


  <div class="login-container">
    <h2>Actualizar Buque</h2>
    
    <?php
    if (isset($error_message)) {
      echo "<p style='color: red;'>$error_message</p>";
    }
    if (isset($success_message)) {
      echo "<p style='color: green;'>$success_message</p>";
    }
    ?>

    <!-- Formulario de actualización de buque -->
    <form action="actualizar_buque.php" method="POST">
      <div class="input-group">
        <label for="ID_Buque">Ingrese ID del Buque</label>
        <input type="text" id="ID_Buque" name="ID_Buque" required>
      </div>
      <button type="submit" class="btn">Buscar Buque</button>
    </form>

    <?php if (isset($buque)): ?>
    <form action="actualizar_buque.php" method="POST">
      <div class="input-group">
        <label for="Nombre">Nombre del Buque</label>
        <input type="text" id="Nombre" name="Nombre" value="<?php echo $Nombre; ?>" required>
      </div>

      <div class="input-group">
        <label for="Estado">Estado</label>
        <input type="text" id="Estado" name="Estado" value="<?php echo $Estado; ?>" required>
      </div>

      <div class="input-group">
        <label for="Capacidad">Capacidad</label>
        <input type="number" id="Capacidad" name="Capacidad" value="<?php echo $Capacidad; ?>" required>
      </div>

      <div class="input-group">
        <label for="ID_Tipo_Buque">ID Tipo de Buque</label>
        <input type="text" id="ID_Tipo_Buque" name="ID_Tipo_Buque" value="<?php echo $ID_Tipo_Buque; ?>" required>
      </div>

      <button type="submit" name="actualizar" class="btn">Actualizar Buque</button>
    </form>
    <?php endif; ?>
  </div>

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

</body>
</html>
