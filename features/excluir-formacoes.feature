#language: pt
Funcionalidade: Excluir Formação
  Eu como instrutor
  Quero poder excluir uma formação
  Para poder organizar a minha lista de formações

  @e2e
  Cenario: Excluir formação existente
    Dado estou em "/login"
    Quando preencho "email" com "caiorodrigues9@gmail.com"
    E preencho "senha" com "123456"
    E pressiono "Entrar"
    E sigo o link "Formações"
    E sigo o link "Nova Formação"
    E preencho "descricao" com "PHP na web"
    E pressiono "Salvar"
    Quando sigo o link "Excluir"
    Entao devo ver "Formação excluída com sucesso"
