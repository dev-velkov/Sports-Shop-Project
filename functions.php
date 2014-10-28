<?php
function my_header($title){
    error_reporting(0);
//I am hiding the notices
    session_start();
    ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/menu.css">
    <title><?php echo($title)?></title>
    <meta charset="utf-8">
</head>
    <body>
        <div id="menu">
            <ul>
            <?php
            if($_SESSION['is_logged']===true){
                echo 'Здравей: <b>'.$_SESSION['user_info']['username'].'</b> <br/>';
                if($_SESSION['user_info']['permission']==1){
                    echo '<li><a href="admin/admin.php">Администраторски панел</a></li>';
                }
                echo '<li><a href="index.php">Начало</a></li><li><a href="news.php">Новини</a></li><li><a href="logout.php">Излез</a></li>';

            }
            else{
                echo '<li><a href="register.php">Регистрирай се</a></li><li><a href="login.php">Вход</a></li>';
            }
            ?>
            </ul>
        </div>
    <?php
}

function footer(){
    echo '</body></html>';
}

function db(){
    mysql_connect('localhost', 'velkov', 'pass') or die ("Database Error");
    mysql_select_db('sports_shop');
}

function my_admin_header($title){
    if($_SESSION['is_logged']!==true && $_SESSION['user_info']['type']!=1){
        header('Location: ../index.php');
        exit;
    }
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/admin-menu.css">
        <title><?php echo($title)?></title>
        <meta charset="utf-8">
    </head>
<body>
<nav>
    <div class="menu-item">
        <h4>Меню</h4>
            <ul>
                <li><a href="../index.php">Начало</a></li>
                <li><a href="../logout.php">Изход</a></li>
            </ul>
    </div>
    <div class="menu-item">
        <h4>Новини</h4>
            <ul  id="avmenu">
                <li><a href="../news.php">Новини</a></li>
                <li><a href="add_news.php">Добави новина</a></li>
                <li><a href="news.php">Редакция новини</a></li>
            </ul>
    </div>
    <div class="menu-item">
        <h4>Потребители</h4>
            <ul  id="avmenu">
                <li><a href="users.php">Редакция потребители</a></li>
            </ul>
    </div>
    <div class="menu-item">
        <h4>Категории</h4>
            <ul id="avmenu">
                <li><a href="categories.php">Редакция категории</a></li>
            </ul>
    </div>
</nav>
<!--<div id="menu">-->
<!--    <ul>-->
<!--        <li><a href="../index.php">Начало</a></li>-->
<!--        <li><a href="users.php">Редакция потребители</a></li>-->
<!--        <li><a href="news.php">Редакция новини</a></li>-->
<!--        <li><a href="categories.php">Редакция категории</a></li>-->
<!--        <li><a href="../logout.php">Изход</a></li>-->
<!--    </ul>-->
<!--</div>-->
<?php
}
