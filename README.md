

# Desafio Técnico – Migração PHP Nativo para Laravel 12

Este projeto é parte de um teste técnico com foco em **migração de código legado em PHP procedural (7.4)** para **Laravel 12 moderno**, aplicando boas práticas, validações, arquitetura limpa e testes automatizados.


#### Plano de migração

[Acesso o plano de migração](https://github.com/fariaslima/desafio_jml/blob/main/PLANO_MIGRACAO.MD)



## 📦 Requisitos

- Docker + Docker Compose
- PHP e Composer (apenas se quiser rodar fora do Docker)
## ▶️ Como rodar o projeto

#### Subir containers
```bash
docker-compose up -d --build
````

#### Instalar dependências
```
composer install
```

#### Gerar chave da aplicação
```
php artisan key:generate
```

#### Rodar migrations + seeders
```
php artisan migrate --seed
```

Após isso, o banco estará populado com 8 fornecedores fake via FornecedorSeeder.
## 🌐 Documentação da API

#### Retorna todos os fornecedores

```http
  GET /api/fornecedores
```

#### Suporta busca por nome

```http
  GET /api/fornecedores?q=joão
```

#### Cria fornecedor

```http
    POST /api/fornecedores
    Content-Type: application/json

    {
        "nome": "Fornecedor Exemplo",
        "cnpj": "12345678000199",
        "email": "contato@fornecedor.com"
    }
```
#### Deleta um fornecedor

```http
  GET /api/forncedores/${id}
```

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `id`      | `string` | **Obrigatório**. O ID do forncedor que você quer deletar |



## 🧪 Rodar Testes

```
php artisan test
```

#### Os testes cobrem:
- Criação bem-sucedida de fornecedor com dados válidos
- Validação de dados inválidos (nome muito curto, CNPJ inválido)
- Filtragem de fornecedores por nome
- Prevenção de CNPJ duplicado
- Validações obrigatórias (nome e CNPJ ausentes)
- Rejeição de CNPJ com todos zeros ou inválido pela regra de validação
- Exclusão via API
- Verificação de soft delete no banco
- Invisibilidade normal
    - Verifica que o registro não é mais encontrado, simulando que foi "removido" para consultas normais.
- Visibilidade com trashed
    - Confirma que o registro ainda existe e pode ser recuperado, permitindo restauração ou consultas especiais.


## 📂 Estrutura relevante

```
/app
    /Http
        /Controllers/Api/FornecedorController.php
        /Requests/StoreFornecedorRequest.php
        /Resources/FornecedorResource.php
        /Resources/FornecedorCollection.php
    /Models/Fornecedor.php
    /Services/FornecedorService.php
    /Services/FornecedorDataPreparer.php
    /Services/ValidationService.php

/database
    /factories/FornecedorFactory.php
    /seeders/FornecedorSeeder.php
    /seeders/DatabaseSeeder.php

/legacy
    fornecedor_legacy.php   <-- código legado incluído

/tests
    Feature/FornecedorTest.php
    Feature/FornecedorSoftDeleteTest.php
```
## 🖍 Roadmap

Este roadmap sugere futuras melhorias e funcionalidades planejadas para o sistema de fornecedores. As tarefas estão organizadas por prioridade e fase de desenvolvimento.

### Fase 1: Melhorias no Backend (Próximas 1-2 semanas)
- [ ] **Autenticação e Autorização**: Implementar JWT ou Sanctum para proteger endpoints da API.
- [ ] **Paginação Avançada**: Melhorar paginação com meta-dados (total, páginas, links).
- [ ] **Validações Adicionais**: Adicionar validação de CPF, telefone e endereço.
- [ ] **Logs e Auditoria**: Implementar logging de ações (criação, edição, exclusão) para compliance.
- [ ] **Rate Limiting**: Adicionar limite de requisições por IP/usuário para prevenir abuso.

### Fase 2: Expansão da API (Próximas 2-4 semanas)
- [ ] **Endpoints para Usuários**: CRUD completo para usuários (admin, cliente).
- [ ] **Relacionamentos**: Adicionar categorias ou tipos de fornecedores.
- [ ] **Busca Avançada**: Filtros por data, status, e busca full-text.
- [ ] **Export/Import**: Suporte a CSV/Excel para importação/exportação de fornecedores.
- [ ] **Notificações**: Envio de emails/SMS para eventos (ex.: fornecedor criado).

### Fase 3: Frontend e UX (Próximas 4-6 semanas)
- [ ] **Interface Web**: Desenvolver dashboard com Vue.js/React para gerenciar fornecedores.
- [ ] **Formulários Dinâmicos**: Validação em tempo real no frontend.
- [ ] **Dashboard com Gráficos**: Estatísticas de fornecedores (ativos, inativos, por região).
- [ ] **Responsividade**: Otimizar para mobile e tablets.
- [ ] **Internacionalização (i18n)**: Suporte a múltiplos idiomas (PT/EN).

### Fase 4: Otimização e Escalabilidade (Próximas 6-8 semanas)
- [ ] **Cache**: Implementar Redis para cache de queries frequentes.
- [ ] **Testes Unitários/Feature**: Aumentar cobertura para 80%+.
- [ ] **API Versioning**: Suporte a v1, v2 da API para backward compatibility.
- [ ] **Monitoramento**: Integração com Sentry/New Relic para logs de erro.
- [ ] **Performance**: Otimizar queries N+1, usar eager loading.

### Fase 5: Produção e Manutenção (Próximas 8-12 semanas)
- [ ] **Deploy Automatizado**: Configurar CI/CD com GitHub Actions/Docker.
- [ ] **Documentação da API**: Usar Swagger/OpenAPI para docs interativas.
- [ ] **Segurança**: Auditoria de segurança, HTTPS obrigatório, sanitização de inputs.
- [ ] **Backup e Recuperação**: Estratégia de backup de banco e recuperação de dados.
- [ ] **Suporte a Microserviços**: Preparar para dividir em serviços menores se necessário.

### Contribuições
Sinta-se à vontade para sugerir novas ideias ou contribuir com qualquer item do roadmap. Abra uma issue ou PR no repositório!

### Prioridades
- **Alta**: Autenticação, paginação, validações.
- **Média**: Frontend, notificações, cache.
- **Baixa**: Microserviços, i18n avançada.



## Autores

- Paulo Lima (fariaslima@gmail.com)
- [@fariaslima](https://www.github.com/fariaslima)

