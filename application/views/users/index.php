		<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
			<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
				<h1 class="h3 font-weight-bolder">Daftar Pengguna / <i>List of Users</i></h1>
				<div class="btn-toolbar mb-2 mb-md-0">
					<div class="btn-group mr-2">
						<button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#addUser">
							<span data-feather="user-plus"></span> Tambah Pengguna / <i>Add Users</i>
						</button>
					</div>
				</div>
			</div>

			<div class="table-responsive p-3">
				<table class="table table-sm table-hover">
					<thead class="text-center">
						<tr>
							<th>#<br> .</th>
							<th>Nama<br><i>Name</i></th>
							<th>Alamat Email<br><i>Email Address</i></th>
							<th>Wewenang<br><i>Role</i></th>
							<th>Site<br><i>Site</i></th>
							<th>Status<br><i>Status</i></th>
							<th>Aksi<br><i>Action</i></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($users as $key => $user) : ?>
							<tr>
								<td class="text-center align-middle font-weight-bold"><?= $key + 1 ?></td>
								<td class="align-middle"><?= $user['name'] ?></td>
								<td class="align-middle"><?= $user['email'] ?></td>
								<td class="text-center align-middle"><?= $user['role'] ?></td>
								<td class="text-center align-middle"><?= $user['name_clinic'] ?></td>
								<td class="text-center align-middle">
									<?php if ($user['status'] == 0) : ?>
										<a data-target="#activateUser<?= $user['id'] ?>" data-toggle="modal" href="#" class="badge badge-pill badge-danger"><span data-feather="x"></span></a>
									<?php else : ?>
										<a data-target="#disableUser<?= $user['id'] ?>" data-toggle="modal" href="#" class="badge badge-pill badge-success"><span data-feather="check"></span></a>
									<?php endif ?>
								</td>
								<td class="text-center align-middle">
									<a class="button-warning mr-1" href="#" data-toggle="modal" data-target="#editUser<?= $user['id'] ?>">
										<i class="fas fa-fw fa-user-edit"></i> Ubah / <i>Edit</i>
									</a>
									<a class="button-danger" href="#" data-toggle="modal" data-target="#deleteUser<?= $user['id'] ?>">
										<i class="fas fa-fw fa-user-minus"></i> Hapus / <i>Delete</i>
									</a>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</main>
		</div>
		</div>

		<!-- Modal Add -->
		<div class="modal fade" id="addUser" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title font-weight-bold" id="staticBackdropLabel">Formulir Tambah Pengguna Baru<br><i>Form Add New User</i></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form method="POST" action="<?= base_url('user/addNewUser') ?>">
						<div class="modal-body">
							<div class="form-group">
								<label class="font-weight-bolder" for="name">Nama / <i>Name</i></label>
								<input type="text" class="form-control form-control-sm" name="name" id="name" placeholder="Name of User..." required autocomplete="off">
							</div>
							<div class="form-group">
								<label class="font-weight-bolder" for="email">Alamat Email / <i>Email Address</i></label>
								<div class="input-group mb-2 mr-sm-2">
									<div class="input-group-prepend">
										<div class="input-group-text"><span data-feather="at-sign"></span></div>
									</div>
									<input type="email" class="form-control form-control-sm" name="email" id="email" placeholder="Email of User..." required autocomplete="off">
								</div>
							</div>
							<div class="form-group">
								<label class="font-weight-bolder" for="password">Kata Sandi / <i>Password</i></label>
								<div class="input-group mb-2 mr-sm-2">
									<div class="input-group-prepend">
										<div class="input-group-text"><span data-feather="key"></span></div>
									</div>
									<input type="password" class="form-control form-control-sm" name="password" id="password" required autocomplete="off">
								</div>
							</div>
							<div class="form-group">
								<label class="font-weight-bolder" for="role">Wewenang / <i>Role</i></label>
								<select class="custom-select" name="role" id="role" required>
									<option selected disabled>Pilih Wewenang / Select the Role</option>
									<option value="admin">Admin</option>
									<option value="doctor">Doctor</option>
									<option value="examinator">Examinator</option>
								</select>
							</div>
							<div class="form-group">
								<label class="font-weight-bolder" for="site">Site / <i>Site</i></label>
								<select class="custom-select" name="site" id="site" required>
									<option selected disabled>Pilih Site / Select the Site</option>
									<?php foreach ($clinics as $clinic) : ?>
										<option value="<?= $clinic['id'] ?>"><?= $clinic['name'] ?></option>
									<?php endforeach ?>
								</select>
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
		<?php foreach ($users as $key => $user) : ?>
			<div class="modal fade" id="editUser<?= $user['id'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title font-weight-bold" id="staticBackdropLabel">Formulir Ubah Data Pengguna<br><i>Form Edit Data User</i></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form method="POST" action="<?= base_url('user/editUser') ?>">
							<div class="modal-body">
								<input type="hidden" name="id" value="<?= $user['id'] ?>">
								<div class="form-group">
									<label class="font-weight-bolder">Nama / <i>Name</i></label>
									<input type="text" class="form-control form-control-sm" name="name" value="<?= $user['name'] ?>" required autocomplete="off">
								</div>
								<div class="form-group">
									<label class="font-weight-bolder">Alamat Email / <i>Email Address</i></label>
									<div class="input-group mb-2 mr-sm-2">
										<div class="input-group-prepend">
											<div class="input-group-text"><span data-feather="at-sign"></span></div>
										</div>
										<input type="email" class="form-control form-control-sm" name="email" value="<?= $user['email'] ?>" required autocomplete="off">
									</div>
								</div>
								<div class="form-group">
									<label class="font-weight-bolder">Gandi Kata Sandi / <i>Change Password</i></label>
									<div class="input-group mb-2 mr-sm-2">
										<div class="input-group-prepend">
											<div class="input-group-text"><span data-feather="key"></span></div>
										</div>
										<input type="password" class="form-control form-control-sm" name="password" autocomplete="off">
									</div>
								</div>
								<div class="form-group">
									<label class="font-weight-bolder">Wewenang / <i>Role</i></label>
									<select class="custom-select" name="role" required>
										<option selected disabled>Pilih Wewenang / Select the Role</option>
										<option value="admin" <?php if ($user['role'] == 'admin') : ?> selected <?php endif ?>>Admin</option>
										<option value="doctor" <?php if ($user['role'] == 'doctor') : ?> selected <?php endif ?>>Doctor</option>
										<option value="examinator" <?php if ($user['role'] == 'examinator') : ?> selected <?php endif ?>>Examinator</option>
									</select>
								</div>
								<div class="form-group">
									<label class="font-weight-bolder">Site / <i>Site</i></label>
									<select class="custom-select" name="site" required>
										<option selected disabled>Pilih Site / Select the Site</option>
										<?php foreach ($clinics as $clinic) : ?>
											<option value="<?= $clinic['id'] ?>" <?php if ($user['site'] == $clinic['id']) : ?> selected <?php endif ?>><?= $clinic['name'] ?></option>
										<?php endforeach ?>
									</select>
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

		<!-- Modal Delete -->
		<?php foreach ($users as $key => $user) : ?>
			<div class="modal fade" id="deleteUser<?= $user['id'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title font-weight-bold" id="staticBackdropLabel">Hapus Pengguna / <i>Delete User</i></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form method="POST" action="<?= base_url('user/deleteUser') ?>">
							<input type="hidden" name="id" value="<?= $user['id'] ?>">
							<div class="modal-body">
								Pilih <b> "hapus" </b> di bawah jika Anda yakin akan menghapus akun <b>'<?= $user['name'] ?>'</b> ini.
								<br><br>
								<i>Select <b>"delete"</b> below if you are sure to delete this <b>'<?= $user['name'] ?>'</b> account.</i>
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

		<!-- Modal Activate -->
		<?php foreach ($users as $key => $user) : ?>
			<div class="modal fade" id="activateUser<?= $user['id'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title font-weight-bold" id="staticBackdropLabel">Aktifkan Pengguna<br><i>Activate User</i></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form method="POST" action="<?= base_url('user/activateUser') ?>">
							<input type="hidden" name="id" value="<?= $user['id'] ?>">
							<div class="modal-body">
								Pilih <b>"Aktifkan"</b> dibawah jika Anda yakin akan mengaktifkan akun <b>'<?= $user['name'] ?>'</b> ini.
								<br><br>
								<i>Select <b>"Activate"</b> below if you are sure to activate this <b>'<?= $user['name'] ?>'</b> account.</i>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-sm btn-success"><span data-feather="check"></span> Aktifkan / <i>Activate</i></button>
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
							<h5 class="modal-title font-weight-bold" id="staticBackdropLabel">Nonaktifkan Pengguna<br><i>Disable User</i></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form method="POST" action="<?= base_url('user/disableUser') ?>">
							<input type="hidden" name="id" value="<?= $user['id'] ?>">
							<div class="modal-body">
								Pilih <b>"Nonaktifkan"</b> dibawah jika Anda yakin akan mengaktifkan akun <b>'<?= $user['name'] ?>'</b> ini.
								<br><br>
								Select <b>"Disable"</b> below if you are sure to disable this <b>'<?= $user['name'] ?>'</b> account.
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-sm btn-danger"><span data-feather="x"></span> Nonaktifkan / <i>Disable</i></button>
							</div>
						</form>
					</div>
				</div>
			</div>
		<?php endforeach ?>
