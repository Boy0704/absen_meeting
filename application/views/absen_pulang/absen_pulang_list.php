<div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('absen_pulang/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('absen_pulang'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
        <th>Jam</th>
        <th>Tanggal</th>
        <th>Foto Selfi</th>
        <th>Lokasi</th>
        <th>Status</th>
        <th>Action</th>
            </tr><?php
            foreach ($absen_pulang_data as $absen_pulang)
            {
                ?>
                <tr>
            <td width="80px"><?php echo ++$start ?></td>
            <td><?php echo $absen_pulang->jam ?></td>
            <td><?php echo $absen_pulang->tanggal ?></td>
            <td><?php echo $absen_pulang->foto_selfi ?></td>
            <td><?php echo $absen_pulang->lokasi ?></td>
            <td><?php echo $absen_pulang->status ?></td>
            <td style="text-align:center" width="200px">
                <?php 
                 
                echo anchor(site_url('absen_pulang/update/'.$absen_pulang->id_absen_pulang),'Update'); 
                echo ' | '; 
                echo anchor(site_url('absen_pulang/delete/'.$absen_pulang->id_absen_pulang),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
                ?>
            </td>
        </tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
                 <a href="app/print_absen/pulang" class="btn btn-info">Print</a>
        </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>