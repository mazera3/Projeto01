## Requisitos

* PHP 8.2 ou superior;
* MySQL 8 ou superior;
* Composer;
* Node.js 20 ou superior;
* sweetalert2
* chart.js
* react-chartjs-2
* git
* laravel-pt-BR-localization

## Como rodar o projeto baixado
Criar o projeto com Laravel
```
composer create-project laravel/laravel .
```
Instalar o Breeze.
```
composer require laravel/breeze --dev
```
Publicar a autenticação, rotas, controladores e outros recursos para a aplicação.
```
php artisan breeze:install
```
* Selecionar React com Breeze, digitar "react".
* Selecionar recurso opcional, digitar "dark".
* Selecionar o Framework de teste, digitar "1". (PHPUnit)

Executar as migration para criar a base de dados e as tabelas.
```
php artisan migrate
```
Instalar as dependências do Node.js.
```
npm install
```
Executar as bibliotecas Node.js.
```
npm run dev
```
Iniciar o projeto criado com Laravel.
```
php artisan serve
```
Acessar no navegador a URL.
```
http://127.0.0.1:8000
```

## Como rodar o projeto baixado

* Duplicar o arquivo ".env.example" e renomear para ".env".
* Alterar no arquivo .env as credenciais do banco de dados.
* Alterar no arquivo .env as credenciais do servidor de envio de e-mail.

```
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=nome_usuario_mailtrap
MAIL_PASSWORD=senha_usuario_mailtrap
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="atendimento@celke.com.br"
MAIL_FROM_NAME="${APP_NAME}"
```
Servidor Iagente: https://login.iagente.com.br/solicitacao-conta-smtp/origin/celke<br>
Configurar DNS da Iagente: https://celke.com.br/artigo/como-configurar-o-dns-da-iagente-na-vps-da-hostinger
```
MAIL_MAILER=smtp
MAIL_HOST=smart.iagentesmtp.com.br
MAIL_PORT=587
MAIL_USERNAME=nome_do_usuario_na_iagente
MAIL_PASSWORD=senha_do_usuario_na_iagente
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="atendimento@celke.com.br"
MAIL_FROM_NAME="${APP_NAME}"
```
Instalar as dependências do PHP.
```
composer install
```
Instalar as dependências do Node.js.
```
npm install
```
Gerar a chave.
```
php artisan key:generate
```
Executar as migration para criar a base de dados e as tabelas.
```
php artisan migrate
```
## Executar as seed para cadastrar registro de teste.

```
php artisan make:seeder NomeDaSeeder
```
```
php artisan make:seeder UserSeeder
```
```
php artisan db:seed
```
```
Usuário: cesar@celke.com.br
```
```
Senha: 123456A#
```
##  Iniciar a aplicação

Iniciar o projeto criado com Laravel.
```
php artisan serve
``
Executar as bibliotecas Node.js.
```
npm run dev
```
Acessar no navegador a URL.
```
```
http://127.0.0.1:8000
```

## Como usar o GitHub
Baixar os arquivos do Git
```
git clone --branch <branch_name> <repository_url> .
```
```
git clone -b dev-master <repository_url> .
```
Definir as configurações do usuário.
```
git config --local user.name Cesar
```
```
git config --local user.email cesar@celke.com.br
```
Verificar em qual branch está.
```
git branch 
```
Baixar as atualizações.
```
git pull
```
Adicionar todos os arquivos modificados no staging area - área de preparação.
```
git add .
```

commit representa um conjunto de alterações em um ponto específico da história do seu projeto, registra apenas as alterações adicionadas ao índice de preparação.
O comando -m permite que insira a mensagem de commit diretamente na linha de comando.
```
git commit -m "Descrição do commit"
```
Enviar os commits locais, para um repositório remoto.
```
git push <remote> <branch>
```
```
git push origin dev-master
```
## Todos em um unico comanto
```
git pull && git add . && git commit -m "Inicio do Projto01." && git push origin projeto01
```
##
```
git remote add origin git@github.com:mazera3/projeto01.git
git branch -M main
git push -u origin main
```
## trocar favicon

## Traduzir para o portugues

* Login.jsx
* Register.jsx
* ForgotPassword.jsx
* Welcome.jsx

Instalar a extensão:
```
https://github.com/lucascudo/laravel-pt-BR-localization
```
## Alterar a página Home

## Alterar o layout da páginas

* Login.jsx
* Register.jsx
* ForgotPassword.jsx
* GuestLayout.jsx
* criar logo svg com chatGPT
* ApplicationLogo.jsx
* PrimaryButton.jsx
* TextInput.jsx

## Criar o layout do sistema administrativo
 * cria um novo diretório: AuthenticatedLayout
 * cria novos arquivos: Sidebar.jsx e Navbar.jsx

## Criar a rota listar usuários
* Criar rota /users (routes/web.php)
* Comando: php artisan make:controller UserController
* Criar método index() em UserController (App\Http\Controllers\UserController)
* Criar a wieview em resources/js/Pages/Users/UserIndex.jsx
* Adicionar a rota /users no Sidebar

## Criar botão como componente
* Diretório:  resources/js/Components/Button
* PrimaryButton.jsx
* SuccessButton.jsx
* SecondaryButton.jsx
* WarningButton.jsx
* DangerButton.jsx

## Listar os usuários com Laravel e React

* Populacionar base de dados: database/seeders/UserSeeders.php
* Editar UserController.php
* Editar UserIndex.jsx, usar chave unica key={user.id}

