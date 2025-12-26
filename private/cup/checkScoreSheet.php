<?php

$jogadores = [];

if (isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
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
            $jogadores[$i][0] = $data["Player $i"]["kombi"];
            $jogadores[$i][1] = $data["Player $i"]["fusca"];
            $jogadores[$i][2] = $data["Player $i"]["new beetle"];
        }
    } else {
        echo "Ocorreu um erro. Código HTTP: $httpCode";
        exit;
    }
} else {
    echo "Nenhuma imagem foi enviada.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validar pontuação</title>
</head>
<body>
    <span>Identificamos as seguintes quantidades de cada veículo:</span>
    <table border="1">
        <tr>
            <th>Jogador</th>
            <th>Kombi</th>
            <th>Fusca</th>
            <th>New Beetle</th>
        </tr>
        <?php
        for($i = 0; $i < 4; $i++){
            $k = $jogadores[$i][0];
            $f = $jogadores[$i][1];
            $n = $jogadores[$i][2];
            echo "
            <tr>
                <td>$i</td>
                <td>$k</td>
                <td>$f</td>
                <td>$n</td>
            </tr>
            ";
        }
        ?>
    </table>
    <span>Deseja confirmar estes resultados?</span>
    <form action="" method="post">
        <input type="submit" value="Sim, confirmo os resultados">
        <input type="submit" value="Não, ir para edição manual">
        <input type="submit" value="Não, repetir foto">
    </form>
</body>
</html>