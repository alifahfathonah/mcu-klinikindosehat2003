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

<?php if ($this->session->userdata('role') == 'superuser') : ?>
	<?php foreach($transactions as $transaction) : ?>
		<div class="modal fade" id="editTransaction<?= $transaction['id'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title font-weight-bold" id="staticBackdropLabel">Formulir Ubah Transaksi<br><i>Form Edit Data Transaction</i></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form method="POST" action="<?= base_url('transaction/editTransaction') ?>">
						<div class="modal-body">
							<input type="hidden" name="id" value="<?= $transaction['id'] ?>">
							<div class="form-group">
								<label class="font-weight-bolder">Harga Total / <i>Total Price</i></label>
								<input type="text" class="form-control form-control-sm" name="total_price" value="<?= $transaction['total_price'] ?>" required autocomplete="off">
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-sm btn-warning"><i class="fas fa-fw fa-user-edit"></i> Ubah / <i>Edit</i></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	<?php endforeach ?>
<?php endif ?>

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
