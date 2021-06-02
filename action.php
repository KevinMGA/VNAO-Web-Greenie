<?php
session_start();
include('config/db.php');
include('lib/pdo_db.php');
include('modules/accounts.php');



$Login = new Account();


if(isset($_GET['id'])) {
    if($_GET['id'] == 'login') {
        $password = md5(trim($_POST['password']));
        if($users = $Login->login($_POST['email'], $password)) {
            $_SESSION['email'] = $users->email;
            $_SESSION['name'] = $users->name;
            $_SESSION['type'] = $users->type;
            $_SESSION['squad'] = $users->squad;
            header("location:index.php");  
        } else {
            header("location:login.php?login=wrong");
        }
    }
    else if($_GET['id'] == 'logout') {
    $_SESSION = array();
    session_destroy();
    header("location:login.php");
    }
}

?>