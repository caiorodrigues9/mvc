<?php

namespace Caio\MVC\Controller;

use Caio\MVC\Entity\Formacao;
use Caio\MVC\Helper\RenderizadorDeHtmlTrait;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ListaDeFormacoes implements RequestHandlerInterface
{
    use RenderizadorDeHtmlTrait;

    private $repositorioFormacoes;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repositorioFormacoes = $entityManager->getRepository(Formacao::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $formacoes = $this->repositorioFormacoes->findBy($request->getQueryParams(), ['descricao' => 'ASC']);
        $titulo = 'Listagem de Formações';

        $html = $this->renderizaHtml('formacoes/listar.php', compact('formacoes', 'titulo'));

        return new Response(200, [], $html);
    }
}
