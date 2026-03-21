# Tasks: Arquitetura Base Oficial do Backend

**Input**: Design documents from /specs/001-backend-official-base-architecture/
**Prerequisites**: plan.md (required), spec.md (required), research.md, data-model.md, contracts/, quickstart.md

**Tests**: Nao ha tarefas de testes automatizados nesta feature, pois o escopo e exclusivamente scaffolding estrutural.

**Organization**: Tasks agrupadas por user story para implementacao e validacao independente.

## Phase 1: Setup (Shared Infrastructure)

**Purpose**: Preparar base da feature e pontos de validacao estrutural.

- [x] T001 Confirmar branch ativa com 001-backend-official-base-architecture via comando em specs/001-backend-official-base-architecture/quickstart.md
- [x] T002 Criar diretorios raiz src, public, storage e tests no repositorio
- [x] T003 [P] Criar diretorios src/config e src/database
- [x] T004 [P] Criar diretorios src/shared/exceptions, src/shared/helpers, src/shared/http, src/shared/middlewares e src/shared/responses

---

## Phase 2: Foundational (Blocking Prerequisites)

**Purpose**: Definir a fundacao bloqueante de estrutura e contrato antes dos modulos por historia.

**⚠️ CRITICAL**: Nenhuma historia comeca antes desta fase.

- [x] T005 Criar arquivo base src/config/app.php
- [x] T006 [P] Criar arquivo base src/config/cors.php
- [x] T007 [P] Criar arquivo base src/config/env.php
- [x] T008 [P] Criar arquivo base src/config/session.php
- [x] T009 Criar arquivo base src/database/connection.php
- [x] T010 Criar arquivo base public/index.php
- [x] T011 Criar diretorio storage/logs
- [x] T012 Revisar e alinhar requisitos estruturais em specs/001-backend-official-base-architecture/contracts/structure-contract.md

**Checkpoint**: Fundacao pronta; historias podem avancar.

---

## Phase 3: User Story 1 - Materializar estrutura oficial de pastas e arquivos (Priority: P1) 🎯 MVP

**Goal**: Criar a estrutura base oficial e artefatos dos modulos auth, users e tickets conforme blueprint.

**Independent Test**: Validar existencia das pastas/arquivos de auth, users e tickets com nomes identicos ao blueprint do documento.

### Implementation for User Story 1

- [x] T013 [P] [US1] Criar diretorio src/modules/auth/dto
- [x] T014 [P] [US1] Criar diretorio src/modules/users/dto
- [x] T015 [P] [US1] Criar diretorio src/modules/tickets/dto
- [x] T016 [US1] Criar arquivo src/modules/auth/auth-routes.php
- [x] T017 [P] [US1] Criar arquivo src/modules/auth/auth-controller.php
- [x] T018 [P] [US1] Criar arquivo src/modules/auth/auth-service.php
- [x] T019 [P] [US1] Criar arquivo src/modules/auth/auth-repository.php
- [x] T020 [P] [US1] Criar arquivo src/modules/auth/auth-validator.php
- [x] T021 [P] [US1] Criar arquivo src/modules/auth/dto/login-dto.php
- [x] T022 [US1] Criar arquivo src/modules/users/user-routes.php
- [x] T023 [P] [US1] Criar arquivo src/modules/users/user-controller.php
- [x] T024 [P] [US1] Criar arquivo src/modules/users/user-service.php
- [x] T025 [P] [US1] Criar arquivo src/modules/users/user-repository.php
- [x] T026 [P] [US1] Criar arquivo src/modules/users/user-validator.php
- [x] T027 [P] [US1] Criar arquivo src/modules/users/dto/create-user-dto.php
- [x] T028 [US1] Criar arquivo src/modules/tickets/ticket-routes.php
- [x] T029 [P] [US1] Criar arquivo src/modules/tickets/ticket-controller.php
- [x] T030 [P] [US1] Criar arquivo src/modules/tickets/ticket-service.php
- [x] T031 [P] [US1] Criar arquivo src/modules/tickets/ticket-repository.php
- [x] T032 [P] [US1] Criar arquivo src/modules/tickets/ticket-validator.php
- [x] T033 [P] [US1] Criar arquivo src/modules/tickets/dto/create-ticket-dto.php
- [x] T034 [P] [US1] Criar arquivo src/modules/tickets/dto/update-ticket-status-dto.php
- [x] T035 [P] [US1] Criar arquivo src/modules/tickets/dto/assign-ticket-dto.php
- [x] T036 [P] [US1] Criar arquivo src/modules/tickets/dto/ticket-filters-dto.php

