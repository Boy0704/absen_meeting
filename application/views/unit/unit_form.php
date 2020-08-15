<form action="<?php echo $action; ?>" method="post">
        <div class="form-group">
            <label for="varchar">Nama Unit <?php echo form_error('nama_unit') ?></label>
            <input type="text" class="form-control" name="nama_unit" id="nama_unit" placeholder="Nama Unit" value="<?php echo $nama_unit; ?>" />
        </div>
        <div class="form-group">
            <label for="deskripsi_unit">Deskripsi Unit <?php echo form_error('deskripsi_unit') ?></label>
            <textarea class="form-control" rows="3" name="deskripsi_unit" id="deskripsi_unit" placeholder="Deskripsi Unit"><?php echo $deskripsi_unit; ?></textarea>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat <?php echo form_error('alamat') ?></label>
            <textarea class="form-control" rows="3" name="alamat" id="alamat" placeholder="Alamat"><?php echo $alamat; ?></textarea>
        </div>
        <input type="hidden" name="id_unit" value="<?php echo $id_unit; ?>" /> 
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        <a href="<?php echo site_url('unit') ?>" class="btn btn-default">Cancel</a>
    </form>