<?php
error_reporting(0);
session_start();
include '../functions.php';
echo '<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>';
my_admin_header('Редакция Новини');
echo '<link rel="stylesheet" type="text/css" href="../css/admin.css">';
db();

$res = mysql_query('SELECT id, cat FROM categories');
echo   '<div id="add_content">
        <h3 id="head">Добавяне на новина</h3>
        <form action="add_news.php" method="post">
        <label for="title">Заглавие:</label>
        <input type="text" name="title" id="title""><br/>
        <label for="category">Категория:</label>
        <select name="group" id="cat">';
        while ($rowCat = mysql_fetch_assoc($res)){
        echo '<option value="'.$rowCat['id'].'">'.$rowCat['cat'].'</option>';
        }
echo   '</select><br/>
        <textarea name="content" id="content" class="ckeditor"></textarea><br/>
        <input type="hidden" name="add" value="1">
        <input type="submit" id="btn" value="Добави">';

if($_REQUEST['add']==1){
    $title = addslashes(trim($_REQUEST['title']));
    $category = $_REQUEST['group'];
    $content = $_REQUEST['content'];


    if(strlen($title)>0 && strlen($content)>0){
        $edit_id = $_REQUEST['edit'];
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        mysql_query('INSERT INTO news (title, category, content, added_by) VALUES ("'.$title.'","'.$category.'","'.$content.'","'.$ip.'")');
        echo '<h3 class="update">Новината е добавена</h3>';
    }
    else{
        echo '<h3 class="update">Попълнете всички полета</h3>';
    }
}