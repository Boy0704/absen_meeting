<form action="<?php echo $action; ?>" method="post">
        <div class="form-group">
            <label for="varchar">Waktu <?php echo form_error('waktu') ?></label>
            <input type="text" class="form-control" name="waktu" id="waktu" placeholder="Waktu" value="<?php echo $waktu; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Durasi <?php echo form_error('durasi') ?></label>
            <input type="text" class="form-control" name="durasi" id="durasi" placeholder="Durasi" value="<?php echo $durasi; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Acara <?php echo form_error('acara') ?></label>
            <input type="text" class="form-control" name="acara" id="acara" placeholder="Acara" value="<?php echo $acara; ?>" />
        </div>
        <!-- <div class="form-group">
            <label for="varchar">Keterangan <?php echo form_error('keterangan') ?></label>
            <input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan" value="<?php echo $keterangan; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Nama Pic <?php echo form_error('nama_pic') ?></label>
            <input type="text" class="form-control" name="nama_pic" id="nama_pic" placeholder="Nama Pic" value="<?php echo $nama_pic; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">No Tlp <?php echo form_error('no_tlp') ?></label>
            <input type="text" class="form-control" name="no_tlp" id="no_tlp" placeholder="No Tlp" value="<?php echo $no_tlp; ?>" />
        </div> -->
        <div class="form-group">
            <label for="varchar">Hari <?php echo form_error('hari') ?></label>
            <input type="text" class="form-control" name="hari" id="hari" placeholder="Hari" value="<?php echo $hari; ?>" />
        </div>
        <input type="hidden" name="id_jadwal" value="<?php echo $id_jadwal; ?>" /> 
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        <a href="<?php echo site_url('jadwal_rundown') ?>" class="btn btn-default">Cancel</a>
    </form>