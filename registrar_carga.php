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
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "naviera";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los IDs de los buques registrados
$sql_buque = "SELECT ID_Buque FROM buque"; // Asegúrate de que la tabla sea la correcta
$result_buque = $conn->query($sql_buque);
$sql_cliente = "SELECT ID_Cliente FROM cliente"; // Asegúrate de que la tabla sea la correcta
$result_cliente = $conn->query($sql_cliente);

// Generar el ID de carga aleatorio
function generateId() {
  $numbers = rand(1000, 9999); // 4 números aleatorios
  $letters = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 2); // 2 letras aleatorias
  return $numbers;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $ID_Carga = $_POST['ID_Carga'];
  $Descripción = $_POST['Descripción'];
  $Peso = $_POST['Peso'];
  $Volumen = $_POST['Volumen'];
  $ID_Tipo_Carga = $_POST['ID_Tipo_Carga'];
  $ID_Buque = $_POST['ID_Buque'];
 $ID_Cliente = $_POST['ID_Cliente'];

  $sql = "INSERT INTO carga (ID_Carga, Descripción, Peso, Volumen, ID_Tipo_Carga, ID_Buque , ID_Cliente) 
          VALUES ('$ID_Carga', '$Descripción', '$Peso', '$Volumen', '$ID_Tipo_Carga', '$ID_Buque', '$ID_Cliente')";

  if ($conn->query($sql) === TRUE) {
    echo "Carga registrada con éxito.";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro de Carga</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      text-align: center;
      background: #ffffff;
    }
    .form-container {
      width: 350px;
      padding: 20px;
      margin: 50px auto;
      background-color: #f4f4f4;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    h2 {
      font-size: 2em;
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
    .input-group input, .input-group select {
      width: 100%;
      padding: 8px;
      border: 1px solid #ddd;
      border-radius: 4px;
    }
 
    button:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>

  <div class="form-container">
    <h2>Registrar Carga</h2>
    <form action="registrar_carga.php" method="POST">
      <div class="input-group">
        <label for="ID_Carga">ID de Carga</label>
        <input type="text" id="ID_Carga" name="ID_Carga" value="<?php echo generateId(); ?>" readonly>
      </div>
      <div class="input-group">
        <label for="Descripción">Descripción</label>
        <input type="text" id="Descripción" name="Descripción" required>
      </div>
      <div class="input-group">
        <label for="Peso">Peso (kg)</label>
        <input type="number" id="Peso" name="Peso" required>
      </div>
      <div class="input-group">
        <label for="Volumen">Volumen (m³)</label>
        <input type="number" id="Volumen" name="Volumen" required>
      </div>
      <div class="input-group">
        <label for="ID_Tipo_Carga">ID de Tipo de Carga</label>
        <input type="text" id="ID_Tipo_Carga" name="ID_Tipo_Carga" required>
      </div>
      <div class="input-group">
        <label for="ID_Buque">ID del Buque</label>
        <select id="ID_Buque" name="ID_Buque" required>
          <option value="">Seleccione un Buque</option>
          <?php
            // Mostrar los buques registrados
            if ($result_buque->num_rows > 0) {
              while($row = $result_buque->fetch_assoc()) {
                echo "<option value='".$row['ID_Buque']."'>".$row['ID_Buque']."</option>";
              }
            } else {
              echo "<option value=''>No hay buques registrados</option>";
            }
          ?>
        </select>
      </div>
<div class="input-group">
        <label for="ID_Cliente">ID del Cliente</label>
        <select id="ID_Cliente" name="ID_Cliente" required>
          <option value="">Seleccione un Cliente</option>
          <?php
            // Mostrar los clientes registrados
            if ($result_cliente->num_rows > 0) {
              while($row = $result_cliente->fetch_assoc()) {
                echo "<option value='".$row['ID_Cliente']."'>".$row['ID_Cliente']."</option>";
              }
            } else {
              echo "<option value=''>No hay clientes registrados</option>";
            }
          ?>
        </select>
      </div>
      <button type="submit">Registrar Carga</button>
    </form>
  </div>

</body>
</html>

<?php $conn->close(); ?>
 <div class="auth-buttons">
      <button onclick="location.href='consultar_carga.php'">Consultar Carga</button>
    <button onclick="location.href='informe_carga.php'">Generar Informe de Carga</button>
 <button onclick="location.href='actualizar_carga.php'">Actualizar Carga</button>
</div>
</body>
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
</html>
