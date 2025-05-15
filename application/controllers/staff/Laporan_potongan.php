<?php

class Laporan_potongan extends CI_Controller{

    public function index()
    {
        $data['title'] = "Laporan Gaji Pegawai";
        $this->load->view('desain_staffTU/header',$data);
        $this->load->view('desain_staffTU/sidebar');
        $this->load->view('staff/filterLaporanPotongan',$data);
        $this->load->view('desain_staffTU/footer');
    }

    public function cetakLaporanPotongan()
    {
        $data['title'] = "Cetak Laporan Potongan";

        $bulan=$this->input->post('bulan');
        $tahun=$this->input->post('tahun');
        $bulantahun=$bulan.$tahun;
        $data['lap_potongan'] = $this->db->query("SELECT data_potongan.bulan, data_potongan.nuptk, data_potongan.nama_pegawai, data_potongan.nama_potongan, data_potongan.potongan
        FROM data_potongan
        WHERE data_potongan.bulan = '$bulantahun' ORDER BY data_potongan.nama_pegawai ASC")->result();
        $this->load->view('desain_staffTU/header',$data);
        $this->load->view('admin/cetakLaporanPotongan',$data);
    }
}

?>