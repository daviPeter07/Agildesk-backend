# Agildesk Backend

## Visão Geral

- API do sistema de help desk Agildesk, responsável por autenticação, regras de negócio, persistência, notificações, relatórios e integração com a camada de realtime.
- Backend em PHP puro com organização modular por domínio e separação explícita entre rotas, controllers, services, repositories, validators e DTOs.
- Documentação concentra convenções para manter consistência entre backend, frontend e banco de dados.

## Tecnologias determinísticas

- PHP puro com orientação a objetos e `declare(strict_types=1)`.
- Composer para gerenciamento de dependências e autoload.
- `vlucas/phpdotenv` para leitura e centralização de variáveis de ambiente.
- PDO para acesso ao PostgreSQL.
- PostgreSQL executado em Docker no ambiente local.
- Arquitetura modular por domínio com classes para controllers, services, repositories, validators e DTOs.
- Sessão/autenticação baseada em cookie, compatível com o fluxo documentado no frontend.
- Camada de realtime a ser alinhada com o frontend e com a estratégia final de integração.
- PHP CS Fixer ou ferramenta equivalente para padronização de código.
- PHPUnit ou Pest como estratégia futura de testes automatizados.

## Estrutura de diretórios (kebab-case)

```txt
src/
  config/
    app.php
    cors.php
    env.php
    session.php

  database/
    connection.php

  shared/
    exceptions/
    helpers/
    http/
    middlewares/
    responses/

  modules/
    auth/
      dto/
        login-dto.php
      auth-routes.php
      auth-controller.php
      auth-service.php
      auth-repository.php
      auth-validator.php

    users/
      dto/
        create-user-dto.php
      user-routes.php
      user-controller.php
      user-service.php
      user-repository.php
      user-validator.php

    tickets/
      dto/
        create-ticket-dto.php
        update-ticket-status-dto.php
        assign-ticket-dto.php
        ticket-filters-dto.php
      ticket-routes.php
      ticket-controller.php
      ticket-service.php
      ticket-repository.php
      ticket-validator.php

    comments/
      dto/
        create-comment-dto.php
      comment-routes.php
      comment-controller.php
      comment-service.php
      comment-repository.php
      comment-validator.php

    notifications/
      dto/
      notification-routes.php
      notification-controller.php
      notification-service.php
      notification-repository.php
      notification-validator.php

    dashboard/
      dto/
      dashboard-routes.php
      dashboard-controller.php
      dashboard-service.php
      dashboard-repository.php
      dashboard-validator.php

public/
  index.php

storage/
  logs/

tests/
```

## Convenções e responsabilidades

- Pastas sempre em kebab-case quando aplicável; nomes de classes em PascalCase.
- Cada módulo deve encapsular seu próprio domínio, evitando espalhar regra de negócio entre áreas não relacionadas.
- `*-routes.php` registra endpoints e delega a execução para controllers.
- `*-controller.php` recebe a request, coordena validação básica, instancia DTOs e retorna respostas HTTP padronizadas.
- `*-service.php` concentra regras de negócio e orquestra o fluxo entre validators, repositories e integrações externas.
- `*-repository.php` concentra acesso ao banco e consultas via PDO.
- `*-validator.php` valida payloads, parâmetros e regras sintáticas de entrada antes de o fluxo seguir para services.
- `dto/` carrega dados estruturados entre camadas com tipagem explícita, principalmente para criação, atualização, autenticação e filtros.
- `shared/` concentra componentes transversais do backend, como middlewares, exceptions, respostas padronizadas e utilitários.
- `config/` centraliza bootstrap de ambiente, sessão, CORS e regras globais de inicialização.
- `database/connection.php` deve ser a fonte oficial de conexão PDO; nenhuma camada de domínio deve abrir conexão diretamente.

## Padrões de código

