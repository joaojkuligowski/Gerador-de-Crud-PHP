# Teste para a Vaga de Programador PHP (ECG)

Um sistema simples para controle de veículos, motoristas e ocorrências de utilização de veículos. 

DEMO: http://93.190.137.139:8155/testeecg/
Usuário: demo
Senha: demo

## Instalação ##

`git clone https://github.com/joaojkuligowski/testeecg.git
cd testeecg
composer install
composer dumpautoload
cp .env_example .env`

Editar Arquivo .env inserindo seu banco de dados

## Criar as tabelas e semear com alguns dados falsos ##

`composer criar-database`

Rodar Servidor

`composer servidor`

Acesse: localhost:8001 ou clone o repositório em seu apache em seu apache (Requer php  >= 8.0, Mcrypt, Pdo e Mbstring)

## Criando um crud ##
- Crie uma tabela no banco de dados
- Faça as traduções do frontend necessárias em app/Label.php (Exemplo, se a tabela for cadastros, traduza para Cadastros, pois é o que vai aparecer no menu)
- Caso precise alterar o comportamento de algum campo do crud (Ou do formulário como um todo), altere o arquivo /assets/js/scripts.js e /app/helpers/crud.php

## Características ##

- *Criação automática de CRUD*: Ao criar uma nova tabela no banco de dados, automaticamente é criado também um crud para aquela tabela no frontend da aplicação, caso precise modificar alguma característica do crud gerado, é possível modificar o arquivo assets/js/scripts.js 
- *Leve*: Pouquíssimas Dependências
- *Adaptável*!