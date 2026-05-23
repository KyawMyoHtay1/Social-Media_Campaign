# SMC Site

This project is deployable on Railway as a plain PHP application.

## Railway deploy steps

1. Push this repository to GitHub.
2. In Railway, create a new project from the GitHub repository.
3. Add a MySQL service to the same Railway project.
4. Deploy the web service. Railway will use the root `Dockerfile`.
5. Set reCAPTCHA variables on the web service:
   - `RECAPTCHA_SITE_KEY`
   - `RECAPTCHA_SECRET_KEY`
6. In the web service variables, add Railway variable references from the MySQL service or set the values manually:
   - `MYSQLHOST=${{MySQL.MYSQLHOST}}`
   - `MYSQLPORT=${{MySQL.MYSQLPORT}}`
   - `MYSQLDATABASE=${{MySQL.MYSQLDATABASE}}`
   - `MYSQLUSER=${{MySQL.MYSQLUSER}}`
   - `MYSQLPASSWORD=${{MySQL.MYSQLPASSWORD}}`
7. Import your existing MySQL data into Railway, or at minimum run `database/schema.sql` against the Railway MySQL database.
8. Generate a Railway public domain from the web service Networking settings.

## Database configuration

The app now supports both local-style variables and Railway MySQL variables.

- Local or generic variables: `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`
- Railway MySQL variables: `MYSQLHOST`, `MYSQLPORT`, `MYSQLDATABASE`, `MYSQLUSER`, `MYSQLPASSWORD`, `MYSQL_URL`

If you use Railway's MySQL service, reference its variables in your web service so they are available at runtime.

## Important note about uploads

User profile images are written to `photos/profile_photos/`.

That works in the deployed container, but those uploads are not durable across fresh deploys or container replacement unless you move them to persistent storage. For production, use one of these options:

1. Attach a Railway volume and store uploads there.
2. Move uploads to object storage such as a Railway bucket.

If you use a Railway Volume with the current code, mount it to:

- `/var/www/html/photos/profile_photos`

## Security note

The tracked `code` file in this repository still contains old reCAPTCHA keys. Rotate those keys and remove that file before pushing this repository to a public remote.

## Local development

Copy `.env.example` to `.env` and fill in your local database and reCAPTCHA values.