- Todos os arquivos PHP devem iniciar com `declare(strict_types=1);`.
- Controllers, services, repositories, validators e DTOs devem ser implementados como classes.
- Métodos devem possuir tipagem explícita de parâmetros e retorno sempre que possível.
- Não utilizar arrays mágicos como contrato principal entre camadas quando houver DTO correspondente.
- Comentários devem ser curtos e usados apenas quando a intenção não for óbvia pelo nome da classe ou método.
- SQL nunca deve ficar em controller; consultas e persistência pertencem à camada de repository.
- Regras de negócio não devem ficar em routes ou repositories; pertencem à camada de service.
- Validators não substituem regra de negócio; eles validam forma e integridade de entrada, enquanto services validam fluxo e permissão.
- Respostas JSON devem seguir formato padronizado em toda a API.

## Sessão e autenticação

- A autenticação do Agildesk Backend será baseada em sessão via cookie, compatível com o frontend documentado.
- O fluxo mínimo de autenticação será:
  - `POST /auth/login`
  - `GET /auth/me`
  - `POST /auth/logout`
- Após login bem-sucedido, o backend deve emitir o cookie de sessão via `Set-Cookie`.
- Em produção, o cookie deve ser configurado com `HttpOnly` e `Secure`.
- O backend deve tratar a sessão como fonte oficial de autenticação nas rotas protegidas.
- `GET /auth/me` deve ser a rota de referência para identificação do usuário autenticado no frontend.
- `POST /auth/logout` deve invalidar a sessão no backend e remover o vínculo autenticado do usuário.
- Respostas `401` devem ser usadas quando não houver sessão válida ou quando a sessão estiver expirada.
- O backend deve responder com `Access-Control-Allow-Credentials: true` quando houver comunicação cross-origin autenticada.
- O backend não deve usar `Access-Control-Allow-Origin: *` em fluxos com credenciais; a origem precisa ser explicitamente permitida.

## Arquitetura HTTP

- O backend deve expor API JSON consistente para consumo pelo frontend SPA.
- Toda rota deve possuir uma responsabilidade clara e seguir convenção REST sempre que possível.
- Controllers devem retornar respostas padronizadas para sucesso, erro de validação, erro de negócio, não encontrado e não autorizado.
- Formato base de sucesso:
  - `data`
  - `message`
  - `meta` (quando houver paginação, filtros ou metadados relevantes)
- Formato base de erro:
  - `message`
  - `errors` (quando houver falha de validação ou detalhamento por campo)

## DTOs

- DTOs serão adotados como parte oficial da arquitetura para transporte estruturado de dados entre camadas.
- DTOs devem ser usados principalmente em:
  - autenticação
  - criação de registros
  - atualização de registros
  - filtros e paginação
- DTOs não devem conter regra de negócio pesada.
- DTOs devem ser tipados e representar contratos claros de entrada/saída interna.
- Exemplos iniciais de DTOs:
  - `LoginDto`
  - `CreateUserDto`
  - `CreateTicketDto`
  - `UpdateTicketStatusDto`
  - `AssignTicketDto`
  - `TicketFiltersDto`
  - `CreateCommentDto`

## Validação de dados

- Toda entrada do cliente deve ser validada antes de seguir para o service.
- Validators devem verificar:
  - campos obrigatórios
  - tipos esperados
  - formatos válidos
  - enums permitidos
  - limites mínimos e máximos quando aplicável
- A validação estrutural deve acontecer antes da criação do DTO.
- Regras de permissão, fluxo e negócio devem ser tratadas em services, não em validators.
- Erros de validação devem retornar estrutura consistente para fácil consumo pelo frontend.

## Repositories e acesso a banco

- A camada de repository será a única responsável por leitura e escrita no PostgreSQL.
- O acesso ao banco será feito via PDO, com statements preparados.
- Repositories devem evitar conhecer regras de negócio; seu foco é persistência e consulta.
- Conexões com banco devem ser reutilizadas a partir de `database/connection.php`.
- Queries devem ser organizadas de forma clara, legível e segura contra SQL Injection.

