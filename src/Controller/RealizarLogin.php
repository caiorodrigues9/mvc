<?php

namespace Caio\MVC\Controller;

use Caio\MVC\Entity\Usuario;
use Caio\MVC\Helper\FlashMessageTrait;
use Caio\MVC\Infra\EntityManagerCreator;

use Doctrine\ORM\EntityRepository;

class RealizarLogin implements InterfaceControladorRequisicao
{
    use FlashMessageTrait;
    
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

        if (is_null($email) || $email === false) {
            $this->defineMensagem('danger',"O e-mail digitado não é um e-mail válido");
            header('Location: /login');
            exit();
        }

        $usuario = $this->entityRepository->findOneBy(['email' => $email]);
        if (is_null($usuario) || !$usuario->senhaEstaCorreta($senha)) {
            $this->defineMensagem('danger',"E-mail ou senha inválidos");
            header('Location: /login');
            return;
        }

        $_SESSION['logado'] = true;


        header('Location: /listar-cursos');
    }
}
