# AGENTS.md — LaParola (`Sito/`)

Guidance for AI coding agents working **only in this directory** (`Sito/`). Ignore other sibling folders in the monorepo. Language for this file: **English**.

## What this project is

**LaParola** is an Italian Bible study website ([laparola.net](https://www.laparola.net/)): online Bible text in multiple Italian versions, search, commentaries, interlinear Greek, vocabulary, difficult passages (“brani difficili”), quizzes, chapter summaries, and related study tools.

This directory holds the **classic website + MySQL data**, adapted to run locally with Docker (fork lineage: [LPN6/LaParola](https://github.com/LPN6/LaParola)).

## Runtime versions (source of truth)

Use the stack defined in `docker-compose.yml`. Do not upgrade PHP or MySQL unless the user asks.

| Component | Docker image | Host ports |
|-----------|--------------|------------|
| Web | `php:8.1-apache` | http://localhost:8080 → container `:80` |
| Database | `mysql:5` | localhost:13306 → container `:3306` |

PHP is further configured at container start (no custom Dockerfile):

- Extension: `mysqli`
- `short_open_tag=On` (required by almost all pages)
- Apache modules: `rewrite`, `headers`
- `memory_limit=256M`, upload/post max 32M

MySQL server flags in Compose include `utf8mb4` charset/collation, `max_allowed_packet=128M`, `secure-file-priv=/var/lib/mysql-files`, `innodb-autoinc-lock-mode=0`.

## Repository layout

```
Sito/
├── docker-compose.yml   # mysql:5 + php:8.1-apache
├── .env / .env.example  # DB credentials (never commit .env)
├── Database/            # Schema SQL + pipe-delimited data dumps
├── Pagine/              # Document root (mounted at /var/www/html)
└── test/                # Placeholder; no active test suite yet
```

### `Pagine/` — web application

Apache document root. Almost all dynamic pages are **PHP**.

| Area | Purpose |
|------|---------|
| `capo.php` / `piede.php` | Shared HTML head/nav and footer layout |
| `conn.php` | MySQLi connection from env vars |
| `funzioni.php` | Shared helpers (errors, Bible links, version mapping) |
| `vistesto.php` | Core: parse references, load/render verse text |
| `tabella_var.php` | Request sanitization + common GET/POST/cookie params |
| `testo.php` | Display a passage (multi-version) |
| `ricerca.php` / `ricfrase.php` | Full-text / phrase search |
| `bibbia/`, `commentario/` | Book/chapter navigation |
| `interlineare/` | Greek interlinear |
| `greco/` | Strong’s, concordances, manuscripts helpers |
| `vocab/` | Greek–Italian NT vocabulary |
| `brani/` | “Brani difficili” pages + data file (see below) |
| `studi/`, `riassunti/`, `quiz/` | Studies, chapter summaries, quizzes |
| `intro/`, `faq/`, `riflessioni/`, `panoramica/` | Editorial / teaching content |
| `nomi/` | Biblical names encyclopedia (many static HTML files) |
| `app/` | “Testo continuo” web Bible reader (static HTML/JSON under `content/`) |
| `stili/` | Site CSS/JS |
| `immagini/`, `file/` | Assets and downloadable packages |
| `f.htaccess` | Error documents, gzip, cache (deploy as `.htaccess` if needed) |

Typical page shape:

```php
<?
// set $titolo, $descriz, $key, $sezione
require("capo.php");
include("conn.php");
// page body / queries
require("piede.php");
```

Subfolders use relative includes (`../conn.php`, `../capo.php`, etc.).

### `Database/` — schema and bulk data

| File type | Role |
|-----------|------|
| `import.sql` | Main schema + `LOAD DATA` for verses, versions, books, word roots, stats |
| `importinterlineare.sql` | Interlinear table |
| `importquiz.sql` | Quiz + themes |
| `importriassunti.sql` | Chapter summaries |
| `importstudi.sql` | User studies, authors, votes |
| `importvocab.sql` | Vocabulary |
| `import-tool.sh` | Interactive importer via `docker compose exec` |
| `*.txt` | Pipe-delimited (`|`) data for `LOAD DATA LOCAL INFILE` |

**Main tables (from `import.sql` and satellites):**

- `Versetti` — verse text keyed by version (`id_t`), book, chapter, verse
- `Versioni` — version metadata (`Nome`, language, type `v`=version / `c`=commentary)
- `Libri`, `Abbreviazioni` — book names and abbreviations
- `Parole`, `Radici`, `Apparenze` — word index for search
- `Letture` — daily reading plan
- `Interlineare`, `Vocabolario`, `Riassunti`, `Quiz` / `QuizTemi`, `Studi` / `Autori` / `Voti`
- `Statistiche` — usage counters

Verse dump format (example `nr.txt`):

```text
id_t|Libro|Capitolo|Versetto|Testo|
```

Text often contains HTML entities and inline markup (`&laquo;`, `<br />`, etc.). Some large commentary dumps are split (`commentpulpitoA/B.txt`, `commentillustratoreA/B.txt`) because of GitHub’s 100 MB file limit; `import-tool.sh` concatenates them before import. Merged `commentpulpito.txt` / `commentillustratore.txt` are **gitignored**.

#### “Brani difficili” data: `Pagine/brani/brani.sql`

Path: **`Pagine/brani/brani.sql`** (not under `Database/`).

Despite the `.sql` extension, this file is **pipe-delimited content data** for the Brani feature (not a full CREATE/LOAD script like `Database/import*.sql`). Related files in the same folder:

- `brani.php`, `index.php` — PHP pages
- `Brani difficili nella Bibbia.pdf` — PDF export/source material

Compose mounts `./Pagine/brani` into the DB container at `/var/lib/mysql-files/brani` for optional loading. That import is **not** wired into `import-tool.sh` today.

## Local development

### Prerequisites

- Docker + Docker Compose
- Copy env: `cp .env.example .env` (defaults match Compose / `conn.php`)

### Start stack

From **`Sito/`** (this directory):

```bash
docker compose up
```

| Service | Image | Host access |
|---------|--------|-------------|
| `web` | `php:8.1-apache` | http://localhost:8080 |
| `db` | `mysql:5` | localhost:13306 |

`Pagine` is mounted **read-only** into the web container. DB connection for PHP comes from env (`DB_HOST=db`, etc.) via `conn.php`.

### Import database

With containers running, from **`Sito/`** (so `docker compose` resolves):

```bash
bash Database/import-tool.sh
```

Options:

1. Main tables (`import.sql`) — also merges split commentary files
2. Interlineare
3. Quiz
4. Riassunti
5. Studi
6. Vocabolario  
`all` — everything above

Imports run inside the DB container with `mysql --local-infile=1` against files under `/var/lib/mysql-files/data` (the `Database/` folder).

Full import is **large** (hundreds of MB of text; multi-minute). For small UI work you may only need option `1`. Data volume: Docker volume `dbdata`.

## Coding conventions

### Target runtime

- Write PHP that runs on **PHP 8.1** as in `php:8.1-apache`.
- Write SQL / schema assumptions compatible with **MySQL 5** as in `mysql:5`.
- Do not require PHP extensions beyond what Compose installs (`mysqli` + base image). Prefer `mysqli` over PDO unless the codebase already uses something else for that path.

### Language and audience

- UI copy, meta tags, and editorial content are **Italian**.
- Prefer Italian for user-facing strings.
- This agent guide stays in English.

### PHP style (legacy — match existing code)

- Prefer **`<?` short tags**, not only `<?php` (Compose enables short tags).
- Shared connection: `include`/`require` of `conn.php`; use global `$conn` with **mysqli**.
- Layout: set `$titolo`, `$descriz`, `$key`, `$sezione` then `require("capo.php")` … `require("piede.php")`.
- Reference parsing and display logic live in **`vistesto.php`** (`converti_rif`, `vistesto`, book abbreviation maps). Reuse these; do not reimplement book/reference parsing elsewhere.
- Light input filtering: `sanitizeVariabile()` in `tabella_var.php`. Much legacy code interpolates SQL — be careful when extending; prepared statements are preferred for new queries where practical.
- Encoding is **mixed historically** (ISO-8859-1 / HTML entities in pages; UTF-8 dumps for some tables; `utf8mb4` connection). Touch encoding only when necessary and test Italian accents and Greek.
- Prefer minimal, local changes over large refactors of `vistesto.php` / `ricfrase.php` unless the task requires it.

### Data / SQL

- Prefer updating **source `.txt` dumps + import SQL** when content is DB-backed, not only live DB state.
- Field terminator is usually `|` (quiz uses `;` + optional quotes — see `importquiz.sql`).
- Keep `LOAD DATA LOCAL INFILE` paths relative to the data directory as used inside the container.
- Do not commit regenerated mega-files `commentpulpito.txt` / `commentillustratore.txt` (see `.gitignore`).

### Front-end

- Classic site CSS: `stili/stilebase6.css` (+ print stylesheet).
- jQuery / jQuery UI loaded from CDN in `capo.php`.
- `Pagine/app/` is a separate static reader; treat `content/` as a **generated/static corpus** (tens of thousands of files) — avoid bulk reformatting.

### Security / secrets

- Never commit `.env` or real passwords.
- `conn.php` reads `DB_*` from the environment; do not hardcode production credentials.
- `Studi` / `Autori` dumps may include password fields — do not log or expose them.

## What not to do

- Do not work on or reference other monorepo trees outside `Sito/`.
- Do not rewrite the site to a modern framework unless explicitly asked.
- Do not run `DROP DATABASE` / full reimport against a DB the user relies on without confirmation.
- Do not delete or “clean up” large data files under `Database/` or `Pagine/app/content/` casually.
- Do not force-push or change remote git history without explicit request.
- Avoid drive-by refactors of encoding, SQL style, or layout across hundreds of PHP files.
- Do not bump PHP/MySQL images without an explicit request.

## Useful smoke checks

After stack + import:

1. http://localhost:8080 — home
2. Passage view: `testo.php` with a reference (default Genesi 1:1)
3. Search: `ricerca.php` with a common Italian word
4. Continuous text app: `/app/`
5. Optional: interlinear, vocab, brani if those data sets are loaded

There is **no mature automated test suite** under `test/` yet; verify manually or add tests if requested.

## Key domain concepts

- **Versione** — Bible translation or commentary stream (`Versioni.Tipo`: `v` or `c`). Default display version is often **Nuova Riveduta**.
- **Riferimento** — human Bible reference string (e.g. `Giovanni 3:16-17`); parsed into packed book/chapter/verse bytes by `converti_rif()`.
- **id_t** — version id in `Versetti` / `Versioni`.
- **Libro** numbers follow the internal book list in `vistesto.php` (includes deuterocanonical books for some versions).
- **Apparenze** — word occurrence links for search (`id_p` → `id_v`).

## Common tasks (quick map)

| Task | Start here |
|------|------------|
| Fix DB connection / env | `conn.php`, `.env`, `docker-compose.yml` |
| Change verse display / multi-version | `vistesto.php`, `testo.php` |
| Search bugs | `ricfrase.php`, `ricerca.php`, `Parole`/`Apparenze` data |
| Layout / menu / footer | `capo.php`, `piede.php`, `stili/stilebase6.css` |
| Add/import content tables | `Database/import*.sql`, `import-tool.sh`, matching `.txt` |
| Continuous-reader app | `Pagine/app/` (`index.html`, `api.php`, `content/`) |
| Difficult passages | `Pagine/brani/` (`brani.php`, `brani.sql`) |

## Git note

Git root may be the monorepo parent with `Sito` as a subtree. When committing, confirm the actual git root and stage only paths under `Sito/` relevant to the task.

---

When in doubt: **prefer small, reversible changes; keep short open tags and mysqli patterns; stay on PHP 8.1 / MySQL 5; treat Bible dumps and `app/content` as data, not code to reformat.**
