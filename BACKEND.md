# Afroverified backend

The project uses PHP 8.2, Doctrine DBAL, and Doctrine Migrations. It keeps the existing HTML/CSS presentation and exposes JSON endpoints from `api/`.

## Install and deploy

```bash
composer install --no-dev --optimize-autoloader
php bin/create-database.php
vendor/bin/doctrine-migrations migrations:migrate --no-interaction
php bin/seed.php
```

Configure production credentials with the `DB_HOST`, `DB_PORT`, `DB_NAME`, `DB_USER`, and `DB_PASSWORD` environment variables. The values supplied for local development are the current fallbacks in `config/database.php`.

The seeder is safe to run repeatedly: it exits without duplicating records when users already exist.

## Sample administrator

- Email: `admin@afroverified.com`
- Password: `Admin123!`

Change this password before production deployment.

## API

Public endpoints include events, event details, categories, venues, organizers, promotions, the current Vibe edition, event submission, and newsletter signup. Admin CRUD endpoints under `/api/admin/*` require a valid administrator session created through `/api/auth/login`.

Apache uses `api/.htaccess` to map clean `/api/events`-style URLs to the front controller. The direct equivalent for servers without rewriting is `/api/index.php?route=events`.
