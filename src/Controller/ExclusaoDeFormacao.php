<?php

namespace Caio\MVC\Controller;

use Caio\MVC\Entity\Formacao;

use Caio\MVC\Helper\FlashMessageTrait;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ExclusaoDeFormacao
{
    use FlashMessageTrait;

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $formacao = $this->entityManager
            ->getReference(
                Formacao::class,
                $request->getQueryParams()['id']
            );
        $this->entityManager->remove($formacao);
        $this->entityManager->flush();
        $this->defineMensagem(
            'success',
            'Formação excluída com sucesso'
        );

        return new Response(302, ['Location' => '/listar-formacoes']);
    }
}
