<?php
$host = '147.45.138.172';
$dbname = "default_db";
$username = "gen_user";
$password = "Qb@88\J:fFYRt)";
$charset = 'utf8mb4';

// Создание соединения
$conn = new mysqli($host, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Ошибка соединения: " . $conn->connect_error);
}
?>
<?php 
