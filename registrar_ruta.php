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

  <?php
  echo "<img src='NAVIERA.webp' alt='Esta es una descripcion alternativa de la imagen para cuando no se pueda mostrar' width='1350' height='400' align='center'/>";
  ?>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "naviera";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener buques
$buques = $conn->query("SELECT ID_Buque, Nombre FROM buque");

// Obtener puertos
$puertos = $conn->query("SELECT ID_Puerto, Nombre FROM puerto");

// Insertar ruta
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $origen = $_POST['origen'];
    $destino = $_POST['destino'];
    $distancia = $_POST['distancia'];
    $duracion = $_POST['duracion'];
    $id_puerto_origen = $_POST['id_puerto_origen'];
    $id_puerto_destino = $_POST['id_puerto_destino'];
    $id_buque = $_POST['id_buque'];

    // Validar si el buque y los puertos existen
    $buque_valido = $conn->query("SELECT * FROM buque WHERE ID_Buque = '$id_buque'")->num_rows > 0;
    $puerto_origen_valido = $conn->query("SELECT * FROM puerto WHERE ID_Puerto = '$id_puerto_origen'")->num_rows > 0;
    $puerto_destino_valido = $conn->query("SELECT * FROM puerto WHERE ID_Puerto = '$id_puerto_destino'")->num_rows > 0;

    if ($buque_valido && $puerto_origen_valido && $puerto_destino_valido) {
        $sql = "INSERT INTO Ruta (Origen, Destino, Distancia, Duración, ID_Puerto_Origen, ID_Puerto_Destino, ID_Buque) 
                VALUES ('$origen', '$destino', $distancia, $duracion, $id_puerto_origen, $id_puerto_destino, $id_buque)";
        
        if ($conn->query($sql) === TRUE) {
            echo "Ruta registrada con éxito.";
        } else {
            echo "Error al registrar la ruta: " . $conn->error;
        }
    } else {
        echo "Error: Buque o puertos no válidos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Ruta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
        }
        form {
            width: 50%;
            margin: auto;
        }
        input, select, button1 {
            display: block;
            width: 100%;
            margin: 10px 0;
            padding: 10px;
            font-size: 16px;
        }
        button1 {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button1:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<div class="login-container">
    <h2>Registrar Nueva Ruta</h2>
    <form method="POST">
        <label for="origen">Origen:</label>
        <input type="text" name="origen" id="origen" required>
        
        <label for="destino">Destino:</label>
        <input type="text" name="destino" id="destino" required>
        
        <label for="distancia">Distancia (km):</label>
        <input type="number" step="0.01" name="distancia" id="distancia" required>
        
        <label for="duracion">Duración (horas):</label>
        <input type="number" name="duracion" id="duracion" required>
        
        <label for="id_puerto_origen">Puerto de Origen:</label>
        <select name="id_puerto_origen" id="id_puerto_origen" required>
            <option value="">Seleccionar</option>
            <?php while ($puerto = $puertos->fetch_assoc()) { ?>
                <option value="<?= $puerto['ID_Puerto'] ?>"><?= $puerto['Nombre'] ?></option>
            <?php } ?>
        </select>
        
        <label for="id_puerto_destino">Puerto de Destino:</label>
        <select name="id_puerto_destino" id="id_puerto_destino" required>
            <option value="">Seleccionar</option>
            <?php 
            // Reset pointer to fetch puertos again
            $puertos->data_seek(0); 
            while ($puerto = $puertos->fetch_assoc()) { ?>
                <option value="<?= $puerto['ID_Puerto'] ?>"><?= $puerto['Nombre'] ?></option>
            <?php } ?>
        </select>
        
        <label for="id_buque">Buque:</label>
        <select name="id_buque" id="id_buque" required>
            <option value="">Seleccionar</option>
            <?php while ($buque = $buques->fetch_assoc()) { ?>
                <option value="<?= $buque['ID_Buque'] ?>"><?= $buque['Nombre'] ?></option>
            <?php } ?>
        </select>
        
        <button type="submit">Registrar Ruta</button>
    </form>
  </div>
</body>
</html>

<?php
$conn->close();
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

