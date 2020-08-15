<?php 
$row = $this->db->query("SELECT * FROM news WHERE id_news='$id'")->row();
 ?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <i class="glyphicon glyphicon-th-large"></i> Detail News
    </div>
    <div class="panel-body">
        
        
        <div class="row" style="margin-left: 10px;">
            <a href="app/detail_news/<?php echo $row->id_news; ?>"><h4><?php echo $row->judul_news; ?></h4></a>
            <p>
                <img src="image/news/<?php echo $row->gambar ?>"> <br>
                <?php echo $row->isi_news; ?>
            </p>
        </div>

    </div>
    <div class="panel-footer"></div>
  </div>