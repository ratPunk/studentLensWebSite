<?php
// Подключение глобальной переменной $conn, которая содержит подключение к базе данных
global $conn;

// Подключение файла db.php, который содержит настройки подключения к базе данных
require_once ('db.php');

// Получаем данные из формы
$login = $_POST['login'];
$pass = $_POST['pass'];

// Получаем хэш пароля пользователя из базы данных
$sql = "SELECT pass FROM users WHERE login=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $login);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $hashed_password_from_db = $row['pass'];

    // Проверяем пароль
    if (password_verify($pass, $hashed_password_from_db)) {
        // Если пароль верный, перенаправляем на страницу успешного входа
        header("Location: gallery.html");
        exit;
    } else {
        // Если пароль неверный, выводим сообщение об ошибке
        echo "Invalid login or password.";
    }
} else {
    // Если пользователь не найден, выводим сообщение об ошибке
    echo "Invalid login or password.";
}

$stmt->close();
$conn->close();
?>