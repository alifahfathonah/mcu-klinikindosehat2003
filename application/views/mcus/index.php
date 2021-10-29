		<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
			<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
				<div class="flex-grow-1">
					<h1 class="h3 font-weight-bolder"><i>Laboratory Result</i></h1>
				</div>
				<?php if ($this->session->userdata('role') == 'superuser' || $this->session->userdata('role') == 'admin') : ?>
					<div>
						<form class="d-flex" action="<?= base_url('mcu/downloadExcelReportMcu') ?>" method="POST">
							<div id="input-filters-date">
								
							</div>
							<div>
								<select class="form-control" name="id_clinic" required>
									<?php foreach($clinics as $clinic) : ?>
										<option value="<?= $clinic['id'] ?>"><?= $clinic['name'] ?></option>
									<?php endforeach ?>
								</select>
							</div>
							<div>
								<div id="reportrange" class="form-control ml-2" style="cursor: pointer; width: 247.5px;">
									<i class="fas fa-calendar-alt"></i>&nbsp;
									<span></span>
								</div>	
							</div>
							<div>
								<button type="submit" class="btn btn-info ml-2">
									<i class="fas fa-file-export"></i> Export
								</button>
							</div>
						</form>
					</div>
				<?php endif ?>
			</div>

			<div class="table-responsive p-3">
				<table class="table table-hover" id="mcu_table" width="100%">
					<thead class="text-center">
						<tr>
							<th>#<br>No</th>
							<th>Nomor Rekam Medis<br><i>Medical Record Number</i></th>
							<th>Nama Pasien<br><i>Patient's Name</i></th>
							<th>KTP<br><i>ID Number</i></th>
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

		<script>
			$(document).ready(function() {
				$('#mcu_table').DataTable({
					"processing": true,
					"serverSide": true,
					"ajax": {
						"url": "<?= base_url('mcu/get_ajax_mcu') ?>",
						"type": "POST"
					},
					"columnDefs": [{
							"targets": [0],
							"className": 'text-center align-middle font-weight-bolder',
							"orderable": false
						},
						{
							"targets": [1],
							"className": 'text-center align-middle font-weight-bolder',
						},
						{
							"targets": [2],
							"className": 'align-middle'
						},
						{
							"targets": [3],
							"className": 'text-center align-middle',
						},
						{
							"targets": [4],
							"className": 'text-center align-middle',
							"orderable": false
						}
					]
				});
			});
		</script>

		<script src="<?= base_url('assets/daterangepicker/moment.min.js') ?>"></script>
		<script src="<?= base_url('assets/daterangepicker/daterangepicker.js') ?>"></script>

		<script>
			$(function() {

				var start = moment();
				var end = moment();

				function cb(start, end) {
					$('#reportrange span').html(start.format('DD-MM-YYYY') + ' s/d ' + end.format('DD-MM-YYYY'));
					$('#input-filters-date').empty();
					$('#input-filters-date').append(`
						<input type="hidden" name="start_date" value="`+ start.format('YYYY-MM-DD') +`">
						<input type="hidden" name="end_date" value="`+ end.format('YYYY-MM-DD') +`">`
		        	);
				}

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

			});
		</script>
