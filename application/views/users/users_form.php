<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="varchar">Npp <?php echo form_error('npp') ?></label>
            <input type="text" class="form-control" name="npp" id="npp" placeholder="Npp" value="<?php echo $npp; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Nama <?php echo form_error('nama') ?></label>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Username <?php echo form_error('username') ?></label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Password <?php echo form_error('password') ?></label>
            <input type="text" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo $password; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Jabatan <?php echo form_error('jabatan') ?></label>
            <input type="text" class="form-control" name="jabatan" id="jabatan" placeholder="Jabatan" value="<?php echo $jabatan; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Unit <?php echo form_error('unit') ?></label>
            <!-- <input type="text" class="form-control" name="unit" id="unit" placeholder="Unit" value="<?php echo $unit; ?>" /> -->
            <select name="unit" class="form-control">
                <option value="<?php echo $unit; ?>"><?php echo $unit; ?></option>
                <?php 
                $sql = $this->db->get("unit");
                foreach ($sql->result() as $row) {
                 ?>
                <option value="<?php echo $row->nama_unit; ?>"><?php echo $row->nama_unit; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="varchar">Foto <?php echo form_error('foto') ?></label>
            <input type="file" class="form-control" name="foto" id="foto" placeholder="Foto" value="<?php echo $foto; ?>" />
            <?php 
            if ($foto !== '') {
                ?>
                <div>
                    *) Gambar Sebelumnya <br>
                    <img src="image/foto/<?php echo $foto ?>" style="width: 100px;height: 100px;">
                </div>
                <?php
            } else {
                #kosngs
            }
            ?>
        </div>
        <div class="form-group">
            <label for="varchar">Level <?php echo form_error('level') ?></label>
            <!-- <input type="text" class="form-control" name="level" id="level" placeholder="Level" value="<?php echo $level; ?>" /> -->
            <select name="level" class="form-control">
                <option value="user">user</option>
                <option value="admin">admin</option>
            </select>
        </div>
        <input type="hidden" name="id_user" value="<?php echo $id_user; ?>" /> 
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        <a href="<?php echo site_url('users') ?>" class="btn btn-default">Cancel</a>
    </form>