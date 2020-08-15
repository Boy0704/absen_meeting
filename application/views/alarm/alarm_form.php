<form action="<?php echo $action; ?>" method="post">
        <div class="form-group">
            <label for="varchar">Judul Alarm <?php echo form_error('judul_alarm') ?></label>
            <input type="text" class="form-control" name="judul_alarm" id="judul_alarm" placeholder="Judul Alarm" value="<?php echo $judul_alarm; ?>" />
        </div>
        <div class="form-group">
            <label for="time">Jam Alarm <?php echo form_error('jam_alarm') ?></label>
            <input type="text" class="form-control" name="jam_alarm" id="jam_alarm" placeholder="07:00:00" value="<?php echo $jam_alarm; ?>" />
        </div>
        <input type="hidden" name="id_alarm" value="<?php echo $id_alarm; ?>" /> 
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        <a href="<?php echo site_url('alarm') ?>" class="btn btn-default">Cancel</a>
    </form>