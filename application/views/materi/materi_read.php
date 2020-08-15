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
        <h2 style="margin-top:0px">Materi Read</h2>
        <table class="table">
	    <tr><td>Judul Materi</td><td><?php echo $judul_materi; ?></td></tr>
	    <tr><td>Nama User</td><td><?php echo $nama_user; ?></td></tr>
	    <tr><td>Unit</td><td><?php echo $unit; ?></td></tr>
	    <tr><td>Berkas</td><td><?php echo $berkas; ?></td></tr>
	    <tr><td>Waktu</td><td><?php echo $waktu; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('materi') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>