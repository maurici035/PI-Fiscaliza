<?php
include 'conexao.php'; // sua conexão com o banco

$titulo = $_POST['titulo'];
$descricao = $_POST['descricao'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];

// Validação básica
if (!$titulo || !$descricao || !$latitude || !$longitude) {
    die("Dados incompletos.");
}

$sql = "INSERT INTO denuncias (titulo, descricao, latitude, longitude, data_criacao)
        VALUES (?, ?, ?, ?, NOW())";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssdd", $titulo, $descricao, $latitude, $longitude);

if ($stmt->execute()) {
    echo "Denúncia salva com sucesso!";
} else {
    echo "Erro ao salvar denúncia: " . $conn->error;
}

$conn->close();
?>