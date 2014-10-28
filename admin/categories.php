<?php
error_reporting(0);
session_start();
include '../functions.php';
my_admin_header('Редакция категории');
db();

if($_REQUEST['mode']=='edit' && $_REQUEST['id']>0){
    $id = (int)$_REQUEST['id'];
    $result = mysql_query('SELECT cat FROM categories WHERE id='.$id);
    $edit_info = mysql_fetch_assoc($result);
}

if($_REQUEST['mode']=='del' && $_REQUEST['id']>0){
    $id = (int)$_REQUEST['id'];
    $result = mysql_query('DELETE FROM categories WHERE id = '.$id);
}

echo '<div id="category_form">
        <form action="categories.php" method="post">
            <input type="text" name="category" value="'.$edit_info['cat'].'"><br/>
            <input type="hidden" name="add" value="1">
            <input type="submit" value="Done">';

if($_REQUEST['add']==1){
    $category = addslashes(trim($_REQUEST['category']));

    if(strlen($category)>0){
        $edit_id = $_REQUEST['edit'];
        if($edit_id > 0){
            mysql_query('UPDATE categories SET cat="'.$category.'" WHERE id='.$edit_id);
            echo '<h3 class="update">Редактирането е успешно</h3>';

        }
        else{
            mysql_query('INSERT INTO categories (cat) VALUES ("'.$category.'")');
            echo '<h3 class="update">Категорията е добавена</h3>';
        }
    }
    else{
        echo '<h3 class="update">Error! Add text in the fields!</h3>';
    }
}

if($_REQUEST['mode']=='edit'){
    echo '<input type="hidden" name="edit" value="'.$_REQUEST['id'].'">';
}

echo '</form>';
echo '</div>';

$rs = mysql_query('SELECT id, cat FROM categories');
echo '<div id="categories">';
while($row=mysql_fetch_assoc($rs)){
    echo 'Категория: <strong>'.$row['cat'].'</strong>
    <a href="categories.php?mode=edit&id='.$row['id'].'">Редактирай</a>'.' |
    <a href="categories.php?mode=del&id='.$row['id'].'">Изтрий</a><br/>';
}

echo '</div>';



