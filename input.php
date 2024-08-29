<?php
// read vars
$nama = $_POST['nama'];
$jeniskelamin = $_POST['jeniskelamin'];
$telp = $_POST['telp'];
$email = $_POST['email'];

$infoSosmed = isset($_POST['infoSosmed'])?1:0;
$infoWhatsapp = isset($_POST['infoWhatsapp'])?1:0;
$infoGereja = isset($_POST['infoGereja'])?1:0;
$infoKeluarga = isset($_POST['infoKeluarga'])?1:0;
$infoSpanduk = isset($_POST['infoSpanduk'])?1:0;
$infoLain = isset($_POST['infoLain'])?str_replace(';',',',$_POST['infoLain']):0;

// get last number
$folder = "data/";

$d = dir($folder);
$max = 0;
while (false !== ($entry = $d->read())) {
    if($entry!='.' && $entry!='..' && $entry!='README.md') {
        // read number
        $num = $entry * 1;
        if($num>$max) {
            $max = $num;
        }
    }
}
$d->close();

$nextnum = $max+1;
$myfile = fopen("$folder/$nextnum", "w") or die("Unable to open file!");
$txt = "$nama;$jeniskelamin;$telp;$email;$infoSosmed;$infoWhatsapp;$infoGereja;$infoKeluarga;$infoSpanduk;$infoLain;-";
fwrite($myfile, $txt);
fclose($myfile);

////////////////////////////////////////////
// KIRIM EMAIL
////////////////////////////////////////////

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'mailer/Exception.php';
require 'mailer/PHPMailer.php';
require 'mailer/SMTP.php';

$mail = new PHPMailer();

$mail->isSMTP();
$mail->Host = 'mail.konseredukasi.com';
$mail->SMTPAuth = true;
$mail->Username = 'pendaftaran@konseredukasi.com';
$mail->Password = 'PendaftaranKonserEdukasi';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;

$mail->setFrom('pendaftaran@konseredukasi.com', 'Konser Edukasi');
$mail->addAddress('pujangga123@gmail.com', 'Me');
$mail->Subject = 'Test';
// Set HTML 
$mail->isHTML(TRUE);
$mail->Body = "<html>
<h3>$nama</h3>
Terdaftar dengan nomor:<br>
<h1>$max</h1>
</html>";

// SEND EMAIL & REDIRECT
if(!$mail->send()){
    header("location:tiket.php?num=$nextnum&nama=$nama&nomail");
} else {
    echo 'Message has been sent';
    header("location:tiket.php?num=$nextnum&nama=$nama");
}

    