## Regras de negócio (RN)

1. **RN01 Cadastro de usuários**: permitir perfis Usuário, Atendente e Administrador.
2. **RN02 Autenticação**: acesso somente via login + senha.
3. **RN03 Abertura de chamado**: requer usuário autenticado.
4. **RN04 Dados obrigatórios**: título, descrição, categoria, prioridade.
5. **RN05 Status inicial**: todo chamado nasce como `OPEN`.
6. **RN06 Status do chamado**: estados válidos – `OPEN`, `IN_PROGRESS`, `PENDING`, `RESOLVED`, `CLOSED`, `CANCELED`.
7. **RN07 Alteração de status**: apenas atendentes podem marcar `IN_PROGRESS`.
8. **RN08 Resolução**: só marcar `RESOLVED` após resposta do atendente.
9. **RN09 Reabertura**: usuário pode reabrir chamados resolvidos; encerrados não.
10. **RN10 Atribuição**: apenas um atendente por chamado; máximo de 3 chamados ativos por atendente.
11. **RN11 Ações do atendente**: assumir, responder e atualizar chamados.
12. **RN12 Histórico**: registrar todas as interações.
13. **RN13 Encerramento**: apenas usuário ou atendente pode encerrar.
14. **RN14 Condição de encerramento**: só encerrar se o status estiver `RESOLVED`.
15. **RN15 Pós-encerramento**: chamados encerrados não podem ser alterados.
16. **RN16 Relatórios**: gerar relatórios de desempenho e chamados.
17. **RN17 Prioridade**: alta prioridade deve ser atendida primeiro.
18. **RN18 SLA**: sistema define tempo máximo de atendimento.
19. **RN19 SLA estourado**: sinalizar chamados fora do prazo.
20. **RN20 Notificações usuário**: notificar sempre que houver atualização.
21. **RN21 Notificações atendente**: alertar sobre novos chamados.

## Modelo de dados (referência backend)

- **users**: `id`, `name`, `cpf`, `email`, `password`, `role (ADMIN|USER|TI)`, `departmentId`, `activeTicketsCount`, `isOnline`, `imagem?`, `createdAt`, `updatedAt`.
- **departments**: `id`, `name`, `description?`, `createdAt`.
- **teams**: `id`, `name`, `description`.
- **team_members**: `userId`, `teamId`.
- **services**: `id`, `name`, `description`, `sla_hours`, `priority_suggested (LOW|MEDIUM|HIGH|URGENT)`, `createdAt`, `updatedAt`.
- **tickets**: `id`, `protocol`, `title`, `description`, `status (OPEN|IN_PROGRESS|PENDING|RESOLVED|CLOSED|CANCELED)`, `priority (LOW|MEDIUM|HIGH|URGENT)`, `userId`, `technicianId?`, `teamId?`, `serviceId`, `departmentId`, `hasTechnicianReply`, `deadline`, `closedAt?`, `createdAt`, `updatedAt`.
- **ticket_comments**: `id`, `ticketId`, `userId`, `message`, `isInternal`, `createdAt`.
- **ticket_history**: `id`, `ticketId`, `changedBy`, `action`, `oldValue?`, `newValue?`, `createdAt`.
- **notifications**: `id`, `userId`, `type (NEW_TICKET|TIMEOUT_WARNING|SLA_BREACHED|NEW_REPLY)`, `content`, `readAt?`, `createdAt`.
- **reports**: `id`, `name`, `type (PERFORMANCE|TICKETS)`, `format (EXCEL|PDF)`, `url`, `userId`, `createdAt`.

## Paginação, filtros e busca

- Listagens principais devem usar paginação server-side.
- O backend deve aceitar parâmetros como:
  - `page`
  - `limit`
  - filtros específicos do módulo
  - busca textual
  - ordenação
- Respostas paginadas devem retornar `meta` com:
  - `page`
  - `limit`
  - `total`
  - `totalPages`
