<?php
error_reporting(0);
session_start();
include '../functions.php';
my_admin_header('Tree');
db();

$result = mysql_query('SELECT id, name, parent FROM category_tree WHERE parent = 0');


//while($row = mysql_fetch_assoc($result)){
//    echo '<a href="category_tree.php?id='.$row['id'].'"">'.$row['name'].'</a><br/>';
//    $id = $_REQUEST['id'];
//    $parent = $row['parent'];
//    $rs = mysql_query('SELECT id, name, parent FROM category_tree WHERE '.$id.'= parent');
//    while ($rw = mysql_fetch_assoc($rs)){
//        $id = $_REQUEST['id'];
//        $parent = $row['parent'];
//        $res = mysql_query('SELECT id, name, parent FROM category_tree WHERE '.$id.'= parent');
//        echo '<a href="category_tree.php?id='.$rw['id'].'""> >>>'.$rw['name'].'</a><br/>';
//
//    }
//}
//
