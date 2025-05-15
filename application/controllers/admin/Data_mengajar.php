<?php

class data_mengajar extends CI_Controller{
    public function __construct()
    {
        parent::__construct();

        if($this->session->userdata('hak_akses') !='1') {
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
        $data['title'] = "Data Mengajar Pegawai";

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

        $data['mengajar'] = $this->db->query("SELECT data_mengajar.*, 
        data_pegawai.nama_pegawai, data_pegawai.jabatan
        FROM data_mengajar INNER JOIN data_pegawai ON data_mengajar.nuptk = data_pegawai.nuptk
        INNER JOIN data_jabatan ON data_pegawai.jabatan = data_jabatan.nama_jabatan
        WHERE data_mengajar.hari = '$bulantahun' ORDER BY data_pegawai.nama_pegawai ASC")->result();

        $this->load->view('desain_admin/header',$data);
        $this->load->view('desain_admin/sidebar');
        $this->load->view('admin/data_mengajar',$data);
        $this->load->view('desain_admin/footer');
    }

    public function update()
{
    $id_mengajar = $this->input->post('id_mengajar');
    $status = $this->input->post('status');
    $keterangan = $this->input->post('keterangan');

    $data = array(
        'status' => $status,
        'keterangan' => $keterangan
    );

    $this->db->where('id_mengajar', $id_mengajar);
    if ($this->db->update('data_mengajar', $data)) {
        echo "Status updated successfully";
    } else {
        echo "Error updating status";
    }
}

    // public function input_mengajar()
    // {
    //     if($this->input->post('submit', TRUE) == 'submit') {

    //         $post = $this->input->post();

    //         foreach ($post['hari'] as $key => $value) {
    //             if($post['hari'][$key] !='' || $post['nuptk'][$key] !='')
    //             {
    //                 $simpan[] = array(
    //                     'hari'         => $post['hari'][$key],
    //                     'bulan'         => $post['bulan'][$key],
    //                     'nuptk'           => $post['nuptk'][$key],
    //                     'nama_pegawai'  => $post['nama_pegawai'][$key],
    //                     'jenis_kelamin'           => $post['jenis_kelamin'][$key],
    //                     'nama_jabatan'  => $post['nama_jabatan'][$key],
    //                     'email'  => $post['email'][$key],
    //                     'mapel'  => $post['mapel'][$key],
    //                     'jumlah_jam'  => $post['jumlah_jam'][$key],
    //                 );
    //             }
    //         }

    //         $this->penggajianModel->insert_batch('data_mengajar', $simpan);
    //         $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
    //         <strong>Data berhasil ditambahkan</strong>
    //         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    //           <span aria-hidden="true">&times;</span>
    //         </button>
    //       </div>');
    //       redirect('admin/data_mengajar');
    //     }

    //     $data['title'] = "Input Mengajar";

    //     if((isset($_GET['hari']) && $_GET['hari']!='') && (isset($_GET['bulan']) && $_GET['bulan']!='') && (isset($_GET['tahun']) && $_GET['tahun']!='')){
    //         $hari = $_GET['hari'];
    //         $bulan = $_GET['bulan'];
    //         $tahun = $_GET['tahun'];
    //         $haribulantahun = $hari.$bulan.$tahun;
    //     }else{
    //         $hari = date('d');
    //         $bulan = date('m');
    //         $tahun = date('Y');
    //         $haribulantahun = $hari.$bulan.$tahun;
    //     }

    //     $data['input_mengajar'] = $this->db->query("SELECT data_pegawai.*, data_jabatan.nama_jabatan FROM data_pegawai
    //     INNER JOIN data_jabatan ON data_pegawai.jabatan = data_jabatan.nama_jabatan
    //     WHERE NOT EXISTS (SELECT * FROM data_mengajar WHERE hari='$haribulantahun' AND data_pegawai.nuptk = data_mengajar.nuptk)
    //     ORDER BY data_pegawai.nama_pegawai ASC")->result();
    //     $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
    //     <strong>Data berhasil ditambahkan</strong>
    //     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    //       <span aria-hidden="true">&times;</span>
    //     </button>
    //   </div>');
    //     $this->load->model('penggajianModel');
    //     $this->load->view('desain_admin/header',$data);
    //     $this->load->view('desain_admin/sidebar');
    //     $this->load->view('admin/formInputMengajar',$data);
    //     $this->load->view('desain_admin/footer');
    // }
}
?>