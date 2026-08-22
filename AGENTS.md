# Repository Guidelines

## Project Structure & Module Organization

This is a Laravel 12 / Filament 3.3 admin panel. Backend application code is under `app/`: HTTP code lives in `app/Http`, models in `app/Models`, reusable workflows in `app/Services`, and Filament resources/widgets in `app/Filament`. Migrations, factories, and seeders are in `database/`. Routes are in `routes/api.php` and `routes/web.php`. Frontend entry points and Tailwind styles are in `resources/js` and `resources/css`; Vite output is generated in `public/build`. API documentation is in `docs/openapi.yaml`. Tests belong in `tests/Feature` or `tests/Unit`.

## Build, Test, and Development Commands

- `composer install` and `npm install` install PHP and frontend dependencies.
- `php artisan migrate --seed` applies the schema and loads development data; configure `.env` first.
- `composer dev` runs the Laravel server on port 8001, queue listener, and Vite together.
- `php artisan serve` starts only the Laravel application; use `npm run dev` for live frontend assets.
- `npm run build` creates production assets in `public/build`.
- `composer test` (or `php artisan test`) runs the Pest/PHPUnit suite.
- `vendor/bin/pint` formats PHP according to Laravel Pint.

## Coding Style & Naming Conventions

Follow PSR-12 and existing Laravel conventions: four-space indentation, one class per file, StudlyCase classes, camelCase methods/variables, and snake_case database fields. Name migrations with Laravel timestamps and factories with the related model plus `Factory` (for example, `PlaceFactory`). Keep domain logic in services/models rather than duplicating it in pages or controllers. Run Pint on changed PHP files before committing; use the existing Vite/Tailwind configuration for frontend imports.

## Testing Guidelines

Use Pest 3 with PHPUnit 11. Put request and integration coverage in `tests/Feature`, isolated behavior in `tests/Unit`, and name files after the subject (for example, `PlacesServiceTest.php`). Add regression tests for bug fixes and run `composer test` locally. No coverage minimum is configured.

## Commit & Pull Request Guidelines

Recent history uses short Conventional Commit-style subjects such as `feat: ...` and `refactor(seeder): ...`; use an imperative, concise subject and a scope when useful. Pull requests should explain the behavior change, link the relevant issue or task, call out migrations/configuration changes, and include screenshots for Filament/UI changes. Mention tests/build commands run and any required `.env` or deployment steps.

## Security & Configuration Tips

Never commit `.env`, credentials, API keys, or production exports. Start from `.env.example`, keep `APP_DEBUG=false` outside local development, and treat Cloudinary, database, admin, and queue settings as environment-specific secrets. Review migrations and seeders carefully before running them against shared databases.

## graphify

This project has a knowledge graph at graphify-out/ with god nodes, community structure, and cross-file relationships.

When the user types `/graphify`, use the installed graphify skill or instructions before doing anything else.

Rules:
- For codebase questions, first run `graphify query "<question>"` when graphify-out/graph.json exists. Use `graphify path "<A>" "<B>"` for relationships and `graphify explain "<concept>"` for focused concepts. These return a scoped subgraph, usually much smaller than GRAPH_REPORT.md or raw grep output.
- Dirty graphify-out/ files are expected after hooks or incremental updates; dirty graph files are not a reason to skip graphify. Only skip graphify if the task is about stale or incorrect graph output, or the user explicitly says not to use it.
- If graphify-out/wiki/index.md exists, use it for broad navigation instead of raw source browsing.
- Read graphify-out/GRAPH_REPORT.md only for broad architecture review or when query/path/explain do not surface enough context.
- After modifying code, run `graphify update .` to keep the graph current (AST-only, no API cost).
