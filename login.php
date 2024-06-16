<?php
session_start();

global $conn;
require_once ('db.php');

// Проверяем, есть ли уже авторизованный пользователь
if(!empty($_SESSION['login'])){
    header('Location: /gallery.php');
    die();
}

// Обработка данных, если форма отправлена
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['user_name'];
    $pass = $_POST['pass'];

    // SQL запрос с плейсхолдером для логина
    $sql = "SELECT id, pass, user_name FROM users WHERE user_name=?";

    // Подготовка запроса
    $stmt = $conn->prepare($sql);

    // Привязка параметра (логин) к плейсхолдеру в запросе
    $stmt->bind_param("s", $login);

    // Выполнение запроса
    $stmt->execute();

    // Получение результатов запроса
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $password_from_db = $row['pass'];
        $id_from_db = $row['id'];
        $user_name_from_db = $row['user_name'];

        // Проверяем пароль
        if ($pass == $password_from_db) {
            $_SESSION['login'] = [
                'user_name' => $user_name_from_db,
                'user_pass' => $password_from_db,
                'user_id' => $id_from_db
            ];
            header('Location: /gallery.php');
            die();
        } else {
           echo "error";
            exit;
        }
    } else {
        echo "error";
        exit;
    }

    // Закрытие подготовленного запроса
    $stmt->close();

    // Закрытие соединения с базой данных
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
    <form action="" method="post">
        <div class="Rectangle">
            <div class="loginT">Войти</div><br>
            <div class="main_group">
                <input type="text" placeholder="uaer_name" name="user_name"><br>
                <br>
                <input type="password" placeholder="password" name="pass"><br>
            </div>
            <div class="line">
                <img src="img/newLogo.svg" alt="" width="63px" height="63px">
                <p>Student Lens</p>
            </div>

            <div class="singin_or_login">
                <button type="submit" class="button">Войти</button><br>
                <a href="register.html">У вас нет аккаунта? Зарегестрироваться</a>
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