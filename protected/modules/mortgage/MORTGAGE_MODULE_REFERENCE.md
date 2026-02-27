# Mortgage module — database, files, and routes

## Database

- **Component:** `Yii::app()->dbMortgage`
- **Config:** `protected/config/main.php` (and localmain, stagingmain) → `dbMortgage`
- **Database name:** `elitemortgage` (production/local); staging: `staginga_elitemortgage` (or as set in staging config)
- All mortgage models and controllers use `dbMortgage`; no mortgage tables live in the default `db` (eliteautocash).

## URL routes (API and entry)

| Route (path or r=) | Module  | Controller | Action   | Purpose |
|--------------------|---------|------------|----------|---------|
| `api/pingpost`     | mortgage| api        | pingpost | Ping-Post API docs page |
| `api/index`        | mortgage| api        | index    | Direct Post API docs page |
| `mortgage/api/pingpost` | mortgage | api | pingpost | Same (explicit module) |
| `mortgage/api/index`   | mortgage | api | index    | Same (explicit module) |

`api/pingpost` and `api/index` are mapped in `urlManager` rules to `mortgage/api/pingpost` and `mortgage/api/index`.

## Config files

- `protected/config/main.php` — modules: `mortgage`, `dbMortgage` (elitemortgage), url rules
- `protected/config/localmain.php` — same url rules; `dbMortgage` (elitemortgage)
- `protected/config/stagingmain.php` — modules: `mortgage`; `dbMortgage` (staginga_elitemortgage); url rules

## Key files

- **ApiController:** `controllers/ApiController.php` — actionIndex(), actionPingpost()
- **API views:** `views/api/index.php`, `views/api/pingpost.php`
- **Layouts:** `views/layouts/api_layout.php`, `api_content_layout.php`
- **Ping/Post handlers:** `PingprocessController`, `PostprocessController`, `PingpostprocessController`
- **Models:** All in `models/` and use `Yii::app()->dbMortgage` (Submissions, AffiliateDailyCounts, LenderDetails, etc.)
