<?php
if($_SESSION['is_logged']!==true && $_SESSION['user_info']['type']!=1){
    header('Location: ../index.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/admin.css">
        <title><?php echo($title)?></title>
        <meta charset="utf-8">
    </head>
    <body>
    <div id="menu">
        <ul>
            <li><a href="../index.php">Начало</a></li>
            <li><a href="users.php">Редакция потребители</a></li>
            <li><a href="news.php">Редакция новини</a></li>
            <li><a href="categorys.php">Редакция категории</a></li>
            <li><a href="../logout.php">Изход</a></li>
        </ul>
    </div>

