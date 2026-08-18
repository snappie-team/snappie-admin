# AGENTS.md — Snappie Admin Panel

## Project Overview
Laravel 12 + Filament 3 admin panel for a gamified location-based check-in platform. PHP 8.2+, MySQL 8.0+.

## Key Commands

| Task | Command |
|------|---------|
| Install deps (backend + frontend) | `composer install && npm install` |
| Run everything (server + queue + Vite) | `composer dev` |
| Run tests (Pest) | `composer test` or `php artisan test` |
| Run single test file | `php artisan test --filter=UsersServiceTest` |
| Lint (Pint) | `./vendor/bin/pint` |
| Build assets | `npm run build` |
| Clear & cache config | `php artisan config:clear && php artisan config:cache` |
| Migrate + seed | `php artisan migrate --seed` |
| Storage link | `php artisan storage:link` |

## Architecture

- **Admin UI**: Filament 3 resources/widgets at `app/Filament/`
- **Domain**: Eloquent models at `app/Models/`
- **Services**: Business logic at `app/Services/` (tested in `tests/Unit/Services/`)
- **Observers**: Model observers at `app/Observers/`
- **Routing**: Filament panel at `/`, console commands in `app/Console/`

## Testing

- Framework: Pest (extends `Tests\TestCase`)
- Unit tests: `tests/Unit/Services/` — service layer only
- Feature tests: `tests/Feature/` (currently empty)
- Run with `php artisan test` — uses Pest config in `tests/Pest.php`

## Conventions

- **PSR-12** via Laravel Pint (no config file, uses defaults)
- **Filament resources** follow standard structure: `Resource.php`, `Pages/`, `RelationManagers/`
- **Services** contain business logic; controllers thin
- **Observers** handle model events (e.g., `PostObserver`, `ReviewObserver`)
- **Migrations** in `database/migrations/`, factories in `database/factories/`

## Environment

- Copy `.env.example` → `.env` before first run
- Required: `DB_CONNECTION=mysql`, `CLOUDINARY_*` for media
- Dev: `php artisan serve` (port 8000), `npm run dev` (Vite)
- Queue: `php artisan queue:listen --tries=1` (required for async jobs)

## Gotchas

- `public/build` and `vendor` are gitignored — run `npm run build` / `composer install` after clone
- `composer dev` runs server, queue, and Vite concurrently via `concurrently`
- Filament upgrade runs on `composer install` via `post-autoload-dump` script
- No Pint config file — uses Laravel defaults
- Tests are gitignored (see `.gitignore:28`) — ensure they run in CI

## graphify

This project has a knowledge graph at graphify-out/ with god nodes, community structure, and cross-file relationships.

When the user types `/graphify`, use the installed graphify skill or instructions before doing anything else.

Rules:
- For codebase questions, first run `graphify query "<question>"` when graphify-out/graph.json exists. Use `graphify path "<A>" "<B>"` for relationships and `graphify explain "<concept>"` for focused concepts. These return a scoped subgraph, usually much smaller than GRAPH_REPORT.md or raw grep output.
- Dirty graphify-out/ files are expected after hooks or incremental updates; dirty graph files are not a reason to skip graphify. Only skip graphify if the task is about stale or incorrect graph output, or the user explicitly says not to use it.
- If graphify-out/wiki/index.md exists, use it for broad navigation instead of raw source browsing.
- Read graphify-out/GRAPH_REPORT.md only for broad architecture review or when query/path/explain do not surface enough context.
- After modifying code, run `graphify update .` to keep the graph current (AST-only, no API cost).
