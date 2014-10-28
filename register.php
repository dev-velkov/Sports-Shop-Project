<?php
error_reporting(0);
//I am hiding the notices
include 'functions.php';
$today = date("F j, Y, g:i a");

if(!$_SESSION['is_logged']==true){
    my_header('Регистрация');
    if($_POST['is_submitted']==1){
        $username = addslashes($_POST['username']);
        $password = addslashes($_POST['password']);
        db();
        $sql = 'SELECT COUNT(*) as cnt FROM users WHERE username="' . addslashes($username). '"';
        $res = mysql_query($sql);
        $row = mysql_fetch_assoc($res);
        if($row['cnt']==0){
            mysql_query('INSERT INTO users (username, password, date_registered) VALUES("'.addslashes($username).'","'.addslashes($password).'","'.$today.'")');
            if(mysql_error()){
                echo('Error! Please try again.');
            }
            else{
                echo '<h1>Registration successful. You may now login!</h1>';
                echo '<script>setTimeout(function(){window.location = "index.php";}, 1000);</script>';
                // This script redirects us to the homepage after 1 second.
                exit;
            }
        }
        else{
            echo '<h1>Username already exists!</h1>';
        }
    }


    ?>
    <form action="register.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required="required"><br/>
        <label for="password">Password:</label>
        <input type="text" name="password" id="password" required="required"><br/>
        <input type="hidden" name="is_submitted" value="1">
        <input type="submit" value="Register">
    </form>
    <?php
}
else{
    header('Location: index.php');
    exit;
}

footer();

