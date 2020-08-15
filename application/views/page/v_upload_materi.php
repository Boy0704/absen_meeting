<form action="app/aksi_upload_materi" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="varchar">Judul Materi </label>
            <input type="text" class="form-control" name="judul_materi" id="judul_materi" placeholder="Judul Materi" />
        </div>
        <div class="form-group">
            <label for="varchar">Nama User </label>
            <input type="text" class="form-control" name="nama_user" id="nama_user" placeholder="Nama User" value="<?php echo $this->session->userdata('nama'); ?>" readonly/>
        </div>
        <div class="form-group">
            <label for="varchar">Unit </label>
            <input type="text" class="form-control" name="unit" id="unit" placeholder="Unit" value="<?php echo $this->session->userdata('unit');; ?>" readonly/>
        </div>
        <div class="form-group">
            <label for="varchar">Berkas </label>
            <input type="file" class="form-control" name="berkas" id="berkas" />
            <b>file berekstensi .pdf .docx</b>
        </div>
        <div class="form-group">
            <label for="varchar">Waktu </label>
            <input type="text" class="form-control" name="waktu" id="waktu" placeholder="Waktu" value="<?php date_default_timezone_set('Asia/Jakarta');
            $jam = date('H:i:s'); echo $jam; ?>" readonly/>
        </div>
        <button type="submit" class="btn btn-primary">Upload</button> 
    </form>