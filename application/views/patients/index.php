<div class="rows main-page">
	<div class="filter-wrapper">
		<form class="row" action="<?= base_url('patient/index') ?>" method="POST">
			<div id="input-filters-date"></div>
			<div class="col-md-10">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="filter-by-company" class="label-filter">Perusahaan</label>
							<select class="form-control form-control-sm selectpicker" data-live-search="true" data-style="btn-info" id="filter-by-company" name="filter-by-company">
								<option value="all" <?= ($this->session->userdata('filterByCompany') == 'all') ? 'selected' : ('') ?>>Semua Perusahaan</option>
								<option value="0" <?= ($this->session->userdata('filterByCompany') == '0') ? 'selected' : ('') ?>>PRIVATE</option>
								<?php foreach ($companies as $company) : ?>
									<option value="<?= $company['id'] ?>" <?= ($this->session->userdata('filterByCompany') == $company['id']) ? ('selected') : ('') ?>>
										<?= $company['name'] ?>		
									</option>
								<?php endforeach ?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="filter-by-data" class="label-filter">Cari</label>
							<input type="text" class="form-control form-control-sm" id="filter-by-data" name="filter-by-data" placeholder="Masukkan kata kunci..." value="<?= ($this->session->userdata('filterByDataPatient') !== '') ? ($this->session->userdata('filterByDataPatient')) : ('') ?>">
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
								<th scope="col" class="text-center">Foto</th>
								<th scope="col">KTP</th>
								<th scope="col">Passpor</th>
								<th scope="col">Nama</th>
								<th scope="col">Perusahaan</th>
								<th scope="col" class="text-center">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php if ($total_data > 0) : ?>
								<?php foreach ($patients as $index => $patient) : ?>
									<tr>
										<td class="align-middle"><?= $index + 1 + $this->uri->segment(3) ?></td>
										<td class="align-middle text-center">
											<img class="img-thumbnail rounded" width="75px" src="<?= ($patient['image'] == '') ? (base_url('assets/images/patients/default.png')) : (base_url('assets/images/patients/' . $patient['image'])) ?>">
										</td>
										<td class="align-middle"><?= $patient['id_number'] ?></td>
										<td class="align-middle"><?= $patient['passport_number'] ?></td>
										<td class="align-middle"><?= $patient['name'] ?></td>
										<td class="align-middle"><?= ($patient['id_company'] == 0) ? ('PRIVATE') : $patient['company_name'] ?></td>
										<td class="align-middle text-center">
											<a class="button-warning mr-1" href="<?= base_url('patient/formEditPatient/' . md5($patient['id_number']) . '/' . $patient['id_number']) ?>">
												<i class="far fa-edit"></i> Ubah
											</a>
											<a class="button-danger" href="#" data-toggle="modal" data-target="#deletePatient<?= $patient['id'] ?>">
												<i class="far fa-trash-alt"></i> Hapus
											</a>
										</td>
									</tr>
								<?php endforeach ?>
							<?php else : ?>
								<tr>
									<td colspan="7" class="no-data-lab">
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

<!-- Modal Delete -->
<?php foreach ($patients as $patient) : ?>
	<div class="modal fade" id="deletePatient<?= $patient['id'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title font-weight-bold" id="staticBackdropLabel">Hapus Pasien</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form method="POST" action="<?= base_url('patient/deletePatient') ?>">
					<input type="hidden" name="id" value="<?= $patient['id'] ?>">
					<div class="modal-body">
						Pilih <b>"hapus"</b> dibawah jika Anda yakin akan menghapus pasien <b>'<?= $patient['name'] ?>'</b> ini.
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-user-minus"></i> Hapus</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php endforeach ?>

<script>
	function myFunction1() {
		document.getElementById("nationality").setAttribute("readonly", "");
		document.getElementById("nationality").value = 'Indonesia';
	}

	function myFunction2() {
		document.getElementById("nationality").removeAttribute("readonly", "");
		document.getElementById("nationality").value = '';
	}

	function myFunction3() {
		document.getElementById("company").setAttribute("readonly", "");
		document.getElementById("company").value = 'Private';
	}

	function myFunction4() {
		document.getElementById("company").removeAttribute("readonly", "");
		document.getElementById("company").value = '';
	}
</script>