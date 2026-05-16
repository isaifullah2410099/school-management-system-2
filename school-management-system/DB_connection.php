<?php  

$sName = getenv('DB_HOST') ? getenv('DB_HOST') : '127.0.0.1';
$uName = getenv('DB_USER') ? getenv('DB_USER') : 'root';
$pass  = getenv('DB_PASS') ? getenv('DB_PASS') : '';
$db_name = getenv('DB_NAME') ? getenv('DB_NAME') : 'sms_db';

try {
	if (!in_array('mysql', PDO::getAvailableDrivers(), true)) {
		exit('Connection failed: PDO MySQL driver is not installed. Install php-mysql or use Docker Compose.');
	}

	$conn = new PDO("mysql:host=$sName;dbname=$db_name;charset=utf8mb4", $uName, $pass);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo "Connection failed: " . $e->getMessage();
	exit;
}