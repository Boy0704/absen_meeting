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
        <h2 style="margin-top:0px">Alarm Read</h2>
        <table class="table">
	    <tr><td>Judul Alarm</td><td><?php echo $judul_alarm; ?></td></tr>
	    <tr><td>Jam Alarm</td><td><?php echo $jam_alarm; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('alarm') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>