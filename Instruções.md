# Requisitos

Para o desenvolvimento dos projetos, é necessário ter o ambiente de desenvolvimento configurado com as seguintes tecnologias:

- PHP >= 5.6
- Database (MySql, Percona ou MariaDB)
- Webserver (Apache2 ou Nginx)
- NodeJS + NPM (frontend)

Para facilitar a instalação, recomendo utilizar uma máquina virtual que já dispõe de todas as tecnologias instaladas e prontas para uso.
Caso prefira utilizar um bundle específico no windows como o MAMP, fique à vontade.

Segue os links para download das tecnologias de configuração do ambiente de desenvolvimento.

- [Laradock](https://laradock.io/getting-started/)
- [Vagrant](https://www.vagrantup.com/downloads.html)
- [Virtual Box](https://www.virtualbox.org/wiki/Downloads)
- [Homestead](https://laravel.com/docs/5.7/homestead)


# Sobre o projeto

No `README.md` do projeto há uma descrição sobre a arquitetura do mix-skeleton.

Em resumo, todos os projetos são divididos em módulos, e cada módulo possui a mesma característica de configuração e organização dos direórios que a aplicação principal.

Neste projeto, o módulo `/mix-skeleton/modules/pages` é um bom exemplo de integração de módulo e um bom ponto de partida para conhecer a arquitetura.

# Instalação

Após instalar e configurar o ambiente de desenvolvimento, acesse o projeto e instale as dependências.

> Obs.: Já incluí as bibliotecas do backend instaladas pois a maioria dos repositórios são privados e você não conseguiria instalar.

```
composer install # ignore este comando
npm install

vagrant ssh # ou docker-compose exec workspace bash

cd www/mix-skeleton
php minion migrations:migrate
php minion migrations:seed
```

Acesse, `http://local.mix-skeleton.com.br` para o site e `http://local.mix-skeleton.com.br/admix` para o painel admin.

Credenciais de acesso:

> user: default
>
> pass: 1596321