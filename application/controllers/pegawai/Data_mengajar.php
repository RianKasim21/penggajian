<?php

class Data_mengajar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // 1. Harus login sebagai pegawai (hak_akses 2)
        if ($this->session->userdata('hak_akses') != '2') {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Belum Login</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            redirect('welcome');
        }

        // 2. Hanya status "Tidak Mengajar" yang ditolak
        $status2 = strtolower(trim((string) $this->session->userdata('status2')));
        if ($status2 === 'tidak mengajar') {
            redirect('pegawai/dashboard');
        }
    }

    // Ambil tanggal dari URL (angka saja), kalau kosong pakai hari ini
    private function ambil_tanggal()
    {
        $hari  = preg_replace('/\D/', '', (string) $this->input->get('hari'));
        $bulan = preg_replace('/\D/', '', (string) $this->input->get('bulan'));
        $tahun = preg_replace('/\D/', '', (string) $this->input->get('tahun'));

        if ($hari === '' || $bulan === '' || $tahun === '') {
            $hari  = date('d');
            $bulan = date('m');
            $tahun = date('Y');
        }
        return $hari . $bulan . $tahun;
    }

    public function index()
    {
        $data['title'] = "Data Mengajar Guru";

        $bulantahun = $this->ambil_tanggal();
        $nuptk      = $this->session->userdata('nuptk');

        // Apakah guru INI sudah absen pada tanggal tersebut?
        $absen_hari_ini = $this->db->query(
            "SELECT id_absensi FROM data_absensi WHERE nuptk = ? AND hari = ?",
            array($nuptk, $bulantahun)
        )->row();
        $data['absen_sudah_dilakukan'] = ($absen_hari_ini) ? true : false;

        // Data mengajar milik guru ini saja
        $data['mengajar'] = $this->db->query(
            "SELECT data_mengajar.*, data_pegawai.nama_pegawai, data_pegawai.jabatan
             FROM data_mengajar
             INNER JOIN data_pegawai ON data_mengajar.nuptk = data_pegawai.nuptk
             INNER JOIN data_jabatan ON data_pegawai.jabatan = data_jabatan.nama_jabatan
             WHERE data_mengajar.hari = ? AND data_mengajar.nuptk = ?
             ORDER BY data_pegawai.nama_pegawai ASC",
            array($bulantahun, $nuptk)
        )->result();

        $this->load->view('desain_pegawai/header', $data);
        $this->load->view('desain_pegawai/sidebar');
        $this->load->view('pegawai/data_mengajar', $data);
        $this->load->view('desain_pegawai/footer');
    }

    public function input_mengajar()
    {
        if ($this->input->post('submit', TRUE) == 'submit') {

            $post   = $this->input->post();
            $simpan = array();

            if (!empty($post['hari']) && is_array($post['hari'])) {
                foreach ($post['hari'] as $key => $value) {
                    if ($post['hari'][$key] != '' || $post['nuptk'][$key] != '') {
                        $simpan[] = array(
                            'hari'          => $post['hari'][$key],
                            'bulan'         => $post['bulan'][$key],
                            'nuptk'         => $post['nuptk'][$key],
                            'nama_pegawai'  => $post['nama_pegawai'][$key],
                            'jenis_kelamin' => $post['jenis_kelamin'][$key],
                            'nama_jabatan'  => $post['nama_jabatan'][$key],
                            'email'         => $post['email'][$key],
                            'mapel'         => $post['mapel'][$key],
                            'jumlah_jam'    => $post['jumlah_jam'][$key],
                            'keterangan'    => '',
                            'status'        => 'Diproses',
                        );
                    }
                }
            }

            if (empty($simpan)) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Tidak ada data yang dikirim.</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
                redirect('pegawai/data_mengajar');
            }

            $this->penggajianModel->insert_batch('data_mengajar', $simpan);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data berhasil ditambahkan</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            redirect('pegawai/data_mengajar');
        }

        $data['title'] = "Input Mengajar";

        $nik = $this->session->userdata('nuptk');
        $data['input_mengajar'] = $this->db->query(
            "SELECT data_pegawai.*, data_jabatan.nama_jabatan
             FROM data_pegawai
             INNER JOIN data_jabatan ON data_pegawai.jabatan = data_jabatan.nama_jabatan
             WHERE data_pegawai.nuptk = ?
             ORDER BY data_pegawai.nama_pegawai ASC",
            array($nik)
        )->result();

        $this->load->model('penggajianModel');
        $this->load->view('desain_pegawai/header', $data);
        $this->load->view('desain_pegawai/sidebar');
        $this->load->view('pegawai/formInputMengajar', $data);
        $this->load->view('desain_pegawai/footer');
    }
}