<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Materi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Materi_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'materi/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'materi/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'materi/index.html';
            $config['first_url'] = base_url() . 'materi/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Materi_model->total_rows($q);
        $materi = $this->Materi_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'materi_data' => $materi,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'konten' => 'materi/materi_list',
            'judul' => 'Materi',
        );
        $this->load->view('v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->Materi_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_materi' => $row->id_materi,
		'judul_materi' => $row->judul_materi,
		'nama_user' => $row->nama_user,
		'unit' => $row->unit,
		'berkas' => $row->berkas,
		'waktu' => $row->waktu,
	    );
            $this->load->view('materi/materi_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('materi'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('materi/create_action'),
	    'id_materi' => set_value('id_materi'),
	    'judul_materi' => set_value('judul_materi'),
	    'nama_user' => set_value('nama_user'),
	    'unit' => set_value('unit'),
	    'berkas' => set_value('berkas'),
	    'waktu' => set_value('waktu'),
        'konten' => 'materi/materi_form',
            'judul' => 'Materi',
	);
        $this->load->view('v_index', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {

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

            $this->Materi_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('materi'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Materi_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('materi/update_action'),
		'id_materi' => set_value('id_materi', $row->id_materi),
		'judul_materi' => set_value('judul_materi', $row->judul_materi),
		'nama_user' => set_value('nama_user', $row->nama_user),
		'unit' => set_value('unit', $row->unit),
		'berkas' => set_value('berkas', $row->berkas),
		'waktu' => set_value('waktu', $row->waktu),
        'konten' => 'materi/materi_form',
            'judul' => 'Materi',
	    );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('materi'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_materi', TRUE));
        } else {

            if ($_FILES['berkas']['name'] == '' ) {

                $data = array(
    		'judul_materi' => $this->input->post('judul_materi',TRUE),
    		'nama_user' => $this->input->post('nama_user',TRUE),
    		'unit' => $this->input->post('unit',TRUE),
    		'waktu' => $this->input->post('waktu',TRUE),
    	    );

                $this->Materi_model->update($this->input->post('id_materi', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('materi'));

            } else {
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

                $this->Materi_model->update($this->input->post('id_materi', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('materi'));
            }
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Materi_model->get_by_id($id);

        if ($row) {
            $this->Materi_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('materi'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('materi'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('judul_materi', 'judul materi', 'trim|required');
	$this->form_validation->set_rules('nama_user', 'nama user', 'trim|required');
	$this->form_validation->set_rules('unit', 'unit', 'trim|required');
	$this->form_validation->set_rules('waktu', 'waktu', 'trim|required');

	$this->form_validation->set_rules('id_materi', 'id_materi', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

