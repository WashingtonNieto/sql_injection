<?php
$conn = new mysqli("localhost", "root", "", "basededatos_login");
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$usuario = trim($_POST['usuario']);
$password = trim($_POST['password']);

$passwordHash = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("SELECT * FROM usuarios WHERE usuario = ?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    echo "❌ El nombre de usuario ya está en uso.";
} else {
    $stmt = $conn->prepare("INSERT INTO usuarios (usuario, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $usuario, $passwordHash);

    if ($stmt->execute()) {
        echo "✅ Usuario registrado con éxito.";
    } else {
        echo "❌ Error al registrar el usuario.";
    }
}
$stmt->close();
$conn->close();
?>