<?php
$conn = new mysqli("localhost", "root", "", "basededatos_login");
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
$usuario = $_POST['usuario'];
$password = $_POST['password'];
$sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND password = '$password'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "✅ Bienvenido, acceso concedido.";
} else {
    echo "❌ Usuario o contraseña incorrectos.";
}
$conn->close();
?>