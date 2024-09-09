# Açaiteria

![GitHub repo size](https://img.shields.io/github/repo-size/bielViccari/Rubiacai-oficial)
![GitHub language count](https://img.shields.io/github/languages/count/bielViccari/Rubiacai-oficial)
![GitHub forks](https://img.shields.io/github/forks/bielViccari/Rubiacai-oficial)

> Aplicação criada pensando em solucionar o dificil controle do negócio, tendo que fazer pedidos via whatsapp, demorando na resposta e na entrega da mercadoria.

### funcionalidades

O projeto se encontra concluido, porem com necessidades de refatoração:

- [x] CRUD de administrador
- [x] CRUD de produtos
- [x] CRUD de comentários
- [x] CRUD de categorias
- [x] Ativação e desativação do sistema 
- [x] Relacionamento de tabelas - produtos to categorias
- [x] Autenticação e autorização com Laravel Breeze


## 💻 Pré-requisitos

Antes de começar, verifique se você atendeu aos seguintes requisitos:

- PHP instalando >= 8.
- Composer instalado na máquina
- Node.js instalado na máquina para utilizar o npm.

## 🚀 Instalando a aplicação

Para instalar o sistema de açaiteria, siga estas etapas:

clone o projeto na sua máquina
```
git clone https://github.com/bielViccari/Rubiacai-oficial.git
```

vá até a pasta clonada
```
cd Rubiacai-oficial
```

execute o composer install
```
composer install
```
execute o npm install
```
npm install
```

crie o arquivo .env para as variáveis do projeto
```
copy .env.example .env
```

gere a chave da sua aplicação laravel
```
php artisan key:generate
```

faça o link da storage na pasta public
```
php artisan storage:link
```

## ☕ Usando o sistema de Açaiteria

Para usar o sistema, siga estas etapas:

configure seu arquivo .env
```
DB_CONNECTION=mysql 
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=<nome-da_sua_base_de_dados>
DB_USERNAME=<username_para_acessar_sua_base>
DB_PASSWORD=<password_para_acessar_sua_base>
```
no seu banco de dados, crie uma tabela do mesmo nome do DB_DATABASE do arquivo .env

realize as migrations do projeto para o banco de dados configurado no .env
```
php artisan migrate
```

rode a aplicação com o comando
```
php artisan serve
```

## 🤝 Colaboradores

Agradecemos às seguintes pessoas que contribuíram para este projeto:

<table>
  <tr>
    <td align="center">
      <a href="#" title="defina o titulo do link">
        <img src="https://avatars.githubusercontent.com/u/87938998?v=4" width="100px;" alt="Foto Gabriel Viccari no GitHub"/><br>
        <sub>
          <b>Gabriel Viccari</b>
        </sub>
      </a>
    </td>
  </tr>
</table>
