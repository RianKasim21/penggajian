<?php

class data_guru extends CI_Controller{
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
        $data['title'] = "Data Pegawai";
        $data['guru'] = $this->penggajianModel->get_data('data_pegawai')->result();
        $this->load->view('desain_admin/header',$data);
        $this->load->view('desain_admin/sidebar');
        $this->load->view('admin/data_guru',$data);
        $this->load->view('desain_admin/footer');
    }

    public function tambah_data()
    {
        $data['title'] = "Tambah Data Pegawai";
        $data['jabatan'] = $this->penggajianModel->get_data('data_jabatan')->result();
        $this->load->view('desain_admin/header',$data);
        $this->load->view('desain_admin/sidebar');
        $this->load->view('admin/formTambahGuru',$data);
        $this->load->view('desain_admin/footer');
    }

    public function tambah_data_aksi()
    {
        $this->_rules();

        if($this->form_validation->run() == FALSE) {
            $this->tambah_data();
        }else{
            $nuptk            = $this->input->post('nuptk');
            $nama_pegawai      = $this->input->post('nama_pegawai');
            $username       = $this->input->post('username');
            $password       = md5($this->input->post('password'));
            $jenis_kelamin  = $this->input->post('jenis_kelamin');
            $tanggal_masuk  = $this->input->post('tanggal_masuk');
            $jabatan        = $this->input->post('jabatan');
            $email        = $this->input->post('email');
            $status         = $this->input->post('status');
            $status2         = $this->input->post('status2');
            $hak_akses      = $this->input->post('hak_akses');
            $photo          = $_FILES['photo']['name'];
            if($photo=''){}else{
                $config ['upload_path']     = './assets/img';
                $config ['allowed_types']    = 'jpg|jpeg|png';
                $this->load->library('upload',$config);
                if(!$this->upload->do_upload('photo')){
                    echo "Foto Gagal Di Upload";
                }else{
                    $photo=$this->upload->data('file_name');
                }
            }

            $data = array(
                'nuptk'               => $nuptk,
                'nama_pegawai'      => $nama_pegawai,
                'username'          => $username,
                'password'          => $password,
                'jenis_kelamin'     => $jenis_kelamin,
                'jabatan'           => $jabatan,
                'email'           => $email,
                'tanggal_masuk'     => $tanggal_masuk,
                'status'            => $status,
                'hak_akses'            => $hak_akses,
                'photo'             => $photo,
                'status2'            => $status2,
            );

            $this->penggajianModel->insert_data($data,'data_pegawai');
            $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data berhasil ditambahkan</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
          redirect('admin/data_guru');
        }
    }

    public function update_data($id)
    {
        $where = array('id_guru' => $id);
        $data['title'] = "Update Data Pegawai";
        $data['jabatan'] = $this->penggajianModel->get_data('data_jabatan')->result();
        $data['guru'] = $this->db->query("SELECT * FROM data_pegawai WHERE id_guru='$id'")->result();
        $this->load->view('desain_admin/header',$data);
        $this->load->view('desain_admin/sidebar');
        $this->load->view('admin/formUpdateGuru',$data);
        $this->load->view('desain_admin/footer');
    }

    public function update_data_aksi()
    {
        $this->_rules();

        if($this->form_validation->run() == FALSE) {
            $this->update_data();
        }else{
            $id             = $this->input->post('id_guru');
            $nuptk          = $this->input->post('nuptk');
            $nama_pegawai   = $this->input->post('nama_pegawai');
            $username       = $this->input->post('username');
            $password       = md5($this->input->post('password'));
            if (!empty($password_input)) {
                $password = md5($password_input);
                $data['password'] = $password;
            }
            $jenis_kelamin  = $this->input->post('jenis_kelamin');
            $jabatan        = $this->input->post('jabatan');
            $email          = $this->input->post('email');
            $tanggal_masuk  = $this->input->post('tanggal_masuk');
            $status         = $this->input->post('status');
            $status2         = $this->input->post('status2');
            $hak_akses         = $this->input->post('hak_akses');
            $photo          = $_FILES['photo']['name'];
            if($photo){
                $config ['upload_path']     = './assets/img';
                $config ['allowed_types']    = 'jpg|jpeg|png';
                $this->load->library('upload',$config);
                if($this->upload->do_upload('photo')){
                    $photo=$this->upload->data('file_name');
                    $this->db->set('photo',$photo);
                }else{
                    echo $this->upload->display_errors();
                }
            }

            $data = array(
                'nuptk'             => $nuptk,
                'nama_pegawai'      => $nama_pegawai,
                'username'          => $username,
                'password'          => $password,
                'jenis_kelamin'     => $jenis_kelamin,
                'jabatan'           => $jabatan,
                'email'             => $email,
                'tanggal_masuk'     => $tanggal_masuk,
                'status'            => $status,
                'status2'            => $status2,
                'hak_akses'         => $hak_akses,
            );

            $where = array(
                'id_guru' => $id
            );

            $this->penggajianModel->update_data('data_pegawai',$data,$where);
            $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data berhasil diupdate</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
          redirect('admin/data_guru');
        }
    }

    public function delete_data($id)
    {
        $where = array('id_guru' => $id);
        $this->penggajianModel->delete_data($where, 'data_pegawai');
        $this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Data berhasil dihapus</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>');
      redirect('admin/data_guru');
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nuptk','nuptk','required');
        $this->form_validation->set_rules('nama_pegawai','nama pegawai','required');
        $this->form_validation->set_rules('jenis_kelamin','jenis kelamin','required');
        $this->form_validation->set_rules('jabatan','jabatan makan','required');
        $this->form_validation->set_rules('tanggal_masuk','tanggal masuk','required');
        $this->form_validation->set_rules('status','status','required');
    }
    
}

?>