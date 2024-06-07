<?php
// Подключение глобальной переменной $conn, которая содержит подключение к базе данных
global $conn;

// Подключение файла db.php, который содержит настройки подключения к базе данных
require_once ('db.php');

// Получение данных из формы регистрации
$login = $_POST['login']; // Логин пользователя
$pass = $_POST['pass']; // Пароль пользователя
$repeatpass = $_POST['repeatpass']; // Повторный ввод пароля
$email = $_POST['email']; // Email пользователя

// Проверка совпадения паролей
if ($pass !== $repeatpass) {
    echo "<script>alert('Пароли не совпадают.'); window.location.href = 'register.html';</script>";
    exit;
}

// Хеширование пароля
$hashed_password = password_hash($pass, PASSWORD_DEFAULT);

// Приведение строки к нижнему регистру
$lowerCaseStr = strtolower($login);

// Удаление пробелов
$loginNoSpaceLowerCase = str_replace(' ', '', $lowerCaseStr);

// Формирование SQL-запроса для добавления нового пользователя в таблицу users
$sql = "INSERT INTO `users` (login, pass, email) VALUES ('$loginNoSpaceLowerCase', '$hashed_password', '$email')";

// Выполнение SQL-запроса
if ($conn->query($sql) === TRUE) {
    header("Location: gallery.html");
} else {
    echo "<script>alert('Ошибка при регистрации: " . $conn->error . "'); window.location.href = 'register.html';</script>";
}

$conn->close();
?>