<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

	
	public function index()
	{
		if ($this->session->userdata('level') !== "user") {
            redirect('app/login');
        } 
		$data = array(
			'konten' => 'page/v_home',
		);
		$this->load->view('v_web',$data);
	}

	public function print_absen($absen)
	{
		if ($this->session->userdata('level') !== "admin") {
            redirect('app/login');
        } 
		$data = array(
			'absen' => $absen,
			'data' => $this->db->query("SELECT * FROM absen_$absen, users where absen_$absen.npp=users.npp ORDER BY id_absen_$absen"),
		);
		$this->load->view('v_print_absen',$data);
	}

	public function set_lokasi()
	{
		if ($this->session->userdata('level') !== "admin") {
            redirect('app/login');
        } 
		$data = array(
			'konten' => 'set_lokasi',
            'judul' => 'SET LOKASI',
		);
		$this->load->view('v_index',$data);
	}

	public function set_absen()
	{
		if ($this->session->userdata('level') !== "admin") {
            redirect('app/login');
        } 
		$data = array(
			'konten' => 'set_absen',
            'judul' => 'SET ABSEN',
		);
		$this->load->view('v_index',$data);
	}


	public function update_lokasi()
	{
		if ($this->session->userdata('level') !== "admin") {
            redirect('app/login');
        } 
        $latlng = $this->input->post('latlng');
        $lokasi = $this->input->post('lokasi');
		$data = array(
			'latlng' => $latlng,
            'lokasi' => $lokasi,
		);
		$this->db->update('set_lokasi', $data);
		?>
		<script type="text/javascript">
			alert('Berhasil Update');
			window.location = '<?php echo base_url() ?>app/set_lokasi';
		</script>
		<?php
	}

	public function update_setabsen()
	{
		if ($this->session->userdata('level') !== "admin") {
            redirect('app/login');
        } 
        $absensi1 = '';
        $absensi2 = '';
        $absen = $this->input->post('absen');
        $jam1 = $this->input->post('jam1');
        $jam2 = $this->input->post('jam2');
        $jam3 = $this->input->post('jam3');
        $jam4 = $this->input->post('jam4');
        if ($absen == 'absen_datang') {
        	$absensi1 = 'y';
        	$absensi2 = 't';
        } elseif ($absen == 'absen_pulang') {
        	$absensi1 = 't';
        	$absensi2 = 'y';
        }
		$data = array(
			'absen_datang' => $absensi1,
            'absen_pulang' => $absensi2,
            'awal_absen_datang' => $jam1,
            'akhir_absen_datang' => $jam2,
            'awal_absen_pulang' => $jam3,
            'akhir_absen_pulang' => $jam4,
		);
		$this->db->update('set_absen', $data);
		?>
		<script type="text/javascript">
			alert('Berhasil Update');
			window.location = '<?php echo base_url() ?>app/set_absen';
		</script>
		<?php
	}

	public function show_jam()
	{
		if ($this->session->userdata('level') !== "user") {
            redirect('app/login');
        } 
		$this->load->view('show_jam');
	}

	public function jadwal()
	{
		if ($this->session->userdata('level') !== "user") {
            redirect('app/login');
        } 
		$data = array(
			'konten' => 'page/v_jadwal',
		);
		$this->load->view('v_web',$data);
	}

	public function news()
	{
		if ($this->session->userdata('level') !== "user") {
            redirect('app/login');
        } 
		$data = array(
			'konten' => 'page/v_news',
		);
		$this->load->view('v_web',$data);
	}

	public function detail_news($id)
	{
		if ($this->session->userdata('level') !== "user") {
            redirect('app/login');
        } 
		$data = array(
			'konten' => 'page/detail_news',
			'id' => $id
		);
		$this->load->view('v_web',$data);
	}

	public function alarm()
	{
		if ($this->session->userdata('level') !== "user") {
            redirect('app/login');
        } 
		$data = array(
			'konten' => 'page/v_alarm',
		);
		$this->load->view('v_web',$data);
	}

	public function foto()
	{
		if ($this->session->userdata('level') !== "user") {
            redirect('app/login');
        } 
		$data = array(
			'konten' => 'page/v_foto',
		);
		$this->load->view('v_web',$data);
	}

	

	public function video()
	{
		if ($this->session->userdata('level') !== "user") {
            redirect('app/login');
        } 
		$data = array(
			'konten' => 'page/v_video',
		);
		$this->load->view('v_web',$data);
	}

	public function upload_materi()
	{
		if ($this->session->userdata('level') !== "user") {
            redirect('app/login');
        } 
		$data = array(
			'konten' => 'page/v_upload_materi',
		);
		$this->load->view('v_web',$data);
	}

	public function aksi_upload_materi()
	{
		if ($this->session->userdata('level') !== "user") {
            redirect('app/login');
        } 
        $nmfile = "berkas_".time();
        $config['upload_path'] = './berkas/';
        $config['allowed_types'] = 'pdf|docx';
        $config['max_size'] = '20000';
        $config['file_name'] = $nmfile;
        // load library upload
        $this->load->library('upload', $config);
        // upload gambar 1
        $this->upload->do_upload('berkas');
        $result1 = $this->upload->data();
        $result = array('gambar'=>$result1);
        $dfile = $result['gambar']['file_name'];
		$data = array(
		'judul_materi' => $this->input->post('judul_materi',TRUE),
		'nama_user' => $this->input->post('nama_user',TRUE),
		'unit' => $this->input->post('unit',TRUE),
		'berkas' => $dfile,
		'waktu' => $this->input->post('waktu',TRUE),
	    );
	    $this->db->insert('materi', $data);
	    redirect('app/materi');
	}

	public function materi()
	{
		if ($this->session->userdata('level') !== "user") {
            redirect('app/login');
        } 
		$data = array(
			'konten' => 'page/v_materi',
		);
		$this->load->view('v_web',$data);
	}

	public function peta()
	{
		if ($this->session->userdata('level') !== "user") {
            redirect('app/login');
        } 
		$data = array(
			'konten' => 'page/v_peta',
		);
		$this->load->view('v_web',$data);
	}

	public function absensi_datang()
	{
		if ($this->session->userdata('level') !== "user") {
            redirect('app/login');
        } 
		$data = array(
			'konten' => 'page/v_absen',
			'absensi' => 'Datang',
		);
		$this->load->view('v_web',$data);
	}

	public function absensi_pulang()
	{
		if ($this->session->userdata('level') !== "user") {
            redirect('app/login');
        } 
		$data = array(
			'konten' => 'page/v_absen',
			'absensi' => 'Pulang',
		);
		$this->load->view('v_web',$data);
	}

	public function simpan_absensi()
	{
		date_default_timezone_set('Asia/Jakarta');
    	$jam = date('H:i:s');
    	$tgl = date('Y-m-d');
    	$status = '';
		$latlng = $this->input->post('latlng');
		$lokasi = $this->input->post('lokasi');
		$absensi = $this->input->post('absensi');
		$npp = $this->session->userdata('npp');
		if ($absensi == 'Datang') {
			$qr = $this->db->get('set_lokasi')->row();
			if ($latlng == $qr->latlng || $lokasi == $qr->lokasi) {
				$ck_jam = $this->db->get('set_absen')->row();
				if (strtotime($jam) > strtotime($ck_jam->akhir_absen_datang)) {
					$status = 'terlambat';
				} else {
					$status = 'hadir';
				}

				$data = array(
					'jam' => $jam,
					'tanggal' => $tgl,
					'lokasi' => $lokasi,
					'npp' => $npp,
					'status' => $status,
				);
				$ambjam = $this->db->query("SELECT jam from absen_datang where npp='$npp' and tanggal='$tgl'")->row();
				$jamc = substr($ambjam->jam, 0,2);
				if ($jamc == $jam) {
					?>
					<script type="text/javascript">
						alert('anda sudah absen sebelumnya !');
						window.location='<?php echo base_url() ?>app/absensi_datang';
					</script>
					<?php
				} else {
					$this->db->insert('absen_datang', $data);
					?>
					<script type="text/javascript">
						alert('anda berhasil absen');
						window.location='<?php echo base_url() ?>app/absensi_datang';
					</script>
					<?php
				}
				
			} else {
				?>
				<script type="text/javascript">
					alert('lokasi anda tidak diizinkan !');
					window.location='<?php echo base_url() ?>app/absensi_datang';
				</script>
				<?php
			}
		} elseif ($absensi == 'Pulang') {
			$qr = $this->db->get('set_lokasi')->row();
			if ($latlng == $qr->latlng || $lokasi == $qr->lokasi) {
				$ck_jam = $this->db->get('set_absen')->row();
				if (strtotime($jam) > strtotime($ck_jam->akhir_absen_pulang)) {
					$status = 'terlambat';
				} else {
					$status = 'hadir';
				}
				$data = array(
					'jam' => $jam,
					'tanggal' => $tgl,
					'lokasi' => $lokasi,
					'npp' => $npp,
					'status' => $status,
				);
				$ambjam = $this->db->query("SELECT jam from absen_pulang where npp='$npp' and tanggal='$tgl'")->row();
				error_reporting(0);
				$jamc = substr($ambjam->jam, 0,2);
				if ($jamc == substr($jam, 0,2)) {
					?>
					<script type="text/javascript">
						alert('anda sudah absen sebelumnya !');
						window.location='<?php echo base_url() ?>app/absensi_pulang';
					</script>
					<?php
				} else {
					$this->db->insert('absen_pulang', $data);
					?>
					<script type="text/javascript">
						alert('anda berhasil absen');
						window.location='<?php echo base_url() ?>app/absensi_pulang';
					</script>
					<?php
				}
				
			} else {
				?>
				<script type="text/javascript">
					alert('lokasi anda tidak diizinkan !');
					window.location='<?php echo base_url() ?>app/absensi_pulang';
				</script>
				<?php
			}
		}
	}

	public function adminweb()
	{
		if ($this->session->userdata('level') !== "admin") {
            redirect('app/login');
        } 
		
		$data = array(
			'konten' => 'home',
            'judul' => 'Dashboard',
		);
		$this->load->view('v_index', $data);
	}

	public function tesgps()
	{
		$this->load->view('tesgps');
	}


	

	public function login()
	{
		if ($this->input->post() == NULL) {
			$this->load->view('login');
		} else {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			
			$cek_user = $this->db->query("SELECT * FROM users WHERE username='$username' and password='$password' ");
				if ($cek_user->num_rows() == 1) {
					foreach ($cek_user->result() as $row) {
						$sess_data['id_user'] = $row->id_user;
						$sess_data['npp'] = $row->npp;
						$sess_data['jabatan'] = $row->jabatan;
						$sess_data['unit'] = $row->unit;
						$sess_data['foto'] = $row->foto;
						$sess_data['nama'] = $row->nama;
						$sess_data['username'] = $row->username;
						$sess_data['level'] = $row->level;
						$this->session->set_userdata($sess_data);
					}
					$rw = $cek_user->row();
					if ($rw->level == 'admin') {
						redirect('app/adminweb');
					} elseif ($rw->level == 'user') {
						redirect('app');
					}
					
				} else {
					?>
					<script type="text/javascript">
						alert('Username dan password kamu salah !');
						window.location="<?php echo base_url('app/login'); ?>";
					</script>
					<?php
				}

		}
	}

	
	function logout()
	{
		$this->session->unset_userdata('id_user');
		$this->session->unset_userdata('nama');
		$this->session->unset_userdata('npp');
		$this->session->unset_userdata('jabatan');
		$this->session->unset_userdata('unit');
		$this->session->unset_userdata('foto');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('level');
		session_destroy();
		redirect('app/adminweb');
	}

	
}
