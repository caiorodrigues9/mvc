<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Caio\MVC\Entity\Formacao;
use Caio\MVC\Infra\EntityManagerCreator;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Defines application features from the specific context.
 */
class FormacaoNoBanco implements Context
{
    private EntityManagerInterface $entityManager;
    private string $mensagemDeErro = '';
    private int $idDaFormacaoInserida;

    /**
     * @Given que estou conectado ao banco de dados
     */
    public function queEstouConectadoAoBancoDeDados()
    {
        $this->entityManager = (new EntityManagerCreator())->getEntityManager();
    }

    /**
     * @When tento salvar uma nova formação com a descrição :arg1
     */
    public function tentoSalvarUmaNovaFormacaoComADescricao(string $descricaoFormacao)
    {
        $formacao = new Formacao();
        $formacao->setDescricao($descricaoFormacao);

        $this->entityManager->persist($formacao);
        $this->entityManager->flush();
        $this->idDaFormacaoInserida = $formacao->getId();
    }

    /**
     * @Then se eu buscar no banco, devo encontar essa formação
     */
    public function seEuBuscarNoBancoDevoEncontarEssaFormacao()
    {
        $repositorio  = $this->entityManager->getRepository(Formacao::class);
        $formacao = $repositorio->find($this->idDaFormacaoInserida);
        return assert($formacao instanceof Formacao);
    }
}
