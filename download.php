<?php
$folder = "data/";
$arr = array();
$d = dir($folder);
$max = 0;
while (false !== ($entry = $d->read())) {
    if($entry!='.' && $entry!='..') {
        $line = file_get_contents($folder.$entry);
        $row = explode(";",$line);
        $arr[] = array(
            'nomor' => $entry,
            'nama' => $row[0],
            'jeniskelamin' => $row[2],
            'telp' => $row[2],
            'email' => $row[3],
            'sosmed' => $row[4],
            'whatsapp' => $row[5],
            'gereja' => $row[6],
            'keluarga' => $row[7],
            'spanduk' => $row[8],
            'lain' => $row[9],
            'status' => $row[10]
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