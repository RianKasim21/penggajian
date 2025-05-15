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
        <h1>SMK Yadika 2 Cijagra Paseh</h1>
        <h2>Laporan Kehadiran</h2>
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
                    <th class="text-center">Kode Absensi</th>
                    <th class="text-center">NUPTK</th>
                    <th class="text-center">Nama Pegawai</th>
                    <th class="text-center">Jenis Kelamin</th>
                    <th class="text-center">Jabatan</th>
                    <th class="text-center">hadir</th>
                    <th class="text-center">izin</th>
                    <th class="text-center">Sakit</th>
                    <th class="text-center">Alpha</th>
                </tr>

                <?php $no=1; foreach ($lap_kehadiran as $l) : ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $l->kode_absensi?></td>
                    <td><?php echo $l->nuptk?></td>
                    <td><?php echo $l->nama_pegawai?></td>
                    <td><?php echo $l->jenis_kelamin?></td>
                    <td><?php echo $l->nama_jabatan?></td>
                    <td><?php echo $l->hadir?></td>
                    <td><?php echo $l->izin?></td>
                    <td><?php echo $l->sakit?></td>
                    <td><?php echo $l->alpha?></td>
                </tr>
                <?php endforeach; ?>
            </table>

            <table width="100%">
                <tr>
                    <td></td>
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