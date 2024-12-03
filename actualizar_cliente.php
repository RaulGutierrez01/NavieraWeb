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
      background: #fffff;
    }

    h1, h2 {
      color: #4CAF50;
      text-align: center;
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
      color: #333;
      text-decoration: none;
      margin: 0 15px;
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

    .container {
      width: 400px;
      margin: 50px auto;
      padding: 20px;
      background-color: #ffffff;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .input-group {
      margin-bottom: 15px;
    }

    .input-group label {
      display: block;
      margin-bottom: 5px;
    }

    .input-group input {
      width: 100%;
      padding: 10px;
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
      background-color: #ffffff;
      color: white;
      padding: 20px 0;
      text-align: center;
    }

    .footer-container {
      display: flex;
      flex-direction: column;
      align-items: center;
  gap: 15px;
    }

    .footer-container img {
      max-width: 100px;
    }

    .footer-container .links-section,
    .footer-container .social-section {
      display: flex;
      gap: 15px;
      margin-top: 10px;
    }

    .footer-container a {
      color: #333;
      text-decoration: none;
    }

    .footer-container a:hover {
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
    <button onclick="location.href='rastrear_buque.php'">Ratrear Buque</button>
  <button onclick="location.href='rastrear_carga.php'">Ratrear Carga</button>
</div>
</div>

  <!-- Imagen principal -->

    <?php
  echo "<img src='NAVIERA.webp' alt='Esta es una descripcion alternativa de la imagen para cuando no se pueda mostrar' width='1350' height='400' align='center'/>";
  ?>


  <!-- Formulario para buscar y actualizar -->
  <div class="container">
    <h2>Buscar Cliente para Actualizar</h2>
    <form action="actualizar_cliente.php" method="POST">
      <div class="input-group">
        <label for="ID_Cliente">Ingrese el ID del Cliente:</label>
        <input type="number" id="ID_Cliente" name="ID_Cliente" required>
      </div>
      <button type="submit" class="btn">Buscar</button>
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

  // Mostrar el formulario de actualización si se encuentra el cliente
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ID_Cliente'])) {
    $ID_Cliente = $_POST['ID_Cliente'];
    $sql = "SELECT * FROM Cliente WHERE ID_Cliente = '$ID_Cliente'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      ?>
      <div class="container">
        <h2>Actualizar Información del Cliente</h2>
        <form action="actualizar_cliente.php" method="POST">
          <input type="hidden" name="ID_Cliente" value="<?php echo $ID_Cliente; ?>">
          <div class="input-group">
            <label for="Nombre">Nombre:</label>
            <input type="text" id="Nombre" name="Nombre" value="<?php echo $row['Nombre']; ?>">
          </div>
          <div class="input-group">
            <label for="Direccion">Dirección:</label>
            <input type="text" id="Direccion" name="Direccion" value="<?php echo $row['Direccion']; ?>">
          </div>
          <div class="input-group">
            <label for="Telefono">Teléfono:</label>
            <input type="text" id="Telefono" name="Telefono" value="<?php echo $row['Telefono']; ?>">
          </div>
          <div class="input-group">
            <label for="Correo">Correo:</label>
            <input type="email" id="Correo" name="Correo" value="<?php echo $row['Correo']; ?>">
          </div>
          <button type="submit" name="update" class="btn">Actualizar</button>
        </form>
      </div>
      <?php
    } else {
      echo "<p>No se encontró un cliente con el ID proporcionado.</p>";
    }
  }

  // Actualizar cliente
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $ID_Cliente = $_POST['ID_Cliente'];
    $Nombre = $_POST['Nombre'];
    $Direccion = $_POST['Direccion'];
    $Telefono = $_POST['Telefono'];
    $Correo = $_POST['Correo'];

    $sql = "UPDATE Cliente SET Nombre='$Nombre', Direccion='$Direccion', Telefono='$Telefono', Correo='$Correo' WHERE ID_Cliente='$ID_Cliente'";
    if ($conn->query($sql) === TRUE) {
      echo "<p>Cliente actualizado con éxito.</p>";
    } else {
      echo "<p>Error al actualizar: " . $conn->error . "</p>";
    }
  }

  $conn->close();
  ?>

  <!-- Footer -->
  <footer>
    <div class="footer-container">
      <img src="logoAtlantisNav.png" alt="Logo">
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