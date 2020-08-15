<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="varchar">Judul Gallery <?php echo form_error('judul_gallery') ?></label>
            <input type="text" class="form-control" name="judul_gallery" id="judul_gallery" placeholder="Judul Gallery" value="<?php echo $judul_gallery; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Foto Gallery </label>
            <input type="file" class="form-control" name="foto_gallery" id="foto_gallery"  />
            <?php 
            if ($foto_gallery !== '') {
                ?>
                <div>
                    *) Gambar Sebelumnya <br>
                    <img src="image/gallery/<?php echo $foto_gallery ?>" style="width: 100px;height: 100px;">
                </div>
                <?php
            } else {
                #kosngs
            }
            ?>
        </div>
        <input type="hidden" name="id_gallery" value="<?php echo $id_gallery; ?>" /> 
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        <a href="<?php echo site_url('gallery') ?>" class="btn btn-default">Cancel</a>
    </form>