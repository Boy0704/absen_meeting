<div class="row">
	<div class="col-md-12">
		<marquee><h3 style="color: red; display: none;" id="judul_alarm"></h3></marquee>
	</div>
	<div class="col-md-4">
		<div class="panel panel-primary">
		    <div class="panel-heading">
		        <i class="glyphicon glyphicon-th-large"></i> List Alarm
		    </div>
		    <div class="panel-body">
		    	<table class="table table-bordered">
		    		<thead>
		    			<tr>
		    				<th>Judul</th>
		    				<th>Jam</th>
		    			</tr>
		    		</thead>
		    		<tbody>
		    			 <?php 
					        $sql = $this->db->query("SELECT * FROM alarm ORDER BY jam_alarm ASC");
					        foreach ($sql->result() as $row) {
					         ?>
		    			<tr>
		    				<td><?php echo $row->judul_alarm; ?></td>
		    				<td><?php echo $row->jam_alarm; ?></td>
		    			</tr>
		    			 <?php } ?>
		    		</tbody>
		    	</table>


		    </div>
		    <div class="panel-footer panel-primary"></div>
		  </div>
	</div>
</div>