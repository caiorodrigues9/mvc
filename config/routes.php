<?php

use Caio\MVC\Controller\{
    Exclusao,
    FormularioEdicao,
    FormularioInsercao, 
    ListarCursos,
    Persistencia
};


return [
    '/listar-cursos' => ListarCursos::class,
    '/novo-curso' => FormularioInsercao::class,
    '/salvar-curso' => Persistencia::class,
    '/excluir-curso' => Exclusao::class,
    '/atualizar-curso' => FormularioEdicao::class
];