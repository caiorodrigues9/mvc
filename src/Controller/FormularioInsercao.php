<?php

namespace Caio\MVC\Controller;

use Caio\MVC\Helper\RenderizadorDeHtmlTrait;

class FormularioInsercao implements InterfaceControladorRequisicao
{
    use RenderizadorDeHtmlTrait;

    public function processaRequisicao():void
    {
        echo $this->renderizaHtml('cursos/formulario.php',[
            'titulo' => "Novo Curso"
        ]);
    }
}