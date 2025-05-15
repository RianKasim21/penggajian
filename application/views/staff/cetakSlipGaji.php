<!DOCTYPE html>
<html>

<head>
	<title><?php echo $title ?></title>
	<style type="text/css">
		body {
			font-family: Arial;
			color: black;
		}
	</style>
</head>

<body>

	<center>
		<img src="<?php echo base_url().'assets/img/logoo.png' ?>" align="left">
		<h1>Sekolah SMK Krija Bhakti Utama</h1>
		<h2>Slip Gaji</h2>
		<hr style="width: 50%; border-width: 5px; color: black">
	</center>

	<?php
        
        $bulan=$this->input->post('bulan');
        $tahun=$this->input->post('tahun');
    ?>

	<?php foreach ($potongan as $p) {
                    if ($p->id == 1){
                    $alpha = $p->jml_potongan;
                    }elseif($p->id == 4){
                    $sakit = $p->jml_potongan;
                    }
                } ?>
	<?php $no=1; foreach($printSlip as $ps) : ?>
	<?php $potongan = $ps->alpha * $alpha ?>
	<?php $potongan1 = $ps->sakit * $sakit ?>
	<?php $gaji_pokok = $ps->gaji_pokok * $ps->jumlah_jam ?>

	<table style="width: 100%">
		<tr>
			<td>Kode Gaji</td>
			<td>:</td>
			<td><?php echo $ps->kode_gaji ?></td>
		</tr>
		<tr>
			<td style="width: 10%">NIK</td>
			<td style="width: 2%">:</td>
			<td><?php echo $ps->nuptk ?></td>
		</tr>
		<tr>
			<td>Nama Karyawan</td>
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
			<th class="text-center">Keterangan</th>
			<th class="text-center">Jumlah</th>
		</tr>

		<tr>
			<td>1</td>
			<td>Gaji Pokok</td>
			<td>Rp. <?php echo number_format($ps->gaji_pokok,0,',','.')?></td>
		</tr>
		<tr>
			<td>2</td>
			<td>Tunjangan Transportasi</td>
			<td>Rp. <?php echo number_format($ps->tj_transport,0,',','.')?></td>
		</tr>
		<tr>
			<td>3</td>
			<td>Wali Kelas</td>
			<td>Rp. <?php echo number_format($ps->wali_kelas,0,',','.')?></td>
		</tr>
		<tr>
			<td>4</td>
			<td>Uang Makan</td>
			<td>Rp. <?php echo number_format($ps->uang_makan,0,',','.')?></td>
		</tr>
		<tr>
		<tr>
			<td>6</td>
			<td>Alpha</td>
			<td>-Rp. <?php echo number_format($potongan,0,',','.')?></td>
		</tr>
		<tr>
			<td>7</td>
			<td>Izin</td>
			<td>-Rp. <?php echo number_format($potongan1,0,',','.')?></td>
		</tr>
		<tr>
			<th colspan="2" style="text-align: right;">Total Gaji</th>
			<td>Rp. <?php echo number_format($ps->gaji_pokok+$ps->tj_transport+$ps->wali_kelas+$ps->uang_makan-
                    $potongan-$potongan1,0,',','.')?></td>
		</tr>
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
				<p>Limbangan, <?php echo date("d M Y") ?><br> Kepala Sekolah</p>
				<br>
				<br>
				<p class="font-weight-bold">Suhartini, S.Pd.</p>
			</td>
		</tr>
	</table>
	<?php endforeach; ?>



</body>

</html>

<script type="text/javascript">
	window.print();
</script>