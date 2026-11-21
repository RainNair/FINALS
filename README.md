# Transaction Management System

Laravel transaction management system with authentication, full transaction CRUD, configurable SMTP email delivery, and transaction-completion emails.

## Features

- Login, registration, and logout authentication.
- Authenticated transaction list, details, create, edit, and delete actions.
- Customers create bookings as pending and may cancel their own bookings; only the admin can mark bookings completed or change any booking status.
- Validation for transaction number, customer details, amount, date, status, and notes.
- Unique transaction numbers and pending, completed, and cancelled statuses.
- Mailable email notification for pending, completed, and cancelled reservation statuses.
- SMTP settings and notification recipient configured through `.env`.

## Setup

```bash
composer install
copy .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

The seeded accounts are:

```text
Admin email: theespi116@gmail.com
Password: password

User email: user@example.com
Password: password
```

For development, leave `MAIL_MAILER=log` and inspect `storage/logs/laravel.log`. For real email, set `MAIL_MAILER=smtp` and the SMTP host, port, username, password, and from address in `.env`. When a reservation is created, or its status changes to `pending`, `completed`, or `cancelled`, the Mailable is sent to the valid email entered in that reservation's `customer_email` field.

## Public host and VS Code email log

Run the application locally with:

```bash
php artisan serve
```

Open it at `http://127.0.0.1:8000`. Render handles the public host after deployment.

To watch booking, editing, status changes, and email activity in the VS Code terminal, open a second terminal and run:

```powershell
Get-Content .\storage\logs\laravel.log -Wait
```

After a reservation is created or edited, the log will show the booking activity and recipient. The actual email will arrive in the customer email entered in the reservation form.

To print database queries directly in the terminal running `php artisan serve`, add these values to `.env`:

```env
LOG_CHANNEL=stderr
LOG_DB_QUERIES=true
```

Then run:

```powershell
php artisan optimize:clear
php artisan serve
```

Reservation inserts, updates, reads, and deletes will appear in the same VS Code terminal.

## Render deployment

The project includes `Dockerfile`, `start-render.sh`, `.dockerignore`, and `render.yaml` for Render. Push the project to GitHub, create a Render Blueprint from the repository, and deploy the `savoria-restaurant` web service with its Render PostgreSQL database. Render supplies the public `onrender.com` URL and the Docker command binds Laravel to `0.0.0.0` using Render's `PORT` value. The server starts before migrations so Render's `/up` health check can respond while the database is prepared. Set `APP_URL` to the generated HTTPS URL and add the Gmail SMTP values in the Render Environment settings. Do not use SQLite in production because Render service files are ephemeral; use the included PostgreSQL connection.

If Render displays `Not Found`, verify that the service is a **Docker Web Service**, the repository root contains `Dockerfile` and `render.yaml`, and the deployed commit is the latest one. The Render health check uses `/login`, while `/` redirects guests to `/login`.
