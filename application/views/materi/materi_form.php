<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="varchar">Judul Materi <?php echo form_error('judul_materi') ?></label>
            <input type="text" class="form-control" name="judul_materi" id="judul_materi" placeholder="Judul Materi" value="<?php echo $judul_materi; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Nama User <?php echo form_error('nama_user') ?></label>
            <input type="text" class="form-control" name="nama_user" id="nama_user" placeholder="Nama User" value="<?php echo $this->session->userdata('nama'); ?>" readonly/>
        </div>
        <div class="form-group">
            <label for="varchar">Unit <?php echo form_error('unit') ?></label>
            <input type="text" class="form-control" name="unit" id="unit" placeholder="Unit" value="<?php echo $this->session->userdata('unit');; ?>" readonly/>
        </div>
        <div class="form-group">
            <label for="varchar">Berkas </label>
            <input type="file" class="form-control" name="berkas" id="berkas" />
            <b>file berekstensi .pdf .docx</b>
            <?php 
            if ($berkas !== '') {
                ?>
                <div>
                    *) Berkas Sebelumnya <br>
                    <?php echo $berkas ?>
                </div>
                <?php
            } else {
                #kosngs
            }
            ?>
        </div>
        <div class="form-group">
            <label for="varchar">Waktu <?php echo form_error('waktu') ?></label>
            <input type="text" class="form-control" name="waktu" id="waktu" placeholder="Waktu" value="<?php date_default_timezone_set('Asia/Jakarta');
            $jam = date('H:i:s'); echo $jam; ?>" readonly/>
        </div>
        <input type="hidden" name="id_materi" value="<?php echo $id_materi; ?>" /> 
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        <a href="<?php echo site_url('materi') ?>" class="btn btn-default">Cancel</a>
    </form>