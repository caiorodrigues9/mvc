<?php

use Caio\MVC\Controller\{CursosEmJson,
    CursosEmXml,
    Deslogar,
    Exclusao,
    ExclusaoDeFormacao,
    FormularioEdicao,
    FormularioInsercao,
    FormularioInsercaoFormacao,
    FormularioLogin,
    ListaDeFormacoes,
    ListarCursos,
    PersistenciaCurso,
    PersistenciaFormacao,
    RealizarLogin};


return [
    '/listar-cursos' => ListarCursos::class,
    '/novo-curso' => FormularioInsercao::class,
    '/salvar-curso' => PersistenciaCurso::class,
    '/excluir-curso' => Exclusao::class,
    '/atualizar-curso' => FormularioEdicao::class,
    '/login' => FormularioLogin::class,
    '/realiza-login' => RealizarLogin::class,
    '/logout' => Deslogar::class,
    '/buscarCursosEmJson' => CursosEmJson::class,
    '/buscarCursosEmXml' => CursosEmXml::class,
    '/nova-formacao' => FormularioInsercaoFormacao::class,
    '/salvar-formacao' => PersistenciaFormacao::class,
    '/listar-formacoes' => ListaDeFormacoes::class,
    '/excluir-formacao' => ExclusaoDeFormacao::class,
];