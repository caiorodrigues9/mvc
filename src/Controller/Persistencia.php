<?php

namespace Caio\MVC\Controller;

use Caio\MVC\Entity\Curso;
use Caio\MVC\Helper\FlashMessageTrait;
use Caio\MVC\Infra\EntityManagerCreator;
use Doctrine\ORM\EntityManagerInterface;

class Persistencia implements InterfaceControladorRequisicao
{
    use FlashMessageTrait;

    private EntityManagerInterface $entityManager;

    public function __construct()
    {
        $this->entityManager = (new EntityManagerCreator())->getEntityManager();    
    }

    public function processaRequisicao(): void
    {
        $descricao = filter_input(
            INPUT_POST,
            'descricao',
            FILTER_SANITIZE_STRING
        );
        $curso = new Curso();
        $curso->setDescricao($descricao);

        $id = filter_input(
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT
        );

        if ( !is_null($id) && $id !== false ) {
            $curso->setId($id);
            $this->entityManager->merge($curso);
            $this->defineMensagem('success','Curso atualizado com sucesso');
        }else{
            $this->entityManager->persist($curso);
            $this->defineMensagem('success','Curso cadastrado com sucesso');
        }

        $this->entityManager->flush();
        
        header('Location: /listar-cursos', true, 302);
    }
}