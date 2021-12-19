<div class="rows main-page">
	<div class="filter-wrapper">
		<form class="row" action="<?= base_url('mcu/index') ?>" method="POST">
			<div id="input-filters-date"></div>
			<div class="col-md-10">
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label for="filter-by-site" class="label-filter">Klinik</label>
							<select class="form-control form-control-sm" id="filter-by-site" name="filter-by-site">
								<option value="0" <?= ($this->session->userdata('role') == 'superuser') ? ('') : ('disabled') ?>>Semua Klinik</option>
								<?php foreach ($clinics as $clinic) : ?>
									<option value="<?= $clinic['id'] ?>" 
										<?php if ($this->session->userdata('role') == 'superuser') : ?>
											<?= ($this->session->userdata('filterBySite') == $clinic['id']) ? ('selected') : ('') ?>
										<?php else : ?>
											<?= ($this->session->userdata('site') == $clinic['id']) ? ('selected disabled') : ('disabled') ?>
										<?php endif ?>>
										<?= $clinic['name'] ?>		
									</option>
								<?php endforeach ?>
							</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label class="label-filter">Tanggal</label>
							<div id="reportrange" class="form-control form-control-sm" style="cursor: pointer;">
								<i class="fas fa-calendar-alt"></i>&nbsp;
								<span></span>
							</div>	
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="filter-by-status" class="label-filter">Status</label>
							<select class="form-control form-control-sm" id="filter-by-status" name="filter-by-status">
								<option value="0">Semua Status</option>
								<option value="1" <?= ($this->session->userdata('filterByStatus') == 1) ? ('selected') : ('') ?>>Belum Input Hasil</option>
								<option value="2" <?= ($this->session->userdata('filterByStatus') == 2) ? ('selected') : ('') ?>>Sudah Input Hasil</option>
							</select>
						</div>
					</div>
					<div class="col-md-3">
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
								<th scope="col">No. Rekam Medis</th>
								<th scope="col">Nama</th>
								<th scope="col">NIK</th>
								<th scope="col" class="text-center">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php if ($total_data > 0) : ?>
								<?php foreach($mcus as $index => $mcu) : ?>
									<tr>
										<th class="align-middle"><?= $index + 1 + $this->uri->segment(3) ?></th>
										<td class="align-middle"><?= ($mcu['mcu_manual'] != NULL) ? ($mcu['mcu_manual']) : ($mcu['medical_record_number']) ?></td>
										<td class="align-middle"><?= $mcu['name_patient'] ?></td>
										<td class="align-middle"><?= $mcu['id_number_patient'] ?></td>
										<td class="align-middle text-center">
											<?php if ($mcu['is_fit'] == null) : ?>
												<?php if ($this->session->userdata('role') == 'superuser' || $this->session->userdata('role') == 'doctor') : ?>
													<?php if ($mcu['type_examination'] == 'rev') : ?>
														<a class="button-warning" href="<?= base_url('mcu/formEditUmumRevMcu/' . md5($mcu['id']) . '/' . $mcu['medical_record_number']) ?>"><i class="far fa-edit"></i> Ubah</a>
														<a class="button-primary" href="<?= base_url('mcu/formInputRevResult/' . md5($mcu['id']) . '/' . $mcu['medical_record_number']) ?>"><i class="fas fa-laptop-code"></i> Input Revalidasi</a>
													<?php else : ?>
														<a class="button-warning" href="<?= base_url('mcu/formEditUmumRevMcu/' . md5($mcu['id']) . '/' . $mcu['medical_record_number']) ?>"><i class="far fa-edit"></i> Ubah</a>
														<a class="button-primary" href="<?= base_url('mcu/formInputMcuResult/' . md5($mcu['id']) . '/' . $mcu['medical_record_number']) ?>"><i class="fas fa-laptop-code"></i> Input MCU</a>
													<?php endif ?>
												<?php else : ?>
													Belum Input Hasil
												<?php endif ?>
											<?php else : ?>
												<?php if ($this->session->userdata('role') == 'superuser' || $this->session->userdata('role') == 'doctor') : ?>
													<?php if ($mcu['type_examination'] == 'rev') : ?>
														<a class="button-warning" href="<?= base_url('mcu/formEditRevWithResult/' . md5($mcu['id']) . '/' . $mcu['medical_record_number']) ?>"><i class="far fa-edit"></i> Ubah</a>
														<a class="button-success" href="<?= base_url('mcu/downloadQRCodePng/' . $mcu['medical_record_number']) ?>">Unduh <i class="fas fa-qrcode"></i></a>
														<a class="button-info" href="<?= base_url('mcu/downloadRevResultPdf/' . $mcu['medical_record_number']) ?>">Unduh <i class="far fa-file-pdf"></i></a>
														<a class="button-danger" href="<?= base_url('mcu/previewRevResultPdf/' . $mcu['medical_record_number']) ?>">View <i class="fas fa-file-pdf"></i></a>
													<?php else : ?>
														<a class="button-warning" href="<?= base_url('mcu/formEditMcuWithResult/' . md5($mcu['id']) . '/' . $mcu['medical_record_number']) ?>"><i class="far fa-edit"></i> Ubah</a>
														<a class="button-success" href="<?= base_url('mcu/downloadQRCodePng/' . $mcu['medical_record_number']) ?>">Unduh <i class="fas fa-qrcode"></i></a>
														<a class="button-info" href="<?= base_url('mcu/downloadMcuResultPdf/' . $mcu['medical_record_number']) ?>">Unduh <i class="far fa-file-pdf"></i></a>
														<a class="button-danger" href="<?= base_url('mcu/previewMcuResultPdf/' . $mcu['medical_record_number']) ?>">View <i class="fas fa-file-pdf"></i></a>
													<?php endif ?>
												<?php else : ?>
													<?php if ($mcu['type_examination'] == 'rev') : ?>
														<a class="button-success" href="<?= base_url('mcu/downloadQRCodePng/' . $mcu['medical_record_number']) ?>">Unduh <i class="fas fa-qrcode"></i></a>
														<a class="button-info" href="<?= base_url('mcu/downloadRevResultPdf/' . $mcu['medical_record_number']) ?>">Unduh <i class="far fa-file-pdf"></i></a>
														<a class="button-danger" href="<?= base_url('mcu/previewRevResultPdf/' . $mcu['medical_record_number']) ?>">View <i class="fas fa-file-pdf"></i></a>
													<?php else : ?>
														<a class="button-success" href="<?= base_url('mcu/downloadQRCodePng/' . $mcu['medical_record_number']) ?>">Unduh <i class="fas fa-qrcode"></i></a>
														<a class="button-info" href="<?= base_url('mcu/downloadMcuResultPdf/' . $mcu['medical_record_number']) ?>">Unduh <i class="far fa-file-pdf"></i></a>
														<a class="button-danger" href="<?= base_url('mcu/previewMcuResultPdf/' . $mcu['medical_record_number']) ?>">View <i class="fas fa-file-pdf"></i></a>
													<?php endif ?>
												<?php endif ?>
											<?php endif ?>
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

