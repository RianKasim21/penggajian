<?php

class Dashboard extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

        if($this->session->userdata('hak_akses') !='4') {
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
        $guru = $this->db->query("SELECT * FROM data_pegawai");
        $staff = $this->db->query("SELECT * FROM data_pegawai WHERE jabatan = 'Staff TU'");
        $jabatan = $this->db->query("SELECT * FROM data_jabatan");
        $kehadiran = $this->db->query("SELECT * FROM data_kehadiran");
        $data['guru'] = $guru->num_rows();
        $data['staff'] = $staff->num_rows();
        $data['jabatan'] = $jabatan->num_rows();
        $data['kehadiran'] = $kehadiran->num_rows();
        $this->load->view('desain_staffTU/header',$data);
        $this->load->view('desain_staffTU/sidebar');
        $this->load->view('staff/dashboard',$data);
        $this->load->view('desain_staffTU/footer');
    }
}

?>