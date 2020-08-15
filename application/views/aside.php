<aside class="left-side sidebar-offcanvas">                
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="assets/img/avatar5.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hello, Mr. <?php echo $this->session->userdata('username'); ?></p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                       
                      

                        

                        <li class="active">
                            <a href="">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-circle"></i>
                                <span>Pengaturan </span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="app/set_lokasi">
                                        <i class="fa fa-angle-double-right"></i> <span>Set Lokasi</span>
                                    </a>
                                </li>                        

                                <li>
                                    <a href="app/set_absen">
                                        <i class="fa fa-angle-double-right"></i> <span>Set Absen</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-circle"></i>
                                <span>Absen </span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="absen_datang">
                                        <i class="fa fa-angle-double-right"></i> <span>Absen Datang</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="absen_pulang">
                                        <i class="fa fa-angle-double-right"></i> <span>Absen Pulang</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        
                        
                        

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-circle"></i>
                                <span>Media </span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="gallery">
                                        <i class="fa fa-dashboard"></i> <span>Gallery</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="video">
                                        <i class="fa fa-angle-double-right"></i> <span>Video</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-circle"></i>
                                <span>Lainnya </span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                
                                <li>
                                    <a href="jadwal_rundown">
                                        <i class="fa fa-dashboard"></i> <span>Jadwal Rundown</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="unit">
                                        <i class="fa fa-dashboard"></i> <span>Unit</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="users">
                                        <i class="fa fa-dashboard"></i> <span>User</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="materi">
                                        <i class="fa fa-dashboard"></i> <span>Materi</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="news">
                                        <i class="fa fa-dashboard"></i> <span>News</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="alarm">
                                        <i class="fa fa-dashboard"></i> <span>Alarm</span>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        
                          

                        
                        
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>