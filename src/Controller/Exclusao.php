<?php

namespace Caio\MVC\Controller;

use Caio\MVC\Entity\Curso;
use Caio\MVC\Helper\FlashMessageTrait;
use Caio\MVC\Infra\EntityManagerCreator;
use Doctrine\ORM\EntityManagerInterface;

class Exclusao implements InterfaceControladorRequisicao
{
    use FlashMessageTrait;

    private EntityManagerInterface $entityManager;

    public function __construct()
    {
        $this->entityManager = (new EntityManagerCreator())->getEntityManager();
    }

    public function processaRequisicao(): void
    {
        $id = filter_input(
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT
        );

        if (is_null($id) || $id === false) {
            $this->defineMensagem('danger',"Curso invalido");
            header('Location: /listar_cursos');
            return;
        }

        $curso = $this->entityManager->getReference(Curso::class,$id);
        $this->entityManager->remove($curso);
        $this->entityManager->flush();

        $this->defineMensagem('success','Curso Excluído com sucesso');

        header('Location: /listar-cursos', true, 302);
    }
}