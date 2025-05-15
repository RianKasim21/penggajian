<?php

class Dashboard extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

        if($this->session->userdata('hak_akses') !='1') {
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
        $admin = $this->db->query("SELECT * FROM data_pegawai WHERE jabatan = 'admin'");
        $jabatan = $this->db->query("SELECT * FROM data_jabatan");
        $potongan = $this->db->query("SELECT * FROM data_potongan");
        $kehadiran = $this->db->query("SELECT * FROM data_kehadiran");
        $data['guru'] = $guru->num_rows();
        $data['staff'] = $staff->num_rows();
        $data['admin'] = $admin->num_rows();
        $data['jabatan'] = $jabatan->num_rows();
        $data['potongan'] = $potongan->num_rows();
        $data['kehadiran'] = $kehadiran->num_rows();
        $this->load->view('desain_admin/header',$data);
        $this->load->view('desain_admin/sidebar');
        $this->load->view('admin/dashboard',$data);
        $this->load->view('desain_admin/footer');
    }
}

?>