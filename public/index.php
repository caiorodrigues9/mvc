<?php

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;

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

$psr17Factory = new Psr17Factory();
$creator = new ServerRequestCreator(
    $psr17Factory, // ServerRequestFactory
    $psr17Factory, // UrlFactory
    $psr17Factory, // UploadedFileFactory
    $psr17Factory // StreamFactory
);

$serverRequest = $creator->fromGlobals();

$classeControladora = $rotas[$_SERVER['PATH_INFO']];
$container = require __DIR__."/../config/dependeces.php";
$controlador = $container->get($classeControladora);
$resposta = $controlador->handle($serverRequest);


foreach ($resposta->getHeaders() as $name => $values) {
    foreach ($values as $value) {
        header(sprintf('%s: %s', $name, $value), false);
    }
}

echo $resposta->getBody();

