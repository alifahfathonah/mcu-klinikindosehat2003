		<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
			<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
				<h1 class="h3 font-weight-bolder">Daftar Transaksi / <i>List of Transaction</i></h1>
				<div class="btn-toolbar mb-2 mb-md-0">
					<div class="btn-group mr-2"></div>
				</div>
			</div>

			<div class="table-responsive p-3">
				<table class="table table-hover" id="transaction_table" width="100%">
					<thead class="text-center">
						<tr>
							<th>#<br>No</th>
							<th>Nomor Transaksi<br><i>Transaction Number</i></th>
							<th>Nomor Rekam Medis<br><i>Medical Record Number</i></th>
							<th>Nama Pasien<br><i>Patient's Name</i></th>
							<th>Tipe Pembayaran<br><i>Payment Type</i></th>
							<th>Harga (Rp)<br><i>Price (IDR)</i></th>
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
				$('#transaction_table').DataTable({
					"processing": true,
					"serverSide": true,
					"ajax": {
						"url": "<?= base_url('transaction/get_ajax_transaction') ?>",
						"type": "POST"
					},
					"columnDefs": [{
							"targets": [0],
							"className": 'text-center align-middle font-weight-bolder',
							"orderable": false
						},
						{
							"targets": [1],
							"className": 'align-middle font-weight-bolder',
						},
						{
							"targets": [2, 3],
							"className": 'align-middle',
						},
						{
							"targets": [4],
							"className": 'align-middle',
						},
						{
							"targets": [5],
							"className": 'text-right align-middle',
						},
						{
							"targets": [6],
							"className": 'text-center align-middle',
							"orderable": false
						}
					]
				});
			});
		</script>
