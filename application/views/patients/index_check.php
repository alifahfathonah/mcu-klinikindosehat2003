		<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
			<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
				<h1 class="h3 font-weight-bolder">Daftar Pasien / <i>List of Patient</i></h1>
				<div class="btn-toolbar mb-2 mb-md-0">
					<form action="<?= base_url('patient/indexCheck') ?>" method="POST">
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Enter keyword..." name="keyword" autocomplete="off" autofocus="on">
							<div class="input-group-append">
								<input class="btn btn-outline-info" type="submit" name="search">
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="row mt-4">
				<?php foreach ($patients as $patient) : ?>
					<div class="col-md-4">
						<div class="card mb-3 shadow" style="max-width: 540px;">
						  <div class="row no-gutters">
						    <div class="col-md-4 my-auto mx-auto text-center">
						      <img src="<?= base_url('assets/images/patients/') . $patient['image'] ?>" alt="Image Patient Check Up" class="img-fluid rounded" width="100px">
						    </div>
						    <div class="col-md-8">
						      <div class="card-body">
						        <p class="card-title h5 font-weight-bolder"><?= ($patient['mcu_manual'] != NULL) ? ($patient['mcu_manual']) : ($patient['medical_record_number']) ?></p>
						        <p class="mt-n3"><small>(<?= date('D, d M Y / H:i', strtotime($patient['created_at'])) ?>)</small></p>
						        <table style="font-size: 0.875rem;">
						        	<tr>
						        		<td><?= $patient['name_patient'] ?></td>
						        	</tr>
						        	<tr>
						        		<td><?= $patient['id_number_patient'] ?></td>
						        	</tr>
						        	<tr>
						        		<td><?= ($patient['id_company'] == 0) ? ('PRIVATE') : ($patient['company_name']) ?></td>
						        	</tr>
						        </table>
						        <div class="text-right mt-3">
						        	<a href="<?= base_url('patient/detailIndexCheck/') . md5($patient['mcu_manual']) . '/' . $patient['medical_record_number'] ?>" class="badge badge-info" style="font-size: .825rem;">View <span data-feather="eye"></span></a>
						        </div>
						      </div>
						    </div>
						  </div>
						</div>
					</div>
				<?php endforeach ?>
			</div>
			<div class="mt-3">
				<?= $this->pagination->create_links(); ?>
			</div>
		</main>
	</div>
</div>