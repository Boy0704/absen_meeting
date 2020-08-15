<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jadwal_rundown extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Jadwal_rundown_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'jadwal_rundown/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'jadwal_rundown/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'jadwal_rundown/index.html';
            $config['first_url'] = base_url() . 'jadwal_rundown/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Jadwal_rundown_model->total_rows($q);
        $jadwal_rundown = $this->Jadwal_rundown_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'jadwal_rundown_data' => $jadwal_rundown,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'konten' => 'jadwal_rundown/jadwal_rundown_list',
            'judul' => 'Jadwal rundown',
        );
        $this->load->view('v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->Jadwal_rundown_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_jadwal' => $row->id_jadwal,
		'waktu' => $row->waktu,
		'durasi' => $row->durasi,
		'acara' => $row->acara,
		'keterangan' => $row->keterangan,
		'nama_pic' => $row->nama_pic,
		'no_tlp' => $row->no_tlp,
		'hari' => $row->hari,
	    );
            $this->load->view('jadwal_rundown/jadwal_rundown_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jadwal_rundown'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('jadwal_rundown/create_action'),
	    'id_jadwal' => set_value('id_jadwal'),
	    'waktu' => set_value('waktu'),
	    'durasi' => set_value('durasi'),
	    'acara' => set_value('acara'),
	    'keterangan' => set_value('keterangan'),
	    'nama_pic' => set_value('nama_pic'),
	    'no_tlp' => set_value('no_tlp'),
	    'hari' => set_value('hari'),
        'konten' => 'jadwal_rundown/jadwal_rundown_form',
            'judul' => 'Jadwal rundown',
	);
        $this->load->view('v_index', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'waktu' => $this->input->post('waktu',TRUE),
		'durasi' => $this->input->post('durasi',TRUE),
		'acara' => $this->input->post('acara',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
		'nama_pic' => $this->input->post('nama_pic',TRUE),
		'no_tlp' => $this->input->post('no_tlp',TRUE),
		'hari' => $this->input->post('hari',TRUE),
	    );

            $this->Jadwal_rundown_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('jadwal_rundown'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Jadwal_rundown_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('jadwal_rundown/update_action'),
		'id_jadwal' => set_value('id_jadwal', $row->id_jadwal),
		'waktu' => set_value('waktu', $row->waktu),
		'durasi' => set_value('durasi', $row->durasi),
		'acara' => set_value('acara', $row->acara),
		'keterangan' => set_value('keterangan', $row->keterangan),
		'nama_pic' => set_value('nama_pic', $row->nama_pic),
		'no_tlp' => set_value('no_tlp', $row->no_tlp),
		'hari' => set_value('hari', $row->hari),
        'konten' => 'jadwal_rundown/jadwal_rundown_form',
            'judul' => 'Jadwal rundown',
	    );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jadwal_rundown'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_jadwal', TRUE));
        } else {
            $data = array(
		'waktu' => $this->input->post('waktu',TRUE),
		'durasi' => $this->input->post('durasi',TRUE),
		'acara' => $this->input->post('acara',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
		'nama_pic' => $this->input->post('nama_pic',TRUE),
		'no_tlp' => $this->input->post('no_tlp',TRUE),
		'hari' => $this->input->post('hari',TRUE),
	    );

            $this->Jadwal_rundown_model->update($this->input->post('id_jadwal', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('jadwal_rundown'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Jadwal_rundown_model->get_by_id($id);

        if ($row) {
            $this->Jadwal_rundown_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('jadwal_rundown'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jadwal_rundown'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('waktu', 'waktu', 'trim|required');
	$this->form_validation->set_rules('durasi', 'durasi', 'trim|required');
	$this->form_validation->set_rules('acara', 'acara', 'trim|required');
	$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
	$this->form_validation->set_rules('nama_pic', 'nama pic', 'trim|required');
	$this->form_validation->set_rules('no_tlp', 'no tlp', 'trim|required');
	$this->form_validation->set_rules('hari', 'hari', 'trim|required');

	$this->form_validation->set_rules('id_jadwal', 'id_jadwal', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

