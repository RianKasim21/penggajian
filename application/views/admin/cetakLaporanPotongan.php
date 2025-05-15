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
                    <th class="text-center">NUPTK</th>
                    <th class="text-center">Nama Pegawai</th>
                    <th class="text-center">Nama Potongan</th>
                    <th class="text-center">Jumlah</th>
                </tr>

                <?php $no=1;
            foreach ($lap_potongan as $a) : ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $a->nuptk ?></td>
                        <td><?php echo $a->nama_pegawai ?></td>
                        <td><?php echo $a->nama_potongan ?></td>
                        <td><?php echo $a->potongan ?></td>
                    </tr>
                <?php endforeach; ?>
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