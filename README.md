# school-management-system-2

## Run in a new Codespace

The app requires PHP with the `pdo_mysql` extension and a MySQL server.

### 1) Install PHP MySQL support

```bash
sudo apt-get update
sudo apt-get install -y php-mysql
```

Verify the driver is installed:

```bash
php -m | grep -E 'pdo|mysql'
```

You should see `PDO` and `pdo_mysql`.

### 2) Start MySQL in Docker

```bash
docker rm -f sms_mysql 2>/dev/null || true
docker run --name sms_mysql -e MYSQL_ALLOW_EMPTY_PASSWORD=yes -e MYSQL_DATABASE=sms_db -p 3306:3306 -d mysql:8.0
for i in $(seq 1 30); do
  docker exec sms_mysql mysql -uroot -e "SELECT 1" &>/dev/null && break || sleep 2
done
```

### 3) Import the database

```bash
docker exec -i sms_mysql mysql -uroot sms_db < school-management-system/sms_db.sql
```

### 4) Start the web app

#### Option A: Docker PHP-Apache (recommended)

```bash
docker rm -f sms_php 2>/dev/null || true
docker run --name sms_php -d -p 8080:80 -v "$PWD/school-management-system":/var/www/html php:8.3-apache bash -lc "docker-php-ext-install pdo_mysql && apache2-foreground"
```

Open:

`http://127.0.0.1:8080`

#### Option B: PHP built-in server

```bash
cd school-management-system
php -S 0.0.0.0:8000
```

Then open the forwarded port `8000` in Codespaces.

### 5) Login credentials

- Username: `ibrahim`
- Password: `123`
- Role: `Admin`

### Troubleshooting

If login fails with `Connection failed: could not find driver`, install `php-mysql` and restart the PHP server.
