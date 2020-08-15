<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class News extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('News_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'news/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'news/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'news/index.html';
            $config['first_url'] = base_url() . 'news/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->News_model->total_rows($q);
        $news = $this->News_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'news_data' => $news,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'konten' => 'news/news_list',
            'judul' => 'News',
        );
        $this->load->view('v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->News_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_news' => $row->id_news,
		'judul_news' => $row->judul_news,
		'isi_news' => $row->isi_news,
	    );
            $this->load->view('news/news_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('news'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('news/create_action'),
	    'id_news' => set_value('id_news'),
	    'judul_news' => set_value('judul_news'),
        'isi_news' => set_value('isi_news'),
	    'gambar' => set_value('gambar'),
        'konten' => 'news/news_form',
            'judul' => 'News',
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
            $config['upload_path'] = './image/news';
            $config['allowed_types'] = 'jpg|png';
            $config['max_size'] = '20000';
            $config['file_name'] = $nmfile;
            // load library upload
            $this->load->library('upload', $config);
            // upload gambar 1
            $this->upload->do_upload('gambar');
            $result1 = $this->upload->data();
            $result = array('gambar'=>$result1);
            $dfile = $result['gambar']['file_name'];

            $data = array(
		'judul_news' => $this->input->post('judul_news',TRUE),
        'isi_news' => $this->input->post('isi_news',TRUE),
		'gambar' => $dfile,
	    );

            $this->News_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('news'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->News_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('news/update_action'),
		'id_news' => set_value('id_news', $row->id_news),
		'judul_news' => set_value('judul_news', $row->judul_news),
        'isi_news' => set_value('isi_news', $row->isi_news),
		'gambar' => set_value('gambar', $row->gambar),
        'konten' => 'news/news_form',
            'judul' => 'News',
	    );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('news'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_news', TRUE));
        } else {

            if ($_FILES['gambar']['name'] == '' ) {

                $data = array(
    		'judul_news' => $this->input->post('judul_news',TRUE),
    		'isi_news' => $this->input->post('isi_news',TRUE),
    	    );

                $this->News_model->update($this->input->post('id_news', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('news'));

            } else {
                $nmfile = "foto_".time();
            $config['upload_path'] = './image/news';
            $config['allowed_types'] = 'jpg|png';
            $config['max_size'] = '20000';
            $config['file_name'] = $nmfile;
            // load library upload
            $this->load->library('upload', $config);
            // upload gambar 1
            $this->upload->do_upload('gambar');
            $result1 = $this->upload->data();
            $result = array('gambar'=>$result1);
            $dfile = $result['gambar']['file_name'];

                $data = array(
            'judul_news' => $this->input->post('judul_news',TRUE),
            'isi_news' => $this->input->post('isi_news',TRUE),
            'gambar' => $dfile,
            );

                $this->News_model->update($this->input->post('id_news', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('news'));

            }

        }
    }
    
    public function delete($id) 
    {
        $row = $this->News_model->get_by_id($id);

        if ($row) {
            $this->News_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('news'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('news'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('judul_news', 'judul news', 'trim|required');
	$this->form_validation->set_rules('isi_news', 'isi news', 'trim|required');

	$this->form_validation->set_rules('id_news', 'id_news', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

