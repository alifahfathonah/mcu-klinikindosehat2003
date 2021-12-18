<div class="rows main-page">
	<div class="filter-wrapper">
		<form class="row" action="<?= base_url('company/index') ?>" method="POST">
			<div id="input-filters-date"></div>
			<div class="col-md-10">
				<div class="form-group">
					<label for="filter-by-data" class="label-filter">Cari</label>
					<input type="text" class="form-control form-control-sm" id="filter-by-data" name="filter-by-data" placeholder="Masukkan nama / alamat perusahaan..." value="<?= ($this->session->userdata('filterByDataCompany') !== '') ? ($this->session->userdata('filterByDataCompany')) : ('') ?>">
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
								<th scope="col">Nama Perusahaan</th>
								<th scope="col">Alamat Perusahaan</th>
								<th scope="col" class="text-center">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php if ($total_data > 0) : ?>
								<?php foreach ($companies as $index => $company) : ?>
									<tr>
										<td class="align-middle"><?= $index + 1 + $this->uri->segment(3) ?></td>
										<td class="align-middle"><?= $company['name'] ?></td>
										<td class="align-middle"><?= $company['address'] ?></td>
										<td class="align-middle text-center">
											<a class="button-warning mr-1" href="#" data-toggle="modal" data-target="#editCompany<?= $company['id'] ?>">
												<i class="far fa-edit"></i> Ubah
											</a>
											<a class="button-danger" href="#" data-toggle="modal" data-target="#deleteCompany<?= $company['id'] ?>">
												<i class="far fa-trash-alt"></i> Hapus
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

<!-- Modal Add -->
<div class="modal fade" id="addCompany" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="addCompanyLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title font-weight-bold" id="addCompanyLabel">Tambah Perusahaan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="POST" action="<?= base_url('company/addCompany') ?>">
				<div class="modal-body">
					<div class="form-group">
						<label class="label-input-result">Nama Perusahaan</label>
						<input type="text" class="form-control form-control-sm value-input-result" name="name" placeholder="Enter Company Name..." required autocomplete="off">
					</div>
					<div class="form-group">
						<label class="label-input-result">Alamat Perusahaan</label>
						<textarea class="form-control form-control-sm value-input-result" name="address" rows="3" required autocomplete="off"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-sm btn-info"><i class="far fa-save"></i> Tambah</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal Edit -->
<?php foreach ($companies as $company) : ?>
	<div class="modal fade" id="editCompany<?= $company['id'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="editCompanyLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title font-weight-bold" id="editCompanyLabel">Ubah Perusahaan</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form method="POST" action="<?= base_url('company/editCompany') ?>">
					<input type="hidden" name="id" value="<?= $company['id'] ?>">
					<div class="modal-body">
						<div class="form-group">
							<label class="label-input-result">Nama Perusahaan</label>
							<input type="text" class="form-control form-control-sm value-input-result" name="name" value="<?= $company['name'] ?>" required autocomplete="off">
						</div>
						<div class="form-group">
							<label class="label-input-result">Alamat Perusahaan</label>
							<textarea class="form-control form-control-sm value-input-result" name="address" rows="3" required autocomplete="off"><?= $company['address'] ?></textarea>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-sm btn-warning"><i class="far fa-edit"></i> Ubah</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php endforeach ?>

<!-- Modal Delete -->
<?php foreach ($companies as $company) : ?>
	<div class="modal fade" id="deleteCompany<?= $company['id'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="deleteCompanyLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title font-weight-bold" id="deleteCompanyLabel">Hapus dokter</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form method="POST" action="<?= base_url('company/deleteCompany') ?>">
					<input type="hidden" name="id" value="<?= $company['id'] ?>">
					<div class="modal-body">
						Pilih <b>"hapus"</b> dibawah jika Anda yakin akan menghapus perusahaan <b>'<?= $company['name'] ?>'</b> ini.
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i> Hapus</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php endforeach ?>