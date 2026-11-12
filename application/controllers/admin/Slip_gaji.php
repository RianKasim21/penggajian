<?php

class slip_gaji extends CI_Controller{
    
    public function index()
    {
        $data['title'] = "Filter Slip Gaji Guru";
        $data['pegawai'] = $this->penggajianModel->get_data('data_pegawai')->result();
        $this->load->view('desain_admin/header',$data);
        $this->load->view('desain_admin/sidebar');
        $this->load->view('admin/filterSlipGaji',$data);
        $this->load->view('desain_admin/footer');
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
        data_jabatan.nama_jabatan, data_jabatan.honor_pendidik, data_jabatan.honor_tk, data_jabatan.tj_jabatan, data_jabatan.kepala_program, data_jabatan.eskul, data_jabatan.ph_guru,
        data_kehadiran.kode_gaji, data_kehadiran.email, data_kehadiran.alpha, data_kehadiran.sakit, data_kehadiran.izin, data_kehadiran.jumlah_jam, data_kehadiran.potongan  
        FROM data_pegawai
        INNER JOIN data_kehadiran ON data_kehadiran.nuptk = data_pegawai.nuptk
        INNER JOIN data_jabatan ON data_jabatan.nama_jabatan = data_pegawai.jabatan
        WHERE data_kehadiran.bulan='$bulantahun' AND data_kehadiran.nama_pegawai='$nama'")->result();
        $this->load->view('desain_admin/header',$data);
        $this->load->view('admin/cetakSlipGaji',$data);
    }
}

?>