- Filtros devem ser tratados preferencialmente por DTO específico de filtros.
- O backend deve diferenciar claramente ausência total de registros e ausência de resultados após filtro.

## Realtime e integração com frontend

- O frontend documentado utiliza `socket.io-client`; portanto, a estratégia final de realtime do backend deve ser compatível com esse contrato.
- A autenticação do canal realtime deve respeitar a sessão autenticada já validada no fluxo HTTP.
- Eventos de domínio devem seguir o padrão `dominio.acao`.
- Eventos previstos inicialmente:
  - `ticket.created`
  - `ticket.status.changed`
  - `ticket.comment.created`
  - `notification.created`
- O backend deve emitir apenas eventos relevantes e coerentes com as regras de negócio já persistidas.

## Regras de SLA no backend

- O SLA deve ser definido com base em `services.sla_hours`.
- O prazo operacional do chamado deve ser refletido em `tickets.deadline`.
- O backend deve ser a fonte oficial de cálculo do `deadline`.
- O frontend deve consumir `deadline` como referência operacional de exibição e ordenação.
- Mudanças de status e relatórios devem considerar SLA de forma consistente.
- Chamados vencidos ou próximos do vencimento podem alimentar notificações e indicadores operacionais.

## Tratamento de erro

- O backend deve responder com códigos HTTP consistentes.
- Erros de validação devem retornar `422` quando aplicável.
- Falhas de autenticação devem retornar `401`.
- Falhas de autorização devem retornar `403`.
- Recursos inexistentes devem retornar `404`.
- Falhas inesperadas devem retornar `500` com mensagem segura e sem expor detalhes sensíveis.
- O tratamento de exceptions deve ser centralizado sempre que possível.

## Observabilidade e debug

- Logs de desenvolvimento devem ser habilitados apenas em ambiente local/dev.
- Nenhum log deve expor senha, cookie, sessão ou informação sensível.
- Erros de banco, autenticação, integrações e realtime devem ser rastreáveis em desenvolvimento.
- Logs devem ser organizados por contexto/domínio sempre que possível:
  - `[auth]`
  - `[tickets]`
  - `[notifications]`
  - `[database]`
  - `[realtime]`
- O projeto deve prever captura e centralização mínima de erros críticos.

## Fluxo de trabalho

- Gerenciador padrão: **Composer** para dependências PHP.
- Banco PostgreSQL executado em Docker no ambiente local.
- Cada tarefa gera branch dedicada seguindo convenção do projeto.
- Commits seguem Conventional Commits para facilitar histórico e revisão.
- Antes de abrir PR: rodar lint/format e testes quando aplicável.
- Atualizar documentação quando houver mudança de regra, fluxo ou contrato de API.
- Toda feature precisa passar por review humano obrigatório.
- Merge somente após aprovação e validação do fluxo principal do módulo alterado.

## Convenção de branches

- `feature/<escopo>` para novas funcionalidades.
- `fix/<escopo>` para correções.
- `chore/<escopo>` para manutenção.
- `docs/<escopo>` para documentação.
- Usar kebab-case após o prefixo e manter escopo curto e descritivo.

## Conventional Commits

- `feat: adiciona criacao de chamados`
- `fix: corrige validacao de login`
- `docs: atualiza regras de autenticacao`
- `refactor: reorganiza services de tickets`
- `chore: ajusta configuracao do composer`
- `test: adiciona testes de repository`

## Padrão de PR

- **Título**: `[tipo] escopo resumido`
- **Descrição mínima**: o que mudou, por que mudou e como testar.
- **Checklist antes do review**:
  - lint/format executado
  - testes executados quando aplicável
  - documentação atualizada quando necessário
  - impacto em rotas, sessão ou banco descrito com clareza
- **Passos de teste**: detalhar fluxo manual/automático para validação.
- **Política de merge**: aguardar pelo menos 1 aprovação antes de concluir; mudanças sensíveis em autenticação, sessão, banco ou realtime exigem revisão mais criteriosa.
