<?php
session_start();

$masterkey = "konser";
$sessionkey = isset($_SESSION['key'])?$_SESSION['key']:"";

if(isset($_GET['logout'])) {
    $_SESSION['key'] = "";
    header("location:auth.php");
}

if(isset($_POST['key'])) {
    $_SESSION['key'] = $masterkey;
    if($_SESSION['key']==$masterkey) {
        header('location:list.php');
    }
}

if($sessionkey!=$masterkey) { ?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auth Admin: Konser Edukasi</title>
</head>
<body>
    <form action="auth.php" method="post">
        <input type="password" name="key" placeholder="key?" >
        <button>Submit</button>
    </form>
</body>
</html>


<?php 
die(); }
?>