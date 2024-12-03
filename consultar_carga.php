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

// Consultar carga específica si se envía el formulario
if(isset($_POST['buscar'])){
    $id_carga = $_POST['id_carga'];
    $sql = "SELECT ID_Carga, Descripción, Peso, Volumen, ID_Tipo_Carga, ID_Buque, ID_Cliente FROM Carga WHERE ID_Carga = '$id_carga'";
} else {
    // Consulta para obtener todas las cargas
    $sql = "SELECT ID_Carga, Descripción, Peso, Volumen, ID_Tipo_Carga, ID_Buque, ID_Cliente FROM Carga";
}

$result = $conn->query($sql);

// Función para exportar a Excel
if (isset($_POST['export'])) {
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=cargas.xls");

    // Abrimos la salida de PHP para escribir en el archivo Excel
    echo "<h2 style='text-align:center;'>Lista de Cargas de Atlantisnav</h2>"; // Título de la tabla
    echo "<table border='1' style='border-collapse:collapse; width: 100%;'>";
    echo "<tr style='background-color:#4CAF50; color:white;'><th>ID_Carga</th><th>Desripción</th><th>Peso</th><th>Volumen</th><th>ID_Tipo_Carga</th><th>ID_Buque</th><th>ID_Cliente</th></tr>";
    
    // Escribimos los datos de cada cliente en la tabla
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["ID_Carga"] . "</td>";
        echo "<td>" . $row["Descripción"] . "</td>";
        echo "<td>" . $row["Peso"] . "</td>";
        echo "<td>" . $row["Volumen"] . "</td>";
        echo "<td>" . $row["ID_Tipo_Carga"] . "</td>";
 	echo "<td>" . $row["ID_Buque"] . "</td>";
	 echo "<td>" . $row["ID_Cliente"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
    exit();
}
// Función para exportar a TXT
if (isset($_POST['export_txt'])) {
    header("Content-Type: text/plain");
    header("Content-Disposition: attachment; filename=cargas.txt");

    // Título del archivo
    echo "Lista de Cargas de AtlantisNav\n";
    echo "ID_Carga | Descripción | Peso | Volumen | ID_Tipo_Carga | ID_Buque | ID_Cliente\n";
    echo "--------------------------------------------------------------\n";

    // Agregar los datos de las cargas
    while ($row = $result->fetch_assoc()) {
        echo $row["ID_Carga"] . " | " . $row["Descripción"] . " | " . $row["Peso"] . " | " . $row["Volumen"] . " | " . $row["ID_Tipo_Carga"] . " | " . $row["ID_Buque"] . " | " . $row["ID_Cliente"] . "\n";
    }
    exit();
}
// Función para exportar a Word
if (isset($_POST['export_word'])) {
    header("Content-Type: application/msword");
    header("Content-Disposition: attachment; filename=cargas.doc");

    // Establecemos el estilo para el archivo Word
    echo "<html>";
    echo "<head>";
    echo "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    echo "<style>";
    echo "table { width: 100%; border-collapse: collapse; }";
    echo "th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }";
    echo "th { background-color: #4CAF50; color: white; }";
    echo "tr:nth-child(even) { background-color: #f2f2f2; }";
    echo "tr:hover { background-color: #ddd; }";
    echo "</style>";
    echo "</head>";
    echo "<body>";

    echo "<h2 style='text-align:center;'>Lista de Cargas de AtlantisNav</h2>";
    echo "<table>";
    echo "<tr><th>ID_Carga</th><th>Descripción</th><th>Peso</th><th>Volumen</th><th>ID_Tipo_Carga</th><th>ID_Buque</th><th>ID_Cliente</th></tr>";

    // Agregar los datos de las cargas
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["ID_Carga"] . "</td>";
        echo "<td>" . $row["Descripción"] . "</td>";
        echo "<td>" . $row["Peso"] . "</td>";
        echo "<td>" . $row["Volumen"] . "</td>";
        echo "<td>" . $row["ID_Tipo_Carga"] . "</td>";
        echo "<td>" . $row["ID_Buque"] . "</td>";
        echo "<td>" . $row["ID_Cliente"] . "</td>";
        echo "</tr>";
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
  <title>Consulta de Carga</title>
  <style>
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
  
  <h1>Consulta de Carga</h1>

  <!-- Formulario para buscar una carga por ID -->
  <form method="post">
    <label for="id_carga">Buscar Carga por ID:</label>
    <input type="text" name="id_carga" id="id_carga" required>
    <button type="submit" name="buscar">Buscar</button>
  </form>

  <h2>Listado de Cargas</h2>

  <table>
    <tr>
      <th>ID_Carga</th>
      <th>Descripción</th>
      <th>Peso</th>
      <th>Volumen</th>
      <th>ID_Tipo_Carga</th>
      <th>ID_Buque</th>
      <th>ID_Cliente</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["ID_Carga"]. "</td><td>" . $row["Descripción"]. "</td><td>" . $row["Peso"]. "</td><td>" . $row["Volumen"]. "</td><td>" . $row["ID_Tipo_Carga"]. "</td><td>" . $row["ID_Buque"]. "</td><td>" . $row["ID_Cliente"]. "</td></tr>";
      }
    } else {
      echo "<tr><td colspan='7'>No hay datos disponibles</td></tr>";
    }
    ?>
  </table>

  <!-- Botón para exportar a Excel -->
  <form method="post">
    <button type="submit" name="export">Exportar a Excel</button>
     <button type="submit" name="export_txt">Exportar a TXT</button>
  <button type="submit" name="export_word">Exportar a Word</button>
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