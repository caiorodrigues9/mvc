<?php

namespace Caio\MVC\Controller;

use Caio\MVC\Entity\Curso;
use Caio\MVC\Helper\FlashMessageTrait;
use Caio\MVC\Infra\EntityManagerCreator;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Persistencia implements RequestHandlerInterface
{
    use FlashMessageTrait;

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;    
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $queryString = $request->getParsedBody();
        $descricao = filter_var($queryString['descricao'],FILTER_SANITIZE_STRING);
        $curso = new Curso();
        $curso->setDescricao($descricao);
        $queryString = $request->getQueryParams();
        $id = filter_var($queryString['id'],FILTER_VALIDATE_INT);

        if ( !is_null($id) && $id !== false ) {
            $curso->setId($id);
            $this->entityManager->merge($curso);
            $this->defineMensagem('success','Curso atualizado com sucesso');
        }else{
            $this->entityManager->persist($curso);
            $this->defineMensagem('success','Curso cadastrado com sucesso');
        }

        $this->entityManager->flush();
        return new Response(302,['Location'=>'/listar-cursos']);
    }
}