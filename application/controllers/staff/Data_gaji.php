<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class data_gaji extends CI_Controller{

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

    public function update_data($id)
    {
        $where = array('kode_gaji' => $id);
        $data['title'] = "Update Data Gaji";
        $data['jabatan'] = $this->penggajianModel->get_data('data_jabatan')->result();
        $data['potongan'] = $this->penggajianModel->get_data('potongan')->result();
        $data['gaji'] = $this->db->query("SELECT data_guru.nik, data_guru.nama_guru, data_guru.jenis_kelamin, 
        data_jabatan.nama_jabatan, data_jabatan.gaji_pokok, data_jabatan.tj_transport, data_jabatan.wali_kelas, data_jabatan.uang_makan,
        data_kehadiran.impaq_koprasi, data_kehadiran.kode_gaji, data_kehadiran.email
        FROM data_guru
        INNER JOIN data_kehadiran ON data_kehadiran.nik = data_guru.nik
        INNER JOIN data_jabatan ON data_jabatan.nama_jabatan = data_guru.jabatan
        WHERE kode_gaji='$id'")->result();
        $this->load->view('desain_admin/header',$data);
        $this->load->view('desain_admin/sidebar');
        $this->load->view('admin/formUpdateGaji',$data);
        $this->load->view('desain_admin/footer');
    }

    public function update_data_aksi()
    {
        $where = array('kode_gaji' => $id);
        $data['jabatan'] = $this->penggajianModel->get_data('data_jabatan')->result();
        $data['potongan'] = $this->penggajianModel->get_data('potongan_gaji')->result();
          $data['gaji'] = $this->db->query("SELECT data_pegawai.nuptk, data_pegawai.nama_pegawai, data_pegawai.jenis_kelamin, 
          data_jabatan.nama_jabatan, data_jabatan.honor_pendidik, data_jabatan.honor_tk, data_jabatan.tj_jabatan, data_jabatan.kepala_program, data_jabatan.eskul, data_jabatan.ph_guru,
          data_kehadiran.kode_gaji, data_kehadiran.email, data_kehadiran.alpha, data_kehadiran.sakit, data_kehadiran.izin, data_kehadiran.jumlah_jam, data_kehadiran.potongan  
          FROM data_pegawai
          INNER JOIN data_kehadiran ON data_kehadiran.nuptk = data_pegawai.nuptk
          INNER JOIN data_jabatan ON data_jabatan.nama_jabatan = data_pegawai.jabatan
        WHERE kode_gaji='$id'")->result();
          $response = false;
          $mail = new PHPMailer();
         
          // SMTP configuration
          $mail->isSMTP();
          $mail->Host     = 'smtp.gmail.com';
          $mail->SMTPAuth = true;
          $mail->Username = 'riankasim421@gmail.com'; // user email anda
          $mail->Password = 'dwdjgxxwfcqghown'; // diisi dengan App Password yang sudah di generate
          $mail->SMTPSecure = 'ssl';
          $mail->Port     = 465;
         
          $mail->setFrom('riankasim421@gmail.com', 'SMK Yadika 2 Cijagra Paseh'); // user email anda
          $mail->addReplyTo('riankasim421@gmail.com', ''); //user email anda
         
          // Email subject
          $mail->Subject = 'Gaji Bulan Ini'; //subject email
         
          // Add a recipient
          $mail->addAddress($this->input->post('email')); //email tujuan pengiriman email
         
          // Set email format to HTML
          $mail->isHTML(true);
         
          // Email body content
          $mailContent = "<p>Hallo <b>".$this->input->post('nama_pegawai')."</b> berikut ini adalah Gaji Anda:</p>
          <table>
            <tr>
              <td>Nama</td>
              <td>:</td>
              <td>".$this->input->post('nama_pegawai')."</td>
            </tr>
            <tr>
              <td>Jabatan</td>
              <td>:</td>
              <td>".$this->input->post('nama_jabatan')."</td>
            </tr>
            <tr>
              <td>Email</td>
              <td>:</td>
              <td>".$this->input->post('email')."</td>
            </tr>
            <tr>
              <td>Gaji</td>
              <td>:</td>
              <td>".$this->input->post('gaji')."</td>
            </tr>
          </table>
          <p>Terimakasih <b>".$this->input->post('nama')."</b> telah memberi komentar.</p>"; // isi email
          $mail->Body = $mailContent;
         
          // Send email
          if(!$mail->send()){
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
          }else{
            echo 'Message has been sent';
          }
        
  
     $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Data berhasil diupdate</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>');
            redirect('staff/data_gaji');

    }

    public function index()
    {
        $data['title'] = "Data Gaji";

        if((isset($_GET['bulan']) && $_GET['bulan']!='') && (isset($_GET['tahun']) && $_GET['tahun']!='')){
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan.$tahun;
        }else{
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan.$tahun;
        }
        
        $data['potongan'] = $this->penggajianModel->get_data('potongan_gaji')->result();
        $data['gaji'] = $this->db->query("SELECT data_pegawai.nuptk, data_pegawai.nama_pegawai, data_pegawai.jenis_kelamin, 
        data_jabatan.nama_jabatan, data_jabatan.honor_pendidik, data_jabatan.honor_tk, data_jabatan.tj_jabatan, data_jabatan.kepala_program, data_jabatan.eskul, data_jabatan.ph_guru,
        data_kehadiran.kode_gaji, data_kehadiran.email, data_kehadiran.alpha, data_kehadiran.sakit, data_kehadiran.izin, data_kehadiran.jumlah_jam, data_kehadiran.potongan  
        FROM data_pegawai
        INNER JOIN data_kehadiran ON data_kehadiran.nuptk = data_pegawai.nuptk
        INNER JOIN data_jabatan ON data_jabatan.nama_jabatan = data_pegawai.jabatan
        WHERE data_kehadiran.bulan='$bulantahun'
        ORDER BY data_pegawai.nama_pegawai ASC")->result();
        $this->load->view('desain_staffTU/header',$data);
        $this->load->view('desain_staffTU/sidebar');
        $this->load->view('staff/data_gaji',$data);
        $this->load->view('desain_staffTU/footer');
    }

    public function cetakGaji()
    {
        $data['title'] = "Cetak Gaji";

        if(($this->input->get('bulan') !== null && $this->input->get('bulan') !== '') && (isset($_GET['tahun']) && $_GET['tahun']!='')){
            $bulan = $get['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan.$tahun;
        }else{
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan.$tahun;
        }
        $data['potongan'] = $this->penggajianModel->get_data('potongan_gaji')->result();
        $data['cetakgaji'] = $this->db->query("SELECT data_guru.nik, data_guru.nama_guru, data_guru.jenis_kelamin, 
        data_jabatan.nama_jabatan, data_jabatan.gaji_pokok, data_jabatan.tj_transport, data_jabatan.uang_makan,
        data_kehadiran.impaq_koprasi, data_kehadiran.kode_gaji, data_kehadiran.email, data_kehadiran.alpha, data_kehadiran.sakit   
        FROM data_guru
        INNER JOIN data_kehadiran ON data_kehadiran.nik = data_guru.nik
        INNER JOIN data_jabatan ON data_jabatan.nama_jabatan = data_guru.jabatan
        WHERE data_kehadiran.bulan='$bulantahun'
        ORDER BY data_guru.nama_guru ASC")->result();
        $this->load->view('desain_staffTU/header',$data);
        $this->load->view('staff/cetakDataGaji',$data);
    }
}

?>