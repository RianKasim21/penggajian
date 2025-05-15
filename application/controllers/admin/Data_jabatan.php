<?php

class data_jabatan extends CI_Controller{

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
        $data['title'] = "Data Jabatan";
        $data['jabatan'] = $this->penggajianModel->get_data('data_jabatan')->result();
        $this->load->view('desain_admin/header',$data);
        $this->load->view('desain_admin/sidebar');
        $this->load->view('admin/data_jabatan',$data);
        $this->load->view('desain_admin/footer');
    }

    public function tambah_data()
    {
        $data['title'] = "Tambah Data Jabatan";
        $this->load->model('penggajianModel');
        $data['urut'] = $this->penggajianModel->CreateCode();
        $this->load->view('desain_admin/header',$data);
        $this->load->view('desain_admin/sidebar');
        $this->load->view('admin/tambah_Datajabatan',$data);
        $this->load->view('desain_admin/footer');
    }

    public function tambah_data_aksi()
    {
        $this->_rules();
        
        if($this->form_validation->run() == FALSE) {
            $this->tambah_data();
        }else{
            $kode_jabatan      = $this->input->post('kode_jabatan');
            $nama_jabatan      = $this->input->post('nama_jabatan');
            $honor_pendidik    = $this->input->post('honor_pendidik');
            $honor_tk          = $this->input->post('honor_tk');
            $tj_jabatan        = $this->input->post('tj_jabatan');
            $kepala_program    = $this->input->post('kepala_program');
            $eskul             = $this->input->post('eskul');
            $ph_guru           = $this->input->post('ph_guru');

            $data = array(
                'kode_jabatan'      => $kode_jabatan,
                'nama_jabatan'      => $nama_jabatan,
                'honor_pendidik'    => $honor_pendidik,
                'honor_tk'          => $honor_tk,
                'tj_jabatan'        => $tj_jabatan,
                'kepala_program'    => $kepala_program,
                'eskul'             => $eskul,
                'ph_guru'           => $ph_guru,
            );

            $this->penggajianModel->insert_data($data,'data_jabatan');
            $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data berhasil ditambahkan</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
          redirect('admin/data_jabatan');

        }
    }

    public function update_data($id)
    {
        $where = array('id_jabatan' => $id);
        $data['jabatan'] = $this->db->query("SELECT * FROM data_jabatan WHERE id_jabatan='$id'")->result();
        $data['title'] = "Update Data Jabatan";
        $this->load->view('desain_admin/header',$data);
        $this->load->view('desain_admin/sidebar');
        $this->load->view('admin/update_Datajabatan',$data);
        $this->load->view('desain_admin/footer');
    }

    public function update_data_aksi()
    {
        $this->_rules();
        
        if($this->form_validation->run() == FALSE) {
            $this->update_data();
        }else{
            $id              = $this->input->post('id_jabatan');
            $kode_jabatan      = $this->input->post('kode_jabatan');
            $nama_jabatan      = $this->input->post('nama_jabatan');
            $honor_pendidik    = $this->input->post('honor_pendidik');
            $honor_tk          = $this->input->post('honor_tk');
            $tj_jabatan        = $this->input->post('tj_jabatan');
            $kepala_program    = $this->input->post('kepala_program');
            $eskul             = $this->input->post('eskul');
            $ph_guru           = $this->input->post('ph_guru');

            $data = array(
                'kode_jabatan'      => $kode_jabatan,
                'nama_jabatan'      => $nama_jabatan,
                'honor_pendidik'    => $honor_pendidik,
                'honor_tk'          => $honor_tk,
                'tj_jabatan'        => $tj_jabatan,
                'kepala_program'    => $kepala_program,
                'eskul'             => $eskul,
                'ph_guru'           => $ph_guru,
            );

            $where = array(
                'id_jabatan' => $id
            );

            $this->penggajianModel->update_data('data_jabatan',$data,$where);
            $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data berhasil diupdate</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
          redirect('admin/data_jabatan');

        }
    }

    public function delete_data($id)
    {
        $where = array('id_jabatan' => $id);
        $this->penggajianModel->delete_data($where, 'data_jabatan');
        $this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Data berhasil dihapus</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>');
      redirect('admin/data_jabatan');
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nama_jabatan','nama jabatan','required');
        $this->form_validation->set_rules('honor_pendidik','honor pendidik','required');
        $this->form_validation->set_rules('honor_tk','Honor Tenaga Pendidikan','required');
    }
}

?>