Projeto para avaliação da Altran

Tecnologias
-PHP OO
-Javascript
-Jquery 3.3
-HTML5
-CSS3
-Bootstrap 4.1.3
-MYSQL

O sistema terá 3 níveis de usuários (cliente, médico e atendente)

+Cadastro
Ao cadastrar, o usuário irá escolher qual o nível de usuário ele terá
Foi feito assim para evitar a criação de um master responsável por cadastrar os níveis ou os usuário dos níveis mais altos

+Eventos (usuário)
Como o teste afirmar que o usuário só poderá cadastrar nos data permitidas-
Tomei como regra de negócio um consultório que funciona todos os dias das 9:00 às 14:30
Assim os outros horário não são permitidos

+LIBs
Lib Fullcalendar.js usada para controlar os eventos
Lib Moment.js e Datetimepicker.js para formação das data e uso do calendário inline
Lib Jquery usada para manipular funções e interação com as páginas

+CRUD
As interações com o banco de dados estão sendo feitas via AJAX

+Médicos e Atendentes
Ambos estão tendo acesso as mesmas funções
Toda interação do usuário com os eventos estão sendo notificadas através do menu Notificações

+Layout
Bootstrap usado para deixa o layout adaptável

+Registros
Alguns registros foi deixados no banco de dados para facilitar os testes
