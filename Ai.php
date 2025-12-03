<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

$data = json_decode(file_get_contents("php://input"), true);
$question = $data["question"] ?? "";

// ⚠️ PUT YOUR API KEY HERE (secret, backend only)
$apiKey = "sk-e11b6e629df74aa09c3200a4f657d2c1";

$payload = [
    "model" => "deepseek-chat",
    "messages" => [
        ["role" => "user", "content" => $question]
    ]
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.deepseek.com/chat/completions");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer $apiKey",
    "Content-Type: application/json",
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));

$response = curl_exec($ch);
curl_close($ch);

echo $response;
?>
