<?php
    require_once('vendor/autoload.php');
    $client = new GuzzleHttp\Client();
    $params = time();                                                                               //geta timestump
    $key = '8d6f02e7a0f443159268f1ad485281c3';                                                      //chave publica
    $hash = md5($params . 'b9e40c6502c7c2d084717f2ebc50d13c95d08be7' . $key);                       //gera hash com  timeztump + chave privada + chave publica
    $params = 'ts=' . $params . '&apikey=' . $key . '&hash=' . $hash;                               //concatena todas as chaves
    $res = $client->request('GET', 'http://gateway.marvel.com/v1/public/characters?' . $params);    //efetua a requisição
    $resposta = json_decode($res->getBody());                                                       //atribui a resposta a variavel
    $personagens = $resposta->data->results;                                                        // localiza os personagens dentro do resultado
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Tretas da Marvelis</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>
    <body>
        
        <div class="card text-white bg-secondary mb-3">
            <?php foreach ($personagens as $personagem) { ?>
            <div class="card-header">
                <h5><?php echo $personagem->name;?></h5>
            </div>
            <div class="card-body">
                <p>
                    <?='<a class="btn btn-dark" data-toggle="collapse" href="#idimg' . $personagem->id . '" role="button" aria-expanded="false" aria-controls="collapseExample">';?>
                        Imagem
                    </a>
                    <?='<a class="btn btn-dark" data-toggle="collapse" href="#idQuad' . $personagem->id . '" role="button" aria-expanded="false" aria-controls="collapseExample">';?>
                        Quadrinhos
                    </a>
                    <?='<a class="btn btn-dark" data-toggle="collapse" href="#idSer' . $personagem->id . '" role="button" aria-expanded="false" aria-controls="collapseExample">';?>
                        Series
                    </a>
                    <?='<a class="btn btn-dark" data-toggle="collapse" href="#idHis' . $personagem->id . '" role="button" aria-expanded="false" aria-controls="collapseExample">';?>
                        Histórias
                    </a>
                </p>
                <?='<div class="collapse" id="idimg' . $personagem->id . '">';?>
                    <div class="card card-body">
                        <?='<img src="' . $personagem->thumbnail->path . '.' . $personagem->thumbnail->extension . '" style="width:500px;">';?>
                    </div>
                </div>
                <?='<div class="collapse" id="idQuad' . $personagem->id . '">';?>
                    <div class="card card-body">
                        <div class="card text-secondary bg-dark mb-3">
                            <ul class="list-group list-group-flush">
                                <?php foreach ($personagem->comics->items as $item) {?>                                
                                    <li class="list-group-item"><?= $item->name ?></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <?='<div class="collapse" id="idSer' . $personagem->id . '">';?>
                    <div class="card card-body">
                        <div class="card text-secondary bg-dark mb-3">
                            <ul class="list-group list-group-flush">
                                <?php foreach ($personagem->series->items as $item) {?>                                
                                    <li class="list-group-item"><?= $item->name ?></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <?='<div class="collapse" id="idHis' . $personagem->id . '">';?>
                    <div class="card card-body">
                        <div class="card text-secondary bg-dark mb-3">
                            <ul class="list-group list-group-flush">
                                <?php foreach ($personagem->stories->items as $item) {?>                                
                                    <li class="list-group-item"><?= $item->name ?></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    </body>
</html>
