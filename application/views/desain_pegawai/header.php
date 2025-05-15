<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
	<link rel="stylesheet" type="text/css"
		href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
	<link rel="stylesheet" type="text/css"
		href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
	<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
	<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
	<script src="https://unpkg.com/@turf/turf/turf.min.js"></script>
	<style>
		.status-di-proses {
			background-color: orange;
			color: black;
		}

		.status-diterima {
			background-color: green;
			color: white;
		}

		.status-ditolak {
			background-color: red;
			color: white;
		}

	</style>


	<title><?php echo $title?></title>

	<!-- Custom fonts for this template-->
	<link href="<?php echo base_url()?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link
		href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
		rel="stylesheet">

	<script
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBEJPbmF_9W8Nu94EL8tLPKogi6lqMKUn4&libraries=places&callback=initMap"
		async defer></script>
	<script>
		// Inisialisasi peta
		var map;
		// -6.968474, 107.800122
		function initMap() {
			var myLatLng = {
				lat: -6.968943,
				lng: 107.800221
			}; // Ganti dengan koordinat awal

			map = new google.maps.Map(document.getElementById('map'), {
				center: myLatLng,
				zoom: 17
			});

			// Tambahkan event listener untuk mengambil koordinat saat mengklik peta
			google.maps.event.addListener(map, 'click', function (event) {
				document.getElementById('latitude').value = event.latLng.lat();
				document.getElementById('longitude').value = event.latLng.lng();
			});
		}

	</script>

	<!-- Custom styles for this template-->
	<link href="<?php echo base_url()?>assets/css/sb-admin-2.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css"
		href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
</head>
