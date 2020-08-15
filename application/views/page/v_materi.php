<div class="panel panel-primary">
    <div class="panel-heading">
        <i class="glyphicon glyphicon-th-large"></i> Materi
    </div>
    <div class="panel-body">
        
        <table class="table table-bordered">
        	<thead>
        		<tr>
        			<th>Judul</th>
        			<th>Nama User</th>
        			<th>Unit</th>
        			<th>Link Download</th>
        			<th>Last Update</th>
        		</tr>
        	</thead>
        	<tbody>
        		<?php 
        		 $sql = $this->db->query("SELECT * FROM materi ORDER BY id_materi DESC");
  					foreach ($sql->result() as $row) {
        		 ?>
        		<tr>
        			<td><?php echo $row->judul_materi ?></td>
        			<td><?php echo $row->nama_user ?></td>
        			<td><?php echo $row->unit ?></td>
        			<td><a href="berkas/<?php echo $row->berkas ?>">Download</a></td>
        			<td><?php echo $row->waktu; ?></td>
        		</tr>
        		<?php } ?>
        	</tbody>
        </table>

    </div>
    <div class="panel-footer"></div>
  </div>