<?php
session_start();
// Подключение глобальной переменной $conn, которая содержит подключение к базе данных
global $conn;
// Подключение файла db.php, который содержит настройки подключения к базе данных
require_once ('db.php');

// Проверяем, есть ли уже авторизованный пользователь
if(!empty($_SESSION['login'])){
    header('Location: /gallery.php');
    die();
}

// Проверка, были ли данные отправлены через форму
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_name'], $_POST['pass'], $_POST['repeatpass'], $_POST['email'])) {
    // Получение данных из формы регистрации
    $user_name = $_POST['user_name']; // Логин пользователя
    $pass = $_POST['pass']; // Пароль пользователя
    $repeatpass = $_POST['repeatpass']; // Повторный ввод пароля
    $email = $_POST['email']; // Email пользователя

    // Проверка совпадения паролей
    if ($pass !== $repeatpass) {
        echo "<script>alert('Пароли не совпадают.'); window.location.href = 'register.php';</script>";
        exit;
    }

    // Приведение строки к нижнему регистру
    $lowerCaseStr = strtolower($user_name);

    // Удаление пробелов
    $loginNoSpaceLowerCase = str_replace(' ', '', $lowerCaseStr);

    // Формирование SQL-запроса для добавления нового пользователя в таблицу users
    $sql = "INSERT INTO `users` (user_name, pass, email) VALUES ('$loginNoSpaceLowerCase', '$pass', '$email')";

    // Выполнение SQL-запроса
    if ($conn->query($sql) === TRUE) {
        $_SESSION['login'] = [
            'user_name' => $loginNoSpaceLowerCase,
            'user_pass' => $pass,
        ];
        header("Location: gallery.php");
    } else {
        echo "<script>alert('Ошибка при регистрации: " . $conn->error . "'); window.location.href = 'register.php';</script>";
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="register.css">
</head>

<body>
    <form action="" method="post">
        <div class="Rectangle">
            <div class="loginT">Зарегистрироваться</div><br>
            <div class="main_group">
                <input type="text" placeholder="user_name" name="user_name" required><br>
                <br>
                <input type="password" placeholder="password" name="pass" required><br>
                <br>
                <input type="password" placeholder="repeat password" name="repeatpass" required><br>
                <br>
                <input type="email" placeholder="email" name="email" required><br>
            </div>
            <div class="line">
                <img src="img/newLogo.svg" alt="" width="63px" height="63px">
                <p>Student Lens</p>
            </div>
            <div class="singin_or_login">
                <button type="submit" class="button">Зарегистрироваться</button><br>
                <a href="login.php">У вас есть аккаунт? Войти</a>
            </div>
        </div>
    </form>
    <span class="Ellipse_1"></span>
    <span class="Ellipse_2"></span>
    <span class="Ellipse_3"></span>
    <span class="Ellipse_5"></span>
    <span class="Ellipse_6"></span>
    <span class="Ellipse_7"></span>
</body>

</html>