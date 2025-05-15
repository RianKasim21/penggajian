<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class data_potongan extends CI_Controller{

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
        $data['title'] = "Data Potongan";

            if((isset($_GET['bulan']) && $_GET['bulan']!='') && (isset($_GET['tahun']) && $_GET['tahun']!='')){
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $bulantahun = $bulan.$tahun;
            }else{
                $bulan = date('m');
                $tahun = date('Y');
                $bulantahun = $bulan.$tahun;
            }

        $data['potongan'] = $this->db->query("SELECT data_potongan.id_potongan, data_potongan.bulan, data_potongan.nuptk, data_potongan.nama_pegawai, data_potongan.nama_potongan, data_potongan.potongan
        FROM data_potongan
        WHERE data_potongan.bulan = '$bulantahun' ORDER BY data_potongan.nama_pegawai ASC")->result();

        $this->load->view('desain_staffTU/header',$data);
        $this->load->view('desain_staffTU/sidebar');
        $this->load->view('staff/data_potongan',$data);
        $this->load->view('desain_staffTU/footer');
    }

    public function tambah_data()
    {
        $data['title'] = "Tambah Potongan";
        $data['guru'] = $this->penggajianModel->get_data('data_pegawai')->result();
        $this->load->view('desain_staffTU/header',$data);
        $this->load->view('desain_staffTU/sidebar');
        $this->load->view('staff/formInputPotongan',$data);
        $this->load->view('desain_staffTU/footer');
    }

    public function tambah_data_aksi()
    {
        $this->_rules();

        if($this->form_validation->run() == FALSE) {
            $this->tambah_data();
        }else{
            $bulan          = $this->input->post('bulan');
            $nuptk          = $this->input->post('nuptk');
            $nama_pegawai   = $this->input->post('nama_pegawai');
            $nama_potongan  = $this->input->post('nama_potongan');
            $potongan       = $this->input->post('potongan');


            $data = array(
                'bulan'  => $bulan,
                'nuptk'  => $nuptk,
                'nama_pegawai'  => $nama_pegawai,
                'nama_potongan'  => $nama_potongan,
                'potongan'      => $potongan,
            );

            $this->penggajianModel->insert_data($data,'data_potongan');
            $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data berhasil ditambahkan</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
          redirect('staff/data_potongan');
        }
    }

    public function update_data($id)
    {
        $where = array('id_potongan' => $id);
        $data['potongan'] = $this->db->query("SELECT * FROM data_potongan WHERE id_potongan='$id'")->result();
        $data['title'] = "Update Data Potongan";
        $this->load->view('desain_staffTU/header',$data);
        $this->load->view('desain_staffTU/sidebar');
        $this->load->view('staff/update_Datapotongan',$data);
        $this->load->view('desain_staffTU/footer');
    }

    public function update_data_aksi()
    {
        $this->_rules();
        
        if($this->form_validation->run() == FALSE) {
            $this->update_data();
        }else{
            $id              = $this->input->post('id_potongan');
            $nuptk      = $this->input->post('nuptk');
            $nama_pegawai    = $this->input->post('nama_pegawai');
            $nama_potongan          = $this->input->post('nama_potongan');
            $potongan        = $this->input->post('potongan');

            $data = array(
                'nuptk'      => $nuptk,
                'nama_pegawai'      => $nama_pegawai,
                'nama_potongan'    => $nama_potongan,
                'potongan'          => $potongan,
            );

            $where = array(
                'id_potongan' => $id
            );

            $this->penggajianModel->update_data('data_potongan',$data,$where);
            $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data berhasil diupdate</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
          redirect('staff/data_potongan');

        }
    }

    public function delete_data($id)
    {
        $where = array('id_potongan' => $id);
        $this->penggajianModel->delete_data($where, 'data_potongan');
        $this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Data berhasil dihapus</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>');
      redirect('staff/data_potongan');
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nuptk','jumlah potongan','required');
        $this->form_validation->set_rules('potongan','jenis potongan','required');
    }

}
?>