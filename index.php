<?php

function getCEP(string $cep)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://viacep.com.br/ws/" . $cep . "/json/");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $response = curl_exec($curl);
    curl_close($curl);

    $cepData = json_decode($response, true);

    return $cepData;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Via CEP</title>

    <link rel="stylesheet" href="./assets/styles/styles.css">
</head>

<body>
    <main class="main">
        <div class="container">
            <div class="form">
                <form action="" method="POST" class="form__menu">
                    <div class="form__group">
                        <input type="text" name="cep" placeholder="CEP:" minlength="8" maxlength="8">
                        <button type="submit">Buscar</button>
                    </div>
                </form>
                <div class="form__data">
                    <?php if (isset($_POST['cep'])) : ?>
                        <?php if (isset(getCEP($_POST['cep'])['erro'])) : ?>
                            <h1>CEP: <?php echo $_POST['cep'] ?> não existe.</h1>
                        <?php else : ?>
                            <div class="cep">
                                <?php
                                $cepData = getCEP($_POST['cep']);
                                foreach ($cepData as $key => $value) :
                                ?>
                                    <p>
                                        <?php echo $key; ?>: <?php echo $value; ?>
                                    </p>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>
</body>

</html>