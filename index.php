<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Previsão do Tempo</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <center>
        <main>
            <section> 
            <img src="foto.png"> <br> <br>
                <h1>Previsão do Tempo</h1>
                <br>
                <form method="post">
                    <label for="cidade">Digite o nome da cidade que quer consultar:</label>
                    <br> <br>
                    <input type="text" name="cidade" id="cidade"> <br> <br>
                    <button type="submit"><strong>Consultar</strong></button>
                </form>

                <br>
                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $cidade = urlencode($_POST['cidade']);
                    $url = "https://api.weatherapi.com/v1/current.json?key=83bad89c82084aeabcc135938240208&q=$cidade&aqi=no";

                    $json = @file_get_contents($url);

                    if ($json === FALSE) {
                        echo "<p>Erro </p>";
                    } else {
                        $dados = json_decode($json, true);

                        if ($dados && isset($dados['current'])) {
                            $temp = $dados['current']['temp_c'];
                            $condition = $dados['current']['condition']['text'];
                            echo "<h2>Resultado:</h2>";
                            echo "<p>Temperatura: {$temp}°C</p>";
                            echo "<p>Condição: {$condition}</p>";
                        } else {
                            echo "<p>Não foi possível obter os dados para a cidade informada.</p>";
                        }
                    }
                }
                ?>
                <br>
            </section>
        </main>
</body>
</center>

</html>