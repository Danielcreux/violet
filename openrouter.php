<?php

$apiKey = 'yourkey'; // Reemplaza con tu clave

$url = 'https://openrouter.ai/api/v1/chat/completions';

$data = [
    "model" => "mistralai/mistral-7b-instruct", // Puedes cambiar por otro modelo soportado
    "messages" => [
        ["role" => "user", "content" => $_GET['pregunta'] ?? "¿Cuál es la capital de Francia?"]
    ]
];

$headers = [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $apiKey,
    'HTTP-Referer: https://tusitio.com  ', // Requerido por OpenRouter (puede ser cualquier dominio válido)
    'X-Title: Mi App IA' // Nombre personalizado de tu app
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

$response = curl_exec($ch);
curl_close($ch);

$decoded = json_decode($response, true);

if (isset($decoded['choices'][0]['message']['content'])) {
    echo "" . $decoded['choices'][0]['message']['content'];
} else {
    echo "❌ Error en la respuesta:<br><pre>";
    print_r($decoded);
    echo "</pre>";
}
?>