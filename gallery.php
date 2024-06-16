<?php
session_start();
if(empty($_SESSION['login']['user_name']) || empty($_SESSION['login']['user_pass'])){
    header('Location: /login.php');
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your gallery</title>
    <link rel="stylesheet" type="text/css" href="gallery.css">

    <header>
        <div class="top-bar">

            <div class="search">
                <img src="img/magnifying-glass.svg" alt="search">
                <input type="text" placeholder="Найти фотографию" maxlength="35">
            </div>

            <div class="logo">
                <h1>Student Lens</h1>
                <img src="img/newLogo.svg" alt="">
            </div>

        </div>
    </header>
</head>

<body>
    <main>

        <form action="">
            <button class="button_add_img" id="upload-bth"></button>
            <input type="file" hidden="hidden" id="upload-file" accept="image/*">
        </form>

    </main>
    <aside>
        <div class="right-bar">

            <div class="user_all_info">

                <div class="online">
                    <img src="img/online_green.svg" alt="">
                    <span>Online</span>
                </div>

                <div class="user">
                    <img src="img/user.svg" alt="">
                    <span><?php echo htmlspecialchars($_SESSION['login']['user_name']); ?></span>
                </div>

                <div class="info">
                    Всего фотографий: 32 <br>
                    Всего фотографий: 32 <br>
                    Всего одобрений: 134
                </div>

            </div>

            <div class="buttons">
                <ul>
                    <li id="first"><img src="img/Card.svg" alt=""><a href="#">Card</a></li>
                    <li id="second "><img src="img/My_gallery.svg" alt=""><a href="gallery.php">My gallery</a></li>
                    <li id="third "><img src="img/Community.svg" alt=""><a href="#">Community</a></li>
                    <li id="fourth"><img src="img/Home_page.svg" alt=""><a href="index.html">Home page</a></li>
                </ul>
                <button><a href="index.html"> <?php unset($_SESSION['user_name']);?> <p>Exit<img src="img/exit.svg" alt=""></p></a></button>
            </div>
        </div>
    </aside>
    <script src="gallery_scripts.js"></script>
</body>

</html>