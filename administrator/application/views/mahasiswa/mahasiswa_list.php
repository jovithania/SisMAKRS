	<section class="content-header">
		<h1>
			Sekolah Tinggi Teologi Tawangmangu
		</h1>
	</section>
	<section class="content">
		<div class="box">
			<div class="box-body">
				<div class="row" style="margin-bottom: 10px">
					<div class="col-md-4">
						<h2 style="margin-top:0px">Mahasiswa</h2>
					</div>
					<div class="col-md-4 text-center">
						<div style="margin-top: 4px" id="message">
							<?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
						</div>
					</div>
					<div class="col-md-4 text-right">
						<?php echo anchor(site_url('mahasiswa_control/create'), '<i class="fa fa-file-text" aria-hidden="true"></i>&nbsp;Create', 'class="btn btn-primary"'); ?>
					</div>
				</div>
				<table class="table table-bordered table-striped" id="mytable">
					<thead>
						<tr>
							<th width="30px">No</th>
							<th>NIM</th>
							<th>Nama Lengkap</th>
							<th>Alamat</th>
							<th>Email</th>
							<th>Telp</th>
							<th>Jenis Kelamin </th>
							<th width="200px">Action</th>
						</tr>
					</thead>

				</table>
				<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
				<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
				<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
				<script type="text/javascript">
					$(document).ready(function() {
						$.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
							return {
								"iStart": oSettings._iDisplayStart,
								"iEnd": oSettings.fnDisplayEnd(),
								"iLength": oSettings._iDisplayLength,
								"iTotal": oSettings.fnRecordsTotal(),
								"iFilteredTotal": oSettings.fnRecordsDisplay(),
								"iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
								"iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
							};
						};

						var JK = "jenis_kelamin";
						if (JK == "L") {
							tampilJK = "Laki-laki";
						} else {
							tampilJK = "Laki-laki";
						}


						var t = $("#mytable").dataTable({
							sDom: 'lrtip',
							initComplete: function() {
								var api = this.api();
								$('#mytable_filter input')
									.off('.DT')
									.on('keyup.DT', function(e) {
										if (e.keyCode == 13) {
											api.search(this.value).draw();
										}
									});
							},
							oLanguage: {
								sProcessing: "loading..."
							},
							processing: true,
							serverSide: true,
							ajax: {
								"url": "mahasiswa_control/json",
								"type": "POST"
							},
							columns: [{
									"data": "nim",
									"orderable": false
								},
								{
									"data": "nim"
								},
								{
									"data": "nama_lengkap"
								},
								{
									"data": "alamat"
								},
								{
									"data": "email"
								},
								{
									"data": "telp"
								},
								{
									"data": "jenisKelamin"
								},
								{
									"data": "action",
									"orderable": false,
									"className": "text-center"
								}
							],
							order: [
								[0, 'desc']
							],
							rowCallback: function(row, data, iDisplayIndex) {
								var info = this.fnPagingInfo();
								var page = info.iPage;
								var length = info.iLength;
								var index = page * length + (iDisplayIndex + 1);
								$('td:eq(0)', row).html(index);
							}
						});
					});
				</script>