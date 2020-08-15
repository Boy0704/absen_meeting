<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php
                    $sql = $this->db->get('set_absen')->row(); 
                    if ($sql->absen_datang == 'y') {
                        ?>
                        <li>
                            <a href="app/absensi_datang">Absen Datang</a>
                        </li>
                        <?php
                    } elseif ($sql->absen_pulang == 'y') {
                        ?>
                        
                        <li>
                            <a href="app/absensi_pulang" >Absen Pulang</a>
                        </li>
                        <?php
                    }
                     ?>
                    
                    <li>
                        <a href="app/jadwal">Jadwal Rundown</a>
                    </li>
                    <li>
                        <a href="app/news">News</a>
                    </li>
                    <li>
                        <a href="app/alarm">alarm</a>
                    </li>
                    <li>
                        <a href="app/foto">Foto Gallery</a>
                    </li>
                    <li>
                        <a href="app/video">Video</a>
                    </li>
                    <li>
                        <a href="app/upload_materi">Upload Materi</a>
                    </li>
                    <li>
                        <a href="app/materi">All Materi</a>
                    </li>
                    <li>
                        <a href="app/peta">Peta Lokasi</a>
                    </li>
                </ul>
            </div>