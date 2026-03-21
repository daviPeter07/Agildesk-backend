# Data Model: Arquitetura Base Oficial do Backend

## Entity: DirectoryBlueprint
- Description: Representa o blueprint oficial de diretorios e arquivos definidos no documento de design.
- Fields:
  - id (string): Identificador do blueprint (ex.: agildesk-backend-v1)
  - sourceDocument (string): Caminho/nome do documento de origem
  - sections (array<string>): Secoes cobertas (src, public, storage, tests)
  - namingConvention (string): Convencao oficial de nomes (kebab-case)
- Validation Rules:
  - sourceDocument obrigatorio
  - sections nao pode ser vazio
  - namingConvention deve ser kebab-case

## Entity: ModuleSkeleton
- Description: Representa a estrutura minima por modulo de dominio.
- Fields:
  - moduleName (string): Nome do modulo (auth, users, tickets, comments, notifications, dashboard)
  - hasDtoDirectory (bool): Indica existencia de dto/
  - routeFile (string)
  - controllerFile (string)
  - serviceFile (string)
  - repositoryFile (string)
  - validatorFile (string)
  - dtoFiles (array<string>): Lista de DTOs previstos no blueprint
- Validation Rules:
  - moduleName obrigatorio e unico por modulo
  - arquivos de camada obrigatorios
  - dtoFiles pode ser vazio apenas em modulos sem DTO definido nominalmente no blueprint

## Entity: BasePlaceholderFile
- Description: Arquivo base sem implementacao de negocio, criado para fixar contrato arquitetural.
- Fields:
  - path (string): Caminho relativo do arquivo
  - layer (enum): config|database|shared|routes|controller|service|repository|validator|dto|entrypoint
  - strictTypes (bool): Indica se arquivo PHP possui declare(strict_types=1)
  - hasBusinessLogic (bool): Deve permanecer false nesta feature
- Validation Rules:
  - path obrigatorio e deve existir
  - hasBusinessLogic deve ser false
  - strictTypes recomendado para arquivos PHP de camada

## Relationships
- DirectoryBlueprint 1:N ModuleSkeleton
- ModuleSkeleton 1:N BasePlaceholderFile

## State Transitions
- BasePlaceholderFile:
  - planned -> created
  - created -> validated
  - validated -> ready-for-implementation