<!-- Modal Export Mcu -->
<div class="modal fade" id="exportMcu" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel">Ekspor Hasil Laboratorium</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" action="<?= base_url('mcu/downloadExcelReportMcu') ?>">
				<div class="modal-body">
					<div id="input-filters-date-export"></div>
					<div class="form-group">
						<label for="id_clinic" class="label-input-result">Klinik</label>
						<select class="form-control form-control-sm value-input-result" id="id_clinic" name="id_clinic">
							<option value="0">Semua Klinik</option>
							<?php foreach ($clinics as $clinic) : ?>
								<option value="<?= $clinic['id'] ?>">
									<?= $clinic['name'] ?>		
								</option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="form-group">
						<label class="label-input-result">Tanggal</label>
						<div id="reportrangeexport" class="form-control form-control-sm value-input-result" style="cursor: pointer;">
							<i class="fas fa-calendar-alt"></i>&nbsp;
							<span></span>
						</div>	
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-sm btn-info"><i class="fas fa-file-import"></i> Ekspor</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script src="<?= base_url('assets/daterangepicker/moment.min.js') ?>"></script>
<script src="<?= base_url('assets/daterangepicker/daterangepicker.js') ?>"></script>
<script>
	$(function() {

		let start = moment().startOf('month');
		let end = moment();

		function cb(start, end) {
			$('#reportrange span').html(start.format('DD-MM-YYYY') + ' s/d ' + end.format('DD-MM-YYYY'));
			$('#input-filters-date').empty();
			$('#input-filters-date').append(`
				<input type="hidden" name="filter-by-start-date" value="`+ start.format('YYYY-MM-DD') +`">
				<input type="hidden" name="filter-by-end-date" value="`+ end.format('YYYY-MM-DD') +`">`
        	);
		};

		$('#reportrange').daterangepicker({
			startDate: start,
			endDate: end,
			ranges: {
				'Today': [moment(), moment()],
				'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
				'Last 7 Days': [moment().subtract(6, 'days'), moment()],
				'Last 30 Days': [moment().subtract(29, 'days'), moment()],
				'This Month': [moment().startOf('month'), moment().endOf('month')],
				'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
			}
		}, cb);

		<?php if (!$this->session->userdata('filterByStartDate')) : ?>
			cb(start, end);
		<?php else : ?>
			cb(moment("<?= $this->session->userdata('filterByStartDate') ?> ?>"), moment("<?= $this->session->userdata('filterByEndDate') ?> ?>"));
		<?php endif ?>

		function cb2(start, end) {
			$('#reportrangeexport span').html(start.format('DD-MM-YYYY') + ' s/d ' + end.format('DD-MM-YYYY'));
			$('#input-filters-date-export').empty();
			$('#input-filters-date-export').append(`
				<input type="hidden" name="start-date" value="`+ start.format('YYYY-MM-DD') +`">
				<input type="hidden" name="end-date" value="`+ end.format('YYYY-MM-DD') +`">`
        	);
		};

		$('#reportrangeexport').daterangepicker({
			startDate: start,
			endDate: end,
			ranges: {
				'Today': [moment(), moment()],
				'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
				'Last 7 Days': [moment().subtract(6, 'days'), moment()],
				'Last 30 Days': [moment().subtract(29, 'days'), moment()],
				'This Month': [moment().startOf('month'), moment().endOf('month')],
				'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
			}
		}, cb2);
	});
</script>