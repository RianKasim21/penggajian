<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <div class="card" style="width: 60%">
        <div class="card-body">
            <?php foreach($jabatan as $j): ?>
            <form method="POST" action="<?php echo base_url('admin/Data_jabatan/update_data_aksi') ?>">

            <div class="form-group">
                <label>Nama Jabatan</label>
                <input type="hidden" name="id_jabatan" class="form-control" value="<?php echo $j->id_jabatan ?>">
                <input type="hidden" name="kode_jabatan" class="form-control" value="<?php echo $j->kode_jabatan ?>">
                <input type="text" name="nama_jabatan" class="form-control" value="<?php echo $j->nama_jabatan ?>">
                <?php echo form_error('nama_jabatan','<div class="text-small text-danger"> </div>') ?>
            </div>
            <div class="form-group">
                <label>Honor Pendidik</label>
                <input type="number" name="honor_pendidik" class="form-control" value="<?php echo $j->honor_pendidik ?>">
                <?php echo form_error('honor_pendidik','<div class="text-small text-danger"> </div>') ?>
            </div>
            <div class="form-group">
                <label>Honor Tenaga Kependidikan</label>
                <input type="number" name="honor_tk" class="form-control" value="<?php echo $j->honor_tk ?>">
                <?php echo form_error('honor_tk','<div class="text-small text-danger"> </div>') ?>
            </div>
            <div class="form-group">
                <label>Tunjangan Jabatan</label>
                <input type="number" name="tj_jabatan" class="form-control" value="<?php echo $j->tj_jabatan ?>">
                <?php echo form_error('tj_jabatan','<div class="text-small text-danger"> </div>') ?>
            </div>
            <div class="form-group">
                <label>Kepala Program</label>
                <input type="number" name="kepala_program" class="form-control" value="<?php echo $j->kepala_program ?>">
                <?php echo form_error('kepala_program','<div class="text-small text-danger"> </div>') ?>
            </div>
            <div class="form-group">
                <label>Eskul</label>
                <input type="number" name="eskul" class="form-control" value="<?php echo $j->eskul ?>">
                <?php echo form_error('eskul','<div class="text-small text-danger"> </div>') ?>
            </div>
            <div class="form-group">
                <label>Piket Bulanan</label>
                <input type="number" name="ph_guru" class="form-control" value="<?php echo $j->ph_guru ?>">
                <?php echo form_error('ph_guru','<div class="text-small text-danger"> </div>') ?>
            </div>
            
            <button onclick="return confirm('Update Data ?')" type="submit" class="btn btn-primary">Update Data</button>

            </form>
            <?php endforeach;?>
        </div>
    </div>


</div>