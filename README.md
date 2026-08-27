# Papelaria Encanto — site chamariz (PHP + MySQL)

Landing page para uma papelaria, com produtos vindos do banco de dados e
formulário de contato que grava os leads na tabela `contatos`.

## Estrutura

```
papelaria-encanto/
├── index.php              → página inicial (hero, sobre, destaques, depoimentos, contato)
├── produtos.php            → catálogo completo com filtro por categoria
├── processa_contato.php    → recebe o POST do formulário e grava no banco
├── config/db.php           → conexão PDO com o MySQL
├── database/schema.sql     → criação das tabelas + dados de exemplo
├── includes/header.php     → cabeçalho reutilizável
├── includes/footer.php     → rodapé reutilizável
├── css/style.css           → identidade visual
└── js/script.js            → menu mobile + animações de scroll
```

## Como rodar (XAMPP / WAMP / MAMP)

1. Copie a pasta `papelaria-encanto` para `htdocs` (XAMPP) ou `www` (WAMP).
2. Abra o **phpMyAdmin**, crie uma nova aba "SQL" e importe o arquivo
   `database/schema.sql` (ele já cria o banco `papelaria_encanto`, as tabelas
   e alguns produtos de exemplo).
3. Confira as credenciais em `config/db.php` — por padrão:
   `host=localhost`, `usuário=root`, `senha=` (vazia).
4. Acesse `http://localhost/papelaria-encanto/` no navegador.

## Como rodar com o servidor embutido do PHP

Se você já tem PHP e MySQL instalados localmente:

```bash

mysql -u root -p < database/schema.sql


php -S localhost:8000


http://localhost:8000
```

## Banco de dados

- **categorias** — categorias do catálogo (cadernos, canetas, artesanato...)
- **produtos** — itens exibidos no site, com `destaque` (0/1) controlando o
  que aparece na home
- **contatos** — leads recebidos pelo formulário de contato

Para adicionar produtos, insira direto na tabela `produtos` (via phpMyAdmin
ou uma query `INSERT`) — o site lista tudo automaticamente.

## Próximos passos sugeridos

- Painel administrativo simples para cadastrar produtos sem SQL manual
- Upload de imagens reais dos produtos (hoje o layout é ilustrativo)
- Paginação no catálogo se o número de produtos crescer bastante
