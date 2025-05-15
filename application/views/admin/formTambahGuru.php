<div class="container-fluid">

                    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <div class="card">
        <div class="card-body">

        <form method="POST" action="<?php echo base_url('admin/data_guru/tambah_data_aksi') ?>" enctype="multipart/form-data">

        <div class="form-group">
                <label>Nuptk</label>
                <input type="number" name="nuptk" class="form-control" maxlength="16" oninput="validateNUPTK(this)" required>
                <?php echo form_error('nuptk','<div class="text-small text-danger"> </div>') ?>
            </div>
            <div class="form-group">
                <label>Nama Pegawai</label>
                <input type="text" name="nama_pegawai" class="form-control">
                <?php echo form_error('nama_pegawai','<div class="text-small text-danger"> </div>') ?>
            </div>
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control">
                <?php echo form_error('username','<div class="text-small text-danger"> </div>') ?>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <?php echo form_error('password','<div class="text-small text-danger"> </div>') ?>
            </div>
            <div class="form-group">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" id="" class="form-control">
                    <option value="">--Pilih Jenis Kelamin--</option>
                    <option value="Laki-Laki">Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
                <?php echo form_error('jenis_kelamin','<div class="text-small text-danger"> </div>') ?>
            </div>
            <div class="form-group">
                <label>Jabatan</label>
                <select name="jabatan" id="" class="form-control">
                    <option value="">--Pilih Jabatan--</option>
                    <?php foreach($jabatan as $j) : ?>
                    <option value="<?php echo $j->nama_jabatan ?>"><?php echo $j->nama_jabatan ?></option>
                    <?php endforeach; ?>
                </select>
                <?php echo form_error('jabatan','<div class="text-small text-danger"> </div>') ?>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control">
                <?php echo form_error('email','<div class="text-small text-danger"> </div>') ?>
            </div>
            <div class="form-group">
                <label>Tanggal Masuk</label>
                <input type="date" name="tanggal_masuk" class="form-control" width="20%">
                <?php echo form_error('tanggal_masuk','<div class="text-small text-danger"> </div>') ?>
            </div>
            <div class="form-group">
                <label>Status</label>
                <select name="status" id="" class="form-control">
                    <option value="">--Pilih Status--</option>
                    <option value="Guru Tetap">Guru Tetap</option>
                    <option value="Guru Tidak Tetap">Guru Tidak Tetap</option>
                    <option value="Bendahara">Bendahara</option>
                </select>
                <?php echo form_error('status','<div class="text-small text-danger"> </div>') ?>
            </div>
            <div class="form-group">
                <label>Foto</label>
                <input type="file" name="photo" class="form-control">
                <?php echo form_error('photo','<div class="text-small text-danger"> </div>') ?>
            </div>
            <div class="form-group">
                <label>Hak Akses</label>
                <select name="hak_akses" class="form-control" >
                    <option value="">--Pilih Hak Akses</option>
                    <option value="1">Admin</option>
                    <option value="2">Guru</option>
                    <option value="3">Kepala Sekolah</option>
                    <option value="4">Staff TU</option>
                </select>
            </div>
            <div class="form-group">
                <label>Status2</label>
                <select name="status2" id="" class="form-control">
                    <option value="">--Pilih Status--</option>
                    <option value="mengajar">Mengajar</option>
                    <option value="Tidak Mengajar">Tidak Mengajar</option>
                </select>
                <?php echo form_error('status','<div class="text-small text-danger"> </div>') ?>
            </div>
            
            <button onclick="return confirm('Yakin Ingin Menambahkan Data?')" type="submit" class="btn btn-primary">Tambah Data</button>


            
        </form>

        </div>
    </div>

                  

</div>

<script>
function validateNUPTK(input) {
    // Remove any non-digit characters
    input.value = input.value.replace(/\D/g, '');

    // Trim the value to 16 digits if it exceeds 16
    if (input.value.length > 16) {
        input.value = input.value.slice(0, 16);
    }
}
</script>