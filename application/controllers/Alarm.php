<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Alarm extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Alarm_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'alarm/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'alarm/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'alarm/index.html';
            $config['first_url'] = base_url() . 'alarm/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Alarm_model->total_rows($q);
        $alarm = $this->Alarm_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'alarm_data' => $alarm,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'konten' => 'alarm/alarm_list',
            'judul' => 'Alarm',
        );
        $this->load->view('v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->Alarm_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_alarm' => $row->id_alarm,
		'judul_alarm' => $row->judul_alarm,
		'jam_alarm' => $row->jam_alarm,
	    );
            $this->load->view('alarm/alarm_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('alarm'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('alarm/create_action'),
	    'id_alarm' => set_value('id_alarm'),
	    'judul_alarm' => set_value('judul_alarm'),
	    'jam_alarm' => set_value('jam_alarm'),
        'konten' => 'alarm/alarm_form',
            'judul' => 'Alarm',
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
		'judul_alarm' => $this->input->post('judul_alarm',TRUE),
		'jam_alarm' => $this->input->post('jam_alarm',TRUE),
	    );

            $this->Alarm_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('alarm'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Alarm_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('alarm/update_action'),
		'id_alarm' => set_value('id_alarm', $row->id_alarm),
		'judul_alarm' => set_value('judul_alarm', $row->judul_alarm),
		'jam_alarm' => set_value('jam_alarm', $row->jam_alarm),
        'konten' => 'alarm/alarm_form',
            'judul' => 'Alarm',
	    );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('alarm'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_alarm', TRUE));
        } else {
            $data = array(
		'judul_alarm' => $this->input->post('judul_alarm',TRUE),
		'jam_alarm' => $this->input->post('jam_alarm',TRUE),
	    );

            $this->Alarm_model->update($this->input->post('id_alarm', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('alarm'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Alarm_model->get_by_id($id);

        if ($row) {
            $this->Alarm_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('alarm'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('alarm'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('judul_alarm', 'judul alarm', 'trim|required');
	$this->form_validation->set_rules('jam_alarm', 'jam alarm', 'trim|required');

	$this->form_validation->set_rules('id_alarm', 'id_alarm', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

