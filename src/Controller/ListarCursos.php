<?php

namespace Caio\MVC\Controller;

use Caio\MVC\Entity\Curso;
use Caio\MVC\Helper\RenderizadorDeHtmlTrait;
use Caio\MVC\Infra\EntityManagerCreator;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ListarCursos implements RequestHandlerInterface
{
    use RenderizadorDeHtmlTrait;
    
    private $repositorioDeCursos;

    public function __construct(EntityManagerInterface $entityManager)
    {  
        $this->repositorioDeCursos = $entityManager->getRepository(Curso::class);
        
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        
        $html = $this->renderizaHtml('cursos/listar-cursos.php',[
            'titulo' => "Lista de Cursos",
            'cursos' => $this->repositorioDeCursos->findAll()
        ]);
        return new Response(200, [], $html);
    }
}