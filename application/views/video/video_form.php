<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="varchar">Judul Video <?php echo form_error('judul_video') ?></label>
            <input type="text" class="form-control" name="judul_video" id="judul_video" placeholder="Judul Video" value="<?php echo $judul_video; ?>" />
        </div>
        <div class="form-group">
            <label for="link_video">Link Video </label>
            <input type="file" name="link_video" class="form-control">
            <b>ektensi hanya boleh .mp4</b>
            <?php 
            if ($link_video !== '') {
                ?>
                <div>
                    *) video Sebelumnya <br>
                    <?php echo $link_video ?>
                </div>
                <?php
            } else {
                #kosngs
            }
            ?>
        </div>
        <input type="hidden" name="id_video" value="<?php echo $id_video; ?>" /> 
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        <a href="<?php echo site_url('video') ?>" class="btn btn-default">Cancel</a>
    </form>