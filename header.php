<?php
error_reporting(0);
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

