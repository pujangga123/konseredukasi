<?php

$num = $_GET['num'];
$status = isset($_GET['status'])?$_GET['status']:'checkin';

$folder = "data/";
if(file_exists($folder.$num)) {
    $line = file_get_contents($folder.$num);
    $row = explode(";",$line);
    $row[10] = $status;
    $nama = $row[0];
    
    $updated = implode(";", $row);
    $f = fopen($folder.$num,"w");
    fwrite($f, $updated);
    fclose($f);
    header("location: list.php?checked=$num+$nama+$status");
} else {
    header("location: list.php?checked=$num+tidak+ditemukan");
}

    
