# SoftPar ToDo List

**Descrição breve:**  
Este projeto é uma aplicação **To-Do List** desenvolvida com **Laravel** no backend e **Quasar**, **Vue.js** e **Node.js** no frontend. O objetivo é permitir aos usuários criar, editar, concluir e excluir tarefas de forma simples e eficiente.

## Sumário
1. [Descrição do Projeto](#descrição-do-projeto)
2. [Tecnologias Utilizadas](#tecnologias-utilizadas)
3. [Requisitos](#requisitos)
4. [Configuração do Ambiente](#configuração-do-ambiente)
5. [Comandos para Executar o Backend](#comandos-para-executar-o-backend)
6. [Configuração do Banco de Dados](#configuração-do-banco-de-dados)
7. [Comandos para Executar o Frontend](#comandos-para-executar-o-frontend)
8. [Funcionalidades Extras](#funcionalidades-extras)
9. [Links Importantes](#links-importantes)

---

## Descrição do Projeto

O **SoftPar ToDo List** é um sistema de gerenciamento de tarefas (To-Do List) que permite aos usuários adicionar, editar, concluir e excluir tarefas. O projeto é dividido em duas partes:

- **Backend (Laravel)**: Responsável por fornecer as APIs para CRUD (criar, ler, atualizar, excluir) das tarefas.
- **Frontend (Quasar/Vue.js)**: Interface do usuário, onde o usuário pode interagir com as tarefas.

---

## Tecnologias Utilizadas

- **Backend**:
  - **PHP**: Linguagem de programação
  - **Laravel**: Framework PHP para backend
  - **PostgreSQL**: Banco de dados relacional
  - **Composer**: Gerenciador de dependências PHP

- **Frontend**:
  - **Node.js**: Ambiente de execução JavaScript
  - **Vue.js**: Framework JavaScript para construção de interfaces
  - **Quasar Framework**: Framework Vue.js para construção de UIs responsivas e SPA (Single Page Application)
  - **NPM**: Gerenciador de pacotes JavaScript

---

## Requisitos

### Backend (Laravel):
- **PHP**: 7.x ou superior (recomenda-se a versão 8.x ou superior)
- **Composer**: 2.x ou superior
- **PostgreSQL**: Versão 12.x ou superior

### Frontend (Quasar/Vue.js/Node.js):
- **Node.js**: Versão 16.x ou superior
- **NPM**: Versão 8.x ou superior

---

## Configuração do Ambiente

### 1. Clonar o Repositório

Clone o repositório do projeto para sua máquina local usando o comando `git clone`.

### 2. Instalar Dependências

#### Backend (Laravel)

1. Navegue até a pasta do backend.
```bash
git clone https://github.com/off-jpedro/SoftPar-ToDoList.git
```

2. Instale as dependências PHP com o Composer.
```bash
composer install
```

#### Frontend (Quasar/Vue.js/Node.js)

1. Navegue até a pasta do frontend.
```bash
cd SoftPar-ToDoList/front-view
```
3. Instale as dependências JavaScript com o NPM.
```bash
npm install
```
---

## 3. Configuração do Banco de Dados

#### Backend (Laravel)

1. Crie o arquivo `.env` copiando o arquivo `.env.example`.
2. Abra o arquivo `.env` e configure as informações do banco de dados PostgreSQL, como `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`.

---

## 4. Rodar as Migrações

#### Backend (Laravel)

1. Execute as migrações para criar as tabelas necessárias no banco de dados PostgreSQL.
```bash
php artisan migrate
```
3. Caso queira rodar seeders (dados iniciais), execute o comando de seeders.
```bash
php artisan db:seed
```
5. Se necessário, gere a chave de aplicação.
```bash
php artisan key:generate
```

---

## 5. Executar o Projeto

#### Backend

1. Para rodar o servidor do Laravel, use o comando de execução do servidor.
```bash
php artisan serve
```

#### Frontend

1. Para rodar o servidor de desenvolvimento do Quasar, use o comando de desenvolvimento do Quasar.
```bash
quasar dev
```
---

Agora o seu projeto está pronto para ser utilizado! 🎉

---

## Links Importantes:

- [Repositório Backend no GitHub](https://github.com/off-jpedro/SoftPar-ToDoList/tree/master/backEnd)
- [Repositório Frontend no GitHub](https://github.com/off-jpedro/SoftPar-ToDoList/tree/master/front-view)
