<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="varchar">Judul News <?php echo form_error('judul_news') ?></label>
            <input type="text" class="form-control" name="judul_news" id="judul_news" placeholder="Judul News" value="<?php echo $judul_news; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Gambar News</label>
            <input type="file" class="form-control" name="gambar" />
            <?php 
            if ($gambar !== '') {
                ?>
                <div>
                    *) Gambar Sebelumnya <br>
                    <img src="image/news/<?php echo $gambar ?>" style="width: 100px;height: 100px;">
                </div>
                <?php
            } else {
                #kosngs
            }
            ?>
        </div>
        <div class="form-group">
            <label for="isi_news">Isi News <?php echo form_error('isi_news') ?></label>
            <textarea class="form-control" rows="3" name="isi_news" id="isi_news" placeholder="Isi News"><?php echo $isi_news; ?></textarea>
        </div>
        <input type="hidden" name="id_news" value="<?php echo $id_news; ?>" /> 
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        <a href="<?php echo site_url('news') ?>" class="btn btn-default">Cancel</a>
    </form>

    <script type="text/javascript">
        CKEDITOR.replace( 'isi_news' );
    </script>