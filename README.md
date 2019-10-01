# Mix App Skeleton

Este projeto tem o intuito de ser utilizado como base para a criação de outros projetos da empresa.


## Requisitos

- PHP >= 5.6
- Database (MySql, Percona ou MariaDB)
- Webserver (Apache2 ou Nginx)
- NodeJS + NPM (frontend)


## Tecnologias

- [Kohana 3.3.6][1]
- [Mix Core][2]
- [Symfony][3]
- [Doctrine][4]
- [Yarn][9]
- [Webpack][10]
- [VueJs][12]

A estrutura deste projeto utiliza o framework Kohana como base, para organização dos diretórios e arquivos de configuração, assim como para implementação do frontend (views) e mapa de rotas.

O sistema administrativo é criado com base no módulo admin e nas bibliotecas do [Mix Core][5], que controlam a exibição e criação de menus automaticamente, utilizando controle de acesso por tipos de usuário e habilitando um sistema de CRUD padrão para toda a aplicação.
Todo o comportamento do sistema administrativo é definido a partir do arquivo de configuração `app/modules/<MODULE_NAME>/config/<MODULE_NAME>.php`.


## Permissões de acesso

Antes de prosseguir é necessário criar uma chave [OAuth consumer][6] em sua conta pessoal, para ter permissão de clonar os repositórios privados da empresa via composer.

Para isso, basta seguir [o guia][6] e criar uma chave contendo, no mínimo, uma _url de callback_ e _**permissão de leitura** de repositório_.


## Instalação

```
# Clone este repositório
git clone git@bitbucket.org:mixinternet/mix-skeleton.git

# Atualize a referência do repositório com a url do seu projeto
$ git remote set-url origin git@bitbucket.org:mixinternet/NEW_REPOSITORY.git

# instale as dependências backend do projeto
$ composer install --prefer-dist --no-interaction

# instale as dependências frontend do projeto
$ yarn install

# compile os assets da aplicação
$ yarn dev # development
$ yarn build # production

# configure as credenciais do database em application/config/.env
$ cp application/config/.env.default application/config/.env

# Execute as migrações de instalação do banco de dados (no root do projeto)
$ php minion migrations:migrate

# instala um usuário padrão
$ php minion migrations:seed
```

## Sugestões de dependências (Frontend)

```sh
$ yarn add @fortawesome/fontawesome \
    @fortawesome/vue-fontawesome \
    @glidejs/glide @glidejs/vue-glide \
    axios \
    bootstrap-vue \
    headroom.js \
    lightgallery \
    lodash \
    vee-validate \
    vue \
    vue-headroom \
    vue-notification \
    vue-router \
    vue-scrollto \
    vue-youtube-embed \
    vuejs-paginate \
    vuex
```

## Exemplo de configuração do Apache
```
<VirtualHost *:80>
  ServerName local.mix-skeleton
  DocumentRoot /var/www/mix-skeleton/www/
  Options Indexes FollowSymLinks

  <Directory "/var/www/mix-skeleton/www/">
    AllowOverride All
    <IfVersion < 2.4>
      Allow from all
    </IfVersion>
    <IfVersion >= 2.4>
      Require all granted
    </IfVersion>
  </Directory>
</VirtualHost>

<VirtualHost *:443>
  ServerName local.mix-skeleton
  DocumentRoot /var/www/mix-skeleton/www/
  Options Indexes FollowSymLinks

  <Directory "/var/www/mix-skeleton/www/">
    AllowOverride All
    <IfVersion < 2.4>
      Allow from all
    </IfVersion>
    <IfVersion >= 2.4>
      Require all granted
    </IfVersion>
  </Directory>

</VirtualHost>
```

#### Crie uma configuração de host local para facilitar o acesso
```sh
$ sudo vim /etc/hosts


127.0.0.1   local.mix-skeleton
```

## acesse o projeto no browser

[local.mix-skeleton](local.mix-skeleton)

## acesse a área administrativa
[local.mix-skeleton/admix](local.mix-skeleton/admix)

Credenciais

- login: default
- senha: 1596321


## [Estrutura de diretórios][7]

### application

Armazena as configurações da aplicação, mensagens com internacionalização, logs, assim como toda a lógica de negócio.

#### bootstrap e config

configurações para cada parte da aplicação, carregadas em todas as requisições.

#### i18n

configurações de internacionalização do sistema.

#### views

arquivos _.php_ com as definições de layout e demais páginas da aplicação.


### modules

Partes da lógica de negócio da aplicação pode ser modularizada a fim de ser reaproveitada em outras aplicações.

Estes módulos podem possuir a mesma estrutura de diretórios do diretório _application_, não sendo obrigatório utilizar todos os recursos.

> Os modulos utilizados nos projetos da **Mix** utilizam uma estrutura de diretórios customizada, diferente da [sugerida pelo Kohana][8].


### system

Este diretório contem a aplicação core do Kohana e deve ser instalado automaticamente via GitSubmodules.

> Os códigos neste diretório NÃO deve ser alterados para evitar potenciais problemas. Em vez disso, sugira a modificação no repositório do projeto original ou faça um _fork_ do mesmo.


### vendor

Todas as dependências da aplicação devem ser carregadas com o composer e instaladas automaticamente neste diretório.


### src-assets

Código fonte dos assets da aplicação (_.less, .sass, .js_), assim como _fontes_ e _imagens_.


### www

Diretório final de arquivos estáticos à serem usados pela aplicação.

> Para um melhor fluxo de desenvolvimento e segurança da aplicação, os assets devem ser modificados SOMENTE no diretório _src-assets_ e compilados utilizando alguma ferramenta como: _Gulp_, _Grunt_ ou _Webpack_.
>
> Dessa forma, somente os arquivos utilizados pela aplicação são disponibilizados publicamente.


[1]: https://github.com/koseven/kohana
[2]: https://bitbucket.org/mixinternet/mix-core
[3]: https://github.com/symfony/symfony
[4]: http://www.doctrine-project.org/
[5]: https://bitbucket.org/mixinternet/mix-core
[6]: https://confluence.atlassian.com/bitbucket/oauth-on-bitbucket-cloud-238027431.html
[7]: https://v2docs.kohanaframework.org/3.3/guide/kohana/files
[8]: https://v2docs.kohanaframework.org/3.3/guide/kohana/modules
[9]: https://yarnpkg.com/lang/en/docs/install/
[10]: https://webpack.js.org
[11]: https://help.github.com/articles/changing-a-remote-s-url/
[12]: https://vuejs.org/
