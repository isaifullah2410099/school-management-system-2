# school-management-system-2

## Run in a new Codespace

This repository is a PHP school management application that requires PHP with PDO MySQL support and a MySQL database.

## Recommended setup: Docker Compose

This is the fastest reliable way to run the app in a new Codespace.

1. Start the app:

```bash
docker compose up --build
```

2. Open the application in your browser:

```text
http://127.0.0.1:8081
```

3. Default login credentials:

- Admin: `ibrahim` / `123`
- Teacher: `emma` / `123`
- Student: `lily` / `123`

4. To stop and remove containers:

```bash
docker compose down
```

## Local Codespace setup (without Docker)

If you prefer to run the app directly in the Codespace:

1. Install required packages:

```bash
sudo apt-get update
sudo apt-get install -y mariadb-server php php-mysql php-cli php-curl php-xml php-mbstring
```

2. Start MySQL:

```bash
sudo service mysql start
```

3. Create the database and import schema:

```bash
mysql -uroot -e "CREATE DATABASE IF NOT EXISTS sms_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
mysql -uroot sms_db < school-management-system/sms_db.sql
```

4. Run the PHP built-in server:

```bash
cd school-management-system
php -S 0.0.0.0:8000
```

5. Open the Codespace forwarded port `8000` in your browser.

## Verify PHP MySQL support

Run:

```bash
php -m | grep -E 'PDO|pdo_mysql'
```

You should see both `PDO` and `pdo_mysql`.

## Troubleshooting

- If you see `Connection failed: could not find driver`, install `php-mysql` and restart the PHP server.
- If the Docker Compose database does not load, run:

```bash
docker compose down -v
```

Then start again with:

```bash
docker compose up --build
```
