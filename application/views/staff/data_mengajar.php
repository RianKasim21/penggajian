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
						<?php 
        				// Get the current month and year
        				$month = date('m');
        				$year = date('Y');
        
       					// Get the number of days in the current month
        				$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        
        				// Generate options for each day in the month
        				for($i = 1; $i <= $daysInMonth; $i++) { ?>
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
					<th class="text-center">NUPTK</th>
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
					<td class="text-center" id="status-cell-<?php echo $a->id_mengajar; ?>">
						<?php if ($a->status == 'Diterima'): ?>
						<span class="status-accepted">Diterima</span>
						<?php elseif ($a->status == 'Ditolak'): ?>
						<span class="status-rejected">Ditolak</span>
						<?php else: ?>
						<button class="btn btn-success"
							onclick="updateStatus('<?php echo $a->id_mengajar; ?>', 'Diterima')"><i
								class="fas fa-check"></i></button>
						<button class="btn btn-danger" onclick="showRejectModal('<?php echo $a->id_mengajar; ?>')"><i
								class="fas fa-times"></i></button>
						<?php endif; ?>
					</td>
					<td id="keterangan-cell-<?php echo $a->id_mengajar; ?>"><?php echo $a->keterangan ?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<?php } else {?>
	<span class="badge badge-danger"><i class="fas fa-info-circle"></i>
		Data Masih Kosong</span>
	<?php } ?>

</div>

<!-- Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="rejectModalLabel">Isi Keterangan Penolakan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="rejectForm">
					<div class="form-group">
						<label for="rejectReason">Keterangan</label>
						<textarea class="form-control" id="rejectReason" rows="3" required></textarea>
					</div>
					<input type="hidden" id="rejectId">
					<button type="submit" class="btn btn-danger">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>