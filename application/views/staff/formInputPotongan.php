<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
	</div>

	<div class="card mb-3">
		<div class="card-header bg-primary text-white">
			Tambah Absensi
		</div>
		<div class="card-body">
			<button type="button" class="btn btn-primary" id="modalButton">
				Cari Nama Pegawai
			</button>
		</div>
	</div>

	<div class="modal fade" id="exampleModalLive" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-fullscreen">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Cari Pegawai</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="table-responsive">
						<table id="example" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th class="text-center">NO</th>
									<th class="text-center">Nuptk</th>
									<th class="text-center">Nama Pegawai</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $no=1; foreach($guru as $p) : ?>
								<tr>
									<td><?php echo $no++ ?></td>
									<td><?php echo $p->nuptk ?></td>
									<td><?php echo $p->nama_pegawai ?></td>
									<td>
										<center>
											<a class="btn btn-sm btn-primary btn-pilih">Pilih</a>
										</center>
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
				</div>
			</div>
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
		Menampilkan Data Pegawai Bulan : <span class="font-weight-bold"><?php echo $bulan ?></span>
		Tahun : <span class="font-weight-bold"><?php echo $tahun ?></span>
	</div>

	<form method="POST" action="<?php echo base_url('staff/data_potongan/tambah_data_aksi') ?>">

		<div class="form-group">
			<input type="hidden" name="bulan" class="form-control" value="<?php echo $bulantahun ?>">
			<label>nuptk</label>
			<input type="number" name="nuptk" class="form-control" readonly>
			<?php echo form_error('nuptk') ?>
		</div>
		<div class="form-group">
			<label>Nama Pegawai</label>
			<input type="text" name="nama_pegawai" id="nama_pegawai" class="form-control" readonly>
			<?php echo form_error('nama_pegawai') ?>
		</div>
		<div class="form-group">
			<label>Nama Potongan</label>
			<input type="text" name="nama_potongan" class="form-control">
			<?php echo form_error('nama_potongan') ?>
		</div>
		<div class="form-group">
			<label>Potongan</label>
			<input type="number" name="potongan" class="form-control">
			<?php echo form_error('potongan') ?>
		</div>

		<button type="submit" class="btn btn-primary">Simpan</button>

	</form>

</div>
</div>
</div>

<script>
	document.addEventListener('DOMContentLoaded', function () {
		var myModal = new bootstrap.Modal(document.getElementById('exampleModalLive'), {
			keyboard: false
		});

		document.getElementById('modalButton').addEventListener('click', function () {
			myModal.show();
		});
	});
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
	$(document).ready(function () {
		// Ketika tombol "Pilih" diklik
		$(".btn-pilih").click(function () {
			// Ambil data dari baris tabel yang terkait
			var row = $(this).closest("tr");
			var nuptk = row.find("td:eq(1)").text(); // Mengambil data Nuptk dari kolom kedua
			var nama = row.find("td:eq(2)").text(); // Mengambil data Nama Pegawai dari kolom ketiga

			// Masukkan data ke dalam input
			$("input[name='nuptk']").val(nuptk);
			$("input[name='nama_pegawai']").val(nama);

			// Tutup modal secara manual
			$("#exampleModalLive").modal('hide');
		});
	});
</script>