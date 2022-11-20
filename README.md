# Agenda de contatos

## Este é um projeto simples de um CRUD de uma agenda de contatos usando laravel 9 e Vue 3

## Como executar o projeto:
# Para o desenvolvimento do projeto, foram usadas as seguintes tecnologias
* npm 8.4.4
* node v17.7.1
* Composer versão 2.2.4
* Vue 3
* Vue/cli 5.0.8
* php 8.1.12
* Laravel 8.1.12
* Sqlite 3

## Para a execução do projeto
O arquivo .env.example contém tudo necessário a execução exceto a configuração do mailtrap descrita abaixo, crie um clone seu renomeado .env

```
composer install
php artisan migrate (necessário ter php-sqlite3)
npm install
```
# Envio de email
Para receber o email ao cadastrar um usuário, é necessário criar uma conta no mailtrap (https://mailtrap.io/home)
e adicionar a configuração disponível para laravel7+ ao arquivo .env
![Screenshot from 2022-11-20 18-38-06](https://user-images.githubusercontent.com/52075166/202927500-094a00a9-0a36-4240-a5da-b16617027a1b.png)

O modelo da configuração smtp foi cortado da imagem para não exibir o usuario e a senha, mas ele será fornecido inteiramente no seguinte modelo:

```
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
```

Importate falar que o processamento de emails está sendo feito na database, por isso atente-se ao 2 comando abaixo para que ocorra o processamento da fila dos emails

Agora com todas as dependencias instaladas, são necessários três terminais rodando os seguintes comandos
```
php artisan serve
php artisan queue:work
npm run dev
```

Para acessar o projeto, abra o link que o terminal aonde o servidor php está rodando disponibilizou

Com todos os passos executados corretamente, o programa já estara pronto para uso
