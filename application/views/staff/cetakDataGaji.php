<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title ?></title>
        <style type="text/css">
            body{
                font-family: Arial;
                color: black;
            }
        </style>
    </head>
    <body>
        
        <center>
        <img src="<?php echo base_url().'assets/img/logoo.png' ?>" align="left">
        <h1>Sekolah SMK Krija Bakti Utama</h1>
        <h2>Daftar Gaji Karyawan</h2>
        <hr style="width: 50%; border-width: 5px; color: black">
    </center>

    <?php

$bulan=$this->input->post('bulan');
$tahun=$this->input->post('tahun');

    ?>

    <table>
        <tr>
            <td>Bulan</td>
            <td>:</td>
            <td><?php echo $bulan ?></td>
        </tr>
        <tr>
            <td>Tahun</td>
            <td>:</td>
            <td><?php echo $tahun ?></td>
        </tr>
    </table>

    <table class="table table-bordered table-striped">
                <tr>
                <th class="text-center">NO</th>
                    <th class="text-center">Kode Gaji</th>
                    <th class="text-center">Nuptk</th>
                    <th class="text-center">Nama Guru</th>
                    <th class="text-center">Jenis Kelamin</th>
                    <th class="text-center">Jabatan</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Gaji Pokok</th>
                    <th class="text-center">Tj. Transport</th>
                    <th class="text-center">Wali Kelas</th>
                    <th class="text-center">Uang Makan</th>
                    <th class="text-center">Alfa</th>
                    <th class="text-center">Sakit</th>
                    <th class="text-center">Total gaji</th>
                </tr>

                <?php foreach ($potongan as $p) {
                    if ($p->id == 1){
                    $alpha = $p->jml_potongan;
                    }elseif($p->id == 4){
                    $sakit = $p->jml_potongan;
                    }
                } ?>
                <?php $no=1; foreach($cetakgaji as $g) : ?>
                <?php $potongan = $g->alpha * $alpha ?>    
                <?php $potongan1 = $g->sakit * $sakit ?> 
                <?php $gaji_pokok = $g->gaji_pokok * $g->jumlah_jam ?>
                <tr>
                    <td><?php echo $no ?></td>
                    <td><?php echo $g->kode_gaji?></td>
                    <td><?php echo $g->nuptk?></td>
                    <td><?php echo $g->nama_pegawai?></td>
                    <td><?php echo $g->jenis_kelamin?></td>
                    <td><?php echo $g->nama_jabatan?></td>
                    <td><?php echo $g->email?></td>
                    <td>Rp. <?php echo number_format($gaji_pokok,0,',','.')?></td>
                    <td>Rp. <?php echo number_format($g->tj_transport,0,',','.')?></td>
                    <td>Rp. <?php echo number_format($g->wali_kelas,0,',','.')?></td>
                    <td>Rp. <?php echo number_format($g->uang_makan,0,',','.')?></td>
                    <td>-Rp. <?php echo number_format($potongan,0,',','.')?></td>
                    <td>-Rp. <?php echo number_format($potongan1,0,',','.')?></td>
                    <td>Rp. <?php echo number_format($g->gaji_pokok + $g->tj_transport + $g->wali_kelas + $g->uang_makan - $potongan - $potongan1,0,',','.')?></td>
                </tr>

                <?php $no++; endforeach; ?>
            </table>

            <table width="100%">
                <tr>
                    <td></td>
                    <td>
                        <p>Bendahara</p>
                        <br>
                        <br>
                        <br>
                        <p class="font-weight-bold">Didin Salahudin, A.Md</p>
                    </td>
                    <td width="200px">
                        <p>Limbangan <?php echo date("d M Y") ?> <br> Kepala Sekolah</p>
                        <br>
                        <br>
                        <p>Suhartini, S.Pd.</p>
                    </td>
                </tr>
            </table>
        
    </body>
</html>

<script type="text/javascript">
    window.print();
</script>