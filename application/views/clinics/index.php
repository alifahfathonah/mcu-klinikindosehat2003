<div class="rows main-page">
	<div class="row mr-1">
		<div class="col-md-12">
			<button type="button" class="btn btn-sm btn-success float-right" data-toggle="modal" data-target="#addClinic" style="background-color: #04AA6D;">
				<i class="fas fa-plus"></i> Tambah Klinik
			</button>
		</div>
	</div>
	<div class="table-in-page mt-3">
		<div class="col-md-12">
			<div class="card" style="border: none;">
				<div class="table-responsive">
					<table class="table table-borderless my-table">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Nama</th>
								<th scope="col">Alamat</th>
								<th scope="col" class="text-center">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($clinics as $index => $clinic) : ?>
								<tr>
									<td class="align-middle"><?= $index + 1 ?></td>
									<td class="align-middle"><?= $clinic['name'] ?></td>
									<td class="align-middle"><?= $clinic['address'] ?></td>
									<td class="align-middle text-center">
										<a class="button-warning mr-1" href="#" data-toggle="modal" data-target="#editClinic<?= $clinic['id'] ?>">
											<i class="far fa-edit"></i> Ubah
										</a>
										<a class="button-danger" href="#" data-toggle="modal" data-target="#deleteClinic<?= $clinic['id'] ?>">
											<i class="far fa-trash-alt"></i> Hapus
										</a>
									</td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal Add -->
<div class="modal fade" id="addClinic" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title font-weight-bold" id="staticBackdropLabel">Formulir Tambah Klinik Baru</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="POST" action="<?= base_url('clinic/addNewClinic') ?>">
				<div class="modal-body">
					<div class="form-group">
						<label class="label-input-result" for="name">Nama</label>
						<input class="form-control form-control-sm value-input-result" type="text" name="name" id="name" required autocomplete="off">
					</div>
					<div class="form-group">
						<label class="label-input-result" for="address">Alamat</label>
						<textarea class="form-control form-control-sm value-input-result" name="address" id="address" rows="3" required></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-sm btn-success"><i class="far fa-save"></i> Tambah</button>
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
					<h5 class="modal-title font-weight-bold" id="staticBackdropLabel">Formulir Ubah Data Klinik</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form method="POST" action="<?= base_url('clinic/editClinic') ?>">
					<input type="hidden" name="id" value="<?= $clinic['id'] ?>">
					<div class="modal-body">
						<div class="form-group">
							<label class="label-input-result">Nama</label>
							<input class="form-control form-control-sm value-input-result" type="text" name="name" value="<?= $clinic['name'] ?>" required autocomplete="off">
						</div>
						<div class="form-group">
							<label class="label-input-result" for="address">Alamat</label>
							<textarea class="form-control form-control-sm value-input-result" name="address" rows="3" required><?= $clinic['address'] ?></textarea>
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
<?php foreach ($clinics as $key => $clinic) : ?>
	<div class="modal fade" id="deleteClinic<?= $clinic['id'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title font-weight-bold" id="staticBackdropLabel">Hapus Klinik</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form method="POST" action="<?= base_url('clinic/deleteClinic') ?>">
					<input type="hidden" name="id" value="<?= $clinic['id'] ?>">
					<div class="modal-body">
						Pilih <b>"hapus"</b> dibawah jika Anda yakin ingin menghapus klinik <b>'<?= $clinic['name'] ?>'</b> ini.
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