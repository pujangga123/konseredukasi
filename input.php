<?php
    // read vars
    $nama = $_POST['nama'];
    $jeniskelamin = $_POST['jeniskelamin'];
    $telp = $_POST['telp'];

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
        if($entry!='.'&& $entry!='..') {
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
    $txt = "$nama;$jeniskelamin;$telp;$infoSosmed;$infoWhatsapp;$infoGereja;$infoKeluarga;$infoSpanduk;$infoLain";
    fwrite($myfile, $txt);
    fclose($myfile);

    header("location:form.php?num=$nextnum")
    