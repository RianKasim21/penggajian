<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <div class="card" style="width: 60%">
        <div class="card-body">
            <form method="POST" action="<?php echo base_url('admin/Data_jabatan/tambah_data_aksi') ?>">

            <div class="form-group">
                <label>kode Jabatan</label>
                <input type="text" name="kode_jabatan" class="form-control" value="<?php echo sprintf($urut) ?>" readonly>
                <?php echo form_error('kode_jabatan','<div class="text-small text-danger"> </div>') ?>
            </div>
            <div class="form-group">
                <label>Nama Jabatan</label>
                <input type="text" name="nama_jabatan" class="form-control">
                <?php echo form_error('nama_jabatan','<div class="text-small text-danger"> </div>') ?>
            </div>
            <div class="form-group">
                <label>Honor Pendidik</label>
                <input type="number" name="honor_pendidik" class="form-control">
                <?php echo form_error('honor_pendidik','<div class="text-small text-danger"> </div>') ?>
            </div>
            <div class="form-group">
                <label>Honor Tenaga Kependidikan</label>
                <input type="number" name="honor_tk" class="form-control">
                <?php echo form_error('honor_tk','<div class="text-small text-danger"> </div>') ?>
            </div>
            <div class="form-group">
                <label>Tunjangan Jabatan</label>
                <input type="number" name="tj_jabatan" class="form-control">
                <?php echo form_error('tj_jabatan','<div class="text-small text-danger"> </div>') ?>
            </div>
            <div class="form-group">
                <label>Kepala Program Keahlian</label>
                <input type="number" name="kepala_program" class="form-control">
                <?php echo form_error('kepala_program','<div class="text-small text-danger"> </div>') ?>
            </div>
            <div class="form-group">
                <label>Eskul</label>
                <input type="number" name="eskul" class="form-control">
                <?php echo form_error('eskul','<div class="text-small text-danger"> </div>') ?>
            </div>
            <div class="form-group">
                <label>Piket Bulanan</label>
                <input type="number" name="ph_guru" class="form-control">
                <?php echo form_error('ph_guru','<div class="text-small text-danger"> </div>') ?>
            </div>
            
            <button onclick="return confirm('Yakin ingin tambah data ?')" type="submit" class="btn btn-primary">Tambah Data</button>

            </form>
        </div>
    </div>


</div>