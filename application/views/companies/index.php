		<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
			<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
				<h1 class="h3 font-weight-bolder">Daftar Perusahaan / <i>List of Company</i></h1>
				<div class="btn-toolbar mb-2 mb-md-0">
					<div class="btn-group mr-2">
						<button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#addCompany">
							<i class="fas fa-fw fa-user-plus"></i> Tambah Perusahaan / <i>Add Company</i>
						</button>
					</div>
				</div>
			</div>

			<div class="table-responsive p-3">
				<table class="table table-hover" id="company_table" width="100%">
					<thead class="text-center">
						<tr>
							<th>#<br>No</th>
							<th>Nama Perusahaan<br><i>Company Name</i></th>
							<th>Alamat Perusahaan<br><i>Company Address</i></th>
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

		<!-- Modal Add -->
		<div class="modal fade" id="addCompany" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="addCompanyLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title font-weight-bold" id="addCompanyLabel">Tambah Perusahaan / <i>Add Company</i></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form method="POST" action="<?= base_url('company/addCompany') ?>">
						<div class="modal-body">
							<div class="form-group">
								<label class="font-weight-bolder">Nama Perusahaan / <i>Company Name</i></label>
								<input type="text" class="form-control form-control-sm" name="name" placeholder="Enter Company Name..." required autocomplete="off">
							</div>
							<div class="form-group">
								<label class="font-weight-bolder">Alamat Perusahaan / <i>Company Address</i></label>
								<textarea class="form-control form-control-sm" name="address" rows="3" required autocomplete="off"></textarea>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-fw fa-user-plus"></i> Simpan / <i>Save</i></button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<!-- Modal Edit -->
		<?php foreach ($companies as $index => $company) : ?>
			<div class="modal fade" id="editCompany<?= $company->id ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="editCompanyLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title font-weight-bold" id="editCompanyLabel">Ubah Perusahaan / <i>Edit Company</i></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form method="POST" action="<?= base_url('company/editCompany') ?>">
							<input type="hidden" name="id" value="<?= $company->id ?>">
							<div class="modal-body">
								<div class="form-group">
									<label class="font-weight-bolder">Nama Perusahaan / <i>Company Name</i></label>
									<input type="text" class="form-control form-control-sm" name="name" value="<?= $company->name ?>" required autocomplete="off">
								</div>
								<div class="form-group">
									<label class="font-weight-bolder">Alamat Perusahaan / <i>Company Address</i></label>
									<textarea class="form-control form-control-sm" name="address" rows="3" required autocomplete="off"><?= $company->address ?></textarea>
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
			<?php endforeach ?>Edit

			<!-- Modal Delete -->
			<?php foreach ($companies as $index => $company) : ?>
				<div class="modal fade" id="deleteCompany<?= $company->id ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="deleteCompanyLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title font-weight-bold" id="deleteCompanyLabel">Hapus dokter / <i>Delete Doctor</i></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<form method="POST" action="<?= base_url('company/deleteCompany') ?>">
								<input type="hidden" name="id" value="<?= $company->id ?>">
								<div class="modal-body">
									Pilih <b>"hapus"</b> dibawah jika Anda yakin akan menghapus perusahaan <b>'<?= $company->name ?>'</b> ini.
									<br><br>
									Select <b>"delete"</b> below if you are sure to delete this <b>'<?= $company->name ?>'</b> company.
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-user-minus"></i> Hapus / <i>Delete</i></button>
								</div>
							</form>
						</div>
					</div>
				</div>
			<?php endforeach ?>

			<script>
				$(document).ready(function() {
					$('#company_table').DataTable({
						"processing": true,
						"serverSide": true,
						"ajax": {
							"url": "<?= base_url('company/get_ajax_company') ?>",
							"type": "POST"
						},
						"columnDefs": [{
								"targets": [0],
								"className": 'text-center align-middle font-weight-bolder',
								"orderable": false
							},
							{
								"targets": [1],
								"className": 'align-middle font-weight-bolder'
							},
							{
								"targets": [2],
								"className": 'align-middle'
							},
							{
								"targets": [3],
								"className": 'text-center align-middle',
								"orderable": false
							}
						]
					});
				});
			</script>
