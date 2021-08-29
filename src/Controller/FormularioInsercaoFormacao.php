<?php

namespace Caio\MVC\Controller;

use Caio\MVC\Entity\Formacao;
use Caio\MVC\Helper\RenderizadorDeHtmlTrait;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FormularioInsercaoFormacao implements RequestHandlerInterface
{
    use RenderizadorDeHtmlTrait;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $formacao = new Formacao();
        $titulo = 'Cadastrar Formação';
        $html = $this->renderizaHtml('formacoes/formulario.php', compact('formacao', 'titulo'));

        return new Response(200, [], $html);
    }
}
