<div class="container-fluid">

                    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <?php echo $this->session->flashdata('pesan') ?>

    <!-- <a class="btn btn-sm btn-success mb-2 mt-2" href="<?php echo base_url('admin/potongan_gaji/tambah_data') ?>">
    <i class="fas fa-plus"></i>Tambah Data</a> -->

    <table class="table table-bordered table-striped">
        <tr>
            <th class="text-center">NO</th>
            <th class="text-center">Jenis Potongan</th>
            <th class="text-center">Jumlah Potongan</th>
            <th class="text-center">Action</th>
        </tr>

        <?php $no=1; foreach($pot_gaji as $p) : ?>
            <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $p->potongan ?></td>
                <td>Rp. <?php echo number_format($p->jml_potongan,0,',','.')?></td>
                <td>
                <center>
                    <a class="btn btn-sm btn-primary" href="<?php echo base_url('admin/potongan_gaji/update_data/'.$p->id_pg) ?>">
                    <i class="fas fa-edit"></i></a>
                    <!-- <a onclick="return confirm('Yakin Ingin Hapus ?')" class="btn btn-sm btn-danger" href="<?php echo base_url('admin/potongan_gaji/delete_data/'.$p->id_pg) ?>">
                    <i class="fas fa-trash"></i></a> -->
                </center>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

                  

</div>