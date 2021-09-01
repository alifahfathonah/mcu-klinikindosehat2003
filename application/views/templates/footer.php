	<!-- Logout Modal-->
	<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title font-weight-bold" id="exampleModalLabel">Yakin ingin keluar? / <i>Ready to Leave?</i></h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					Pilih <b>"Keluar"</b> di bawah ini bila Anda siap untuk mengakhiri sesi Anda saat ini.
					<br><br>
					<i>Choose <b>"Sign Out"</b> below when you are ready to end your current session.</i>
				</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
					<a class="btn btn-danger font-weight-bolder" href="<?= base_url('auth/logout') ?>">Keluar / <i>Sign Out</i></a>
				</div>
			</div>
		</div>
	</div>

	<script src="<?= base_url('assets/bootstrap-4.6.0/js/bootstrap.bundle.min.js') ?>"></script>
	<script src="<?= base_url('assets/datatables/datatables.min.js') ?>"></script>
	<script src="<?= base_url('assets/datatables/bootstrap4/js/dataTables.bootstrap4.min.js') ?>"></script>
	<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
	<script>
		(function() {
			'use strict'

			feather.replace()
		})()

		jQuery('#date_of_birth').datetimepicker({
			timepicker: false,
			format: 'Y-m-d'
		});
	</script>
	</body>

	</html>
