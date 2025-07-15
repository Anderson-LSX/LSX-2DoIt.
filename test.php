<?php
$conn = new mysqli("127.0.0.1", "root", "", "projeto_x", 3308);
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
} else {
    echo "Conexão OK!";
}
$conn->close();
