# Research: Arquitetura Base Oficial do Backend

## Decision 1: Fonte oficial da estrutura
- Decision: Usar exclusivamente a secao "Estrutura de diretorios (kebab-case)" do documento Agildesk Backend System Design.md como blueprint da feature.
- Rationale: O usuario removeu escopo por modulo especifico e pediu aderencia estrita as linhas marcadas do documento.
- Alternatives considered:
  - Usar modulo existente como modelo principal: rejeitado por causar desvio do blueprint oficial.
  - Definir estrutura livre por conveniencia: rejeitado por risco de inconsistencias.

## Decision 2: Escopo tecnico da entrega
- Decision: Entregar apenas scaffolding estrutural (pastas e arquivos base) sem implementacao de logica de dominio.
- Rationale: O principio explicitado da feature e "arquitetura completa sem escrever codigo".
- Alternatives considered:
  - Incluir endpoints e regras de negocio iniciais: rejeitado por violar o escopo definido.
  - Incluir SQL de producao e persistencia real: rejeitado por antecipar fase de implementacao.

## Decision 3: Convencoes de nomeacao
- Decision: Aplicar nomenclatura exatamente como no documento (kebab-case e nomes de arquivo por modulo).
- Rationale: Aderencia total ao design reduz retrabalho e facilita onboarding.
- Alternatives considered:
  - Renomear para estilo alternativo: rejeitado por quebrar alinhamento com arquitetura acordada.

## Decision 4: Estrategia de validacao
- Decision: Validar por correspondencia de arvore de diretorios/arquivos e checklist arquitetural.
- Rationale: Nao ha comportamento de execucao para testar nesta etapa; a validacao e estrutural.
- Alternatives considered:
  - Testes de integracao/funcionais: rejeitado por depender de implementacao fora de escopo.

## Decision 5: Gate de constituicao ausente
- Decision: Prosseguir com gates derivados do spec e do documento de design, registrando ausencia de `.specify/memory/constitution.md`.
- Rationale: O repositorio nao contem arquivo de constituicao; bloquear o planejamento impediria avancar uma feature puramente estrutural com requisitos claros.
- Alternatives considered:
  - Interromper planejamento ate constituicao existir: rejeitado por nao ser necessario para este escopo fechado.

## Decision 6: Modulo legado chat
- Decision: Manter `src/modules/chat` no repositorio por solicitacao explicita do usuario.
- Rationale: O modulo e legado/preexistente e sua manutencao nao bloqueia o escopo estrutural exigido nas linhas marcadas do blueprint.
- Alternatives considered:
  - Remover modulo chat para espelhar apenas o blueprint: rejeitado por decisao do usuario.
