<?php
$folder = "data/";
$arr = array();
$d = dir($folder);
$max = 0;
while (false !== ($entry = $d->read())) {
    if($entry!='.' && $entry!='..') {
        $line = file_get_contents($folder.$entry);
        echo "$entry xx".$line;
        $row = explode(";",$line);
        var_dump($row);
        $arr[] = array(
            'nama' => $row[0],
            'jeniskelamin' => $row[2],
            'telp' => $row[2],
            'email' => $row[3],
            'sosmed' => $row[4],
            'Whatsapp' => $row[5],
            'Gereja' => $row[6],
            'Keluarga' => $row[7],
            'Spanduk' => $row[8],
            'Lain' => $row[9]
        );
    }
}
$d->close();

var_dump($arr);