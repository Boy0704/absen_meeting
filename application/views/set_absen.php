<form action="app/update_setabsen" method="POST">
	<div class="form-group">
		<label>Absen Aktif</label> <br>
        <?php 
        $sql = $this->db->get('set_absen')->row();
        if ($sql->absen_datang == 'y') {
            ?>
            <input type="radio" name="absen" value="absen_datang" checked> Absen Datang
            <input type="radio" name="absen" value="absen_pulang"> Absen Pulang
            <?php
        } elseif ($sql->absen_pulang == 'y') {
           ?>
            <input type="radio" name="absen" value="absen_datang" > Absen Datang
            <input type="radio" name="absen" value="absen_pulang" checked> Absen Pulang
            <?php
        }
         ?>
        
	</div>
	<div class="form-group">
        <label>Jam Absen Datang</label> <br>
        <label class="radio-inline"><input type="text" name="jam1" class="form-control" placeholder="07:00:00" value="<?php echo $sql->awal_absen_datang ?>"> Jam mulai</label>
        <label class="radio-inline"><input type="text" name="jam2" class="form-control" placeholder="07:00:00" value="<?php echo $sql->akhir_absen_datang ?>"> Jam selesai</label>
    </div>
    <div class="form-group">
        <label>Jam Absen Pulang</label> <br>
        <label class="radio-inline"><input type="text" name="jam3" class="form-control" placeholder="07:00:00" value="<?php echo $sql->awal_absen_pulang ?>"> Jam mulai</label>
        <label class="radio-inline"><input type="text" name="jam4" class="form-control" placeholder="07:00:00" value="<?php echo $sql->akhir_absen_pulang ?>"> Jam selesai</label>
    </div>
	<div class="form-group">
		<button type="submit" class="btn btn-block btn-success">UPDATE</button>
	</div>
</form>