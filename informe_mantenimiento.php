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

// Obtener detalles de un mantenimiento específico
if (isset($_POST['generar'])) {
    $id_mantenimiento = $_POST['id_mantenimiento'];
    $sql = "SELECT * FROM mantenimiento_buque WHERE ID_Mantenimiento = '$id_mantenimiento'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $mantenimiento = $result->fetch_assoc();

        // Encabezados para descargar como Word
        header("Content-Type: application/vnd.ms-word");
        header("Content-Disposition: attachment; filename=informe_mantenimiento_" . $mantenimiento['ID_Mantenimiento'] . ".doc");

        // Generar contenido del documento
        echo "
        <html>
        <head>
            <meta charset='UTF-8'>
            <title>Informe de Mantenimiento del Buque</title>
            <style>
                body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
                table {
                    width: 100%;
                    height: 100vh;
                    border-collapse: collapse;
                    margin: 0 auto;
                }
                th, td {
                    border: 2px solid #000;
                    padding: 20px;
                    text-align: left;
                    font-size: 18px;
                }
                th {
                    background-color: #4CAF50;
                    color: white;
                }
                caption {
                    font-size: 2em;
                    margin-bottom: 10px;
                }
            </style>
        </head>
        <body>
            <h1 style='text-align:center;'>Informe de Mantenimiento del Buque</h1>
            <table>
                <caption>Detalles del Mantenimiento</caption>
                <tr>
                    <th>ID del Mantenimiento</th>
                    <td>" . $mantenimiento['ID_Mantenimiento'] . "</td>
                </tr>
                <tr>
                    <th>Fecha</th>
                    <td>" . $mantenimiento['Fecha'] . "</td>
                </tr>
                <tr>
                    <th>Descripción</th>
                    <td>" . $mantenimiento['Descripcion'] . "</td>
                </tr>
                <tr>
                    <th>Costo</th>
                    <td>" . $mantenimiento['Costo'] . "</td>
                </tr>
                <tr>
                    <th>ID del Buque</th>
                    <td>" . $mantenimiento['ID_Buque'] . "</td>
                </tr>
            </table>
        </body>
        </html>
        ";
        exit();
    } else {
        echo "No se encontró el mantenimiento con ID: $id_mantenimiento";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar Informe de Mantenimiento</title>
</head>
<body>
    <h1>Generar Informe de Mantenimiento</h1>
    <form method="post">
        <label for="id_mantenimiento">Ingrese el ID del Mantenimiento:</label>
        <input type="text" name="id_mantenimiento" id="id_mantenimiento" required>
        <button type="submit" name="generar">Generar Informe</button>
    </form>
</body>
</html>
