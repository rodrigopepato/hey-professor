Hey-Professor 🎓

**Hey-Professor** é uma aplicação semelhante ao Slido, desenvolvida em Laravel, que permite aos usuários fazer login autenticando-se pelo GitHub. A aplicação oferece uma interface para interagir com professores, fazendo perguntas e participando de discussões.

## Funcionalidades
- Autenticação via GitHub.
- Interface para perguntas e respostas.
- Sistema de gerenciamento de sessões e interações.

## Requisitos
Para rodar o projeto na sua máquina, você precisará de:
- PHP 8.0 ou superior
- Composer
- MySQL 5.7 ou superior
- Laravel 8.x
- Um navegador moderno
- Conta no GitHub para configuração de OAuth

## Configuração do Ambiente

1. **Banco de Dados**:
   - Crie um banco de dados no MySQL.
   - Importe o arquivo SQL disponível no projeto para configurar as tabelas e dados iniciais.

2. **Configuração do Projeto**:
   - Copie o arquivo `.env.example` para `.env` e configure as variáveis de ambiente:
     ```bash
     cp .env.example .env
     ```
   - Configure as credenciais do banco de dados no arquivo `.env`:
     ```
     DB_DATABASE=nome_do_banco
     DB_USERNAME=seu_usuario
     DB_PASSWORD=sua_senha
     ```
   - Configure o OAuth para o login via GitHub no arquivo `.env`:
     ```
     GITHUB_CLIENT_ID=seu_client_id
     GITHUB_CLIENT_SECRET=seu_client_secret
     GITHUB_REDIRECT_URL=http://localhost:8000/auth/callback
     ```

3. **Instalar Dependências**:
   - Instale as dependências do projeto utilizando o Composer:
     ```bash
     composer install
     ```
   - Gere a chave da aplicação:
     ```bash
     php artisan key:generate
     ```

4. **Executar as Migrações**:
   - Execute as migrações para configurar as tabelas no banco de dados:
     ```bash
     php artisan migrate
     ```

5. **Iniciar o Servidor**:
   - Inicie o servidor localmente com o comando:
     ```bash
     php artisan serve
     ```
   - Acesse a aplicação no navegador em `http://localhost:8000`.

## Licença
Este projeto está licenciado sob a [MIT License](LICENSE).
