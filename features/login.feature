#language: pt
  Funcionalidade: login
    Descrição da funcionalidade

  @e2e
  Cenario: Realizar Login
    Dado estou em "/login"
    Quando preencho "email" com "caiorodrigues9@gmail.com"
    E preencho "senha" com "123456"
    E pressiono "Entrar"
    Entao devo estar em "/listar-cursos"