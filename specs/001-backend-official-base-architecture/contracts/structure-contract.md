# Contract: Structure Blueprint Contract

## Purpose
Definir o contrato verificavel da estrutura base do backend que deve ser criada nesta feature.

## Contract Type
Filesystem Structure Contract (arquitetura de diretorios e arquivos)

## Required Roots
- src/
- public/
- storage/
- tests/

## Required Subtrees
- src/config/{app.php,cors.php,env.php,session.php}
- src/database/{connection.php}
- src/shared/{exceptions/,helpers/,http/,middlewares/,responses/}
- src/modules/auth/{dto/login-dto.php,auth-routes.php,auth-controller.php,auth-service.php,auth-repository.php,auth-validator.php}
- src/modules/users/{dto/create-user-dto.php,user-routes.php,user-controller.php,user-service.php,user-repository.php,user-validator.php}
- src/modules/tickets/{dto/create-ticket-dto.php,dto/update-ticket-status-dto.php,dto/assign-ticket-dto.php,dto/ticket-filters-dto.php,ticket-routes.php,ticket-controller.php,ticket-service.php,ticket-repository.php,ticket-validator.php}
- src/modules/comments/{dto/create-comment-dto.php,comment-routes.php,comment-controller.php,comment-service.php,comment-repository.php,comment-validator.php}
- src/modules/notifications/{dto/,notification-routes.php,notification-controller.php,notification-service.php,notification-repository.php,notification-validator.php}
- src/modules/dashboard/{dto/,dashboard-routes.php,dashboard-controller.php,dashboard-service.php,dashboard-repository.php,dashboard-validator.php}
- public/{index.php}
- storage/{logs/}

## Naming Rules
- Pastas e arquivos em kebab-case quando aplicavel, respeitando exatamente os nomes definidos no documento.

## Out of Contract
- Implementacao de regra de negocio
- SQL de producao
- Endpoints REST completos
- Integracao realtime funcional

## Validation Criteria
- 100% dos caminhos requeridos existem
- Caminhos extras preexistentes sao permitidos quando nao conflitam com os caminhos requeridos (ex.: `src/modules/chat` legado)
- Arquivos base mantem conteudo estrutural minimo
