<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Unit extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Unit_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'unit/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'unit/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'unit/index.html';
            $config['first_url'] = base_url() . 'unit/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Unit_model->total_rows($q);
        $unit = $this->Unit_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'unit_data' => $unit,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'konten' => 'unit/unit_list',
            'judul' => 'Unit',
        );
        $this->load->view('v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->Unit_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_unit' => $row->id_unit,
		'nama_unit' => $row->nama_unit,
		'deskripsi_unit' => $row->deskripsi_unit,
		'alamat' => $row->alamat,
	    );
            $this->load->view('unit/unit_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('unit'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('unit/create_action'),
	    'id_unit' => set_value('id_unit'),
	    'nama_unit' => set_value('nama_unit'),
	    'deskripsi_unit' => set_value('deskripsi_unit'),
	    'alamat' => set_value('alamat'),
        'konten' => 'unit/unit_form',
            'judul' => 'Unit',
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
		'nama_unit' => $this->input->post('nama_unit',TRUE),
		'deskripsi_unit' => $this->input->post('deskripsi_unit',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
	    );

            $this->Unit_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('unit'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Unit_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('unit/update_action'),
		'id_unit' => set_value('id_unit', $row->id_unit),
		'nama_unit' => set_value('nama_unit', $row->nama_unit),
		'deskripsi_unit' => set_value('deskripsi_unit', $row->deskripsi_unit),
		'alamat' => set_value('alamat', $row->alamat),
        'konten' => 'unit/unit_form',
            'judul' => 'Unit',
	    );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('unit'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_unit', TRUE));
        } else {
            $data = array(
		'nama_unit' => $this->input->post('nama_unit',TRUE),
		'deskripsi_unit' => $this->input->post('deskripsi_unit',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
	    );

            $this->Unit_model->update($this->input->post('id_unit', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('unit'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Unit_model->get_by_id($id);

        if ($row) {
            $this->Unit_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('unit'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('unit'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_unit', 'nama unit', 'trim|required');
	$this->form_validation->set_rules('deskripsi_unit', 'deskripsi unit', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');

	$this->form_validation->set_rules('id_unit', 'id_unit', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

