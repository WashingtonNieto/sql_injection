<?php
$conn = new mysqli("localhost", "root", "", "basededatos_login");
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$usuario = trim($_POST['usuario']);
$password = trim($_POST['password']);

$stmt = $conn->prepare("SELECT password FROM usuarios WHERE usuario = ?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $hashedPassword = $row['password'];

    if (password_verify($password, $hashedPassword)) {
        echo "✅ Bienvenido, acceso concedido a $usuario!";
    } else {
        echo "❌ Usuario o contraseña incorrectos.";
    }
} else {
    echo "❌ Usuario no encontrado.";
}

$stmt->close();
$conn->close();
?>