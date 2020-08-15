<div class="panel panel-primary">
    <div class="panel-heading">
        <i class="glyphicon glyphicon-th-large"></i> News
    </div>
    <div class="panel-body">
        
        <?php 
        $sql = $this->db->query("SELECT * FROM news ORDER BY id_news DESC");
        foreach ($sql->result() as $row) {
         ?>
        <div class="row" style="margin-left: 10px;">
            <div class="media">
              <div class="media-left">
                <a href="app/detail_news/<?php echo $row->id_news; ?>">
                  <img class="media-object" src="image/news/<?php echo $row->gambar; ?>" alt="<?php echo $row->gambar; ?>" style="width: 100px; height: 100px; padding-bottom: 10px;">
                </a>
              </div>
              <div class="media-body">
                <a href="app/detail_news/<?php echo $row->id_news; ?>"><h4 class="media-heading"><?php echo $row->judul_news; ?></h4></a>
                <?php echo substr($row->isi_news, 0, 300); ?>
              </div>
            </div>
        </div>

        

        <?php } ?>

    </div>
    <div class="panel-footer"></div>
  </div>