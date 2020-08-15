<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gallery extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Gallery_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'gallery/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'gallery/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'gallery/index.html';
            $config['first_url'] = base_url() . 'gallery/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Gallery_model->total_rows($q);
        $gallery = $this->Gallery_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'gallery_data' => $gallery,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'konten' => 'gallery/gallery_list',
            'judul' => 'Gallery',
        );
        $this->load->view('v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->Gallery_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_gallery' => $row->id_gallery,
		'judul_gallery' => $row->judul_gallery,
		'foto_gallery' => $row->foto_gallery,
	    );
            $this->load->view('gallery/gallery_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('gallery'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('gallery/create_action'),
	    'id_gallery' => set_value('id_gallery'),
	    'judul_gallery' => set_value('judul_gallery'),
	    'foto_gallery' => set_value('foto_gallery'),
        'konten' => 'gallery/gallery_form',
            'judul' => 'Gallery',
	);
        $this->load->view('v_index', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {

            $nmfile = "gallery_".time();
            $config['upload_path'] = './image/gallery';
            $config['allowed_types'] = 'jpg|png';
            $config['max_size'] = '20000';
            $config['file_name'] = $nmfile;
            // load library upload
            $this->load->library('upload', $config);
            // upload gambar 1
            $this->upload->do_upload('foto_gallery');
            $result1 = $this->upload->data();
            $result = array('gambar'=>$result1);
            $dfile = $result['gambar']['file_name'];

            $data = array(
		'judul_gallery' => $this->input->post('judul_gallery',TRUE),
		'foto_gallery' => $dfile,
	    );

            $this->Gallery_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('gallery'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Gallery_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('gallery/update_action'),
		'id_gallery' => set_value('id_gallery', $row->id_gallery),
		'judul_gallery' => set_value('judul_gallery', $row->judul_gallery),
		'foto_gallery' => set_value('foto_gallery', $row->foto_gallery),
        'konten' => 'gallery/gallery_form',
            'judul' => 'Gallery',
	    );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('gallery'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_gallery', TRUE));
        } else {

            if ($_FILES['foto_gallery']['name'] == '' ) {

                $data = array(
    		'judul_gallery' => $this->input->post('judul_gallery',TRUE),
    	    );

                $this->Gallery_model->update($this->input->post('id_gallery', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('gallery'));
            } else {
                $nmfile = "gallery_".time();
                $config['upload_path'] = './image/gallery';
                $config['allowed_types'] = 'jpg|png';
                $config['max_size'] = '20000';
                $config['file_name'] = $nmfile;
                // load library upload
                $this->load->library('upload', $config);
                // upload gambar 1
                $this->upload->do_upload('foto_gallery');
                $result1 = $this->upload->data();
                $result = array('gambar'=>$result1);
                $dfile = $result['gambar']['file_name'];

                $data = array(
            'judul_gallery' => $this->input->post('judul_gallery',TRUE),
            'foto_gallery' => $dfile,
            );

                $this->Gallery_model->update($this->input->post('id_gallery', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('gallery'));
            }
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Gallery_model->get_by_id($id);

        if ($row) {
            $this->Gallery_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('gallery'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('gallery'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('judul_gallery', 'judul gallery', 'trim|required');

	$this->form_validation->set_rules('id_gallery', 'id_gallery', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

