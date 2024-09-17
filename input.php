<?php
// read vars
$nama = $_POST['nama'];
$jeniskelamin = $_POST['jeniskelamin'];
$telp = $_POST['telp'];
$email = $_POST['email'];

if($nama=="") {
    header("location:daftar.html?gagal");
}

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
$mail->addAddress($email, $nama);
$mail->Subject = 'Pendaftaran: Konser Edukasi 2024 Bandung';
// Set HTML 
$mail->isHTML(TRUE);
$mail->Body = "<html>
<p>Terimakasih, $nama</p>
<p>Anda telah terdaftar dalam <i>Konser Edukasi Musik Klasik 2024</i> dengan nomer :</p>
<h1>$nextnum</h1>
<p>
    Mohon bisa hadir di acara 30 menit sebelum konser dimulai.<br>
    Alamat GRII Bandung : <a href='https://maps.app.goo.gl/LonewXLZtW8ToEng8'>Jl. Moch. Toha 229</a> <br>
    Informasi lebih lengkap : <a href='https://konseredukasi.com/gloria/'>konseredukasi.com</a><br>
    Kontak kami : 0851-0507-1880 <a href='tel:+6285105071880'>Telp</a> / <a href='https://wa.me/6285105071880'>WhatsApp</a>
</p>
</html>";

// SEND EMAIL & REDIRECT
if(!$mail->send()){
    header("location:tiket.php?num=$nextnum&nama=$nama&nomail");
} else {
    header("location:tiket.php?num=$nextnum&nama=$nama");
}

    