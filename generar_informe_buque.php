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

// Obtener detalles de un buque específico
if (isset($_POST['generar'])) {
    $id_buque = $_POST['id_buque'];
    $sql = "SELECT * FROM buque WHERE ID_Buque = '$id_buque'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $buque = $result->fetch_assoc();

        // Encabezados para descargar como Word
        header("Content-Type: application/vnd.ms-word");
        header("Content-Disposition: attachment; filename=informe_buque_" . $buque['ID_Buque'] . ".doc");

        // Generar contenido del documento
        echo "
        <html>
        <head>
            <meta charset='UTF-8'>
            <title>Informe del Buque</title>
        </head>
        <body>
            <h1>Informe del Buque: " . $buque['Nombre'] . "</h1>
            <p><strong>ID del Buque:</strong> " . $buque['ID_Buque'] . "</p>
            <p><strong>Nombre:</strong> " . $buque['Nombre'] . "</p>
            <p><strong>Estado:</strong> " . $buque['Estado'] . "</p>
            <p><strong>Capacidad:</strong> " . $buque['Capacidad'] . "</p>
            <p><strong>ID Tipo de Buque:</strong> " . $buque['ID_Tipo_Buque'] . "</p>
        </body>
        </html>
        ";
        exit();
    } else {
        echo "No se encontró el buque con ID: $id_buque";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar Informe de Buque</title>
</head>
<body>
    <h1>Generar Informe de Buque</h1>
    <form method="post">
        <label for="id_buque">Ingrese el ID del Buque:</label>
        <input type="text" name="id_buque" id="id_buque" required>
        <button type="submit" name="generar">Generar Informe</button>
    </form>
</body>
</html>
