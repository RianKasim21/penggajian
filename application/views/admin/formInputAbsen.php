<div class="container-fluid">

                    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <div class="card mb-3">
        <div class="card-header bg-primary text-white">
            Tambah Absen
        </div>
        <div class="card-body">

    <form class="form-inline">
    <div class="form-group mb-2 ml-1">
            <label for="staticEmail2">Hari </label>
            <select class="form-control ml-1" name="hari">
                <option value="">--Pilih Hari--</option>
                <?php $hari = date('d');
                for($i=1;$i<$hari+20;$i++) { ?>
                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group mb-2">
            <label for="staticEmail2">Bulan </label>
            <select class="form-control ml-2" name="bulan">
                <option value="">--Pilih Bulan--</option>
                <option value="01">Januari</option>
                <option value="02">Febuari</option>
                <option value="03">Maret</option>
                <option value="04">April</option>
                <option value="05">Mei</option>
                <option value="06">Juni</option>
                <option value="07">Juli</option>
                <option value="08">Agustus</option>
                <option value="09">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
            </select>
        </div>
        <div class="form-group mb-2 ml-3">
            <label for="staticEmail2">Tahun </label>
            <select class="form-control ml-3" name="tahun">
                <option value="">--Pilih Tahun--</option>
                <?php $tahun = date('Y');
                for($i=2022;$i<$tahun+5;$i++) { ?>
                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                <?php } ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary mb-2 ml-auto"><i class="fas fa-eye"></i> Tampilkan Absensi</button>
    </form>

    </div>
</div>

        <?php
            if((isset($_GET['hari']) && $_GET['hari']!='') && (isset($_GET['bulan']) && $_GET['bulan']!='') && (isset($_GET['tahun']) && $_GET['tahun']!='')){
                $hari = $_GET['hari'];
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $haribulantahun = $hari.$bulan.$tahun;
            }else{
                $hari = date('d');
                $bulan = date('m');
                $tahun = date('Y');
                $haribulantahun = $hari.$bulan.$tahun;
            }

        ?>

        <?php
            if((isset($_GET['bulan']) && $_GET['bulan']!='') && (isset($_GET['tahun']) && $_GET['tahun']!='')){
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $bulantahun = $bulan.$tahun;
            }else{
                $bulan = date('m');
                $tahun = date('Y');
                $bulantahun = $bulan.$tahun;
            }

        ?>

        <div class="alert alert-info">
        Menampilkan Data Karyawan Hari : <span class="font-weight-bold"><?php echo $hari ?></span>
            Bulan : <span class="font-weight-bold"><?php echo $bulan ?></span> 
            Tahun : <span class="font-weight-bold"><?php echo $tahun ?></span> 
        </div>

        <form method="POST">
        <button class="btn btn-success mb-3" type="submit" name="submit" value="submit">Simpan</button>
        <table class="table table-bordered table-striped mt-2">
                <tr>
                    <th class="text-center">NO</th>
                    <th class="text-center">Nuptk</th>
                    <th class="text-center">Nama Pegawai</th>
                    <th class="text-center">Jenis Kelamin</th>
                    <th class="text-center">Jabatan</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Hadir</th>
                </tr>

                <?php $no=1; foreach ($input_absen as $a) : ?>
                    <tr>
                        <input type="hidden" name="hari[]" class="form-control" value="<?php echo $haribulantahun ?>">
                        <input type="hidden" name="bulan[]" class="form-control" value="<?php echo $bulantahun ?>">
                        <input type="hidden" name="nuptk[]" class="form-control" value="<?php echo $a->nuptk ?>">
                        <input type="hidden" name="nama_pegawai[]" class="form-control" value="<?php echo $a->nama_pegawai ?>">
                        <input type="hidden" name="jenis_kelamin[]" class="form-control" value="<?php echo $a->jenis_kelamin ?>">
                        <input type="hidden" name="nama_jabatan[]" class="form-control" value="<?php echo $a->nama_jabatan ?>">
                        <input type="hidden" name="email[]" class="form-control" value="<?php echo $a->email ?>">
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $a->nuptk ?></td>
                        <td><?php echo $a->nama_pegawai ?></td>
                        <td><?php echo $a->jenis_kelamin ?></td>
                        <td><?php echo $a->nama_jabatan ?></td>
                        <td><?php echo $a->email ?></td>
                        <td><select name="status[]" required>
                                <option value="hadir">Hadir</option>
                                <option value="izin">Izin</option>
                                <option value="sakit">Sakit</option>
                                <option value="alfa">Alfa</option>
                            </select>
                        </td>
                    </tr>
                <?php endforeach; ?>
        </table>
    </form>

        

                  

</div>