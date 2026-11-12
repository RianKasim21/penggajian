<?php

class Laporan_absensi extends CI_Controller
{
    public function index()
    {
        $data['title'] = "Laporan Absensi Pegawai";
        $this->load->view('desain_staffTU/header', $data);
        $this->load->view('desain_staffTU/sidebar');
        $this->load->view('staff/filterLaporanAbsensi', $data);
        $this->load->view('desain_staffTU/footer');
    }

    public function cetakLaporanAbsensi()
    {
        $data['title'] = "Cetak Laporan Absensi";
        $bulan=$this->input->post('bulan');
        $tahun=$this->input->post('tahun');
        $bulantahun=$bulan.$tahun;
        $data['lap_kehadiran'] = $this->db->query("SELECT * FROM data_kehadiran WHERE bulan='$bulantahun'
        ORDER BY nama_pegawai ASC")->result();
        $this->load->view('desain_staffTU/header',$data);
        $this->load->view('staff/cetakLaporanAbsensi',$data);
    }
}

?>