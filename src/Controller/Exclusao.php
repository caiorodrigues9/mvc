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

class Exclusao implements RequestHandlerInterface
{
    use FlashMessageTrait;

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $queryString = $request->getQueryParams();
        $id = filter_var($queryString['id'],FILTER_VALIDATE_INT);

        if (is_null($id) || $id === false) {
            $this->defineMensagem('danger',"Curso invalido");
            return new Response(404,['Location'=>'/listar-cursos']);
        }

        $curso = $this->entityManager->getReference(Curso::class,$id);
        $this->entityManager->remove($curso);
        $this->entityManager->flush();

        $this->defineMensagem('success','Curso Excluído com sucesso');

        return new Response(302,['Location'=>'/listar-cursos']);
    }
}