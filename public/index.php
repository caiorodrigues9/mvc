<?php

require __DIR__ . '/../vendor/autoload.php';

$rotas = require __DIR__.'/../config/routes.php';

if (!array_key_exists($_SERVER['PATH_INFO'],$rotas)) {
    http_response_code(404);
    exit(); 
}

$classeControladora = $rotas[$_SERVER['PATH_INFO']];
$controlador = new $classeControladora();
$controlador->processaRequisicao();
