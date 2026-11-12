<?php

class slip_gaji extends CI_Controller{

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
        $data['title'] = "Filter Slip Gaji Guru";
        $data['pegawai'] = $this->penggajianModel->get_data('data_pegawai')->result();
        $this->load->view('desain_kepsek/header',$data);
        $this->load->view('desain_kepsek/sidebar');
        $this->load->view('kepsek/filterSlipGaji',$data);
        $this->load->view('desain_kepsek/footer');
    }

    public function cetakSlipGaji()
    {
        $data['title'] = "Cetak Slip Gaji Guru";

        $data['potongan'] = $this->penggajianModel->get_data('potongan_gaji')->result();

        $nama = $this->input->post('nama_pegawai');
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        $bulantahun=$bulan.$tahun;

        $data['printSlip'] = $this->db->query("SELECT data_pegawai.nuptk, data_pegawai.nama_pegawai, data_pegawai.jenis_kelamin, 
        data_jabatan.nama_jabatan, data_jabatan.gaji_pokok, data_jabatan.tj_transport, data_jabatan.wali_kelas, data_jabatan.uang_makan
        , data_kehadiran.kode_gaji, data_kehadiran.email, data_kehadiran.alpha, data_kehadiran.sakit, data_kehadiran.jumlah_jam  
        FROM data_pegawai
        INNER JOIN data_kehadiran ON data_kehadiran.nuptk=data_pegawai.nuptk
        INNER JOIN data_jabatan ON data_jabatan.nama_jabatan=data_pegawai.jabatan
        WHERE data_kehadiran.bulan='$bulantahun' AND data_kehadiran.nama_pegawai='$nama'")->result();
        $this->load->view('desain_kepsek/header',$data);
        $this->load->view('kepsek/cetakSlipGaji',$data);
    }
}

?>