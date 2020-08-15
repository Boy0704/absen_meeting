<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Absen_pulang extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Absen_pulang_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'absen_pulang/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'absen_pulang/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'absen_pulang/index.html';
            $config['first_url'] = base_url() . 'absen_pulang/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Absen_pulang_model->total_rows($q);
        $absen_pulang = $this->Absen_pulang_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'absen_pulang_data' => $absen_pulang,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'konten' => 'absen_pulang/absen_pulang_list',
            'judul' => 'Absen Pulang',
        );
        $this->load->view('v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->Absen_pulang_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_absen_pulang' => $row->id_absen_pulang,
		'jam' => $row->jam,
		'tanggal' => $row->tanggal,
		'foto_selfi' => $row->foto_selfi,
		'lokasi' => $row->lokasi,
		'status' => $row->status,
	    );
            $this->load->view('absen_pulang/absen_pulang_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('absen_pulang'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('absen_pulang/create_action'),
	    'id_absen_pulang' => set_value('id_absen_pulang'),
	    'jam' => set_value('jam'),
	    'tanggal' => set_value('tanggal'),
	    'foto_selfi' => set_value('foto_selfi'),
	    'lokasi' => set_value('lokasi'),
	    'status' => set_value('status'),
        'konten' => 'absen_pulang/absen_pulang_form',
            'judul' => 'Absen Pulang',
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
		'jam' => $this->input->post('jam',TRUE),
		'tanggal' => $this->input->post('tanggal',TRUE),
		'foto_selfi' => $this->input->post('foto_selfi',TRUE),
		'lokasi' => $this->input->post('lokasi',TRUE),
		'status' => $this->input->post('status',TRUE),
	    );

            $this->Absen_pulang_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('absen_pulang'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Absen_pulang_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('absen_pulang/update_action'),
		'id_absen_pulang' => set_value('id_absen_pulang', $row->id_absen_pulang),
		'jam' => set_value('jam', $row->jam),
		'tanggal' => set_value('tanggal', $row->tanggal),
		'foto_selfi' => set_value('foto_selfi', $row->foto_selfi),
		'lokasi' => set_value('lokasi', $row->lokasi),
		'status' => set_value('status', $row->status),
        'konten' => 'absen_pulang/absen_pulang_form',
            'judul' => 'Absen Pulang',
	    );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('absen_pulang'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_absen_pulang', TRUE));
        } else {
            $data = array(
		'jam' => $this->input->post('jam',TRUE),
		'tanggal' => $this->input->post('tanggal',TRUE),
		'foto_selfi' => $this->input->post('foto_selfi',TRUE),
		'lokasi' => $this->input->post('lokasi',TRUE),
		'status' => $this->input->post('status',TRUE),
	    );

            $this->Absen_pulang_model->update($this->input->post('id_absen_pulang', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('absen_pulang'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Absen_pulang_model->get_by_id($id);

        if ($row) {
            $this->Absen_pulang_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('absen_pulang'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('absen_pulang'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('jam', 'jam', 'trim|required');
	$this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');
	$this->form_validation->set_rules('foto_selfi', 'foto selfi', 'trim|required');
	$this->form_validation->set_rules('lokasi', 'lokasi', 'trim|required');
	$this->form_validation->set_rules('status', 'status', 'trim|required');

	$this->form_validation->set_rules('id_absen_pulang', 'id_absen_pulang', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

