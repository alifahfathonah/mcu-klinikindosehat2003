<div class="rows main-page">
	<div class="row mr-1">
		<div class="col-md-12">
			<button type="button" class="btn btn-sm btn-success float-right" data-toggle="modal" data-target="#addUser" style="background-color: #04AA6D;">
				<i class="fas fa-user-plus"></i> Tambah Pengguna
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
								<th scope="col">Email</th>
								<th scope="col">Hak Akses</th>
								<th scope="col">Klinik</th>
								<th scope="col" class="text-center">Status</th>
								<th scope="col" class="text-center">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($users as $index => $user) : ?>
								<tr>
									<td class="align-middle"><?= $index + 1 ?></td>
									<td class="align-middle"><?= $user['name'] ?></td>
									<td class="align-middle"><?= $user['email'] ?></td>
									<td class="align-middle"><?= $user['role'] ?></td>
									<td class="align-middle"><?= $user['name_clinic'] ?></td>
									<td class="align-middle text-center">
										<?php if ($user['status'] == 0) : ?>
											<a href="#" data-target="#activateUser<?= $user['id'] ?>" data-toggle="modal" style="color: red; font-size: 20px;">
												<i class="far fa-times-circle"></i>
											</a>
										<?php else : ?>
											<a href="#" data-target="#disableUser<?= $user['id'] ?>" data-toggle="modal" style="color: green; font-size: 20px;">
												<i class="far fa-check-circle"></i>
											</a>
										<?php endif ?>
									</td>
									<td class="align-middle text-center">
										<a class="button-warning mr-1" href="#" data-toggle="modal" data-target="#editUser<?= $user['id'] ?>">
											<i class="fas fa-user-edit"></i> Ubah
										</a>
										<a class="button-danger" href="#" data-toggle="modal" data-target="#deleteUser<?= $user['id'] ?>">
											<i class="fas fa-user-times"></i> Hapus
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
<div class="modal fade" id="addUser" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title font-weight-bold" id="staticBackdropLabel">Formulir Tambah Pengguna Baru</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="POST" action="<?= base_url('user/addNewUser') ?>">
				<div class="modal-body">
					<div class="form-group">
						<label class="label-input-result" for="name">Nama</label>
						<input type="text" class="form-control form-control-sm value-input-result" name="name" id="name" placeholder="Name of User..." required autocomplete="off">
					</div>
					<div class="form-group">
						<label class="label-input-result" for="email">Email</label>
						<div class="input-group mb-2 mr-sm-2">
							<div class="input-group-prepend">
								<div class="input-group-text"><i class="fas fa-at"></i></div>
							</div>
							<input type="email" class="form-control form-control-sm value-input-result" name="email" id="email" placeholder="Email of User..." required autocomplete="off">
						</div>
					</div>
					<div class="form-group">
						<label class="label-input-result" for="password">Kata Sandi</label>
						<div class="input-group mb-2 mr-sm-2">
							<div class="input-group-prepend">
								<div class="input-group-text"><i class="fas fa-lock"></i></div>
							</div>
							<input type="password" class="form-control form-control-sm value-input-result" name="password" id="password" required autocomplete="off">
						</div>
					</div>
					<div class="form-group">
						<label class="label-input-result" for="role">Hak Akses</label>
						<select class="custom-select custom-select-sm value-input-result" name="role" id="role" required>
							<option selected disabled>Pilih hak akses</option>
							<option value="admin">Admin</option>
							<option value="doctor">Doctor</option>
							<option value="examinator">Examinator</option>
						</select>
					</div>
					<div class="form-group">
						<label class="label-input-result" for="site">Klinik</label>
						<select class="custom-select custom-select-sm value-input-result" name="site" id="site" required>
							<option selected disabled>Pilih klinik</option>
							<?php foreach ($clinics as $clinic) : ?>
								<option value="<?= $clinic['id'] ?>"><?= $clinic['name'] ?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-sm btn-success"><i class="fas fa-user-plus"></i> Tambah</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal Edit -->
