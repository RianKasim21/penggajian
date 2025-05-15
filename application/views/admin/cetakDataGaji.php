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
        <img src="<?php echo base_url().'assets/img/images.png' ?>" style="width: 120px;" align="left">
        <h1>Sekolah SMK Yadika 2 Cijagra Paseh</h1>
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
                    <th class="text-center">Nama Pegawai</th>
                    <th class="text-center">Jenis Kelamin</th>
                    <th class="text-center">Jabatan</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Honor Pendidik</th>
                    <th class="text-center">Honor Tenaga Kependidikan</th>
                    <th class="text-center">Tunjangan Jabatan</th>
                    <th class="text-center">Kepala Program Keahlian</th>
                    <th class="text-center">Eskul</th>
                    <th class="text-center">Piket Harian Guru</th>
                    <th class="text-center">Alfa</th>
                    <th class="text-center">Sakit</th>
                    <th class="text-center">Izin</th>
                    <th class="text-center">Potongan</th>
                    <th class="text-center">Total gaji</th>
                </tr>

                <?php foreach ($potongan as $p) {
                    if ($p->id_pg == 1){
                    $alpha = $p->jml_potongan;
                    }elseif($p->id_pg == 2){
                    $sakit = $p->jml_potongan;
                    }elseif($p->id_pg == 5){
                    $izin = $p->jml_potongan;
                    }
                } ?>
                <?php $no=1; foreach($cetakgaji as $g) : ?>
                <?php $potongan = $g->alpha * $alpha ?>    
                <?php $potongan1 = $g->sakit * $sakit ?> 
                <?php $potongan2 = $g->izin * $izin ?>
                <?php $honor_pendidik = $g->honor_pendidik * $g->jumlah_jam ?>
                <tr>
                <td><?php echo $no ?></td>
                    <td><?php echo $g->kode_gaji?></td>
                    <td><?php echo $g->nuptk?></td>
                    <td><?php echo $g->nama_pegawai?></td>
                    <td><?php echo $g->jenis_kelamin?></td>
                    <td><?php echo $g->nama_jabatan?></td>
                    <td><?php echo $g->email?></td>
                    <td>Rp. <?php echo number_format($honor_pendidik,0,',','.')?></td>
                    <td>Rp. <?php echo number_format($g->honor_tk,0,',','.')?></td>
                    <td>Rp. <?php echo number_format($g->tj_jabatan,0,',','.')?></td>
                    <td>Rp. <?php echo number_format($g->kepala_program,0,',','.')?></td>
                    <td>Rp. <?php echo number_format($g->eskul,0,',','.')?></td>
                    <td>Rp. <?php echo number_format($g->ph_guru,0,',','.')?></td>
                    <td>-Rp. <?php echo number_format($potongan,0,',','.')?></td>
                    <td>-Rp. <?php echo number_format($potongan1,0,',','.')?></td>
                    <td>-Rp. <?php echo number_format($potongan2,0,',','.')?></td>
                    <td>-Rp. <?php echo number_format($g->potongan,0,',','.')?></td>
                    <td>Rp. <?php echo number_format($honor_pendidik + $g->honor_tk + $g->tj_jabatan + $g->kepala_program + $g->eskul + $g->ph_guru - $potongan - $potongan1 - $potongan2 - $g->potongan,0,',','.')?></td>
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
                        <p><?php echo date("d M Y") ?> <br> Kepala Sekolah</p>
                        <br>
                        <br>
                        <p class="font-weight-bold">Selly Dwi Agustine S, SE</p>
                    </td>
                </tr>
            </table>
        
    </body>
</html>

<script type="text/javascript">
    window.print();
</script>