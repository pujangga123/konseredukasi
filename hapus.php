<?php

$num = $_GET['num'];

unlink("data/$num");

header("location: list.php");

    
