<?php

namespace Caio\MVC\Controller;

class Deslogar implements InterfaceControladorRequisicao
{
    public function processaRequisicao(): void
    {
        session_destroy();
        header('Location: /login');
    }
}