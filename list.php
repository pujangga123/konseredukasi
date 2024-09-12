<?php
include("auth.php");
$editmode = isset($_GET['edit']);
$checked = isset($_GET['checked'])?$_GET['checked']:"";

// BACA DATA.
$folder = "data/";
$arr = array();
$d = dir($folder);
$max = 0;
$total = 0;
$checkin = 0;
while (false !== ($entry = $d->read())) {
    if($entry!='.' && $entry!='..' && $entry!='README.md') {
        $line = file_get_contents($folder.$entry);
        $row = explode(";",$line);
        $arr[$entry] = array(
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
        // format telp
        $telp = $arr[$entry]['telp'];
        if(substr($telp,0,2)=='08') {
            $telp = "628".substr($telp,2,20);
            $arr[$entry]['telp'] = $telp;
        }
        if($row[10]=='checkin') {
            $checkin++;
        }
        $total++;
    }
}
$d->close();
if($checkin>0) {
    $rasio = round($checkin/$total*100,2);
} else {
    $rasio = 0;
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Peserta Konser</title>
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php if($editmode) { ?>
        <a href="list.php">View Mode</a> - <a href="download.php">Download CSV</a>
    <?php } else { ?>
        <a href="list.php?edit">Edit Mode</a>
    <?php } ?> - <a href="auth.php?logout">Log out</a>
    <div style="max-width:200px; margin-left:15px; margin-top:15px; font-weight:bold">
        <?php echo "Total: $total ($rasio% Check In)"; ?>
    </div>
    <div style="max-width:200px" class="m-3">
        <input type="text" id="num" style="font-size:5em" class="form-control text-center">
        <button type="button" class="btn btn-primary mt-1" style="width:100%" onclick="window.location='checkin.php?num='+document.getElementById('num').value">Check In</button>
        <?php if($checked!='') { ?>
        <div class="border radius mt-1 p-2">
            <?php echo $checked; ?>
        </div>
        <?php } ?>
    </div>
    <table class="table-sm">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($arr as $key=>$row) { ?> 
                <tr>
                    <td><?php echo $key; ?></td>
                    <td><?php echo $row['nama'];?></td>
                    <td><?php echo ($row['status']=="checkin")?"✔":$row['status']; ?></td>
                    <?php if($editmode) { ?>
                        <td><a href="https://wa.me/<?php echo $row['telp']; ?>?text=Pendaftaran+Konser+Edukasi%0D%0ANomor:*<?php echo $key; ?>*%0D%0A%0D%0Ahttps://konseredukasi.com/gloria/tiket.php%26num=<?php echo $key; ?>">WhatsApp</a> - <a href="#" onclick="alert('not implemented')">Email</a> - <a href="#">Hapus</a></td>
                    <?php } else { ?>
                        <td><a href="checkin.php?num=<?php echo $key; ?>">check in</a> - <a href="checkin.php?num=<?php echo $key; ?>&status=-">uncheck</a></td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>