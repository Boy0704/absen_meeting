<div class="row">
<?php 

	// function youtube($url){
	// 	$link=str_replace('http://www.youtube.com/watch?v=', '', $url);
	// 	$link=str_replace('https://www.youtube.com/watch?v=', '', $link);
	// 	$data='<object width="300" height="350" data="http://www.youtube.com/v/'.$link.'" type="application/x-shockwave-flash">
	// 	<param name="src" value="http://www.youtube.com/v/'.$link.'" />
	// 	</object>';
	// 	return $data;
	// }

  $sql = $this->db->query("SELECT * FROM video ORDER BY id_video DESC");
  foreach ($sql->result() as $row) {

   ?>

   <div class="col-md-6">
   		<video width="100%" controls>
		  <source src="image/video/<?php echo $row->link_video; ?>" type="video/mp4">
		  Your browser does not support HTML5 video.
		</video>
		<p><b><?php echo $row->judul_video; ?></b></p>
   </div>
   

	

<?php } ?>
</div>



