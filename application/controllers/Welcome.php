<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function index()
	{
		$this->_rules();

		if($this->form_validation->run()==false) {
			$data['title'] = "Form Login";
			$this->load->view('desain_admin/header',$data);
			$this->load->view('login');

		}else{
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$cek = $this->penggajianModel->cek_login($username,$password);

			if($cek == false)
			{
				$this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>Username Atau Password Salah!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>');
				redirect('welcome');
			}else{
				$this->session->set_userdata('hak_akses',$cek->hak_akses);
				$this->session->set_userdata('nama_pegawai',$cek->nama_pegawai);
				$this->session->set_userdata('photo',$cek->photo);
				$this->session->set_userdata('id_guru',$cek->id_guru);
				$this->session->set_userdata('nuptk',$cek->nuptk);
				$this->session->set_userdata('status2',$cek->status2);

				switch ($cek->hak_akses) {
					case 1 : redirect('admin/dashboard');
						break;
					case 2 : redirect('pegawai/dashboard');
						break;
					case 3 : redirect('kepsek/dashboard');
						break;
					case 4 : redirect('staff/dashboard');
						break;

					default:
						break;
				}
			}
		}

	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('welcome');
	}

	public function _rules()
	{
		$this->form_validation->set_rules('username','username','required');
		$this->form_validation->set_rules('password','password','required');
	}
}
