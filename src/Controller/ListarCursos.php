<?php

namespace Caio\MVC\Controller;

use Caio\MVC\Entity\Curso;
use Caio\MVC\Helper\RenderizadorDeHtmlTrait;
use Caio\MVC\Infra\EntityManagerCreator;

class ListarCursos implements InterfaceControladorRequisicao
{
    use RenderizadorDeHtmlTrait;
    
    private $repositorioDeCursos;

    public function __construct()
    {  
        $entityManager = (new EntityManagerCreator())->getEntityManager();
        $this->repositorioDeCursos = $entityManager->getRepository(Curso::class);
        
    }

    public function processaRequisicao(): void
    {
        
        echo $this->renderizaHtml('cursos/listar-cursos.php',[
            'titulo' => "Lista de Cursos",
            'cursos' => $this->repositorioDeCursos->findAll()
        ]);
    }
}