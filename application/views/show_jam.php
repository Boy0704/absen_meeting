<script type="text/javascript">

		$(document).ready(function() {

			var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
			var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
			var date = new Date();
			var day = date.getDate();
			var month = date.getMonth();
			var thisDay = date.getDay(),
			    thisDay = myDays[thisDay];
			var yy = date.getYear();
			var year = (yy < 1000) ? yy + 1900 : yy;

			var jam = showTime();
			// var hari = hari();

			//set Bell
			<?php 
			$sql = $this->db->query("SELECT * FROM alarm order by jam_alarm ASC");
			foreach ($sql->result() as $row) {
			 ?>

			var jamset = "<?php echo $row->jam_alarm; ?>";

			if (jam == jamset ) {
				$("#judul_alarm").show();
				$("#judul_alarm").html('<?php echo $row->judul_alarm; ?> - '+jamset);
				//suara absen inggris
	        	var audio2Element = document.createElement('audio');
	        	audio2Element.setAttribute('src', 'bell/bell_baru.mp3');
	        	audio2Element.play();
			} 

			<?php } ?>
			

			$("#jam").html(jam);
			$("#hari").html(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);

		});


		function hari(){
			var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
			var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
			var date = new Date();
			var day = date.getDate();
			var month = date.getMonth();
			var thisDay = date.getDay(),
			    thisDay = myDays[thisDay];
			var yy = date.getYear();
			var year = (yy < 1000) ? yy + 1900 : yy;
			//document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);
			hari = thisDay;
			return hari;
		}


		function showTime() {
		    var today=new Date(),
	        curr_hour=today.getHours(),
	        curr_min=today.getMinutes(),
	        curr_sec=today.getSeconds();
	 		curr_hour=checkTime(curr_hour);
		    curr_min=checkTime(curr_min);
		    curr_sec=checkTime(curr_sec);
		    // document.getElementById('clock').innerHTML=curr_hour+":"+curr_min+":"+curr_sec;
		 	jam = curr_hour+":"+curr_min+":"+curr_sec;
		 	return jam;
		}

		function checkTime(i) {
		    if (i < 10) {
		        i = "0" + i;
		    }
		    return i;
		}

		

	</script>

	<center>
		<h2 id="hari"></h2>
		<h1 id="jam"></h1>

	</center>