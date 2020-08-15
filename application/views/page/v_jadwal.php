<div class="panel panel-primary">
    <div class="panel-heading">
    	<i class="glyphicon glyphicon-th-large"></i> Jadwal Rundown
    </div>
    <div class="panel-body">
    	
        <table class="table table-bordered">
            
        </table><table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
        <th>Waktu</th>
        <th>Durasi</th>
        <th>Acara</th>
            </tr><?php
            $start = 0;
            $sql = $this->db->get('jadwal_rundown');
            foreach ($sql->result() as $jadwal_rundown)
            {
                ?>
                <tr>
            <td width="80px"><?php echo ++$start ?></td>
            <td><div style="size: 15px;"><?php echo $jadwal_rundown->hari ?><br><?php echo $jadwal_rundown->waktu ?></div></td>
            <td><?php echo $jadwal_rundown->durasi ?></td>
            <td><?php echo $jadwal_rundown->acara ?></td>
        </tr>
                <?php
            }
            ?>
        </table>


    </div>
    <div class="panel-footer"></div>
  </div>