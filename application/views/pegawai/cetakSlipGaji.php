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
        <h1>SMK Yadika 2 Cijagra Paseh</h1>
        <h2>Slip Gaji</h2>
        <hr style="width: 50%; border-width: 5px; color: black">
    </center>

   <?php foreach ($potongan as $p) {
                    if ($p->id_pg == 1){
                    $alpha = $p->jml_potongan;
                    }elseif($p->id_pg == 2){
                    $sakit = $p->jml_potongan;
                    }elseif($p->id_pg == 5){
                    $izin = $p->jml_potongan;
                    }
                } ?>
                <?php $no=1; foreach($printSlip as $ps) : ?>
                <?php $potongan = $ps->alpha * $alpha ?>    
                <?php $potongan1 = $ps->sakit * $sakit ?> 
                <?php $potongan2 = $ps->izin * $izin ?>
                <?php $honor_pendidik = $ps->honor_pendidik * $ps->jumlah_jam ?>

    <table style="width: 100%">
        <tr>
            <td style="width: 10%">NIK</td>
            <td style="width: 2%">:</td>
            <td><?php echo $ps->nuptk ?></td>
        </tr>
        <tr>
            <td>Nama Guru</td>
            <td>:</td>
            <td><?php echo $ps->nama_pegawai ?></td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td><?php echo $ps->nama_jabatan ?></td>
        </tr>
        <tr>
            <td>Bulan</td>
            <td>:</td>
            <td><?php echo substr($ps->bulan, 0,2) ?></td>
        </tr>
        <tr>
            <td>Tahun</td>
            <td>:</td>
            <td><?php echo substr($ps->bulan, 2,4) ?></td>
        </tr>
    </table>

    <table class="table table-bordered table-striped">
                <tr>
                    <th class="text-center">NO</th>
                    <th class="text-center">Keterangan</th>
                    <th class="text-center">Jumlah</th>
                </tr>

                <tr>
                    <td>1</td>
                    <td>Honor Pendidik</td>
                    <td>Rp. <?php echo number_format($ps->honor_pendidik,0,',','.')?></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Honor Tenaga Kependidikan</td>
                    <td>Rp. <?php echo number_format($ps->honor_tk,0,',','.')?></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Tunjangan Jabatan</td>
                    <td>Rp. <?php echo number_format($ps->tj_jabatan,0,',','.')?></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Kepala Program Keahlian</td>
                    <td>Rp. <?php echo number_format($ps->kepala_program,0,',','.')?></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Eskul</td>
                    <td>Rp. <?php echo number_format($ps->eskul,0,',','.')?></td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Piket Harian Guru</td>
                    <td>Rp. <?php echo number_format($ps->ph_guru,0,',','.')?></td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>Alpha</td>
                    <td>- Rp. <?php echo number_format($potongan,0,',','.')?></td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>Sakit</td>
                    <td>- Rp. <?php echo number_format($potongan1,0,',','.')?></td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>Izin</td>
                    <td>- Rp. <?php echo number_format($potongan2,0,',','.')?></td>
                </tr>
                <tr>
                    <td>10</td>
                    <td>potongan</td>
                    <td>- Rp. <?php echo number_format($ps->potongan,0,',','.')?></td>
                </tr>
                <tr>
                    <th colspan="2" style="text-align: right;">Total Gaji</th>
                    <td>Rp. <?php echo number_format($honor_pendidik+$ps->honor_tk+$ps->tj_jabatan+$ps->kepala_program+$ps->eskul+$ps->ph_guru - $potongan - $potongan1- $potongan2 -$ps->potongan,0,',','.')?></td>
                </tr>
            </table>

            <table width="100%">
                <tr>
                    <td></td>
                    <td>
                        <p>Nama Pegawai</p>
                        <br>
                        <br>
                        <p class="font-weight-bold"><?php echo $ps->nama_pegawai ?></p>
                    </td>
                    <td width="200px">
                        <p>Bandung, <?php echo date("d M Y") ?> ....</p>
                        <br>
                        <br>
                        <p>___________________</p>
                    </td>
                </tr>
            </table>
    <?php endforeach; ?>


        
    </body>
</html>

<script type="text/javascript">
    window.print();
</script>