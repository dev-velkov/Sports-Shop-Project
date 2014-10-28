<?php
include 'functions.php';
my_header('Вход');


if(isset($_REQUEST['submit'])){
    $login = $_REQUEST['login_name'];
    $pass = $_REQUEST['login_pass'];
    if(strlen($login)>3 && strlen($pass)>3){
        db();
        $res = mysql_query('SELECT * FROM users WHERE username="'. addslashes($login).'" AND password="'.addslashes($pass).'"');

        if(mysql_num_rows($res)==true){
            $row = mysql_fetch_assoc($res);
            $_SESSION['is_logged'] = true;
            $_SESSION['user_info'] = $row;
            header('Location: index.php');
            exit;

        }
        elseif(mysql_num_rows($res)==0){
            echo('<h1>Wrong username/password</h1>');
        }
    }
    else{
        echo('<h1>Error! The username or the password is too shot</h1>');
    }
}
?>
<form action="login.php" method="post">
    <input type="text" name="login_name"><br/>
    <input type="password" name="login_pass"><br/>
    <input type="submit" value="Login">
    <input type="hidden" name="submit" value="1">
</form>
<?php
footer();