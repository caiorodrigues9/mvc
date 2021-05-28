<?php

namespace Caio\MVC\Controller;

use Caio\MVC\Entity\Curso;
use Caio\MVC\Infra\EntityManagerCreator;
use Doctrine\Persistence\ObjectRepository;

class FormularioEdicao extends ControllerComHtml implements InterfaceControladorRequisicao
{
    private ObjectRepository $repositoryCurso;

    public function __construct()
    {
        $this->repositoryCurso = (
                new EntityManagerCreator()
            )->getEntityManager()
            ->getRepository(Curso::class);
    }

    public function processaRequisicao(): void
    {
        $id = filter_input(
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT
        );

        if ( is_null($id) || $id === false ) {
            header('Location: /listar-cursos');
            return;
        }

        $curso = $this->repositoryCurso->find($id);
        
        echo $this->renderizaHtml('cursos/formulario.php',[
            'curso' => $curso,
            'titulo'=>"Alterar Curso ".$curso->getDescricao()
        ]);
    }
}