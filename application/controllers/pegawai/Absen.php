<?php

class Absen extends CI_Controller{

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
        $data['title'] = "Absen Guru";

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

        $data['title'] = "Data Absen";
        $nuptk = $this->session->userdata('nuptk');
        $user_status = $this->session->userdata('status2');
        $data['user_status'] = $user_status;

        $data['absen'] = $this->db->query("SELECT data_absensi.*, 
        data_pegawai.nama_pegawai, data_pegawai.jabatan
        FROM data_absensi INNER JOIN data_pegawai ON data_absensi.nuptk = data_pegawai.nuptk
        INNER JOIN data_jabatan ON data_pegawai.jabatan = data_jabatan.nama_jabatan
        WHERE data_absensi.hari = '$bulantahun' AND data_absensi.nuptk='$nuptk' ORDER BY data_pegawai.nama_pegawai ASC")->result();

        $this->load->view('desain_pegawai/header',$data);
        $this->load->view('desain_pegawai/sidebar');
        $this->load->view('pegawai/absen',$data);
        $this->load->view('desain_pegawai/footer');
    }

    private function calculateDistance($lat1, $lon1, $lat2, $lon2) {
        $earthRadius = 6371000; // Radius Bumi dalam meter

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon/2) * sin($dLon/2);
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));

        return $earthRadius * $c;
    }

    public function input_absen()
    {
        if($this->input->post('submit', TRUE) == 'submit') {

            $post = $this->input->post();

            date_default_timezone_set('Asia/Jakarta');

            foreach ($post['hari'] as $key => $value) {
                if($post['hari'][$key] !='' && $post['nuptk'][$key] !='') {
                    $latitude = $post['latitude'][$key];
                    $longitude = $post['longitude'][$key];
                    $targetLatitude = -6.968474; // Ganti dengan latitude lokasi tujuan
                    $targetLongitude = 107.800122; // Ganti dengan longitude lokasi tujuan
                    $maxDistance = 60; // Ganti sesuai dengan batasan jarak yang diinginkan (dalam meter)
                
                    $distance = $this->calculateDistance($latitude, $longitude, $targetLatitude, $targetLongitude);
                    if ($distance <= $maxDistance) {
                        // Set nilai jam saat ini berdasarkan timezone Indonesia
                        $jam = date('H:i:s');
                
                        // Jika waktu absen lebih dari jam 13:00, set status menjadi "Terlambat"
                        if (strtotime($jam) > strtotime('13:00:00')) {
                            $status = 'Terlambat';
                        } else {
                            $status = 'Hadir';
                        }
                    } else {
                        // Jika lokasi berada di luar jarak yang ditentukan, beri pengguna pilihan untuk memilih status
                        $status = $post['status'][$key];
                        if(empty($status) || $status == 'Pilih') {
                            $this->session->set_flashdata('pesan','<div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Silakan pilih status absen yang valid.</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>');
                            redirect('pegawai/absen');
                        }
                    }
                
                    $simpan[] = array(
                        'hari'         => $post['hari'][$key],
                        'bulan'         => $post['bulan'][$key],
                        'nuptk'           => $post['nuptk'][$key],
                        'nama_pegawai'  => $post['nama_pegawai'][$key],
                        'jenis_kelamin'  => $post['jenis_kelamin'][$key],
                        'nama_jabatan'  => $post['nama_jabatan'][$key],
                        'email'  => $post['email'][$key],
                        'status'  => $status,
                        'latitude'  => $post['latitude'][$key],
                        'longitude'  => $post['longitude'][$key],
                        'jam'          => isset($jam) ? $jam : date('H:i:s'),
                    );
                } else {
                    // Data absen di luar batasan jarak
                    $this->session->set_flashdata('pesan','<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Absen di luar batas jarak yang diizinkan.</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>');
                    redirect('pegawai/absen');
                }                
                }
            
            

            $this->penggajianModel->insert_batch('data_absensi', $simpan);
            $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data berhasil ditambahkan</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
          redirect('pegawai/absen');
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

        $nuptk = $this->session->userdata('nuptk');
        $data['input_absen'] = $this->db->query("SELECT data_pegawai.*, data_jabatan.nama_jabatan FROM data_pegawai
        INNER JOIN data_jabatan ON data_pegawai.jabatan = data_jabatan.nama_jabatan
        WHERE NOT EXISTS (SELECT * FROM data_absensi WHERE hari='$haribulantahun' AND data_pegawai.nuptk = data_absensi.nuptk) AND data_pegawai.nuptk='$nuptk'
        ORDER BY data_pegawai.nama_pegawai ASC")->result();
        $this->load->model('penggajianModel');
        $this->load->view('desain_pegawai/header',$data);
        $this->load->view('desain_pegawai/sidebar');
        $this->load->view('pegawai/formAbsen',$data);
        $this->load->view('desain_pegawai/footer');
    }

    public function view_map() {
        // -6.968474, 107.800122
        $targetLatitude = -6.968474; // Ganti dengan latitude lokasi tujuan
        $targetLongitude = 107.800122; // Ganti dengan longitude lokasi tujuan
    
        $userLatitude = $this->session->userdata('latitude'); // Ganti dengan cara Anda mendapatkan latitude pengguna
        $userLongitude = $this->session->userdata('longitude'); // Ganti dengan cara Anda mendapatkan longitude pengguna
    
        $maxDistance = $this->getMaxDistance($targetLatitude, $targetLongitude);
    
        $data['target_latitude'] = $targetLatitude;
        $data['target_longitude'] = $targetLongitude;
        $data['latitude'] = $userLatitude;
        $data['longitude'] = $userLongitude;
        $data['max_distance'] = $maxDistance;
    
        $this->load->model('penggajianModel');
        $this->load->view('desain_pegawai/header',$data);
        $this->load->view('desain_pegawai/sidebar');
        $this->load->view('pegawai/formAbsen',$data);
        $this->load->view('desain_pegawai/footer'); // Ganti 'map_view' dengan nama file view yang sesuai
    }

}