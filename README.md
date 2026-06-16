# Sistema Pedagógico

Sistema web para gerenciamento de atividades pedagógicas, elaboração de planos de aula e fluxo de revisão entre professores e coordenação.

## Sobre o Projeto

O Sistema Pedagógico foi desenvolvido como parte de um projeto acadêmico com o objetivo de centralizar o armazenamento de atividades educacionais e padronizar o processo de criação, revisão e aprovação de planos de aula.

A aplicação permite que professores criem atividades reutilizáveis, organizadas por disciplina e série, componham planos de aula e os submetam para validação pedagógica.

Os coordenadores podem revisar os materiais, registrar comentários e aprovar ou rejeitar os conteúdos.

## Funcionalidades

### Professor

- Cadastro e gerenciamento de atividades;
- Upload de imagens para atividades;
- Criação e edição de planos de aula;
- Vinculação de atividades aos planos de aula;
- Pré-visualização do documento final;
- Exportação para PDF e DOCX;
- Submissão de aulas para revisão;
- Acompanhamento do status das revisões.

### Coordenador

- Gerenciamento de disciplinas;
- Gerenciamento de séries;
- Consulta de aulas submetidas;
- Aprovação e rejeição de planos de aula;
- Registro de comentários de revisão;
- Exportação de documentos.

## Tecnologias Utilizadas

### Backend

- PHP 8.3
- Laravel 11
- Laravel Breeze
- Spatie Laravel Permission

### Frontend

- Blade
- Bootstrap 5
- JavaScript
- Vite

### Banco de Dados

- SQLite

### Geração de Documentos

- DomPDF
- PHPWord

### Infraestrutura

- Nginx
- PHP-FPM
- VPS Linux
- HTTPS com Let's Encrypt

## Arquitetura Simplificada

```text
Professor → Atividades → Plano de Aula → Revisão → Aprovação → Exportação
```

## Requisitos

- PHP 8.3 ou superior
- Composer
- Node.js 20 ou superior
- NPM
- SQLite

## Instalação

Clone o repositório:

```bash
git clone https://github.com/SEU-USUARIO/aula-repository.git
```

Acesse a pasta do projeto:

```bash
cd aula-repository
```

Instale as dependências do PHP:

```bash
composer install
```

Instale as dependências do frontend:

```bash
npm install
```

Crie o arquivo de ambiente:

```bash
cp .env.example .env
```

Gere a chave da aplicação:

```bash
php artisan key:generate
```

Crie o banco de dados SQLite:

### Linux

```bash
touch database/database.sqlite
```

### Windows (PowerShell)

```powershell
New-Item database/database.sqlite -ItemType File
```

Configure o arquivo `.env`:

```env
DB_CONNECTION=sqlite
DB_DATABASE=/caminho/para/database/database.sqlite
```

Execute as migrations e seeders:

```bash
php artisan migrate --seed
```

Crie o link simbólico para os arquivos públicos:

```bash
php artisan storage:link
```

Compile os assets:

```bash
npm run build
```

Inicie o servidor local:

```bash
php artisan serve
```

Acesse:

```text
http://127.0.0.1:8000
```
