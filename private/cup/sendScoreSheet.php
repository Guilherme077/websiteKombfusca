<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar Folha de Pontuação</title>
</head>
<body>
    <h1>Envio de Folha de Pontuação</h1>
    <span>Envie uma foto da Folha de Pontuação</span>
    <span>A foto não pode ter variações de iluminação</span>
    <form action="checkScoreSheet.php" method="post" enctype="multipart/form-data">
        <input type="file" name="picture" id="picture">
        <input type="submit" name="withPicture" value="Continuar para validação">
        <input type="submit" name="noPicture" value="Continuar SEM foto">
    </form>
</body>
</html>