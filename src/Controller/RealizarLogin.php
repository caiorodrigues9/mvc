<?php

namespace Caio\MVC\Controller;

use Caio\MVC\Entity\Usuario;
use Caio\MVC\Infra\EntityManagerCreator;

use Doctrine\ORM\EntityRepository;

class RealizarLogin implements InterfaceControladorRequisicao
{
    private EntityRepository $entityRepository;

    public function __construct()
    {
        $this->entityRepository = (new EntityManagerCreator())->getEntityManager()->getRepository(Usuario::class);
    }

    public function processaRequisicao(): void
    {
        $email = filter_input(
            INPUT_POST,
            'email',
            FILTER_VALIDATE_EMAIL
        );
        $senha = filter_input(
            INPUT_POST,
            'senha',
            FILTER_SANITIZE_STRING
        );

        if(is_null($email) || $email === false) {
            echo "E-mail Invalido";
            return;
        }
        $usuario = $this->entityRepository->findOneBy(['email' => $email]);
        if (is_null($usuario) || !$usuario->senhaEstaCorreta($senha)) {
            echo "E-mail ou senha invalidos";
            return;
        }
        header('Location: /listar-cursos');
        
    }
}