<?php
$folder = "data/";
$arr = array();
$d = dir($folder);
$max = 0;
while (false !== ($entry = $d->read())) {
    if($entry!='.' && $entry!='..' && $entry!='README.md') {
        $line = file_get_contents($folder.$entry);
        $row = explode(";",$line);
        $arr[] = array(
            'nomor' => $entry,
            'nama' => isset($row[0])?$row[0]:"",
            'jeniskelamin' => isset($row[1])?$row[1]:"",
            'telp' => isset($row[2])?$row[2]:"",
            'email' => isset($row[3])?$row[3]:"",
            'sosmed' => isset($row[4])?$row[4]:"",
            'whatsapp' => isset($row[5])?$row[5]:"",
            'gereja' => isset($row[6])?$row[6]:"",
            'keluarga' => isset($row[7])?$row[7]:"",
            'spanduk' => isset($row[8])?$row[8]:"",
            'lain' => isset($row[9])?$row[9]:"",
            'status' => isset($row[10])?$row[10]:"",
            'institusi' => isset($row[11])?$row[11]:""
        );
    }
}
$d->close();

header('Content-Type: application/csv');
header('Content-Disposition: attachment; filename="daftar.csv";');

// open the "output" stream
// see http://www.php.net/manual/en/wrappers.php.php#refsect2-wrappers.php-unknown-unknown-unknown-descriptioq
$f = fopen('php://output', 'w');

foreach ($arr as $line) {
    fputcsv($f, $line, ";");
}