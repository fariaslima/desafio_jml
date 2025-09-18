
# 📄 Plano de Migração – Sistema Fornecedores

## Contexto
O sistema legado em PHP 7.4 procedural (arquivo `fornecedor_legacy.php`) será migrado para Laravel 12, aproveitando recursos modernos e arquitetura limpa.
## Estratégia

1. **Mapeamento da Tabela**
   - Tabela `fornecedores` mantida.
   - Campos adaptados para `created_at`, `updated_at`, `deleted_at`.

2. **Camadas**
   - **Model Eloquent**: `Fornecedor`.
   - **Requests**: validação e sanitização de CNPJ.
   - **Service Layer**: regras de negócio e transações.
   - **Resources**: padronização JSON.
   - **Controllers**: apenas orquestram fluxo.

3. **Incremental**
   - Código legado preservado em `/legacy`.
   - API moderna implementada em paralelo.
   - Migração completa após testes.

4. **Validações**
   - `nome`: obrigatório, min 3.
   - `cnpj`: 14 dígitos, único, validação customizada.
   - `email`: opcional, formato válido.

5. **Testes**
   - Casos de sucesso, falha de validação e busca com filtro.
   - Garantia de compatibilidade.
## Benefícios
- Segurança contra SQL Injection (Query Builder + Eloquent).
- Arquitetura limpa e desacoplada.
- Evolução futura mais simples (Laravel 12).
- Código testável e documentado.
## Autores

- Paulo Lima (fariaslima@gmail.com)
- [@fariaslima](https://www.github.com/fariaslima)

