<div class="rows main-page">
	<div class="filter-wrapper">
		<form class="row" action="<?= base_url('transaction/index') ?>" method="POST">
			<div id="input-filters-date"></div>
			<div class="col-md-10">
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label for="filter-by-site" class="label-filter">Klinik</label>
							<select class="form-control form-control-sm" id="filter-by-site" name="filter-by-site">
								<option value="0" <?= ($this->session->userdata('role') == 'superuser') ? ('') : ('disabled') ?>>Semua Klinik</option>
								<?php foreach ($clinics as $clinic) : ?>
									<option value="<?= $clinic['id'] ?>" 
										<?php if ($this->session->userdata('role') == 'superuser') : ?>
											<?= ($this->session->userdata('filterBySiteTransaction') == $clinic['id']) ? ('selected') : ('') ?>
										<?php else : ?>
											<?= ($this->session->userdata('site') == $clinic['id']) ? ('selected disabled') : ('disabled') ?>
										<?php endif ?>>
										<?= $clinic['name'] ?>		
									</option>
								<?php endforeach ?>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="filter-by-status" class="label-filter">Status</label>
							<select class="form-control form-control-sm" id="filter-by-status" name="filter-by-status">
								<option value="0">Semua Status</option>
								<option value="cash" <?= ($this->session->userdata('filterByStatus') == 'cash') ? ('selected') : ('') ?>>Tunai</option>
								<option value="debit" <?= ($this->session->userdata('filterByStatus') == 'debit') ? ('selected') : ('') ?>>Debit</option>
								<option value="company" <?= ($this->session->userdata('filterByStatus') == 'company') ? ('selected') : ('') ?>>Company</option>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="filter-by-data" class="label-filter">Cari</label>
							<input type="text" class="form-control form-control-sm" id="filter-by-data" name="filter-by-data" placeholder="Masukkan kata kunci..." value="<?= ($this->session->userdata('filterByData') !== '') ? ($this->session->userdata('filterByData')) : ('') ?>">
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label class="label-filter">&nbsp;</label>
					<input class="btn btn-sm btn-block btn-success" type="submit" name="filter" value="Filter" style="background-color: #04AA6D;">
				</div>
			</div>
		</form>
	</div>

	<div class="table-in-page mt-3">
		<div class="col-md-12">
			<div class="card" style="border: none;">
				<div class="table-responsive">
					<table class="table table-borderless my-table">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Invoice</th>
								<th scope="col">Nomor Rekam Medis</th>
								<th scope="col">Nama Pasien</th>
								<th scope="col">Tipe Pembayaran</th>
								<th scope="col">Harga</th>
								<th scope="col" class="text-center">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php if ($total_data > 0) : ?>
								<?php foreach ($transactions as $index => $transaction) : ?>
									<tr>
										<td class="align-middle"><?= $index + 1 + $this->uri->segment(3) ?></td>
										<td class="align-middle"><?= $transaction['no_transaction'] ?></td>
										<td class="align-middle"><?= $transaction['medical_record_number'] ?></td>
										<td class="align-middle"><?= $transaction['patient_name'] ?></td>
										<td class="align-middle"><?= strtoupper($transaction['type_transaction']) ?></td>
										<td class="align-middle text-right"><?= number_format($transaction['total_price'] , 0, '.', '.') ?></td>
										<td class="align-middle text-center">
											<?php if ($this->session->userdata('role') == 'superuser') : ?>
												<a class="button-warning mr-1" href="#" data-toggle="modal" data-target="#editTransaction<?= $transaction['id'] ?>">
													<i class="far fa-edit"></i> Ubah
												</a>
											<?php endif ?>
											<a class="button-info" href="<?= base_url('transaction/previewInvoicePdf/' . $transaction['no_transaction']) ?>">
												<i class="far fa-fw fa-eye"></i> Lihat
											</a>
										</td>
									</tr>
								<?php endforeach ?>
							<?php else : ?>
								<tr>
									<td colspan="5" class="no-data-lab">
										<i class="fas fa-search"></i><br>
										Data tidak ditemukan
									</td>
								</tr>
							<?php endif ?>
						</tbody>
					</table>
				</div>
				<div class="mt-1">
					<div class="row">
						<div class="col-lg-6">
							<span class="pagination-total">Menampilkan <?= ($total_data < 1) ? $total_data : ($this->uri->segment(3)+1) ?> - <?= ($this->uri->segment(3)+15 > $total_data) ? ($total_data) : ($this->uri->segment(3)+15) ?> dari <?= $total_data ?> data</span>
						</div>
						<div class="col-lg-6">				
							<?= $this->pagination->create_links(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php if ($this->session->userdata('role') == 'superuser') : ?>
	<?php foreach($transactions as $transaction) : ?>
		<div class="modal fade" id="editTransaction<?= $transaction['id'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title font-weight-bold" id="staticBackdropLabel">Formulir Ubah Transaksi</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form method="POST" action="<?= base_url('transaction/editTransaction') ?>">
						<div class="modal-body">
							<input type="hidden" name="id" value="<?= $transaction['id'] ?>">
							<div class="form-group">
								<label class="label-input-result">Harga Total</label>
								<input type="text" class="form-control form-control-sm value-input-result" name="total_price" value="<?= $transaction['total_price'] ?>" required autocomplete="off">
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-sm btn-warning"><i class="fas fa-fw fa-user-edit"></i> Ubah</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	<?php endforeach ?>
<?php endif ?>