<!DOCTYPE html>
<html>
<head>
	<base href="<?php echo base_url() ?>">
	<title>Cetak Absensi <?php echo $absen ?></title>
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
</head>
<body onload="print()">
	<center>
		<h3>Cetak Absensi <?php echo $absen ?></h3>
		<hr>
	</center>
<table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
                <th>Npp</th>
                <th>Nama</th>
        <th>Jam</th>
        <th>Tanggal</th>
        <th>Lokasi</th>
        <th>Status</th>
            </tr><?php
            $start = 0;
            foreach ($data->result() as $absen_datang)
            {
                ?>
                <tr>
            <td width="80px"><?php echo ++$start ?></td>
            <td><?php echo $absen_datang->npp ?></td>
            <td><?php echo $absen_datang->nama ?></td>
            <td><?php echo $absen_datang->jam ?></td>
            <td><?php echo $absen_datang->tanggal ?></td>
            <td><?php echo $absen_datang->lokasi ?></td>
            <td><?php echo $absen_datang->status ?></td>
            
        </tr>
                <?php
            }
            ?>
        </table>

</body>
</html>