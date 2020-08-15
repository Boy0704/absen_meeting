<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Video extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Video_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'video/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'video/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'video/index.html';
            $config['first_url'] = base_url() . 'video/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Video_model->total_rows($q);
        $video = $this->Video_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'video_data' => $video,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'konten' => 'video/video_list',
            'judul' => 'Video',
        );
        $this->load->view('v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->Video_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_video' => $row->id_video,
		'judul_video' => $row->judul_video,
		'link_video' => $row->link_video,
	    );
            $this->load->view('video/video_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('video'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('video/create_action'),
	    'id_video' => set_value('id_video'),
	    'judul_video' => set_value('judul_video'),
	    'link_video' => set_value('link_video'),
        'konten' => 'video/video_form',
            'judul' => 'Video',
	);
        $this->load->view('v_index', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $nmfile = "video_".time();
            $config['upload_path'] = './image/video';
            $config['allowed_types'] = 'mp4';
            $config['max_size'] = '200000000';
            $config['file_name'] = $nmfile;
            // load library upload
            $this->load->library('upload', $config);
            // upload gambar 1
            $this->upload->do_upload('link_video');
            $result1 = $this->upload->data();
            $result = array('gambar'=>$result1);
            $dfile = $result['gambar']['file_name'];
            $data = array(
		'judul_video' => $this->input->post('judul_video',TRUE),
		'link_video' => $dfile,
	    );

            $this->Video_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('video'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Video_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('video/update_action'),
		'id_video' => set_value('id_video', $row->id_video),
		'judul_video' => set_value('judul_video', $row->judul_video),
		'link_video' => set_value('link_video', $row->link_video),
        'konten' => 'video/video_form',
            'judul' => 'Video',
	    );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('video'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_video', TRUE));
        } else {

            if ($_FILES['berkas']['name'] == '' ) {

                $data = array(
    		'judul_video' => $this->input->post('judul_video',TRUE),
    	    );

                $this->Video_model->update($this->input->post('id_video', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('video'));
            } else {

                $nmfile = "video_".time();
            $config['upload_path'] = './image/video';
            $config['allowed_types'] = 'mp4';
            $config['max_size'] = '200000000';
            $config['file_name'] = $nmfile;
            // load library upload
            $this->load->library('upload', $config);
            // upload gambar 1
            $this->upload->do_upload('link_video');
            $result1 = $this->upload->data();
            $result = array('gambar'=>$result1);
            $dfile = $result['gambar']['file_name'];

                $data = array(
            'judul_video' => $this->input->post('judul_video',TRUE),
            'link_video' => $dfile,
            );

                $this->Video_model->update($this->input->post('id_video', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('video'));

            }
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Video_model->get_by_id($id);

        if ($row) {
            $this->Video_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('video'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('video'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('judul_video', 'judul video', 'trim|required');
	// $this->form_validation->set_rules('link_video', 'link video', 'trim|required');

	$this->form_validation->set_rules('id_video', 'id_video', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

