<div class="container-fluid">

                    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <div class="card">
        <div class="card-body">

        <?php foreach ($gaji as $g) : ?>
        <form method="POST" action="<?php echo base_url('admin/data_gaji/update_data_aksi') ?>" enctype="multipart/form-data">

        <div class="form-group">
                <label>NIK</label>
                <input type="hidden" name="kode_gaji" class="form-control" value="<?php echo $g->kode_gaji ?>">
                <input type="number" name="nik" class="form-control" value="<?php echo $g->nik ?>">
                <?php echo form_error('nik','<div class="text-small text-danger"> </div>') ?>
            </div>
            <div class="form-group">
                <label>Nama Guru</label>
                <input type="text" name="nama_guru" class="form-control" value="<?php echo $g->nama_guru ?>">
                <?php echo form_error('nama_guru','<div class="text-small text-danger"> </div>') ?>
            </div>
            <div class="form-group">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" id="" class="form-control">
                    <option value="<?php echo $g->jenis_kelamin ?>"><?php echo $g->jenis_kelamin ?></option>
                    <option value="Laki-Laki">Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
                <?php echo form_error('jenis_kelamin','<div class="text-small text-danger"> </div>') ?>
            </div>
            <div class="form-group">
                <label>Jabatan</label>
                <select name="jabatan" id="" class="form-control">
                    <option value="<?php echo $g->nama_jabatan ?>"><?php echo $g->nama_jabatan ?></option>
                    <?php foreach($jabatan as $j) : ?>
                    <option value="<?php echo $j->nama_jabatan ?>"><?php echo $j->nama_jabatan ?></option>
                    <?php endforeach; ?>
                </select>
                <?php echo form_error('jabatan','<div class="text-small text-danger"> </div>') ?>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo $g->email ?>">
                <?php echo form_error('email','<div class="text-small text-danger"> </div>') ?>
            </div>
            
            
            <button type="submit" class="btn btn-primary">Update Data</button>

            
        </form>
        <?php endforeach; ?>

        </div>
    </div>

                  

</div>