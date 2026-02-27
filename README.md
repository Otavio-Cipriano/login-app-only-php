# Login App ONLY PHP 

Projeto de autenticação em PHP puro, criado para treinar sessões, 
filtros de input e lógica de login/logout, persitencia de dados 
de usuários e como manter senhas de forma seguras no banco de dados.
Serve como base para futuras implementações de JWT, OAuth e OAuth2.

## Tecnologias usadas

- PHP 8
- MySQL
- Bootstrap
- Composer


## Motivação e decisões

Criei este projeto para praticar o fluxo de autenticação do zero, sem frameworks.
Decidi usar PHP puro para entender o fluxo completo:
- Recebimento de dados via POST
- Sanitização com filter_input()
- Validação de credenciais
- Controle de sessão 
- Registro de novos usuários
- Senhas em hash


## Funcionalidades atuais

- Login/logout
- Controle de sessão
- Validação e Sanitização de dados
- Redirecionamento seguro após login/logout
- Registro de novos usuários
- Senhas em hash
- scrip para importar bootsrap em public
- Render de Views
- Router Dinâmico, baseado em laravel
- Estrutura MVC

## Próximos passos

- [ ] Implementar JWT para autenticação stateless
- [ ] Adicionar login via OAuth/Google
- [ ] Implementar OAuth2 para aplicações externas
- [ ] Criar testes unitários

## Como Rodar

1. Clonar o repositório
2. Configurar banco de dados
3. Instalar os pacotes com composer
4. Rodar o `composer copy-bootstrap`
5. Rodar servidor PHP: php -S localhost:8000
6. Acessar no navegador
