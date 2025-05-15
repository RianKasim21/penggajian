<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <?php echo $this->session->flashdata('pesan') ?>

    <a class="mb-2 mt-2 btn btn-sm btn-success" href="<?php echo base_url('admin/data_jabatan/tambah_data') ?>">
    <i class="fas fa-plus"> </i> Tambah Data</a>

    <div class="table-responsive">
    <table id="example" class="table table-striped table-bordered">
        <thead>
        <tr>
            <th class="text-center">NO</th>
            <th class="text-center">Kode Jabatan</th>
            <th class="text-center">Nama Jabatan</th>
            <th class="text-center">Honor Pendidik</th>
            <th class="text-center">Honor Tenaga Pendidik</th>
            <th class="text-center">Tunjangan Jabatan</th>
            <th class="text-center">Kepala Program</th>
            <th class="text-center">Eskul</th>
            <th class="text-center">Piket Bulanan</th>
            <th class="text-center">Total</th>
            <th class="text-center">Action</th>
        </tr>
        </thead>

        <tbody>
        <?php $no=1; foreach($jabatan as $j) : ?>
            <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $j->kode_jabatan ?></td>
                <td><?php echo $j->nama_jabatan ?></td>
                <td>Rp. <?php echo number_format($j->honor_pendidik,0,',','.') ?></td>
                <td>Rp. <?php echo number_format($j->honor_tk,0,',','.') ?></td>
                <td>Rp. <?php echo number_format($j->tj_jabatan,0,',','.') ?></td>
                <td>Rp. <?php echo number_format($j->kepala_program,0,',','.') ?></td>
                <td>Rp. <?php echo number_format($j->eskul,0,',','.') ?></td>
                <td>Rp. <?php echo number_format($j->ph_guru,0,',','.') ?></td>
                <td>Rp. <?php echo number_format($j->honor_pendidik + $j->honor_tk + $j->tj_jabatan + $j->kepala_program + $j->eskul + $j->ph_guru,0,',','.') ?></td>
                <td>
                    <center>
                        <a class="btn btn-sm btn-primary" href="<?php echo base_url('admin/data_jabatan/update_data/'.$j->id_jabatan) ?>">
                        <i class="fas fa-edit"></i></a>
                        <a onclick="return confirm('Yakin Ingin Hapus ?')" class="btn btn-sm btn-danger" href="<?php echo base_url('admin/data_jabatan/delete_data/'.$j->id_jabatan) ?>">
                        <i class="fas fa-trash"></i></a>
                    </center>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
    </table>
                  

</div>
                <!-- /.container-fluid -->