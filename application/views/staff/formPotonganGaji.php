<div class="container-fluid">

                    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <div class="card">
        <div class="card-body">

        <form method="POST" action="<?php echo base_url('staff/potongan_gaji/tambah_data_aksi') ?>">

        <div class="form-group">
            <label>Potongan</label>
            <input type="text" name="potongan" class="form-control">
            <?php echo form_error('potongan') ?>
        </div>
        <div class="form-group">
            <label>Jumlah Potongan</label>
            <input type="number" name="jml_potongan" class="form-control">
            <?php echo form_error('jml_potongan') ?>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        
        </form>

        </div>
    </div>

                  

</div>