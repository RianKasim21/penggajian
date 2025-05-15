<?php

class data_mengajar extends CI_Controller{
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
        $data['title'] = "Data Mengajar Guru";

            if((isset  ($_GET['hari']) && $_GET['hari']!='') && (isset  ($_GET['bulan']) && $_GET['bulan']!='') && (isset($_GET['tahun']) && $_GET['tahun']!='')){
                $hari = $_GET['hari'];
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $bulantahun = $hari.$bulan.$tahun;
            }else{
                $hari = date('d');
                $bulan = date('m');
                $tahun = date('Y');
                $bulantahun = $hari.$bulan.$tahun;
            }

             // Ambil nuptk dari session
    $nuptk = $this->session->userdata('nuptk');

    // Query untuk mendapatkan id_absensi dari data_absensi
    $query_absensi = $this->db->query("SELECT id_absensi
                                       FROM data_absensi
                                       WHERE nuptk = '$nuptk'")->row();

    // Debugging: Tampilkan query terakhir
    // echo $this->db->last_query();

    // Jika id_absensi ditemukan, lanjutkan untuk memeriksa kehadiran
    if ($query_absensi) {
        // Ambil id_absensi dari hasil query
        $id_absensi = $query_absensi->id_absensi;

        // Periksa apakah sudah ada absensi untuk hari ini
        $today = date('dmY'); // Format hari ini
        $query_absen_hari_ini = $this->db->query("SELECT *
                                                  FROM data_absensi
                                                  WHERE hari = '$bulantahun'")->row();

        // Debugging: Tampilkan query terakhir
        // echo $this->db->last_query();

        // Set data absen_sudah_dilakukan berdasarkan kehadiran hari ini
        $data['absen_sudah_dilakukan'] = ($query_absen_hari_ini) ? true : false;
    } else {
        // Jika id_absensi tidak ditemukan, set absen_sudah_dilakukan ke false
        $data['absen_sudah_dilakukan'] = false;
    }

        $data['mengajar'] = $this->db->query("SELECT data_mengajar.*, 
        data_pegawai.nama_pegawai, data_pegawai.jabatan
        FROM data_mengajar INNER JOIN data_pegawai ON data_mengajar.nuptk = data_pegawai.nuptk
        INNER JOIN data_jabatan ON data_pegawai.jabatan = data_jabatan.nama_jabatan
        WHERE data_mengajar.hari = '$bulantahun' ORDER BY data_pegawai.nama_pegawai ASC")->result();

        $this->load->view('desain_pegawai/header',$data);
        $this->load->view('desain_pegawai/sidebar');
        $this->load->view('pegawai/data_mengajar',$data);
        $this->load->view('desain_pegawai/footer');
    }

    public function input_mengajar()
    {
        if($this->input->post('submit', TRUE) == 'submit') {

            $post = $this->input->post();

            foreach ($post['hari'] as $key => $value) {
                if($post['hari'][$key] !='' || $post['nuptk'][$key] !='')
                {
                    $simpan[] = array(
                        'hari'         => $post['hari'][$key],
                        'bulan'         => $post['bulan'][$key],
                        'nuptk'           => $post['nuptk'][$key],
                        'nama_pegawai'  => $post['nama_pegawai'][$key],
                        'jenis_kelamin'           => $post['jenis_kelamin'][$key],
                        'nama_jabatan'  => $post['nama_jabatan'][$key],
                        'email'  => $post['email'][$key],
                        'mapel'  => $post['mapel'][$key],
                        'jumlah_jam'  => $post['jumlah_jam'][$key],
                        'status'        => 'Diproses',
                    );
                }
            }

            $this->penggajianModel->insert_batch('data_mengajar', $simpan);
            $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data berhasil ditambahkan</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
          redirect('pegawai/data_mengajar');
        }

        $data['title'] = "Input Mengajar";

        if((isset($_GET['hari']) && $_GET['hari']!='') && (isset($_GET['bulan']) && $_GET['bulan']!='') && (isset($_GET['tahun']) && $_GET['tahun']!='')){
            $hari = $_GET['hari'];
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $haribulantahun = $hari.$bulan.$tahun;
        }else{
            $hari = date('d');
            $bulan = date('m');
            $tahun = date('Y');
            $haribulantahun = $hari.$bulan.$tahun;
        }

        $nik = $this->session->userdata('nuptk');
        $data['input_mengajar'] = $this->db->query("SELECT data_pegawai.*, data_jabatan.nama_jabatan FROM data_pegawai
        INNER JOIN data_jabatan ON data_pegawai.jabatan = data_jabatan.nama_jabatan
        WHERE data_pegawai.nuptk='$nik'
        ORDER BY data_pegawai.nama_pegawai ASC")->result();
        $this->load->model('penggajianModel');
        $this->load->view('desain_pegawai/header',$data);
        $this->load->view('desain_pegawai/sidebar');
        $this->load->view('pegawai/formInputMengajar',$data);
        $this->load->view('desain_pegawai/footer');
    }
}
?>