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

// Comprobar si se ha enviado el formulario de búsqueda
$cliente_id = '';
if(isset($_POST['buscar'])){
    $cliente_id = $_POST['cliente_id'];
    $sql = "SELECT ID_Cliente, Nombre, Direccion, Telefono, Correo FROM Cliente WHERE ID_Cliente = '$cliente_id'";
} else {
    // Consulta para obtener todos los clientes si no se está buscando uno específico
    $sql = "SELECT ID_Cliente, Nombre, Direccion, Telefono, Correo FROM Cliente";
}

$result = $conn->query($sql);

// Función para exportar a Excel
if (isset($_POST['export'])) {
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=clientes.xls");

    // Abrimos la salida de PHP para escribir en el archivo Excel
    echo "<h2 style='text-align:center;'>Clientes de Atlantisnav</h2>"; // Título de la tabla
    echo "<table border='1' style='border-collapse:collapse; width: 100%;'>";
    echo "<tr style='background-color:#4CAF50; color:white;'><th>ID_Cliente</th><th>Nombre</th><th>Dirección</th><th>Teléfono</th><th>Correo</th></tr>";
    
    // Escribimos los datos de cada cliente en la tabla
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["ID_Cliente"] . "</td>";
        echo "<td>" . $row["Nombre"] . "</td>";
        echo "<td>" . $row["Direccion"] . "</td>";
        echo "<td>" . $row["Telefono"] . "</td>";
        echo "<td>" . $row["Correo"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
    exit();
}
// Función para exportar a TXT
if (isset($_POST['export_txt'])) {
    header("Content-Type: text/plain");
    header("Content-Disposition: attachment; filename=clientes.txt");

    // Escribe el contenido del archivo
    echo "ID_Cliente\tNombre\tDirección\tTeléfono\tCorreo\n"; // Encabezados con tabulación
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo $row["ID_Cliente"] . "\t" .
                 $row["Nombre"] . "\t" .
                 $row["Direccion"] . "\t" .
                 $row["Telefono"] . "\t" .
                 $row["Correo"] . "\n";
        }
    } else {
        echo "No hay datos disponibles.";
    }
    exit();
}
if (isset($_POST['export_word'])) {
    header("Content-Type: application/msword");
    header("Content-Disposition: attachment; filename=clientes.doc");

    // Establecemos el estilo para el archivo Word
    echo "<html>";
    echo "<head>";
    echo "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    echo "<style>";
    echo "table { width: 100%; border-collapse: collapse; }";
    echo "th, td { border: 1px solid #ddd; padding: 8px; text-align: left; font-family: Arial, sans-serif; }";
    echo "th { background-color: #4CAF50; color: white; }"; // Fondo verde para encabezados
    echo "tr:nth-child(even) { background-color: #f2f2f2; }";
    echo "tr:hover { background-color: #ddd; }";
    echo "</style>";
    echo "</head>";
    echo "<body>";

    echo "<h2 style='text-align:center;'>Lista de Clientes de AtlantisNav</h2>";
    echo "<table>";
    echo "<tr><th>ID_Cliente</th><th>Nombre</th><th>Dirección</th><th>Teléfono</th><th>Correo</th></tr>";

    // Agregar los datos de los clientes
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["ID_Cliente"] . "</td>";
            echo "<td>" . $row["Nombre"] . "</td>";
            echo "<td>" . $row["Direccion"] . "</td>";
            echo "<td>" . $row["Telefono"] . "</td>";
            echo "<td>" . $row["Correo"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No hay datos disponibles.</td></tr>";
    }

    echo "</table>";
    echo "</body>";
    echo "</html>";
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Consulta de Clientes</title>
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
    }
    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }
    th {
      background-color: #4CAF50;
      color: white;
    }
    tr:nth-child(even) {
      background-color: #f2f2f2;
    }
    tr:hover {
      background-color: #ddd;
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

  <h1>Consulta de Clientes</h1>

  <!-- Formulario para buscar un cliente -->
  <form method="post">
    <label for="cliente_id">Buscar Cliente por ID:</label>
    <input type="text" name="cliente_id" id="cliente_id" required>
    <button type="submit" name="buscar">Buscar</button>
  </form>

  <h2>Clientes de Atlantisnav</h2> <!-- Título de la tabla en la página -->

  <table>
    <tr>
      <th>ID_Cliente</th>
      <th>Nombre</th>
      <th>Dirección</th>
      <th>Teléfono</th>
      <th>Correo</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["ID_Cliente"]. "</td><td>" . $row["Nombre"]. "</td><td>" . $row["Direccion"]. "</td><td>" . $row["Telefono"]. "</td><td>" . $row["Correo"]. "</td></tr>";
      }
    } else {
      echo "<tr><td colspan='5'>No hay datos disponibles</td></tr>";
    }
    ?>
  </table>

  <!-- Botón para exportar a Excel -->
  <form method="post">
    <button type="submit" name="export">Exportar a Excel</button>
    <button type="submit" name="export_txt">Exportar a TXT</button>

    <button type="submit" name="export_word">Exportar a Word</button>
</form>

</form>

</form>
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
