<?php

namespace Caio\MVC\Controller;

use Caio\MVC\Entity\Curso;
use Caio\MVC\Helper\RenderizadorDeHtmlTrait;
use Caio\MVC\Infra\EntityManagerCreator;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FormularioEdicao implements RequestHandlerInterface
{
    private ObjectRepository $repositoryCurso;
    use RenderizadorDeHtmlTrait;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repositoryCurso = $entityManager
            ->getRepository(Curso::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $id = filter_input(
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT
        );

        if ( is_null($id) || $id === false ) {
            return new Response(404, ['Location'=>'/listar-cursos']);
        }

        $curso = $this->repositoryCurso->find($id);
        
        $html = $this->renderizaHtml('cursos/formulario.php',[
            'curso' => $curso,
            'titulo'=>"Alterar Curso ".$curso->getDescricao()
        ]);

        return new Response(200, [], $html);
    }
}