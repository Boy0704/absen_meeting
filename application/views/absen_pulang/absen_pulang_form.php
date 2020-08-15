<form action="<?php echo $action; ?>" method="post">
        <div class="form-group">
            <label for="time">Jam <?php echo form_error('jam') ?></label>
            <input type="text" class="form-control" name="jam" id="jam" placeholder="Jam" value="<?php echo $jam; ?>" />
        </div>
        <div class="form-group">
            <label for="date">Tanggal <?php echo form_error('tanggal') ?></label>
            <input type="text" class="form-control" name="tanggal" id="tanggal" placeholder="Tanggal" value="<?php echo $tanggal; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Foto Selfi <?php echo form_error('foto_selfi') ?></label>
            <input type="text" class="form-control" name="foto_selfi" id="foto_selfi" placeholder="Foto Selfi" value="<?php echo $foto_selfi; ?>" />
        </div>
        <div class="form-group">
            <label for="lokasi">Lokasi <?php echo form_error('lokasi') ?></label>
            <textarea class="form-control" rows="3" name="lokasi" id="lokasi" placeholder="Lokasi"><?php echo $lokasi; ?></textarea>
        </div>
        <div class="form-group">
            <label for="varchar">Status <?php echo form_error('status') ?></label>
            <input type="text" class="form-control" name="status" id="status" placeholder="Status" value="<?php echo $status; ?>" />
        </div>
        <input type="hidden" name="id_absen_pulang" value="<?php echo $id_absen_pulang; ?>" /> 
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        <a href="<?php echo site_url('absen_pulang') ?>" class="btn btn-default">Cancel</a>
    </form>