<?php

namespace Caio\MVC\Controller;

use Caio\MVC\Helper\RenderizadorDeHtmlTrait;

class FormularioLogin implements InterfaceControladorRequisicao
{
    use RenderizadorDeHtmlTrait;

    public function processaRequisicao(): void
    {
        echo $this->renderizaHtml('login/formulario.php',[
            'titulo' => 'Login'
        ]);
    }
}