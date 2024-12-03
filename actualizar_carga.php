<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Actualizar Carga</title>
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
    .form-container {
      width: 400px;
      margin: 50px auto;
      padding: 30px;
      background-color: white;
      border-radius: 8px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    .form-container h2 {
      text-align: center;
      margin-bottom: 30px;
    }

    .form-container .input-group {
      margin-bottom: 15px;
    }

    .form-container .input-group label {
      font-size: 14px;
      color: #333;
      display: block;
      margin-bottom: 5px;
    }

    .form-container .input-group input,
    .form-container .input-group select {
      width: 100%;
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 4px;
      font-size: 16px;
    }

    .form-container .input-group select {
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
      background-color: #fff;
    }

    .form-container .input-group input[type="number"] {
      -moz-appearance: textfield;
    }

    .form-container button {
      width: 100%;
      padding: 12px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 4px;
      font-size: 18px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .form-container button:hover {
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

  <!-- Título de la página -->
  <h1>Actualizar Carga</h1>

  <!-- Formulario de búsqueda de carga -->
  <div class="form-container">
    <h2>Buscar Carga</h2>
    <form action="actualizar_carga.php" method="POST">
      <div class="input-group">
        <label for="ID_Carga">ID de Carga</label>
        <input type="text" id="ID_Carga" name="ID_Carga" required>
      </div>
      <button type="submit">Buscar Carga</button>
    </form>
  </div>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ID_Carga'])) {
    $ID_Carga = $_POST['ID_Carga'];

    // Conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "naviera";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
      die("Conexión fallida: " . $conn->connect_error);
    }

    // Buscar carga por ID
    $sql = "SELECT * FROM carga WHERE ID_Carga = '$ID_Carga'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $Descripción = $row['Descripción'];
      $Peso = $row['Peso'];
      $Volumen = $row['Volumen'];
      $ID_Tipo_Carga = $row['ID_Tipo_Carga'];
      $ID_Buque = $row['ID_Buque'];
      $ID_Cliente = $row['ID_Cliente'];
    } else {
      echo "No se encontró la carga con el ID proporcionado.";
      $conn->close();
      exit;
    }
  }
  ?>

  <?php if (isset($Descripción)): ?>
  <div class="form-container">
    <h2>Actualizar Datos de Carga</h2>
    <form action="actualizar_carga.php" method="POST">
      <input type="hidden" name="ID_Carga" value="<?php echo $ID_Carga; ?>">
      <div class="input-group">
        <label for="Descripción">Descripción</label>
        <input type="text" id="Descripción" name="Descripción" value="<?php echo $Descripción; ?>" required>
      </div>
      <div class="input-group">
        <label for="Peso">Peso (kg)</label>
        <input type="number" id="Peso" name="Peso" value="<?php echo $Peso; ?>" required>
      </div>
      <div class="input-group">
        <label for="Volumen">Volumen (m³)</label>
        <input type="number" id="Volumen" name="Volumen" value="<?php echo $Volumen; ?>" required>
      </div>
      <div class="input-group">
        <label for="ID_Tipo_Carga">ID de Tipo de Carga</label>
        <input type="text" id="ID_Tipo_Carga" name="ID_Tipo_Carga" value="<?php echo $ID_Tipo_Carga; ?>" required>
      </div>
      <div class="input-group">
        <label for="ID_Buque">ID del Buque</label>
        <select id="ID_Buque" name="ID_Buque" required>
          <option value="<?php echo $ID_Buque; ?>"><?php echo $ID_Buque; ?> (Actual)</option>
          <?php
            // Mostrar los buques registrados
            $sql_buque = "SELECT ID_Buque FROM buque";
            $result_buque = $conn->query($sql_buque);
            if ($result_buque->num_rows > 0) {
              while($row = $result_buque->fetch_assoc()) {
                echo "<option value='".$row['ID_Buque']."'>".$row['ID_Buque']."</option>";
              }
            }
          ?>
        </select>
      </div>
      <div class="input-group">
        <label for="ID_Cliente">ID del Cliente</label>
        <select id="ID_Cliente" name="ID_Cliente" required>
          <option value="<?php echo $ID_Cliente; ?>"><?php echo $ID_Cliente; ?> (Actual)</option>
          <?php
            // Mostrar los clientes registrados
            $sql_cliente = "SELECT ID_Cliente FROM cliente";
            $result_cliente = $conn->query($sql_cliente);
            if ($result_cliente->num_rows > 0) {
              while($row = $result_cliente->fetch_assoc()) {
                echo "<option value='".$row['ID_Cliente']."'>".$row['ID_Cliente']."</option>";
              }
            }
          ?>
        </select>
      </div>
      <button type="submit">Actualizar Carga</button>
    </form>
  </div>
  <?php endif; ?>

  <?php
  // Actualizar los datos cuando se envía el formulario
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ID_Carga']) && isset($_POST['Descripción'])) {
    $ID_Carga = $_POST['ID_Carga'];
    $Descripción = $_POST['Descripción'];
    $Peso = $_POST['Peso'];
    $Volumen = $_POST['Volumen'];
    $ID_Tipo_Carga = $_POST['ID_Tipo_Carga'];
    $ID_Buque = $_POST['ID_Buque'];
    $ID_Cliente = $_POST['ID_Cliente'];

    $sql_update = "UPDATE carga SET 
                   Descripción = '$Descripción',
                   Peso = '$Peso',
                   Volumen = '$Volumen',
                   ID_Tipo_Carga = '$ID_Tipo_Carga',
                   ID_Buque = '$ID_Buque',
                   ID_Cliente = '$ID_Cliente'
                   WHERE ID_Carga = '$ID_Carga'";

    if ($conn->query($sql_update) === TRUE) {
      echo "Carga actualizada con éxito.";
    } else {
      echo "Error: " . $sql_update . "<br>" . $conn->error;
    }

    $conn->close();
  }
  ?>

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
