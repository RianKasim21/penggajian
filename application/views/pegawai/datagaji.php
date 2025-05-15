<div class="container-fluid">

                    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered">
                <thead>
        <tr>
            <th>Bulan/Tahun</th>
            <th>Honor Pendidik</th>
            <th>Honor Tenaga Kependidikan</th>
            <th>TUnjangan Jabatan</th>
            <th>Kepala Program Keahlian</th>
            <th>Eskul</th>
            <th>Piket Harian Guru</th>
            <th class="text-center">Alpha</th>
            <th class="text-center">Sakit</th>
            <th class="text-center">Izin</th>
            <th class="text-center">Potongan</th>
            <th class="text-center">Total Gaji</th>
            <th>Cetak Slip</th>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($potongan as $p) {
                    if ($p->id_pg == 1){
                    $alpha = $p->jml_potongan;
                    }elseif($p->id_pg == 2){
                    $sakit = $p->jml_potongan;
                    }elseif($p->id_pg == 5){
                    $izin = $p->jml_potongan;
                    }
                } ?>
                <?php $no=1; foreach($gaji as $g) : ?>
                <?php $potongan = $g->alpha * $alpha ?>    
                <?php $potongan1 = $g->sakit * $sakit ?> 
                <?php $potongan2 = $g->izin * $izin ?> 
                <?php $honor_pendidik = $g->honor_pendidik * $g->jumlah_jam ?>
        <tr>
            <td><?php echo $g->bulan ?></td>
            <td>Rp. <?php echo number_format($honor_pendidik,0,',','.') ?></td>
            <td>Rp. <?php echo number_format($g->honor_tk,0,',','.') ?></td>
            <td>Rp. <?php echo number_format($g->tj_jabatan,0,',','.') ?></td>
            <td>Rp. <?php echo number_format($g->kepala_program,0,',','.') ?></td>
            <td>Rp. <?php echo number_format($g->eskul,0,',','.') ?></td>
            <td>Rp. <?php echo number_format($g->ph_guru,0,',','.') ?></td>
            <td>-Rp. <?php echo number_format($potongan,0,',','.')?></td>
            <td>-Rp. <?php echo number_format($potongan1,0,',','.')?></td>
            <td>-Rp. <?php echo number_format($potongan2,0,',','.')?></td>
            <td>-Rp. <?php echo number_format($g->potongan,0,',','.') ?></td>
            <td>Rp. <?php echo number_format($honor_pendidik + $g->honor_tk + $g->tj_jabatan + $g->kepala_program + $g->eskul + $g->ph_guru - $potongan - $potongan1 - $potongan2 - $g->potongan,0,',','.')?></td>
            <td>
                <center>
                    <a class="btn btn-sm btn-primary" href="<?php echo base_url('pegawai/datagaji/cetakSlip/'.$g->id_kehadiran) ?>">
                <i class="fas fa-print"></i></a>
                </center>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

                  

</div>