<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <div class="card" style="width: 60%">
        <div class="card-body">
            <?php foreach($potongan as $p): ?>
            <form method="POST" action="<?php echo base_url('staff/Data_potongan/update_data_aksi') ?>">

            <div class="form-group">
                <label>NUPTK</label>
                <input type="hidden" name="id_potongan" class="form-control" value="<?php echo $p->id_potongan ?>">
                <input type="text" name="nuptk" class="form-control" value="<?php echo $p->nuptk ?>">
                <?php echo form_error('nuptk','<div class="text-small text-danger"> </div>') ?>
            </div>
            <div class="form-group">
                <label>Nama Pegawai</label>
                <input type="text" name="nama_pegawai" class="form-control" value="<?php echo $p->nama_pegawai ?>">
                <?php echo form_error('nama_pegawai','<div class="text-small text-danger"> </div>') ?>
            </div>
            <div class="form-group">
                <label>Nama Potongan</label>
                <input type="text" name="nama_potongan" class="form-control" value="<?php echo $p->nama_potongan ?>">
                <?php echo form_error('nama_potongan','<div class="text-small text-danger"> </div>') ?>
            </div>
            <div class="form-group">
                <label>Potongan</label>
                <input type="number" name="potongan" class="form-control" value="<?php echo $p->potongan ?>">
                <?php echo form_error('potongan','<div class="text-small text-danger"> </div>') ?>
            </div>
            
            <button type="submit" class="btn btn-primary">Update Data</button>

            </form>
            <?php endforeach;?>
        </div>
    </div>


</div>