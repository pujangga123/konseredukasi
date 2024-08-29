<?php
$editmode = isset($_GET['edit']);

// BACA DATA
$folder = "data/";
$arr = array();
$d = dir($folder);
$max = 0;
while (false !== ($entry = $d->read())) {
    if($entry!='.' && $entry!='..' & $entry!='README.md') {
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
    }
}
$d->close();
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List</title>
</head>
<body>
    <?php if($editmode) { ?>
        <a href="list.php">View Mode</a> - <a href="download.php">Download CSV</a>
    <?php } else { ?>
        <a href="list.php?edit">Edit Mode</a>
    <?php } ?>
    <table>
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
                    <td><?php echo $row['status']; ?></td>
                    <?php if($editmode) { ?>
                        <td><a href="#">WhatsApp</a> - <a href="#">Email</a> - <a href="#">Hapus</a></td>
                    <?php } else { ?>
                        <td><a href="#">check in</a> - <a href="#">uncheck</a></td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>