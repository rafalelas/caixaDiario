Caixa Diário

Projeto pessoal desenvolvido para resolver um problema real do dia a dia: organizar e registrar o fechamento de caixa diário de forma simples, confiável e acessível.

O sistema permite o controle de vendas por produto, diferentes formas de pagamento (máquinas, dinheiro e taxas) e a visualização de caixas anteriores, facilitando conferência, correções e histórico financeiro.
Foi pensado para uso prático, evitando erros comuns em controles manuais e planilhas.

Contexto e Motivação

Este projeto surgiu a partir de uma necessidade real no trabalho do meu pai. A ideia foi transformar um processo manual e sujeito a erros em um sistema web simples, com dados centralizados e persistidos em banco de dados.

Além do uso prático, o projeto também funciona como um estudo aplicado de desenvolvimento backend com Laravel, organização de regras de negócio e estruturação de CRUDs reais.

Funcionalidades Principais

Criação de caixa diário com data controlada

Registro de vendas por produto

Controle de múltiplas formas de pagamento

Edição de caixas já criados

Listagem e visualização de caixas anteriores

Autenticação de usuários

Estrutura preparada para evolução futura (relatórios, permissões, etc.)

Tecnologias Utilizadas

O projeto foi desenvolvido utilizando:

PHP com Laravel

MySQL

Blade para as views

HTML e CSS

Git e GitHub para versionamento

A estrutura segue os padrões do Laravel, com separação clara entre controllers, models, migrations e views.

Estrutura do Projeto

CaixaDiario: entidade principal do sistema

Produtos: cadastro base para vendas

CaixaItens: relação entre caixa e produtos vendidos

Controllers organizados por responsabilidade

Migrations versionando toda a estrutura do banco

Próximos Passos

Algumas melhorias já estão planejadas para evolução do projeto:

Implementar relatórios diários e mensais de faturamento

Cálculo automático de totais por forma de pagamento

Controle de permissões por tipo de usuário

Dashboard com indicadores visuais

Exportação de dados (PDF ou CSV)

Validações mais robustas no backend

Testes automatizados para regras de negócio

Status

Projeto em desenvolvimento contínuo, com foco em qualidade de código, clareza de regras e evolução incremental baseada em necessidades reais.

Como rodar o projeto localmente

Este projeto foi desenvolvido com Laravel e utiliza MySQL como banco de dados.
Para rodar localmente, é necessário ter o ambiente básico de desenvolvimento PHP configurado.

Requisitos

PHP 8.1+

Composer

MySQL

Node.js e NPM (para assets)

Servidor local (XAMPP, Laragon ou similar)

Passo a passo

Clone o repositório:

```bash
git clone https://github.com/rafalelas/caixaDiario.git
cd caixaDiario
```


Instale as dependências do PHP:
```bash
composer install
```

Copie o arquivo de ambiente e configure:
```bash
cp .env.example .env
```

No arquivo .env, ajuste principalmente:

- DB_DATABASE

- DB_USERNAME

- DB_PASSWORD

Gere a chave da aplicação:
```bash
php artisan key:generate
```

Execute as migrations e seeders:
```bash
php artisan migrate --seed
```

Instale as dependências do front-end:
```bash
npm install
npm run dev
```

Inicie o servidor:
```bash
php artisan serve
```

Acesse no navegador:
```bash
http://localhost:8000
```
Usuários e dados iniciais

O projeto possui seeders para produtos, permitindo testar o fluxo completo do caixa diário logo após a instalação.
