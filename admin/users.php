<?php
error_reporting(0);
session_start();
include '../functions.php';
my_admin_header('Редакция потребители');
db();

if($_REQUEST['mode']=='edit' && $_REQUEST['id']>0){
    $id = (int)$_REQUEST['id'];
    $result = mysql_query('SELECT username, password, date_registered, permission FROM users WHERE user_id='.$id);
    $edit_info = mysql_fetch_assoc($result);
}

if($_REQUEST['mode']=='del' && $_REQUEST['id']>0){
    $id = (int)$_REQUEST['id'];
    $result = mysql_query('DELETE FROM users WHERE user_id = '.$id);
}


echo '<div id="user_form">
        <form action="users.php" method="post">
            Username:<input type="text" id="input" name="user" value="'.$edit_info['username'].'"><br/>
            Password:<input type="text" id="input" name="pass" value="'.$edit_info['password'].'"><br/>
            Permission:<input type="checkbox" name="permission" value="1">
            <input type="hidden" name="add" value="1"><br/>
            <input type="submit" value="Done">';

if($_REQUEST['add']==1){
    $username = addslashes(trim($_REQUEST['user']));
    $password = addslashes(trim($_REQUEST['pass']));
    $permission = $_REQUEST['permission'];
    $today = date("F j, Y, g:i a");

    if(strlen($username)>0 && strlen($password)>0){
        $edit_id = $_REQUEST['edit'];
        if($edit_id > 0){
            mysql_query('UPDATE users SET username="'.$username.'", password="'.$password.'", permission="'.$permission.'" WHERE user_id='.$edit_id);
            echo '<h3 class="update">Редактирането е успешно</h3>';

        }
        else{
            mysql_query('INSERT INTO users (username, password, date_registered, permission) VALUES ("'.$username.'","'.$password.'","'.$today.'","'.$password.'")');
            echo '<h3 class="update">Потребителят е добавен</h3>';
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


$rs = mysql_query('SELECT user_id, username, date_registered, permission FROM users');
echo '<div id="users">';
while($row=mysql_fetch_assoc($rs)){
    echo '<h3>Username: '.$row['username'].'</h3>'.'<p>Permission: '.$row['permission'].'</p>'.'
    <p>Date registered: '.$row['date_registered'].'<br/>
    <a href="users.php?mode=edit&id='.$row['user_id'].'">Редактирай</a>'.' |
    <a href="users.php?mode=del&id='.$row['user_id'].'">Изтрий</a>';
}

echo '</div>';

footer();