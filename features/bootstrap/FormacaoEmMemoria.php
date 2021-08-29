<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Caio\MVC\Entity\Formacao;

class FormacaoEmMemoria implements Context
{
    private string $mensagemDeErro = '';
    private Formacao $formacao;

    /**
     * @When eu tentar criar uma formação com a descrição :arg1
     */
    public function euTentarCriarUmaFormacaoComADescricao(string $descricaoFormacao)
    {
        $formacao = new Formacao();
        try{
            $formacao->setDescricao($descricaoFormacao);
            $this->formacao = $formacao;
        }catch (\InvalidArgumentException $exception){
            $this->mensagemDeErro = $exception->getMessage();
        }
    }

    /**
     * @Then eu vou ver a seguinte mensagem de erro :arg1
     */
    public function euVouVerASeguinteMensagemDeErro(string $mensagemDeErro)
    {
        assert($mensagemDeErro === $this->mensagemDeErro);
    }

    /**
     * @Then eu devo ter uma formação criada com a descrição :arg1
     */
    public function euDevoTerUmaFormacaoCriadaComADescricao(string $descricaoFormacao)
    {
        assert($descricaoFormacao === $this->formacao->getDescricao());
    }
}