# Api Sistema Pontos Turísticos

## Composer

Primeira coisa necessária para instalar o laravel é o composer. Disponível em: https://getcomposer.org/download/

## PHP
O PHP necessário para rodar a versão 10 do laravel é o php versão 8.1. Disponível em: https://windows.php.net/download#php-8.1

## Laravel
Para instalar o laravel globalmente na sua máquina utilize o comando `composer global require laravel/installer`

## Rodando o projeto
Primeiro clone ele na sua máquina com o git. Necessário ter o git instalado. Disponível em: https://git-scm.com/
Para instalar as dependências e rodar o projeto em sua máquina segue um passo a passo: https://www.linkedin.com/pulse/clonando-e-configurando-um-reposit%C3%B3rio-laravel-jo%C3%A3o-manoel/
Necessário também instalar um banco de dados mysql.
Depois dessa etapa de configuração inicial só basta rodar o comando `php artisan serve`. A porta padrão da api é http://localhost:8000/api/v1/.
Para visualizar a documentação Swagger da API basta só entrar no domínio http://localhost:8000/docs/api. Essa Aplicação mostra todas as rotas disponíveis da API.
