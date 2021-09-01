		<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
			<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
				<h1 class="h3 font-weight-bolder">Daftar Klinik / <i>List of Clinic</i></h1>
				<?php if ($this->session->userdata('role') != 'user') : ?>
					<div class="btn-toolbar mb-2 mb-md-0">
						<div class="btn-group mr-2">
							<button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#addClinic">
								<span data-feather="plus"></span> Tambah Klinik / <i>Add Clinic</i>
							</button>
						</div>
					</div>
				<?php endif ?>
			</div>

			<div class="table-responsive p-3">
				<table class="table table-sm table-hover" id="table_clinic">
					<thead class="text-center">
						<tr>
							<th>#<br>.</th>
							<th width="20%">Nama<br><i>Name</i></th>
							<th>Alamat<br><i>Address</i></th>
							<?php if ($this->session->userdata('role') != 'user') : ?>
								<th width="25%">Aksi<br><i>Action</i></th>
							<?php endif ?>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</main>
		</div>
		</div>

		<!-- Modal Add -->
		<div class="modal fade" id="addClinic" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title font-weight-bold" id="staticBackdropLabel">Formulir Tambah Klinik Baru<br><i>Form Add New Clinic</i></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form method="POST" action="<?= base_url('clinic/addNewClinic') ?>">
						<div class="modal-body">
							<div class="form-group">
								<label class="font-weight-bolder" for="name">Nama / <i>Name</i></label>
								<input class="form-control form-control-sm" type="text" name="name" id="name" required autocomplete="off">
							</div>
							<div class="form-group">
								<label class="font-weight-bolder" for="address">Alamat / <i>Address</i></label>
								<textarea name="address" id="address" class="form-control form-control-sm" rows="3" required></textarea>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-sm btn-primary"><span data-feather="save"></span> Simpan / <i>Save</i></button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<!-- Modal Edit -->
		<?php foreach ($clinics as $key => $clinic) : ?>
			<div class="modal fade" id="editClinic<?= $clinic['id'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title font-weight-bold" id="staticBackdropLabel">Formulir Ubah Data Klinik<br><i>Form Edit Data Clinic</i></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form method="POST" action="<?= base_url('clinic/editClinic') ?>">
							<input type="hidden" name="id" value="<?= $clinic['id'] ?>">
							<div class="modal-body">
								<div class="form-group">
									<label class="font-weight-bolder">Nama / <i>Name</i></label>
									<input class="form-control form-control-sm" type="text" name="name" value="<?= $clinic['name'] ?>" required autocomplete="off">
								</div>
								<div class="form-group">
									<label class="font-weight-bolder" for="address">Alamat / <i>Address</label>
									<textarea name="address" class="form-control form-control-sm" rows="3" required><?= $clinic['address'] ?></textarea>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-sm btn-warning"><span data-feather="edit"></span> Ubah / <i>Edit</i></button>
							</div>
						</form>
					</div>
				</div>
			</div>
		<?php endforeach ?>

		<!-- Modal Delete -->
		<?php foreach ($clinics as $key => $clinic) : ?>
			<div class="modal fade" id="deleteClinic<?= $clinic['id'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title font-weight-bold" id="staticBackdropLabel">Hapus Klinik / <i>Delete Clinic</i></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form method="POST" action="<?= base_url('clinic/deleteClinic') ?>">
							<input type="hidden" name="id" value="<?= $clinic['id'] ?>">
							<div class="modal-body">
								Pilih <b>"hapus"</b> dibawah jika Anda yakin ingin menghapus klinik <b>'<?= $clinic['name'] ?>'</b> ini.
								<br><br>
								Select <b>"delete"</b> below if you are sure to delete this <b>'<?= $clinic['name'] ?>'</b> clinic.
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-sm btn-danger"><span data-feather="trash-2"></span> Hapus / <i>Delete</i></button>
							</div>
						</form>
					</div>
				</div>
			</div>
		<?php endforeach ?>

		<script>
			$(document).ready(function() {
			$('#table_clinic').DataTable({
				"processing": true,
				"serverSide": true,
				"ajax": {
					"url": "<?= base_url('clinic/get_ajax_clinic') ?>",
					"type": "POST"
				},
				"columnDefs": [{
						"targets": [0],
						"className": 'align-middle text-center font-weight-bolder',
						"orderable": false
					},
					{
						"targets": [1],
						"className": 'align-middle font-weight-bolder',
					},
					{
						"targets": [2],
						"className": 'align-middle',
					},
					{
						"targets": [3],
						"className": 'align-middle text-center',
						"orderable": false
					}
				]
			});
		});
		</script>