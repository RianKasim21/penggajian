<?php

class Dashboard extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

        if($this->session->userdata('hak_akses') !='2') {
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
        $id = $this->session->userdata('id_guru');
        $data['guru'] = $this->db->query("SELECT * FROM data_pegawai
        WHERE id_guru = '$id'")->result();
        $user_status = $this->session->userdata('status2');
        $data['user_status'] = $user_status;
        $this->load->view('desain_pegawai/header',$data);
        $this->load->view('desain_pegawai/sidebar',$data);
        $this->load->view('pegawai/dashboard',$data);
        $this->load->view('desain_pegawai/footer');
    }

    public function index2() {
        $instructor_id = $this->session->userdata('id_guru'); // Asumsikan ID pengguna disimpan di sesi
        $status = $this->PenggajianModel->get_teaching_status($instructor_id);

        $data['tidak_mengajar'] = ($status != 'Mengajar');
        $this->load->view('desain_pegawai/header',$data);
        $this->load->view('desain_pegawai/sidebar');
        $this->load->view('pegawai/dashboard',$data);
        $this->load->view('desain_pegawai/footer');
    }

    public function data_mengajar() {
        // Ambil status pengguna dari session atau database
        $user_status = $this->session->userdata('status2'); // Misalnya disimpan di session

        $data['user_status'] = $user_status;
        $this->load->view('nama_view_anda', $data);
    }
}

?>