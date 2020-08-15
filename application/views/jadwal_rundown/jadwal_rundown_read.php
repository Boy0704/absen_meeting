<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Jadwal_rundown Read</h2>
        <table class="table">
	    <tr><td>Waktu</td><td><?php echo $waktu; ?></td></tr>
	    <tr><td>Durasi</td><td><?php echo $durasi; ?></td></tr>
	    <tr><td>Acara</td><td><?php echo $acara; ?></td></tr>
	    <tr><td>Keterangan</td><td><?php echo $keterangan; ?></td></tr>
	    <tr><td>Nama Pic</td><td><?php echo $nama_pic; ?></td></tr>
	    <tr><td>No Tlp</td><td><?php echo $no_tlp; ?></td></tr>
	    <tr><td>Hari</td><td><?php echo $hari; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('jadwal_rundown') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>