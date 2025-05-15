<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
	</div>

	<div class="card mb-3">
		<div class="card-header bg-primary text-white">
			Filter Data Mengajar
		</div>
		<div class="card-body">

			<form class="form-inline">
				<div class="form-group mb-2 ml-1">
					<label for="staticEmail2">Hari </label>
					<select class="form-control ml-1" name="hari">
						<option value="">--Pilih Hari--</option>
						<?php $hari = date('d');
                for($i=1;$i<$hari+28;$i++) { ?>
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
				<button type="submit" class="btn btn-primary mb-2 ml-auto"><i class="fas fa-eye"></i> Tampilkan Data
					Mengajar</button>
			<?php if ($absen_sudah_dilakukan) { ?>
                <a href="<?php echo base_url('pegawai/data_mengajar/input_mengajar') ?>"
                   class="btn btn-success mb-2 ml-2"><i class="fas fa-plus"></i> Input Data Mengajar</a>
            <?php } else { ?>
                <p class="text-danger">Anda harus melakukan absensi terlebih dahulu sebelum menginput data mengajar.</p>
            <?php } ?>
			</form>

		</div>
	</div>

	<?php
            if((isset($_GET['hari']) && $_GET['hari']!='') && (isset($_GET['bulan']) && $_GET['bulan']!='') && (isset($_GET['tahun']) && $_GET['tahun']!='')){
                $hari = $_GET['hari'];
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $bulantahun = $hari.$bulan.$tahun;
            }else{
                $hari = date('d');
                $bulan = date('m');
                $tahun = date('Y');
                $bulantahun = $hari.$bulan.$tahun;
            }

        ?>

	<div class="alert alert-info">
		Menampilkan Data Karyawan Hari : <span class="font-weight-bold"><?php echo $hari ?></span>
		Bulan : <span class="font-weight-bold"><?php echo $bulan ?></span>
		Tahun : <span class="font-weight-bold"><?php echo $tahun ?></span>
	</div>

	<?php

        $jml_data = count($mengajar);
        if ($jml_data > 0) {
            ?>

<div class="table-responsive">
		<table id="example" class="table table-striped table-bordered">
		<thead>
		<tr>
			<th class="text-center">NO</th>
			<th class="text-center">NIK</th>
			<th class="text-center">Nama Pegawai</th>
			<th class="text-center">Jabatan</th>
			<th class="text-center">mapel</th>
			<th class="text-center">Jumlah Jam</th>
			<th class="text-center">Status</th>
			<th class="text-center">Keterangan</th>
		</tr>
		</thead>

			<tbody>

		<?php $no=1; foreach ($mengajar as $a) : ?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $a->nuptk ?></td>
			<td><?php echo $a->nama_pegawai ?></td>
			<td><?php echo $a->jabatan ?></td>
			<td><?php echo $a->mapel ?></td>
			<td><?php echo $a->jumlah_jam ?></td>
			<td class="
                <?php 
                    if ($a->status == 'Diproses') echo 'status-di-proses'; 
                    elseif ($a->status == 'Diterima') echo 'status-diterima'; 
                    elseif ($a->status == 'Ditolak') echo 'status-ditolak'; 
                ?>">
				<?= $a->status ?>
			</td>
			<td><?php echo $a->keterangan ?></td>
		</tr>
		<?php endforeach; ?>
		</tbody>
		</table>
	<?php } else {?>
	<span class="badge badge-danger"><i class="fas fa-info-circle"></i>
		Data Masih Kosong</span>
	<?php } ?>



</div>