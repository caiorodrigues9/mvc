<?php

namespace Caio\MVC\Controller;

use Caio\MVC\Entity\Usuario;
use Caio\MVC\Helper\FlashMessageTrait;
use Caio\MVC\Infra\EntityManagerCreator;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RealizarLogin implements RequestHandlerInterface
{
    use FlashMessageTrait;
    
    private EntityRepository $entityRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityRepository = $entityManager->getRepository(Usuario::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $queryString = $request->getParsedBody();

        $email = filter_var($queryString['email'],FILTER_VALIDATE_EMAIL);
        $senha = filter_var($queryString['senha'],FILTER_SANITIZE_STRING);
        
        if (is_null($email) || $email === false) {
            $this->defineMensagem('danger',"O e-mail digitado não é um e-mail válido");
            return new Response(302,['Location'=>'/login']);
        }

        $usuario = $this->entityRepository->findOneBy(['email' => $email]);
        if (is_null($usuario) || !$usuario->senhaEstaCorreta($senha)) {
            $this->defineMensagem('danger',"E-mail ou senha inválidos");
            return new Response(302,['Location'=>'/login']);
        }

        $_SESSION['logado'] = true;


        return new Response(302,['Location'=>'/listar-cursos']);
    }
}