<?php foreach ($users as $key => $user) : ?>
	<div class="modal fade" id="editUser<?= $user['id'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title font-weight-bold" id="staticBackdropLabel">Formulir Ubah Data Pengguna</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form method="POST" action="<?= base_url('user/editUser') ?>">
					<div class="modal-body">
						<input type="hidden" name="id" value="<?= $user['id'] ?>">
						<div class="form-group">
							<label class="label-input-result">Nama</label>
							<input type="text" class="form-control form-control-sm value-input-result" name="name" value="<?= $user['name'] ?>" required autocomplete="off">
						</div>
						<div class="form-group">
							<label class="label-input-result">Email</label>
							<div class="input-group mb-2 mr-sm-2">
								<div class="input-group-prepend">
									<div class="input-group-text"><i class="fas fa-at"></i></div>
								</div>
								<input type="email" class="form-control form-control-sm value-input-result" name="email" value="<?= $user['email'] ?>" required autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label class="label-input-result">Ubah Kata Sandi</label>
							<div class="input-group mb-2 mr-sm-2">
								<div class="input-group-prepend">
									<div class="input-group-text"><i class="fas fa-lock"></i></div>
								</div>
								<input type="password" class="form-control form-control-sm value-input-result" name="password" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label class="label-input-result">Hak Akses</label>
							<select class="custom-select custom-select-sm value-input-result" name="role" required>
								<option selected disabled>Pilih hak akses</option>
								<option value="admin" <?php if ($user['role'] == 'admin') : ?> selected <?php endif ?>>Admin</option>
								<option value="doctor" <?php if ($user['role'] == 'doctor') : ?> selected <?php endif ?>>Doctor</option>
								<option value="examinator" <?php if ($user['role'] == 'examinator') : ?> selected <?php endif ?>>Examinator</option>
							</select>
						</div>
						<div class="form-group">
							<label class="label-input-result">Klinik</label>
							<select class="custom-select custom-select-sm value-input-result" name="site" required>
								<option selected disabled>Pilih klinik</option>
								<?php foreach ($clinics as $clinic) : ?>
									<option value="<?= $clinic['id'] ?>" <?php if ($user['site'] == $clinic['id']) : ?> selected <?php endif ?>><?= $clinic['name'] ?></option>
								<?php endforeach ?>
							</select>
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

<!-- Modal Delete -->
<?php foreach ($users as $key => $user) : ?>
	<div class="modal fade" id="deleteUser<?= $user['id'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title font-weight-bold" id="staticBackdropLabel">Hapus Pengguna</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form method="POST" action="<?= base_url('user/deleteUser') ?>">
					<input type="hidden" name="id" value="<?= $user['id'] ?>">
					<div class="modal-body">
						Pilih <b> "hapus" </b> di bawah jika Anda yakin akan menghapus akun <b>'<?= $user['name'] ?>'</b> ini.
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

<!-- Modal Activate -->
<?php foreach ($users as $key => $user) : ?>
	<div class="modal fade" id="activateUser<?= $user['id'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title font-weight-bold" id="staticBackdropLabel">Aktifkan Pengguna</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form method="POST" action="<?= base_url('user/activateUser') ?>">
					<input type="hidden" name="id" value="<?= $user['id'] ?>">
					<div class="modal-body">
						Pilih <b>"Aktifkan"</b> dibawah jika Anda yakin akan mengaktifkan akun <b>'<?= $user['name'] ?>'</b> ini.
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-sm btn-success"><i class="far fa-check-circle"></i> Aktifkan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php endforeach ?>

<!-- Modal Disable -->
<?php foreach ($users as $key => $user) : ?>
	<div class="modal fade" id="disableUser<?= $user['id'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title font-weight-bold" id="staticBackdropLabel">Nonaktifkan Pengguna</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form method="POST" action="<?= base_url('user/disableUser') ?>">
					<input type="hidden" name="id" value="<?= $user['id'] ?>">
					<div class="modal-body">
						Pilih <b>"Nonaktifkan"</b> dibawah jika Anda yakin akan mengaktifkan akun <b>'<?= $user['name'] ?>'</b> ini.
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-sm btn-danger"><i class="far fa-times-circle"></i> Nonaktifkan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php endforeach ?>