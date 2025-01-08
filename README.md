SoftPar ToDo List
Descrição breve:
Este projeto é uma aplicação To-Do List desenvolvida com Laravel no backend e Quasar, Vue.js e Node.js no frontend. O objetivo é permitir aos usuários criar, editar, concluir e excluir tarefas de forma simples e eficiente.

Sumário
Descrição do Projeto
Tecnologias Utilizadas
Requisitos
Configuração do Ambiente
Comandos para Executar o Backend
Configuração do Banco de Dados
Comandos para Executar o Frontend
Funcionalidades Extras
Descrição do Projeto
O SoftPar ToDo List é um sistema de gerenciamento de tarefas (To-Do List) que permite aos usuários adicionar, editar, concluir e excluir tarefas. O projeto é dividido em duas partes:

Backend (Laravel): Responsável por fornecer as APIs para CRUD (criar, ler, atualizar, excluir) das tarefas.
Frontend (Quasar/Vue.js): Interface do usuário, onde o usuário pode interagir com as tarefas.
Tecnologias Utilizadas
Backend:
PHP: Linguagem de programação
Laravel: Framework PHP para backend
PostgreSQL: Banco de dados relacional
Composer: Gerenciador de dependências PHP
Frontend:
Node.js: Ambiente de execução JavaScript
Vue.js: Framework JavaScript para construção de interfaces
Quasar Framework: Framework Vue.js para construção de UIs responsivas e SPA (Single Page Application)
NPM: Gerenciador de pacotes JavaScript
Requisitos
Backend (Laravel):
PHP: 7.x ou superior (recomenda-se a versão 8.x ou superior)
Composer: 2.x ou superior
PostgreSQL: Versão 12.x ou superior
Frontend (Quasar/Vue.js/Node.js):
Node.js: Versão 16.x ou superior
NPM: Versão 8.x ou superior
Configuração do Ambiente
1. Clonar o Repositório
Clone o repositório do projeto para sua máquina local:

bash
Copy code
git clone https://github.com/off-jpedro/SoftPar-ToDoList.git
2. Instalar Dependências do Backend (Laravel)
Navegue até a pasta do backend e instale as dependências PHP com o Composer:

bash
Copy code
cd SoftPar-ToDoList/backEnd
composer install
3. Instalar Dependências do Frontend (Quasar/Vue.js/Node.js)
Navegue até a pasta do frontend e instale as dependências JavaScript com o NPM:

bash
Copy code
cd SoftPar-ToDoList/front-view
npm install
Comandos para Executar o Backend
1. Rodar o Servidor de Desenvolvimento do Backend
Para rodar o servidor do Laravel, use o comando:

bash
Copy code
cd SoftPar-ToDoList/backEnd
php artisan serve
O servidor será executado em http://localhost:8000.

2. Rodar as Migrações do Banco de Dados
Execute as migrações para criar as tabelas necessárias no banco de dados PostgreSQL:

bash
Copy code
php artisan migrate
3. Rodar Seeders (opcional)
Se houver dados iniciais para popular o banco, execute o comando:

bash
Copy code
php artisan db:seed
4. Gerar Chave de Aplicação
Caso necessário, gere a chave da aplicação com:

bash
Copy code
php artisan key:generate
Configuração do Banco de Dados
Criar o arquivo .env: O Laravel usa o arquivo .env para configurar as variáveis de ambiente. Crie o arquivo copiando o arquivo .env.example:

bash
Copy code
cp .env.example .env
Configuração do Banco de Dados PostgreSQL: Abra o arquivo .env e configure as informações do banco de dados:

makefile
Copy code
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=nome_do_banco
DB_USERNAME=usuario
DB_PASSWORD=senha
Rodar as Migrações: Para rodar as migrações e preencher o banco com dados de teste (se houver seeders configurados):

bash
Copy code
php artisan migrate --seed
Comandos para Executar o Frontend
1. Rodar o Servidor de Desenvolvimento do Frontend (Quasar)
No diretório do frontend, execute o comando:

bash
Copy code
cd SoftPar-ToDoList/front-view
quasar dev
O servidor Quasar será iniciado em http://localhost:8080 (ou outro porto configurado).

2. Compilar a Aplicação para Produção
Para gerar a versão otimizada para produção:

bash
Copy code
quasar build
Funcionalidades Extras
Se você implementou funcionalidades extras, explique brevemente aqui, com instruções para utilizá-las:

Exemplo de Funcionalidade: Descrição da funcionalidade e como usá-la.
API: Se houver endpoints de API, liste os principais endpoints com exemplos de requisições e respostas.
Links Importantes:
Repositório Backend: GitHub - Backend
Repositório Frontend: GitHub - Frontend
