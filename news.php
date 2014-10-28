<?php
include 'functions.php';
my_header('Новини');
echo '<link rel="stylesheet" type="text/css" href="css/news.css">';
db();
$rs = mysql_query('SELECT title, category, content FROM news');

while($row=mysql_fetch_assoc($rs)){
    echo '<div id=news><h3>'.$row['title'].'</h3><h6>'.$row['category'].'</h6><p>'.$row['content'].'</p></div>';
}

footer();


