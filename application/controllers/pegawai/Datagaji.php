<?php

class Datagaji extends CI_Controller{

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
        $data['title'] = "Data Gaji";
        $nuptk = $this->session->userdata('nuptk');
        $data['potongan'] = $this->penggajianModel->get_data('potongan_gaji')->result();
        $data['gaji'] = $this->db->query("SELECT data_pegawai.nuptk, data_pegawai.nama_pegawai, data_pegawai.jenis_kelamin, 
        data_jabatan.nama_jabatan, data_jabatan.honor_pendidik, data_jabatan.honor_tk, data_jabatan.tj_jabatan, data_jabatan.kepala_program, data_jabatan.eskul, data_jabatan.ph_guru,
        data_kehadiran.kode_gaji, data_kehadiran.email, data_kehadiran.alpha, data_kehadiran.sakit, data_kehadiran.izin, data_kehadiran.jumlah_jam, data_kehadiran.potongan, data_kehadiran.bulan, data_kehadiran.id_kehadiran
        FROM data_pegawai
        INNER JOIN data_kehadiran ON data_kehadiran.nuptk = data_pegawai.nuptk
        INNER JOIN data_jabatan ON data_jabatan.nama_jabatan = data_pegawai.jabatan
        WHERE data_kehadiran.nuptk='$nuptk'
        ORDER BY data_kehadiran.bulan DESC")->result();
        $user_status = $this->session->userdata('status2');
        $data['user_status'] = $user_status;
        $this->load->view('desain_pegawai/header',$data);
        $this->load->view('desain_pegawai/sidebar');
        $this->load->view('pegawai/datagaji',$data);
        $this->load->view('desain_pegawai/footer');
    }

    public function cetakSlip($id)
    {
        $data['title'] = "Cetak Slip Gaji";
        $nuptk = $this->session->userdata('nuptk');
        $data['potongan'] = $this->penggajianModel->get_data('potongan_gaji')->result();
        $data['printSlip'] = $this->db->query("SELECT data_pegawai.nuptk, data_pegawai.nama_pegawai, data_pegawai.jenis_kelamin, 
        data_jabatan.nama_jabatan, data_jabatan.honor_pendidik, data_jabatan.honor_tk, data_jabatan.tj_jabatan, data_jabatan.kepala_program, data_jabatan.eskul, data_jabatan.ph_guru,
        data_kehadiran.kode_gaji, data_kehadiran.email, data_kehadiran.alpha, data_kehadiran.sakit, data_kehadiran.izin, data_kehadiran.jumlah_jam, data_kehadiran.potongan, data_kehadiran.bulan, data_kehadiran.id_kehadiran
        FROM data_pegawai
        INNER JOIN data_kehadiran ON data_kehadiran.nuptk = data_pegawai.nuptk
        INNER JOIN data_jabatan ON data_jabatan.nama_jabatan = data_pegawai.jabatan
        WHERE data_kehadiran.nuptk='$nuptk'")->result();
        $this->load->view('desain_pegawai/header',$data);
        $this->load->view('pegawai/cetakSlipGaji',$data);
    }
}

?>