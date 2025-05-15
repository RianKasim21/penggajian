<?php

class data_absen extends CI_Controller{
    public function __construct()
    {
        parent::__construct();

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
        $data['title'] = "Data Absen Pegawai";

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

        $data['absen'] = $this->db->query("SELECT data_absensi.*, 
        data_pegawai.nama_pegawai, data_pegawai.jabatan
        FROM data_absensi INNER JOIN data_pegawai ON data_absensi.nuptk = data_pegawai.nuptk
        INNER JOIN data_jabatan ON data_pegawai.jabatan = data_jabatan.nama_jabatan
        WHERE data_absensi.hari = '$bulantahun' ORDER BY data_pegawai.nama_pegawai ASC")->result();

        $this->load->view('desain_staffTU/header',$data);
        $this->load->view('desain_staffTU/sidebar');
        $this->load->view('staff/data_absen',$data);
        $this->load->view('desain_staffTU/footer');
    }

    public function input_absen()
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
                        'status'  => $post['status'][$key],
                    );
                }
            }

            $this->penggajianModel->insert_batch('data_absensi', $simpan);
            $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data berhasil ditambahkan</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
          redirect('admin/data_absen');
        }

        $data['title'] = "Input Absen";

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

        $data['input_absen'] = $this->db->query("SELECT data_pegawai.*, data_jabatan.nama_jabatan FROM data_pegawai
        INNER JOIN data_jabatan ON data_pegawai.jabatan = data_jabatan.nama_jabatan
        WHERE NOT EXISTS (SELECT * FROM data_absensi WHERE hari='$haribulantahun' AND data_pegawai.nuptk = data_absensi.nuptk) AND data_pegawai.jabatan != 'Kepala Sekolah'
        ORDER BY data_pegawai.nama_pegawai ASC")->result();
        $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Data berhasil ditambahkan</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>');
        $this->load->model('penggajianModel');
        $this->load->view('desain_admin/header',$data);
        $this->load->view('desain_admin/sidebar');
        $this->load->view('admin/formInputAbsen',$data);
        $this->load->view('desain_admin/footer');
    }
}
?>