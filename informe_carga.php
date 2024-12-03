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

// Obtener detalles de una carga específica
if (isset($_POST['generar'])) {
    $id_carga = $_POST['id_carga'];
    $sql = "SELECT c.ID_Carga, c.Descripción, c.Peso, c.Volumen, c.ID_Tipo_Carga, c.ID_Buque, c.ID_Cliente, 
                   cl.Nombre, cl.Direccion, cl.Telefono, cl.Correo,
                   b.ID_Buque, b.Nombre AS Nombre_Buque, b.Estado, b.Capacidad, b.ID_Tipo_Buque,
                   r.ID_Ruta, r.Origen, r.Destino, r.Distancia, r.Duración, r.ID_Puerto_Origen, r.ID_Puerto_Destino
            FROM carga c
            INNER JOIN cliente cl ON c.ID_Cliente = cl.ID_Cliente
            INNER JOIN buque b ON c.ID_Buque = b.ID_Buque
            INNER JOIN ruta r ON b.ID_Buque = r.ID_Buque
            WHERE c.ID_Carga = '$id_carga'";
    $result = $conn->query($sql);
    if (!$result) {
        die("Error en la consulta SQL: " . $conn->error);
    }

    if ($result->num_rows > 0) {
        $carga = $result->fetch_assoc();

        // Encabezados para descargar como Word
        header("Content-Type: application/vnd.ms-word");
        header("Content-Disposition: attachment; filename=informe_carga_" . $carga['ID_Carga'] . ".doc");

        // Generar contenido del documento
        echo "
        <html>
        <head>
            <meta charset='UTF-8'>
            <title>Informe de Carga</title>
            <style>
                body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin: 20px 0;
                }
                th, td {
                    border: 1px solid #000;
                    padding: 10px;
                    text-align: left;
                }
                caption {
                    font-size: 1.5em;
                    margin-bottom: 10px;
                }
                img {
                    width: 50px;
                    height: auto;
                    float: left;
                    margin-right: 20px;
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
            <img src='logoAtlantisNav.png' alt='Logo' />
            <h1 style='text-align:center;'>Informe Detallado de la Carga</h1>
            <table>
                <tr><th>Detalles de la Carga</th></tr>
                <tr><th>ID de la Carga</th><td>" . $carga['ID_Carga'] . "</td></tr>
                <tr><th>Descripción</th><td>" . $carga['Descripcion'] . "</td></tr>
                <tr><th>Peso</th><td>" . $carga['Peso'] . " kg</td></tr>
                <tr><th>Volumen</th><td>" . $carga['Volumen'] . " m³</td></tr>
                <tr><th>ID del Tipo de Carga</th><td>" . $carga['ID_Tipo_Carga'] . "</td></tr>
                <tr><th>ID del Buque</th><td>" . $carga['ID_Buque'] . "</td></tr>
            </table>
            <table>
                <caption>Detalles del Cliente</caption>
                <tr><th>ID del Cliente</th><td>" . $carga['ID_Cliente'] . "</td></tr>
                <tr><th>Nombre</th><td>" . $carga['Nombre'] . "</td></tr>
                <tr><th>Dirección</th><td>" . $carga['Direccion'] . "</td></tr>
                <tr><th>Teléfono</th><td>" . $carga['Telefono'] . "</td></tr>
                <tr><th>Correo</th><td>" . $carga['Correo'] . "</td></tr>
            </table>
            <table>
                <caption>Detalles del Buque</caption>
                <tr><th>ID del Buque</th><td>" . $carga['ID_Buque'] . "</td></tr>
                <tr><th>Nombre del Buque</th><td>" . $carga['Nombre_Buque'] . "</td></tr>
                <tr><th>Estado</th><td>" . $carga['Estado'] . "</td></tr>
                <tr><th>Capacidad</th><td>" . $carga['Capacidad'] . "</td></tr>
                <tr><th>ID del Tipo de Buque</th><td>" . $carga['ID_Tipo_Buque'] . "</td></tr>
            </table>
            <table>
                <caption>Detalles de la Ruta</caption>
                <tr><th>ID de la Ruta</th><td>" . $carga['ID_Ruta'] . "</td></tr>
                <tr><th>Origen</th><td>" . $carga['Origen'] . "</td></tr>
                <tr><th>Destino</th><td>" . $carga['Destino'] . "</td></tr>
                <tr><th>Distancia</th><td>" . $carga['Distancia'] . " km</td></tr>
                <tr><th>Duración</th><td>" . $carga['Duración'] . " horas</td></tr>
                <tr><th>ID del Puerto de Origen</th><td>" . $carga['ID_Puerto_Origen'] . "</td></tr>
                <tr><th>ID del Puerto de Destino</th><td>" . $carga['ID_Puerto_Destino'] . "</td></tr>
            </table>
        </body>
        </html>
        ";
        exit();
    } else {
        echo "No se encontró la carga con ID: $id_carga";
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
  </style>
</head>
<body>

    <div class="navbar">
    <div class="links">
      <a href="inicio.php">Inicio</a>
      <a href="servicio1.php">Servicio 1</a>

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


    <h1>Generar Informe de Carga</h1>
    <form method="post">
        <label for="id_carga">Ingrese el ID de la Carga:</label>
        <input type="text" name="id_carga" id="id_carga" required>
        <button type="submit" name="generar">Generar Informe</button>
    </form>
</body>
</html>
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


