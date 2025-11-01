<?php

if ($_FILES['picture']['error'] === UPLOAD_ERR_OK) {
    $caminhoTemporario = $_FILES['picture']['tmp_name'];

    $url = "http://127.0.0.1:5000/scorecounter";

    $curl = curl_init();
    $cfile = new CURLFile($caminhoTemporario, $_FILES['picture']['type'], $_FILES['picture']['name']);

    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => ['picture' => $cfile],
        CURLOPT_RETURNTRANSFER => true
    ]);

    $response = curl_exec($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    if ($httpCode == 201) {
        $data = json_decode($response, true);
        
        for ($i = 0; $i < 4; $i++){
            echo "Jogador $i: ";
            echo "Kombi" . $data["Player $i"]["kombi"];
            echo "Fusca" . $data["Player $i"]["fusca"];
            echo "New Beetle" . $data["Player $i"]["new beetle"];
        }
    } else {
        echo "Ocorreu um erro. Código HTTP: $httpCode";
    }
} else {
    echo "Nenhuma imagem foi enviada.";
}
?>