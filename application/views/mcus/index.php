		<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
			<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
				<h1 class="h3 font-weight-bolder">Hasil Laboratorium / <i>Laboratory Result</i></h1>
			</div>

			<div class="table-responsive p-3">
				<table class="table table-hover" id="mcu_table" width="100%">
					<thead class="text-center">
						<tr>
							<th>#<br>No</th>
							<th>Nomor Rekam Medis<br><i>Medical Record Number</i></th>
							<th>Nama Pasien<br><i>Patient's Name</i></th>
							<th>KTP<br><i>ID Number</i></th>
							<th>Aksi<br><i>Action</i></th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</main>
		</div>
		</div>

		<script>
			$(document).ready(function() {
				$('#mcu_table').DataTable({
					"processing": true,
					"serverSide": true,
					"ajax": {
						"url": "<?= base_url('mcu/get_ajax_mcu') ?>",
						"type": "POST"
					},
					"columnDefs": [{
							"targets": [0],
							"className": 'text-center align-middle font-weight-bolder',
							"orderable": false
						},
						{
							"targets": [1],
							"className": 'text-center align-middle font-weight-bolder',
						},
						{
							"targets": [2],
							"className": 'align-middle'
						},
						{
							"targets": [3],
							"className": 'text-center align-middle',
						},
						{
							"targets": [4],
							"className": 'text-center align-middle',
							"orderable": false
						}
					]
				});
			});
		</script>
