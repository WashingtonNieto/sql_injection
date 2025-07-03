<?php
$conn = new mysqli("localhost", "root", "", "basededatos_login");
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
$usuario = $_POST['usuario'];
$password = $_POST['password'];

$sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "❌ El nombre de usuario ya está en uso.";
} else {
    $sql = "INSERT INTO usuarios (usuario, password) values ('$usuario','$password')";

    $result = $conn->query($sql);
    if ($result) {
        echo "✅ Usuario registrado con éxito.";
    } else {
        echo "❌ Error al registrar el usuario.";
    }
}
$conn->close();
?>