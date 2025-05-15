<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
	</div>

	<?php echo $this->session->flashdata('pesan') ?>

	<a class="mb-2 mt-2 btn btn-sm btn-success" href="<?php echo base_url('admin/data_guru/tambah_data') ?>">
		<i class="fas fa-plus"></i> Tambah Guru</a>

	<div class="table-responsive">
		<table id="example" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th class="text-center">NO</th>
					<th class="text-center">Nuptk</th>
					<th class="text-center">Nama Pegawai</th>
					<th class="text-center">Jenis Kelamin</th>
					<th class="text-center">Jabatan</th>
					<th class="text-center">Email</th>
					<th class="text-center">Tanggal Masuk</th>
					<th class="text-center">Status</th>
					<th class="text-center">Foto</th>
					<th class="text-center">Hak Akses</th>
					<th class="text-center">Action</th>
				</tr>
			</thead>

			<tbody>
				<?php $no=1; foreach($guru as $p) : ?>
				<tr>
					<td><?php echo $no++ ?></td>
					<td><?php echo $p->nuptk ?></td>
					<td><?php echo $p->nama_pegawai ?></td>
					<td><?php echo $p->jenis_kelamin ?></td>
					<td><?php echo $p->jabatan ?></td>
					<td><?php echo $p->email ?></td>
					<td><?php echo $p->tanggal_masuk ?></td>
					<td><?php echo $p->status ?></td>
					<td><img src="<?php echo base_url().'assets/img/'.$p->photo ?>" width="75px" height="90px"></td>

					<?php 
                    if ($p->hak_akses == '1') { ?>
					<td>Admin</td>
					<?php } elseif ($p->hak_akses == '2') { ?>
					<td>Guru</td>
					<?php } elseif ($p->hak_akses == '3') { ?>
					<td>Kepala Sekolah</td>
					<?php } elseif ($p->hak_akses == '4') { ?>
					<td>Staff TU</td>
					<?php } else { ?>
					<td>Hak akses tidak valid</td>
					<?php } ?>



					<td>
						<center>
							<a class="btn btn-sm btn-primary"
								href="<?php echo base_url('admin/data_guru/update_data/'.$p->id_guru) ?>">
								<i class="fas fa-edit"></i></a>
							<a onclick="return confirm('Yakin Ingin Hapus ?')" class="btn btn-sm btn-danger"
								href="<?php echo base_url('admin/data_guru/delete_data/'.$p->id_guru) ?>">
								<i class="fas fa-trash"></i></a>
						</center>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>


</div>
