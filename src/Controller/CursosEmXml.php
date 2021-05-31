<?php

namespace Caio\MVC\Controller;

use Caio\MVC\Entity\Curso;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use SimpleXMLElement;

class CursosEmXml implements RequestHandlerInterface
{
    private EntityRepository $repositorioDeCursos;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repositorioDeCursos = $entityManager
            ->getRepository(Curso::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $cursos = $this->repositorioDeCursos->findAll();
    $cursosEmXml = new \SimpleXMLElement('<cursos/>');

    foreach ($cursos as $curso) {
        $cursoEmXml = $cursosEmXml->addChild('curso');
        $cursoEmXml->addChild('id', $curso->getId());
        $cursoEmXml->addChild('descricao', $curso->getDescricao());
    }

        return new Response(200,['Content-type' => 'application/xml'],$cursosEmXml->asXML());
    }

}