**Checkpoint**: US1 funcional como MVP estrutural.

---

## Phase 4: User Story 2 - Preservar fronteiras por modulo e camada (Priority: P2)

**Goal**: Criar estrutura de comments, notifications e dashboard mantendo separacao clara por camada.

**Independent Test**: Validar que cada um dos 3 modulos contem dto/, routes, controller, service, repository e validator.

### Implementation for User Story 2

- [x] T037 [P] [US2] Criar diretorio src/modules/comments/dto
- [x] T038 [P] [US2] Criar diretorio src/modules/notifications/dto
- [x] T039 [P] [US2] Criar diretorio src/modules/dashboard/dto
- [x] T040 [US2] Criar arquivo src/modules/comments/comment-routes.php
- [x] T041 [P] [US2] Criar arquivo src/modules/comments/comment-controller.php
- [x] T042 [P] [US2] Criar arquivo src/modules/comments/comment-service.php
- [x] T043 [P] [US2] Criar arquivo src/modules/comments/comment-repository.php
- [x] T044 [P] [US2] Criar arquivo src/modules/comments/comment-validator.php
- [x] T045 [P] [US2] Criar arquivo src/modules/comments/dto/create-comment-dto.php
- [x] T046 [US2] Criar arquivo src/modules/notifications/notification-routes.php
- [x] T047 [P] [US2] Criar arquivo src/modules/notifications/notification-controller.php
- [x] T048 [P] [US2] Criar arquivo src/modules/notifications/notification-service.php
- [x] T049 [P] [US2] Criar arquivo src/modules/notifications/notification-repository.php
- [x] T050 [P] [US2] Criar arquivo src/modules/notifications/notification-validator.php
- [x] T051 [US2] Criar arquivo src/modules/dashboard/dashboard-routes.php
- [x] T052 [P] [US2] Criar arquivo src/modules/dashboard/dashboard-controller.php
- [x] T053 [P] [US2] Criar arquivo src/modules/dashboard/dashboard-service.php
- [x] T054 [P] [US2] Criar arquivo src/modules/dashboard/dashboard-repository.php
- [x] T055 [P] [US2] Criar arquivo src/modules/dashboard/dashboard-validator.php

**Checkpoint**: US2 adiciona todos os modulos restantes com fronteiras de camada consistentes.

---

## Phase 5: User Story 3 - Garantir base minima sem implementacao de logica (Priority: P3)

**Goal**: Padronizar placeholders e validar que nao ha logica de negocio/SQL/realtime nos arquivos base.

**Independent Test**: Verificar que todos os arquivos PHP possuem apenas conteudo estrutural minimo e nenhuma implementacao de dominio.

### Implementation for User Story 3

- [x] T056 [US3] Adicionar placeholder estrutural em src/config/app.php sem logica de negocio
- [x] T057 [P] [US3] Adicionar placeholder estrutural em src/config/cors.php sem logica de negocio
- [x] T058 [P] [US3] Adicionar placeholder estrutural em src/config/env.php sem logica de negocio
- [x] T059 [P] [US3] Adicionar placeholder estrutural em src/config/session.php sem logica de negocio
- [x] T060 [US3] Adicionar placeholder estrutural em src/database/connection.php sem SQL de producao
- [x] T061 [US3] Adicionar placeholder estrutural em src/modules/auth/auth-service.php sem regras de negocio
- [x] T062 [P] [US3] Adicionar placeholder estrutural em src/modules/users/user-service.php sem regras de negocio
- [x] T063 [P] [US3] Adicionar placeholder estrutural em src/modules/tickets/ticket-service.php sem regras de negocio
- [x] T064 [P] [US3] Adicionar placeholder estrutural em src/modules/comments/comment-service.php sem regras de negocio
- [x] T065 [P] [US3] Adicionar placeholder estrutural em src/modules/notifications/notification-service.php sem regras de negocio
- [x] T066 [P] [US3] Adicionar placeholder estrutural em src/modules/dashboard/dashboard-service.php sem regras de negocio

