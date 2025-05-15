 <!-- Footer -->
 <!-- End of Footer -->

 </div>
 <!-- End of Content Wrapper -->

 </div>
 <!-- End of Page Wrapper -->

 <!-- Scroll to Top Button-->
 <a class="scroll-to-top rounded" href="#page-top">
 	<i class="fas fa-angle-up"></i>
 </a>

 <!-- Logout Modal-->
 <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
 	aria-hidden="true">
 	<div class="modal-dialog" role="document">
 		<div class="modal-content">
 			<div class="modal-header">
 				<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
 				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
 					<span aria-hidden="true">×</span>
 				</button>
 			</div>
 			<div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
 			<div class="modal-footer">
 				<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
 				<a class="btn btn-primary" href="login.html">Logout</a>
 			</div>
 		</div>
 	</div>
 </div>

 <!-- Bootstrap core JavaScript-->
 <script src="<?php echo base_url()?>assets/vendor/jquery/jquery.min.js"></script>
 <script src="<?php echo base_url()?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

 <!-- Core plugin JavaScript-->
 <script src="<?php echo base_url()?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

 <!-- Custom scripts for all pages-->
 <script src="<?php echo base_url()?>assets/js/sb-admin-2.min.js"></script>

 <!-- Page level plugins -->
 <script src="<?php echo base_url()?>assets/vendor/chart.js/Chart.min.js"></script>

 <!-- Page level custom scripts -->
 <script src="<?php echo base_url()?>assets/js/demo/chart-area-demo.js"></script>
 <script src="<?php echo base_url()?>assets/js/demo/chart-pie-demo.js"></script>
 <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
 <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
 <!-- Bootstrap JavaScript -->
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
 <!-- FontAwesome -->
 <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
 <!-- DataTables -->
 <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
 <script>
 	$(document).ready(function () {
 		$('.table').DataTable();
 	});

 	function updateStatus(id, status, keterangan = null) {
 		$.ajax({
 			url: "<?php echo site_url('admin/data_mengajar/update'); ?>",
 			type: "POST",
 			data: {
 				id_mengajar: id,
 				status: status,
 				keterangan: keterangan
 			},
 			success: function (response) {
 				if (response.trim() == "Status updated successfully") {
 					document.getElementById('status-cell-' + id).innerHTML = status;
 				} else {
 					alert('Failed to update status');
 				}
 			},
 			error: function (xhr, status, error) {
 				console.error(xhr.responseText);
 			}
 		});
 	}

 	function showRejectModal(id) {
 		document.getElementById('rejectId').value = id;
 		$('#rejectModal').modal('show');
 	}

 	document.getElementById('rejectForm').addEventListener('submit', function (event) {
 		event.preventDefault();
 		var id = document.getElementById('rejectId').value;
 		var reason = document.getElementById('rejectReason').value;
 		updateStatus(id, 'Ditolak', reason);
 		$('#rejectModal').modal('hide');
 	});
 </script>

 </body>

 </html>