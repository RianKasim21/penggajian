<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class data_absensi extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

        require APPPATH.'libraries/phpmailer/src/Exception.php';
        require APPPATH.'libraries/phpmailer/src/PHPMailer.php';
        require APPPATH.'libraries/phpmailer/src/SMTP.php';

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
        $data['title'] = "Rekap Data Penggajian";

            if((isset($_GET['bulan']) && $_GET['bulan']!='') && (isset($_GET['tahun']) && $_GET['tahun']!='')){
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $bulantahun = $bulan.$tahun;
            }else{
                $bulan = date('m');
                $tahun = date('Y');
                $bulantahun = $bulan.$tahun;
            }

        $data['absensi'] = $this->db->query("SELECT data_kehadiran.*, 
        data_pegawai.nama_pegawai, data_pegawai.jenis_kelamin, data_pegawai.jabatan
        FROM data_kehadiran INNER JOIN data_pegawai ON data_kehadiran.nuptk = data_pegawai.nuptk
        INNER JOIN data_jabatan ON data_pegawai.jabatan = data_jabatan.nama_jabatan
        WHERE data_kehadiran.bulan = '$bulantahun' ORDER BY data_pegawai.nama_pegawai ASC")->result();

        $this->load->view('desain_staffTU/header',$data);
        $this->load->view('desain_staffTU/sidebar');
        $this->load->view('staff/data_absensi',$data);
        $this->load->view('desain_staffTU/footer');
    }

    public function input_absensi()
    {
        if($this->input->post('submit', TRUE) == 'submit') {

            $post = $this->input->post();

            foreach ($post['bulan'] as $key => $value) {
                if($post['bulan'][$key] !='' || $post['nuptk'][$key] !='')
                {
                    $simpan[] = array(
                        'bulan'         => $post['bulan'][$key],
                        'kode_absensi'  => $post['kode_absensi'][$key],
                        'kode_gaji'  => $post['kode_gaji'][$key],
                        'nuptk'           => $post['nuptk'][$key],
                        'nama_pegawai'  => $post['nama_pegawai'][$key],
                        'jenis_kelamin' => $post['jenis_kelamin'][$key],
                        'nama_jabatan'  => $post['nama_jabatan'][$key],
                        'email'  => $post['email'][$key],
                        'hadir'  => $post['hadir'][$key],
                        'izin'         => $post['izin'][$key],
                        'sakit'         => $post['sakit'][$key],
                        'alpha'         => $post['alpha'][$key],
                        'jumlah_jam'         => $post['jumlah_jam'][$key],
                        'potongan'         => $post['potongan'][$key],
                    );
                }
            }

            $this->penggajianModel->insert_batch('data_kehadiran', $simpan);
            $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data berhasil ditambahkan</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
          redirect('staff/data_absensi');
        }

        $data['title'] = "Rekap Data Penggajian";

        if((isset($_GET['bulan']) && $_GET['bulan']!='') && (isset($_GET['tahun']) && $_GET['tahun']!='')){
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan.$tahun;
        }else{
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan.$tahun;
        }

        $data['input_absensi'] = $this->db->query("SELECT data_absensi.nuptk, COUNT(*) AS status, data_absensi.nama_pegawai, 
        data_absensi.jenis_kelamin, data_absensi.nama_jabatan, data_absensi.email, 
        SUM(CASE WHEN data_absensi.status IN ('hadir', 'terlambat') THEN 1 ELSE 0 END) AS jumlah_hadir, 
        SUM(CASE WHEN data_absensi.status = 'izin' THEN 1 ELSE 0 END) AS jumlah_izin,
        SUM(CASE WHEN data_absensi.status = 'sakit' THEN 1 ELSE 0 END) AS jumlah_sakit,
        SUM(CASE WHEN data_absensi.status = 'alfa' THEN 1 ELSE 0 END) AS jumlah_alfa,
        COALESCE(data_mengajar.jumlah_jam, 0) AS jumlah_jam,
        COALESCE(potongan.potongan, 0) AS potongan
        FROM data_absensi 
        LEFT JOIN (SELECT nuptk, SUM(jumlah_jam) AS jumlah_jam FROM data_mengajar WHERE bulan='$bulantahun' AND status='Diterima' GROUP BY nuptk) data_mengajar ON data_absensi.nuptk = data_mengajar.nuptk
        LEFT JOIN (SELECT nuptk, SUM(potongan) AS potongan FROM data_potongan WHERE bulan='$bulantahun' GROUP BY nuptk) potongan ON data_absensi.nuptk = potongan.nuptk
        WHERE data_absensi.bulan='$bulantahun' AND NOT EXISTS (SELECT * FROM data_kehadiran WHERE bulan='$bulantahun' AND data_absensi.nuptk = data_kehadiran.nuptk)
        GROUP BY data_absensi.nuptk ORDER BY data_absensi.nama_pegawai")->result();
        $this->load->model('penggajianModel');
        $data['kode_absensi'] = $this->penggajianModel->CreateCode1();
        $data['kode_gaji'] = $this->penggajianModel->KodeGaji();
        $this->load->view('desain_staffTU/header',$data);
        $this->load->view('desain_staffTU/sidebar');
        $this->load->view('staff/formInputAbsensi',$data);
        $this->load->view('desain_staffTU/footer');
    }
}
?>