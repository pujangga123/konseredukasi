<?php
$msg = "";
if(isset($_POST['content'])) {
    $content = $_POST['content'];
    $lines = explode("\n",$content);
    $n = 0;
    foreach($lines as $key=>$row) {
        if($row!="") {
            $data = explode(";",$row);
            $entry = array(
                $data[1], // nama (WAJIB)
                isset($data[2])?$data[2]:"", // jenis kelamin
                isset($data[3])?trim($data[3]):"", // telp 
                isset($data[4])?trim($data[4]):"", // email
                isset($data[5])?trim($data[5]):"", // sosmed
                isset($data[6])?trim($data[6]):"", // whatsapp
                isset($data[7])?trim($data[7]):"", // gereja
                isset($data[8])?trim($data[8]):"", // keluarga
                isset($data[9])?trim($data[9]):"", // spanduk 
                isset($data[10])?trim($data[10]):"", // lain
                isset($data[11])?trim($data[11]):"-", // status
            );
            $f=fopen("data/".$data[0],"w");
            fwrite($f,implode(";", $entry));
            fclose($f);
            $n++;
        }
    }
    $msg = "$n DATA TERSIMPAN";
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import Data</title>
</head>
<body>
    <?php if($msg=='') { ?>
        <form action="import.php" method="post">
            <textarea name="content" id="content" rows="20" style="width:500px"></textarea><br>
            <button type="submit">Submit</button>
        </form>
    <?php } else {
        echo "$msg<br>";
        echo "Kembali ke <a href='list.php'>LIST</a>";
    } ?>
</body>
</html>