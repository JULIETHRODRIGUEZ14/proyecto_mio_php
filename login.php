<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proyecto";
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si la conexión es exitosa
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores del formulario
    $username = $_POST['Usuario'];
    $password = $_POST['Password'];
    // Imprimir los valores para verificar
    var_dump($_POST);

    // Consulta SQL para verificar las credenciales del usuario
    $query = "SELECT * FROM login WHERE Usuario='$username' AND Password='$password'";
    $result = $conn->query($query);

    if ($result) {
        $nr = $result->num_rows;

        if ($nr == 1) {
            echo "Bienvenido: " . $username;

            // Realizar la inserción de datos en la tabla
            $insertQuery = "INSERT INTO login (Usuario, Password) VALUES ('$username', '$password')";
            $insertResult = $conn->query($insertQuery);

            if ($insertResult) {
                echo "Datos guardados en la base de datos.";
            } else {
                echo "Error al guardar los datos: " . $conn->error;
            }
        } else {
            echo "No ingresó, el usuario no existe.";
        }
    } else {
        echo "Error en la consulta: " . $conn->error;
    }
}

$conn->close();
?>
