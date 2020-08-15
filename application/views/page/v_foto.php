<div class="row">
  <?php 
  $sql = $this->db->query("SELECT * FROM gallery ORDER BY id_gallery DESC");
  foreach ($sql->result() as $row) {
   ?>
  <div class="col-sm-6 col-md-4">
    <a href="image/gallery/<?php echo $row->foto_gallery; ?>">
      <div class="thumbnail">
        <img src="image/gallery/<?php echo $row->foto_gallery; ?>" alt="<?php echo $row->foto_gallery; ?>" style="width: 242px; height: 200px; padding-bottom: 10px;">
        <h4 style="padding-left:10px; "><?php echo $row->judul_gallery; ?></h4>
      </div>
    </a>
  </div>
  <?php } ?>
</div>