<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

Este projeto está sendo desenvolvido como parte da disciplina de Fábrica de Software, para uma fábrica de software que desenvolve aplicações para instituições educacionais. A fábrica necessita de um software para gerenciar suas tarefas e tem como objetivo criar uma ferramenta de monitoramento de atividades para equipes de desenvolvimento. A aplicação permite o gerenciamento de tarefas e o acompanhamento do progresso dos projetos utilizando o modelo Kanban, promovendo organização, produtividade e visibilidade em tempo real do fluxo de trabalho.
Usando linguagem de programação PHP com seu framework Laravel é para banco de dados MySql

## Requisitos

* PHP 8.2 ou superior
* Composer
* Node.js 20 ou superior<br>

## Como rodar o projeto baixado

Duplicar o arquivo ".env.example" e renomear para ".env".<br>
Alterar no arquivo .env as credenciais do banco de dados<br>

Instalar as dependências do PHP.
```
composer install
```

Instalar as dependências do Node.js.
```
npm install
```

Gerar a chave no arquivo .env.
```
php artisan key:generate
```

Executar as migration para criar a base de dados e as tabelas.
```
php artisan migrate
```

Iniciar o projeto criado com Laravel.
```
php artisan serve
```

Executar as bibliotecas Node.js.
```
npm run dev
```

Acessar o conteúdo do projeto no navegador.
```
http://127.0.0.1:8000
