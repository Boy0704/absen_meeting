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
                <form action="<?php echo site_url('absen_datang/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('absen_datang'); ?>" class="btn btn-default">Reset</a>
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
            foreach ($absen_datang_data as $absen_datang)
            {
                ?>
                <tr>
            <td width="80px"><?php echo ++$start ?></td>
            <td><?php echo $absen_datang->jam ?></td>
            <td><?php echo $absen_datang->tanggal ?></td>
            <td><?php echo $absen_datang->foto_selfi ?></td>
            <td><?php echo $absen_datang->lokasi ?></td>
            <td><?php echo $absen_datang->status ?></td>
            <td style="text-align:center" width="200px">
                <?php 
                
                echo anchor(site_url('absen_datang/update/'.$absen_datang->id_absen_datang),'Update'); 
                echo ' | '; 
                echo anchor(site_url('absen_datang/delete/'.$absen_datang->id_absen_datang),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
                <a href="app/print_absen/datang" class="btn btn-info">Print</a>
        </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>