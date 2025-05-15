<div class="container-fluid">

                    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <div class="card mb-3">
        <div class="card-header bg-primary text-white">
            Filter Data Gaji
        </div>
        <div class="card-body">

    <form class="form-inline">
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
        <button type="submit" class="btn btn-primary mb-2 ml-auto"><i class="fas fa-eye"></i> Tampilkan Absensi</button>

        <?php if(count($gaji) > 0) { ?>
            <a href="<?php echo base_url('admin/data_gaji/cetakGaji?bulan='.$bulan),'$tahun='.$tahun ?>" target="blank" class="btn btn-success mb-2 ml-2"><i class="fas fa-plus"></i> Cetak Daftar gaji</a>
            <?php }else{ ?>
                <button type="button" class="btn btn-success mb-2 ml-2" data-toggle="modal" data-target="#exampleModal" target="blank">
                <i class="fas fa-plus"></i> Cetak Daftar gaji</button>
                <?php } ?>
    </form>

    </div>
</div>

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
            Menampilkan Data Gaji Pegawai Bulan : <span class="font-weight-bold"><?php echo $bulan ?></span> 
            Tahun : <span class="font-weight-bold"><?php echo $tahun ?></span> 
        </div>

        <?php

        $jml_data = count($gaji);
        if ($jml_data > 0) {
            ?>
        
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered">
                <thead>
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
                    <th class="text-center">Kirim Email</th>
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
                    <td>
                      <?php
                    $tombolDiklik = "<script>localStorage.getItem('tombolDiklik_" . $no . "')</script>";
                    ?>
                    <form method="POST" action="<?php echo base_url('admin/data_gaji/update_data_aksi/'.$g->kode_gaji) ?>" enctype="multipart/form-data">
                    <input type="hidden" name="nama_pegawai" class="form-control" value="<?php echo $g->nama_pegawai ?>">
                    <input type="hidden" name="nama_jabatan" class="form-control" value="<?php echo $g->nama_jabatan ?>">
                    <input type="hidden" name="email" class="form-control" value="<?php echo $g->email ?>">
                    <input type="hidden" name="honor_pendidik" class="form-control" value="Rp. <?php echo $honor_pendidik ?>">
                    <input type="hidden" name="honor_tk" class="form-control" value="Rp. <?php echo $g->honor_tk ?>">
                    <input type="hidden" name="tj_jabatan" class="form-control" value="Rp. <?php echo $g->tj_jabatan ?>">
                    <input type="hidden" name="kepala_program" class="form-control" value="Rp. <?php echo $g->kepala_program ?>">
                    <input type="hidden" name="eskul" class="form-control" value="Rp. <?php echo $g->eskul ?>">
                    <input type="hidden" name="ph_guru" class="form-control" value="Rp. <?php echo $g->ph_guru ?>">
                    <input type="hidden" name="alfa" class="form-control" value="Rp. <?php echo $potongan ?>">
                    <input type="hidden" name="sakit" class="form-control" value="Rp. <?php echo $potongan1 ?>">
                    <input type="hidden" name="izin" class="form-control" value="Rp. <?php echo $potongan2 ?>">
                    <input type="hidden" name="potongan" class="form-control" value="Rp. <?php echo $g->potongan ?>">
                    <input type="hidden" name="gaji" class="form-control" value="Rp. <?php echo number_format($honor_pendidik + $g->honor_tk + $g->tj_jabatan + $g->kepala_program + $g->eskul + $g->ph_guru - $potongan - $potongan1 - $potongan2 - $g->potongan,0,',','.')?>">
                    <button type="submit" id="tombolStatus_<?php echo $no; ?>" onclick="updateTombolStatus(<?php echo $no; ?>, <?php echo $tombolDiklik ? 'true' : 'false'; ?>)">Kirim</button>                        
                    </td>
                </tr>
                </form>

                <?php $no++; endforeach; ?>
                </tbody>
            </table>
        </div>

        <?php } else {?>
            <span class="badge badge-danger"><i class="fas fa-info-circle"></i>
        Data Masih Kosong</span>
        <?php } ?>

                  

</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Informasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Data Gaji Masih Kosong, Silahkan Input Absensi Terlebih Dahulu
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
// Fungsi untuk mengubah tampilan tombol
function updateTombolStatus(id, diklik) {
  var tombol = document.getElementById("tombolStatus_" + id);

  if (diklik) {
    tombol.innerHTML = "Telah Dikirim";
    
  }
    // Simpan status tombol ke dalam localStorage
    localStorage.setItem("tombolDiklik_" + id, diklik);
}

// Pemanggilan awal untuk mengatur tampilan tombol berdasarkan status di localStorage
for (var i = 1; i <= <?php echo count($gaji); ?>; i++) {
  var tombolDiklik = localStorage.getItem("tombolDiklik_" + i);
  updateTombolStatus(i, tombolDiklik === "true"); 
}



</script>