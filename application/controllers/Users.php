<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Users_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'users/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'users/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'users/index.html';
            $config['first_url'] = base_url() . 'users/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Users_model->total_rows($q);
        $users = $this->Users_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'users_data' => $users,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'konten' => 'users/users_list',
            'judul' => 'User',
        );
        $this->load->view('v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->Users_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_user' => $row->id_user,
		'npp' => $row->npp,
		'nama' => $row->nama,
		'username' => $row->username,
		'password' => $row->password,
		'jabatan' => $row->jabatan,
		'unit' => $row->unit,
		'foto' => $row->foto,
		'level' => $row->level,
	    );
            $this->load->view('users/users_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('users'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('users/create_action'),
	    'id_user' => set_value('id_user'),
	    'npp' => set_value('npp'),
	    'nama' => set_value('nama'),
	    'username' => set_value('username'),
	    'password' => set_value('password'),
	    'jabatan' => set_value('jabatan'),
	    'unit' => set_value('unit'),
	    'foto' => set_value('foto'),
	    'level' => set_value('level'),
        'konten' => 'users/users_form',
            'judul' => 'User',
	);
        $this->load->view('v_index', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $nmfile = "foto_".time();
            $config['upload_path'] = './image/foto';
            $config['allowed_types'] = 'jpg|png';
            $config['max_size'] = '20000';
            $config['file_name'] = $nmfile;
            // load library upload
            $this->load->library('upload', $config);
            // upload gambar 1
            $this->upload->do_upload('foto');
            $result1 = $this->upload->data();
            $result = array('gambar'=>$result1);
            $dfile = $result['gambar']['file_name'];
            $data = array(
		'npp' => $this->input->post('npp',TRUE),
		'nama' => $this->input->post('nama',TRUE),
		'username' => $this->input->post('username',TRUE),
		'password' => $this->input->post('password',TRUE),
		'jabatan' => $this->input->post('jabatan',TRUE),
		'unit' => $this->input->post('unit',TRUE),
		'foto' => $dfile,
		'level' => $this->input->post('level',TRUE),
	    );

            $this->Users_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('users'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Users_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('users/update_action'),
		'id_user' => set_value('id_user', $row->id_user),
		'npp' => set_value('npp', $row->npp),
		'nama' => set_value('nama', $row->nama),
		'username' => set_value('username', $row->username),
		'password' => set_value('password', $row->password),
		'jabatan' => set_value('jabatan', $row->jabatan),
		'unit' => set_value('unit', $row->unit),
		'foto' => set_value('foto', $row->foto),
		'level' => set_value('level', $row->level),
        'konten' => 'users/users_form',
            'judul' => 'User',
	    );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('users'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_user', TRUE));
        } else {
            if ($_FILES['foto']['name'] == '' ) {

                $data = array(
        'npp' => $this->input->post('npp',TRUE),
        'nama' => $this->input->post('nama',TRUE),
        'username' => $this->input->post('username',TRUE),
        'password' => $this->input->post('password',TRUE),
        'jabatan' => $this->input->post('jabatan',TRUE),
        'unit' => $this->input->post('unit',TRUE),
        'level' => $this->input->post('level',TRUE),
        );

            $this->Users_model->update($this->input->post('id_user', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('users'));

            }else{

                $nmfile = "foto_".time();
            $config['upload_path'] = './image/foto';
            $config['allowed_types'] = 'jpg|png';
            $config['max_size'] = '20000';
            $config['file_name'] = $nmfile;
            // load library upload
            $this->load->library('upload', $config);
            // upload gambar 1
            $this->upload->do_upload('foto');
            $result1 = $this->upload->data();
            $result = array('gambar'=>$result1);
            $dfile = $result['gambar']['file_name'];

                $data = array(
        'npp' => $this->input->post('npp',TRUE),
        'nama' => $this->input->post('nama',TRUE),
        'username' => $this->input->post('username',TRUE),
        'password' => $this->input->post('password',TRUE),
        'jabatan' => $this->input->post('jabatan',TRUE),
        'unit' => $this->input->post('unit',TRUE),
        'foto' => $dfile,
        'level' => $this->input->post('level',TRUE),
        );

            $this->Users_model->update($this->input->post('id_user', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('users'));
            }   

            
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Users_model->get_by_id($id);

        if ($row) {
            $this->Users_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('users'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('users'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('npp', 'npp', 'trim|required');
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('username', 'username', 'trim|required');
	$this->form_validation->set_rules('password', 'password', 'trim|required');
	$this->form_validation->set_rules('jabatan', 'jabatan', 'trim|required');
	$this->form_validation->set_rules('unit', 'unit', 'trim|required');
	$this->form_validation->set_rules('level', 'level', 'trim|required');

	$this->form_validation->set_rules('id_user', 'id_user', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

