<?php
defined('BASEPATH') OR EXIT('No direct script access allowed');

class Siswa extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_siswa');
	}

	public function index()
	{
		$get_data = $this->model_siswa->get_list();
		$data['data'] = $get_data->result();
		$data['jumlah_data'] = $get_data->num_rows();

		$this->load->view('siswa/index', $data);
	}

	public function add()
	{
		$get = $this->input->get();
		$data['total_form'] = $get['total_form'];

		$this->load->view('siswa/add', $data);
	}

	function insert()
        {
            $post = $this->input->post();
            $result = array();
            $total_post = count($post['nama']);

            foreach($post['nama'] AS $key => $val)
            {
                $result[] = array(
                    "nama"  => $post['nama'][$key],
                    "umur"  => $post['umur'][$key],
                    "kelas"  => $post['kelas'][$key]
                );
            }
            $this->model_siswa->insert($result);
            
            $this->session->set_flashdata('notif', '<p style="color:green;font-weight:bold;">'.$total_post.' data berhasil di simpan!</p>');
            redirect('siswa');
        }

	public function action()
	{
		$post = $this->input->post();
		$check = $post['check'];

		if (isset($check)) {
			if(isset($post['edit']))
            {
                $q['data'] = $this->model_siswa->get_edit($post)->result();
                $q['data_count'] = $this->model_siswa->get_edit($post)->num_rows();

                $this->load->view('siswa/edit', $q);
            }
            elseif(isset($post['delete']))
            {
                $this->model_siswa->delete($post);

                $this->session->set_flashdata('notif', '<p style="color:green;font-weight:bold;">'.count($check).' data berhasil dihapus!</p>');
                redirect('siswa');
            }
		} else {
			$this->session->set_flashdata('notif', '<p style="color:red;font-weight:bold;">Harap centang dulu datanya!</p>');
                redirect('siswa');
		}
	}

	function update()
    {
        $post = $this->input->post();
        $result = array();
        $total_post = count($post['id']);

        foreach($post['id'] AS $key => $val)
        {
            $result[] = array(
                "id"  => $post['id'][$key],
                "nama"  => $post['nama'][$key],
                "umur"  => $post['umur'][$key],
                "kelas"  => $post['kelas'][$key]
            );
        }
        $this->model_siswa->update($result);
        
        $this->session->set_flashdata('notif', '<p style="color:green;font-weight:bold;">'.$total_post.' data berhasil di sunting!</p>');
        redirect('siswa');
    }
}
