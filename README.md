# API e Dashboard com Laravel 10 utilizando AdminLTE-3

Este projeto é uma aplicação de API e Dashboard desenvolvida com o framework Laravel 10, integrando o template AdminLTE-3 para o painel administrativo. O objetivo é fornecer uma estrutura completa para criar um sistema que inclui funcionalidades de API e gerenciamento via Dashboard.

## 📋 Funcionalidades

- Autenticação e controle de acesso.
- CRUD completo para gerenciamento de dados.
- API estruturada seguindo as melhores práticas.
- Dashboard interativo com o AdminLTE-3.
- Suporte para múltiplos tipos de dados e operações.

## 🛠️ Tecnologias Utilizadas

- [Laravel 10](https://laravel.com/docs/10.x) - Framework PHP.
- [AdminLTE-3](https://adminlte.io/) - Template de painel administrativo.
- [MySQL](https://www.mysql.com/) - Banco de dados relacional.
- [Composer](https://getcomposer.org/) - Gerenciador de dependências PHP.
- [Node.js](https://nodejs.org/) e [NPM](https://www.npmjs.com/) - Gerenciador de pacotes JavaScript.
  
## 🚀 Pré-requisitos

- PHP >= 8.1
- Composer
- Node.js e NPM
- MySQL ou outro banco de dados compatível
- Git

## 📦 Instalação

1. Clone o repositório:

    ```bash
    git clone https://github.com/EricSearles/api-dashboad-adminLte.git
    ```

2. Acesse o diretório do projeto:

    ```bash
    cd api-dashboad-adminLte
    ```

3. Instale as dependências do PHP com o Composer:

    ```bash
    composer install
    ```

4. Instale as dependências do Node.js:

    ```bash
    npm install
    ```

5. Copie o arquivo `.env.example` para `.env` e configure as variáveis de ambiente, especialmente as relacionadas ao banco de dados:

    ```bash
    cp .env.example .env
    ```

6. Gere a chave da aplicação Laravel:

    ```bash
    php artisan key:generate
    ```

7. Execute as migrações para criar as tabelas no banco de dados:

    ```bash
    php artisan migrate
    ```

8. (Opcional) Popule o banco de dados com dados de exemplo:

    ```bash
    php artisan db:seed
    ```

9. Compile os arquivos do frontend:

    ```bash
    npm run dev
    ```

10. Inicie o servidor local:

    ```bash
    php artisan serve
    ```

11. Acesse a aplicação no navegador:

    ```
    http://localhost:8000
    ```

## 📚 Documentação da API

A documentação completa da API pode ser encontrada em breve, incluindo endpoints, métodos suportados e exemplos de uso.

## 🤝 Contribuindo

Contribuições são sempre bem-vindas! Sinta-se à vontade para abrir uma _issue_ ou enviar um _pull request_.

## 📝 Licença

Este projeto está sob a licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.

## 📞 Contato

Eric Searles - [GitHub](https://github.com/EricSearles)
