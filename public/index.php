<?php

require __DIR__ . '/../vendor/autoload.php';

$rotas = require __DIR__ . '/../config/routes.php';

if (!array_key_exists($_SERVER['PATH_INFO'], $rotas)) {
    http_response_code(404);
    exit();
}

session_start();

if (!isset($_SESSION['logado'])  && stripos($_SERVER['PATH_INFO'], 'login') === false) {
    header('Location: /login');
    exit();
}

$classeControladora = $rotas[$_SERVER['PATH_INFO']];
$controlador = new $classeControladora();
$controlador->processaRequisicao();