**Checkpoint**: US3 garante principio de "arquitetura completa sem implementacao".

---

## Phase 6: Polish & Cross-Cutting Concerns

**Purpose**: Validacao final e consolidacao documental.

- [x] T067 [P] Atualizar checklist de validacao final em specs/001-backend-official-base-architecture/quickstart.md com resultado da verificacao estrutural
- [x] T068 [P] Revisar consistencia de nomenclatura no contrato em specs/001-backend-official-base-architecture/contracts/structure-contract.md
- [x] T069 Executar validacao final comparando arvore criada com blueprint em Agildesk Backend System Design.md
- [x] T070 Registrar conclusao de conformidade no arquivo specs/001-backend-official-base-architecture/research.md

---

## Dependencies & Execution Order

### Phase Dependencies

- Setup (Phase 1): sem dependencias
- Foundational (Phase 2): depende de Phase 1 e bloqueia historias
- User Stories (Phase 3+): dependem de Phase 2
- Polish (Phase 6): depende das historias concluídas

### User Story Dependencies

- US1 (P1): inicia apos Foundational; sem dependencia de outras historias
- US2 (P2): inicia apos Foundational; independente de US1
- US3 (P3): inicia apos US1 e US2 para aplicar placeholders na base completa

### Parallel Opportunities

- T003 e T004 podem rodar em paralelo
- T006, T007 e T008 podem rodar em paralelo
- T013, T014 e T015 podem rodar em paralelo
- T017 a T021 podem rodar em paralelo apos T016
- T023 a T027 podem rodar em paralelo apos T022
- T029 a T036 podem rodar em paralelo apos T028
- T037, T038 e T039 podem rodar em paralelo
- T041 a T045 podem rodar em paralelo apos T040
- T047 a T050 podem rodar em paralelo apos T046
- T052 a T055 podem rodar em paralelo apos T051
- T057 a T059 e T062 a T066 podem rodar em paralelo

---

## Parallel Example: User Story 1

- Executar em paralelo: T013, T014, T015
- Executar em paralelo apos rotas criadas: T017, T018, T019, T020, T021
- Executar em paralelo apos user-routes: T023, T024, T025, T026, T027
- Executar em paralelo apos ticket-routes: T029, T030, T031, T032, T033, T034, T035, T036

## Parallel Example: User Story 2

- Executar em paralelo: T037, T038, T039
- Executar em paralelo apos comment-routes: T041, T042, T043, T044, T045
- Executar em paralelo apos notification-routes: T047, T048, T049, T050
- Executar em paralelo apos dashboard-routes: T052, T053, T054, T055

## Parallel Example: User Story 3

- Executar em paralelo: T057, T058, T059
- Executar em paralelo: T062, T063, T064, T065, T066

---

## Implementation Strategy

### MVP First (US1)

1. Concluir Phase 1 e Phase 2
2. Entregar US1 completa
3. Validar 100% da estrutura de auth/users/tickets

### Incremental Delivery

1. Foundation pronta (Phase 1-2)
2. US1 (MVP estrutural)
3. US2 (completa cobertura de modulos)
4. US3 (padroniza placeholders sem logica)
5. Polish final de conformidade

### Team Parallel Strategy

1. Pessoa A: config/database/public/storage/tests
2. Pessoa B: modulos auth/users/tickets
3. Pessoa C: modulos comments/notifications/dashboard
4. Consolidacao final: placeholders + validacao contratual

---

## Notes

- Formato de checklist seguido em 100% das tarefas: - [ ] Txxx [P?] [US?] Descricao com caminho
- [P] indica execucao paralela sem conflito de arquivo
- [USx] presente apenas em fases de historia
- Escopo limitado a estrutura e placeholders, sem implementacao de dominio

