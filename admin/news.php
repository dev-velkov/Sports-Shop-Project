<?php
error_reporting(0);
session_start();
include '../functions.php';
echo '<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>';
my_admin_header('Редакция Новини');
echo '<link rel="stylesheet" type="text/css" href="../css/admin.css">';
db();

?>

<?php

if($_REQUEST['mode']=='edit' && $_REQUEST['id']>0){
    $id = (int)$_REQUEST['id'];
    $result = mysql_query('SELECT news_id, title, category, content FROM news WHERE news_id='.$id);
    $edit_info = mysql_fetch_assoc($result);
}

if($_REQUEST['mode']=='del' && $_REQUEST['id']>0){
    $id = (int)$_REQUEST['id'];
    $result = mysql_query('DELETE FROM news WHERE news_id = '.$id);
}

$res = mysql_query('SELECT id, cat FROM categories');

echo   '<div id="content"><form action="news.php" method="post">
        <label for="title">Заглавие:</label>
        <input type="text" name="title" id="title" value="'.$edit_info['title'].'"><br/>
        <label for="category">Категория:</label>
        <select name="group" id="cat">';
while ($rowCat = mysql_fetch_assoc($res)){
    echo '<option value="'.$rowCat['id'].'">'.$rowCat['cat'].'</option>';
}
echo   '</select><br/>
        <textarea name="content" id="content" class="ckeditor">'.$edit_info['content'].'</textarea><br/>
        <input type="hidden" name="add" value="1">
        <input type="submit" id="btn" value="Редактирай">';

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
        if($edit_id > 0){
            mysql_query('UPDATE news SET title="'.$title.'", category="'.$category.'", content="'.$content.'" WHERE news_id='.$edit_id);
            echo '<h3 class="update">Редактирането е успешно</h3>';

        }
        else{
            mysql_query('INSERT INTO news (title, category, content, added_by) VALUES ("'.$title.'","'.$category.'","'.$content.'","'.$ip.'")');
            echo '<h3 class="update">Новината е добавена</h3>';
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
?>
<?php

$rs = mysql_query('SELECT news_id, title, content, added_by FROM news');
echo '<div id="admin_news">
      <h2 id="head">Редактиране на новини</h2>';
while($row=mysql_fetch_assoc($rs)){
    echo '<h3>'.$row['title'].'</h3>'.'
    <p>'.$row['content'].'</p>'.'<br/>
    Added by: '.$row['added_by'].'<br/>
    <button id="btn"><a href="news.php?mode=edit&id='.$row['news_id'].'"">Редактирай</a>'.'</button>
    <button id="btn"><a href="news.php?mode=del&id='.$row['news_id'].'">Изтрий</a></button><br/><hr/>';
}

echo '</div>';

footer();