## Criar paginação com Laravel e React
* criar o componente resources/js/Components/Pagination.jsx
* incluir no arquivo UserIndex.jsx
* editar UserController.php

## Criar a página visualizar usuário com Laravel e React
* criar a rota em: routes/web.php
* criar o método show() em: Http/Controller/UserController.php
* criar a página UserShow.jsx
* acrescentar linke em UserIndex.jsx

## Formulário para cadastrar usuário
* criar a rota em: routes/web.php
* criar o método create() em: Http/Controller/UserController.php
* criar a página UserCreate.jsx

## Cadastrar usuário no banco de dados
* criar constant para receber os dados do formulário
* criar constant para enviar os dados para a rota cadastrar através do método POST
* criar funções no UserCreate.jsx
* cria a rota users.store no arquivo web.php
* criar método store em UserController.php
* editar o arquivo Http/Middleware/HandleInertiaRequests.php

## Validar formulário com Laravel
* editar o arquivo Http/Controller/UserController.php
* aplicar a função do laravel validate()
* https://laravel.com/docs/11.x/validation#working-with-validated-input
* personalizar mensagens de erros em UserController.php

## Criar o formulário editar usuário
* criar as rotas em: routes/web.php
* criar os métodos edit() e update() em: Http/Controller/UserController.php
* editar o arquivo UserIndex.jsx
* criar o arquivo UserEdit.jsx

## Botão para apagar usuário
* criar as rotas em: routes/web.php
* criar o método destroy() em: Http/Controller/UserController.php
* editar o arquivo UserIndex.jsx

## Apresentar SweetAlert2 para confirmar a exclusão
* npm install sweetalert2
* https://sweetalert2.github.io/#examples
* editar o arquivo UserIndex.jsx

## Componente SweetAlert2 para confirmar a exclusão
* criar componente em: resources/js/Components/Alert/AlertMessage.jsx
* criar componente em: resources/js/Components/Delete/ConfirmDeleteBotton.jsx

## Armazenar as alterações em um diretório de trabalho, limpar a lista de stash, buscar e integre-se a outro repositório
```
git stash
git stash drop
git pull
```
## Componente com as mensagens de alerta
* criar componente em: resources/js/Components/Alert/AlertMessage.jsx
* editar o arquivo Http/Middleware/HandleInertiaRequests.php

## Criar o arquivo gitignore para ignorar arquivo e não enviar para o GitHub

## Formulário para pesquisar usuário
* implementar em resources/js/Pages/Users/UserIndex.jsx

## Pesquisar usuário no banco de dados
* implementar em resources/js/Pages/Users/UserIndex.jsx

## Recupera arquivo deletado do git
* git checkout HEAD README.md
* https://recoverit.wondershare.com.br/file-recovery/recover-files-from-local-repository-git.html

## Gerar PDF
* https://github.com/barryvdh/laravel-dompdf
* ediatr o arquivo UserIndex.jsx
* criar a rota: users.generate-pdf
* criar a controller: php artisan make:controller UserReportController
* criar o arquivo resources/views/users/generatePdf.blade.php
* php artisan make:view "/users/GeneratePdf"

## Gerar PDF da pesquisa
* editar a classe UserReportController
* criar a função: handleGeneratePdf em UserIndex.jsx

## Gerar CSV
* criar rota em web.php
* criar método generateCsv em UserReportController
* editar arquivo UserIndex.jsx

## Apresentar e ocultar a senha no formulario
* PAGINA: https://cdnjs.com/libraries/font-awesome
* CDN: https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css
* adicionar o css do CDN no arquivo app.blade.php
* editar o arquivo resource/js/Auth/Register.jsx
* ICONES: https://fontawesome.com/icons

## Limitar a quantidade de registros no PDF e CSV
* editar o UserReportController
* editar o arquivo UserIndex.jsx

## Recuperar informações do banco de dados para o gráfico
* editar a rota em web.php
* criar a controller: php artisan make:controller DashboardController
* popular base de dados: editar UserSeeder.php e executar: php artisan db:seed

## Criar gráfico de barra
* ediatar Dashboard
* criar o componente Chart/BarChartUsers.jsx
* Instalar a biblioteca Chart.js: https://www.chartjs.org/docs/latest/
* npm i react-chartjs-2 chart.js: https://www.npmjs.com/package/react-chartjs-2
* OU npm install chart.js react-chartjs-2

## Criar gráfico de linha
* criar o componente Chart/LineChartUsers.jsx

## Merge - Mesclar arquivos de uma branch para outra
* Criar uma nova branch
```
git checkout -b <nome-branch>
```
```
git checkout -b main
```
* alterar de branch
```
git switch <nome-branch>
```
```
git switch dev-master
```
* Mesclar o histórico de commits de uma branch em outra branch
```
git merge <nome-branch-origem>
```
```
git merge dev-master
```
```
git push origin main
```
# excluir um branch no local
git branch -d nomeDoBranchLocal

# excluir um branch remoto
git push origin --delete nomeDoBranchRemoto

## Iniciar o projeto com php no windows sem apache.
* php -S localhost:8000 -t public
* npm run dev

# Avançando no Projeto
## criar um controller com o Artisan (em app/Http/Controllers)
```
php artisan make:controller MeuController
```
## criar um modelo via Artisan (em app/Http/Models)
```
php artisan make:model MeuModel
```
## Criando rotas (routes/web.php, método estático get, objeto Routes)
```
Route::get('/', function(){
  return 'Olá  Mundo';
});
```
