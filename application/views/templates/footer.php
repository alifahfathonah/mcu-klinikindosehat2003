</div>
<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title font-weight-bold" id="exampleModalLabel">Yakin ingin keluar?</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				Pilih <b>"Keluar"</b> di bawah ini bila Anda siap untuk mengakhiri sesi Anda saat ini.
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
				<a class="btn btn-danger font-weight-bolder" href="<?= base_url('auth/logout') ?>">Keluar</a>
			</div>
		</div>
	</div>
</div>

<script src="<?= base_url('assets/bootstrap-4.6.0/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('assets/datatables/datatables.min.js') ?>"></script>
<script src="<?= base_url('assets/datatables/bootstrap4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/selectpicker/dist/js/bootstrap-select.min.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
<script>
	(function() {
		'use strict'

		feather.replace()
	})()

	if ( window.history.replaceState ) {
		window.history.replaceState( null, null, window.location.href );
	}

	jQuery('#date_of_birth').datetimepicker({
		timepicker: false,
		format: 'Y-m-d'
	});

	$('#mobile-tab').on('change', () => {
		if (document.getElementById("mobile-tab").checked == true) {
			$(".mobile-tab-content").show();
		} else {
			$(".mobile-tab-content").hide();
		}
	});
</script>

</body>
</html>