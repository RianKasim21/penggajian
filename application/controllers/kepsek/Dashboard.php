<?php

class Dashboard extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

        if($this->session->userdata('hak_akses') !='3') {
            $this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>Belum Login</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>');
                redirect('welcome');
        }
    }

    public function index()
    {
        $data['title'] = "Dashboard";
        $id = $this->session->userdata('nuptk');
        $data['guru'] = $this->db->query("SELECT * FROM data_pegawai
        WHERE nuptk = '$id'")->result();
        $this->load->view('desain_kepsek/header',$data);
        $this->load->view('desain_kepsek/sidebar');
        $this->load->view('kepsek/dashboard',$data);
        $this->load->view('desain_kepsek/footer');
    }
}

?>