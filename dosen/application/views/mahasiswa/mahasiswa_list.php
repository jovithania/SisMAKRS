<section class="content-header">
	<h1>
		Sekolah Tinggi Teologi Tawangmangu

	</h1>
</section>
<!-- Main content -->
<section class="content">

	<!-- Default box -->
	<div class="box">
		<div class="box-body">

			<!-- Menampilkan Data Mahasiswa -->
			<div class="row" style="margin-bottom: 10px">
				<div class="col-md-4">
					<h2 style="margin-top:0px">Validasi KRS</h2>
				</div>
				<div class="col-md-4 text-center">
					<div style="margin-top: 4px" id="message">
						<?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
					</div>
				</div>
			</div>

			<center>
				<legend><strong>KARTU RENCANA STUDI</strong></legend>
				<table>
					<tr>
						<td><strong>NIM </strong></td>
						<td> &nbsp;: <?php echo $nim; ?></td>
					<tr>
					<tr>
						<td><strong>Nama </strong></td>
						<td> &nbsp;: <?php echo $nama_lengkap; ?> </td>
					</tr>
					<tr>
						<td><strong>Program Studi</strong></td>
						<td> &nbsp;: <?php echo $prodi; ?> </td>
					</tr>
					<tr>
						<td><strong>Tahun akademik(semester) </strong></td>
						<td> &nbsp;: <?php echo $thn_akad . '&nbsp;(' . $semester . ')'; ?> </td>
					</tr>
				</table>
			</center>
			<table class="table table-bordered table-striped" id="mytable">
				<thead>
					<tr>
						<th width="30px">No</th>
						<th width="130px">NIM</th>
						<th>Nama</th>
						<!-- <th>Alamat</th> -->
						<!-- <th>Email</th> -->
						<th>Status</th>
						<!-- <th>Jenis Kelamin </th> -->
						<th width="400px">Action</th>
					</tr>
				</thead>

			</table>
			<!-- Memanggil jQuery -->
			<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
			<!-- Memanggil jQuery data tables -->
			<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
			<!-- Memanggil Bootstrap data tables -->
			<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>

			<!-- JavaScript yang berfungsi untuk menampilkan data dari tabel mahasiswa dengan AJAX -->
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

					var nim = "nim";
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
						processing: false,
						serverSide: true,
						ajax: {
							"url": "krs_control/json",
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
							// {
							// 	"data": "alamat"
							// },
							// {
							// 	"data": "id_thn_akad"
							// },
							{
								"data": "status"
							},
							// {
							// 	"data": "jenisKelamin"
							// },
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
					// $('#mytable .nim').each(function() {
					// 	alert($(this).html());
					// });


					// $('#mytable tbody').on('click', 'button', function () {
					//   //var data = table.row($(this).closest('tr')).data();
					//   var data = table.row($(this).parents('tr')).data();
					//   alert(data[Object.keys(data)[0]]+' s phone: '+data[Object.keys(data)[1]]);
					// });

				});
			</script>


			<!--// Tampil Pop Up Detail KRS -->

			<div class="modal fade" id="myModal" role="dialog">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Detail KRS</h4>
						</div>
						<div class="modal-body">
							<div class="fetched-data"></div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
						</div>
					</div>
				</div>
			</div>

			<!-- <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script> -->
			<script type="text/javascript">
				$(document).ready(function() {
					$('#myModal').on('show.bs.modal', function(e) {
						var nim = $(e.relatedTarget).data('id');
						//menggunakan fungsi ajax untuk pengambilan data
						$.ajax({
							type: 'post',
							url: 'krs_control/lihatKrs',
							data: 'nim=' + nim,
							success: function(data) {
								$('.fetched-data').html(data); //menampilkan data ke dalam modal
							}
						});
					});
				});
			</script>