# Agildesk Backend

Backend API do Agildesk, sistema de help desk para autenticacao, gestao de chamados, comentarios, notificacoes, relatorios e integracao realtime.

## Sobre o projeto

O Agildesk Backend foi projetado para sustentar operacoes de suporte com foco em:

- autenticacao por sessao baseada em cookie
- regras de negocio de chamados, status, atribuicao e SLA
- persistencia segura em PostgreSQL com PDO
- notificacoes e eventos de dominio em tempo real
- arquitetura modular por dominio com responsabilidades bem definidas

A aplicacao segue arquitetura em PHP puro orientada a objetos, com separacao clara entre routes, controllers, services, repositories, validators e DTOs.

## Documentacao de referencia

As decisoes arquiteturais e regras detalhadas estao no documento de design:

- [Agildesk Backend System Design](./Agildesk%20Backend%20System%20Design.md)

## Stack principal

- PHP puro com orientacao a objetos (`declare(strict_types=1)`)
- Composer
- vlucas/phpdotenv
- PDO
- PostgreSQL
- Docker (ambiente local de banco)
- Sessao via cookie
- PHPUnit ou Pest (estrategia de testes)
- PHP CS Fixer (ou equivalente)

## Principais modulos

- Auth: login, sessao atual e logout
- Users: cadastro e gestao de usuarios
- Tickets: abertura, listagem, atribuicao, status e SLA
- Comments: comentarios e interacoes por chamado
- Notifications: central e leitura de notificacoes
- Dashboard: indicadores e visoes operacionais

## Arquitetura resumida

Estrutura base do projeto:

```txt
src/
	config/
	database/
	shared/
	modules/
public/
storage/
tests/
```

## Requisitos

- PHP 8.2 ou superior
- Composer 2 ou superior
- Docker e Docker Compose
- PostgreSQL (via container local)

## Instalacao

1. Clone o repositorio.
2. Entre na pasta do backend.
3. Instale as dependencias com o comando abaixo.

   ```bash
   composer install
   ```

## Configuracao de ambiente

Crie um arquivo `.env` na raiz do projeto com as variaveis necessarias para banco, sessao, CORS e ambiente.

Exemplo:

```env
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:3000

DB_HOST=localhost
DB_PORT=5432
DB_NAME=agildesk
DB_USER=postgres
DB_PASSWORD=postgres

SESSION_NAME=agildesk_session
SESSION_LIFETIME=120
SESSION_SECURE=false
SESSION_HTTP_ONLY=true
SESSION_SAME_SITE=lax

CORS_ALLOWED_ORIGIN=http://localhost:5173
```

Ajuste os valores conforme o ambiente local e o frontend consumidor.

## Executando o projeto

Ambiente de desenvolvimento (servidor embutido PHP):

```bash
php -S localhost:3000 -t public
```

Subindo banco PostgreSQL via Docker (exemplo):

```bash
docker compose up -d
```

## Scripts uteis

- `composer install`
- `composer dump-autoload`
- `php -S localhost:3000 -t public`
- `vendor/bin/php-cs-fixer fix`
- `vendor/bin/phpunit` (quando configurado)

## Diretrizes funcionais importantes

- Sessao autenticada por cookie com suporte a `HttpOnly` e `Secure` em producao.
- Fluxo minimo de autenticacao:
  - `POST /auth/login`
  - `GET /auth/me`
  - `POST /auth/logout`
- Rotas protegidas devem usar a sessao como fonte oficial de autenticacao.
- Respostas cross-origin autenticadas devem incluir `Access-Control-Allow-Credentials: true`.
- Nao usar `Access-Control-Allow-Origin: *` em fluxos com credenciais.
- Repositories concentram SQL e acesso ao banco; services concentram regra de negocio.
- Validators validam entrada (forma e integridade), services validam fluxo e permissao.
- Listagens principais devem usar paginacao server-side com `meta` (`page`, `limit`, `total`, `totalPages`).
- Eventos de dominio previstos no realtime:
  - `ticket.created`
  - `ticket.status.changed`
  - `ticket.comment.created`
  - `notification.created`

## Contrato de resposta HTTP

Formato base de sucesso:

- `data`
- `message`
- `meta` (quando aplicavel)

Formato base de erro:

- `message`
- `errors` (quando aplicavel)

Codigos recomendados:

- `401` para falha de autenticacao
- `403` para falha de autorizacao
- `404` para recurso inexistente
- `422` para erro de validacao
- `500` para falhas inesperadas

## Qualidade e colaboracao

- Gerenciador oficial: Composer
- Branches: `feature/<escopo>`, `fix/<escopo>`, `chore/<escopo>`, `docs/<escopo>`
- Commits: Conventional Commits
- Antes de abrir PR, execute:

  ```bash
  vendor/bin/php-cs-fixer fix
  vendor/bin/phpunit
  ```

- Toda alteracao relevante deve atualizar a documentacao quando necessario.
- Mudancas sensiveis em autenticacao, sessao, banco ou realtime exigem revisao criteriosa.

## Status

Projeto em evolucao continua, com foco em consistencia de regras de negocio, confiabilidade operacional e alinhamento com frontend/realtime.
