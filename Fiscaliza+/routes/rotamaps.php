<?php
$origem = " ";
$destino = " ";
$apiKey = "AIzaSyAgyRuSTvi4-rx2LFLNnIszwMPOFn9rfuI";

// Codificar os endereços para uso na URL
$origemEncoded = urlencode($origem);
$destinoEncoded = urlencode($destino);

// Montar URL da requisição
$url = "https://maps.googleapis.com/maps/api/directions/json?origin=$origemEncoded&destination=$destinoEncoded&key=$apiKey";

// Inicializa cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Executa a requisição
$response = curl_exec($ch);
curl_close($ch);

// Decodifica JSON
$data = json_decode($response, true);

// Verifica se há rotas
if ($data['status'] == 'OK') {
    $route = $data['routes'][0];
    $legs = $route['legs'][0];

    echo "Distância: " . $legs['distance']['text'] . "<br>";
    echo "Duração: " . $legs['duration']['text'] . "<br>";
    echo "Instruções da rota:<br>";

    foreach ($legs['steps'] as $step) {
        echo strip_tags($step['html_instructions']) . "<br>";
    }
} else {
    echo "Erro ao buscar rota: " . $data['status'];
}
?>