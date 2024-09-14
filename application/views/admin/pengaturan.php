<?php $this->app->extend('template/admin') ?>
<?php $this->app->setVar('title', 'Pengaturan') ?>
<?php $this->app->section() ?>
<form id="edit">
	<div class="row">
		<div class="col-md-4">
			<div class="card">
				<div class="card-header">
					<div class="card-title">Icon Aplikasi</div>
				</div>
				<div class="card-body">
					<div class="form-group">
						<img src="<?= base_url() ?>cdn/img/mahasiswa/default.png" style="max-height: 100%; max-width: 100%; width: 100%" class="icongambar">
					</div>
					<div class="form-group">
						<input type="file" class="form-control" name="pilih-icon">
						<input type="hidden" name="icon">
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<div class="card-title">Pengaturan Aplikasi</div>
				</div>
				<div class="card-body">
					<div class="form-group">
						<label>Nama</label>
						<input type="text" class="form-control" placeholder="Masukkan Nama" name="nama">
					</div>
					<div class="form-group">
						<label>Nama</label>
						<input type="text" class="form-control" placeholder="Masukkan Instansi" name="instansi">
					</div>
					<div class="form-group">
						<label>Informasi</label>
						<textarea name="informasi" rows="7" class="form-control summernote" placeholder="Masukkan Informasi"></textarea>
					</div>
				</div>
				<div class="card-footer text-right">
					<button type="submit" class="btn btn-primary">Simpan</button>
				</div>
			</div>
		</div>
	</div>
</form>
<?php foreach ($dataEmail as $de) { ?>
	<form action="<?= base_url('atur-send-email'); ?>" method="POST">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<div class="head-title">Send Email Setting</div>
					</div>
					<div class="card-body">
						<input type="hidden" name="id" value="<?= $de->id; ?>">
						<div class="form-group">
							<label for="smtp_host">SMTP Host</label>
							<input type="text" autocomplete="off" name="smtp_host" id="smtp_host" class="form-control" required value="<?= $de->smtp_host; ?>">
						</div>
						<div class="form-group">
							<label for="smtp_port">SMTP Port</label>
							<input type="text" autocomplete="off" name="smtp_port" id="smtp_port" class="form-control" required value="<?= $de->smtp_port; ?>">
						</div>
						<div class="form-group">
							<label for="account_gmail">Akun Mail</label>
							<input type="email" autocomplete="off" name="smtp_user" id="account_gmail" class="form-control" required value="<?= $de->email; ?>">
						</div>
						<div class="form-group">
							<label for="pass_gmail">Password Mail</label>
							<input type="password" autocomplete="off" name="smtp_password" id="pass_gmail" class="form-control" required value="<?= $de->password; ?>">
						</div>
						<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Perubahan</button>
					</div>
				</div>
			</div>
		</div>
	</form>
<?php } ?>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="text-left">
                  <div class="head-title pb-2">Setingan Komponen <small class="badge badge-danger">Belum Aktif</small></div>
                </div>
                <button class="btn btn-primary" data-toggle="modal" type="button" data-target="#tambah">Tambah</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="data-komponen">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Action</th>
                            <th>Komponen</th>
                            <th>Keterangan</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="text-left">
                    <div class="head-title pb-2">Setingan Bobot <small class="badge badge-danger">Belum Aktif</small></div>
                </div>
                <button class="btn btn-primary" data-toggle="modal" type="button" data-target="#tambahbobot">Tambah</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="data-bobot">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Action</th>
                            <th>Bobot</th>
                            <th>Keterangan</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="text-left">
                    <div class="head-title pb-2">Setingan Kuota Bimbingan Dosen</div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="data-bimbingan">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nilai</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="text-left">
                    <div class="head-title pb-2">Setingan Dosen Pembimbing</div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="data-dospem">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nilai</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="text-left">
                    <div class="head-title pb-2">Setingan Predikat Penilaian</div>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#tambahpredikat">Tambah Predikat</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="data-predikat">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Minimum Nilai</th>
                            <th>Maximum Nilai</th>
                            <th>Predikat Penilaian</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="modal fade" id="tambahpredikat">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="tambahpredikat">
                    <div class="modal-header">
                        <div class="modal-title">Form Tambah Predikat Penilaian</div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_predikat">Nama Predikat</label>
                            <input type="text" name="nama_predikat" id="nama_predikat" class="form-control" autocomplete="off" placeholder="contoh A">
                        </div>
                        <div class="form-group">
                            <label for="nilai_minimum">Nilai Minimum</label>
                            <input type="number" name="nilai_minimum" id="nilai_minimum" class="form-control" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="nilai_maximum">Nilai Maximum</label>
                            <input type="number" name="nilai_maximum" id="nilai_maximum" class="form-control" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" name="keterangan" id="keterangan" class="form-control" autocomplete="off" placeholder="contoh predikat ini untuk nilai">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="hapuspredikat">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">Form Hapus Predikat</div>
                </div>
                <form id="hapuspredikat">
                    <div class="modal-body">
                        <input type="hidden" class="id">
                        <p>Anda yakin menghapus predikat <strong class="nama_predikat">Nama Predikat</strong> ?</p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-danger" type="submit">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="tambah">
        <div class="modal-dialog">
            <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">Tambah Komponen</div>
                    </div>
                <form id="tambah">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Komponen Penilaian</label><input type="text" class="form-control" name="komponen_penilaian" placeholder="Masukkan Komponen Penilaian" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label><input type="text" class="form-control" name="keterangan" placeholder="Masukkan Keterangan" autocomplete="off">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default" type="button" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="tambahbobot">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">Tambah Bobot</div>
                </div>
                <form id="tambahbobot">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Bobot Penilaian</label><input type="text" class="form-control" name="bobot_penilaian" placeholder="Masukkan Bobot Penilaian" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label><input type="text" class="form-control" name="keterangan" placeholder="Masukkan Keterangan" autocomplete="off">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default" type="button" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editbobot">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editbobot">
                    <div class="modal-header">
                        <div class="modal-title">Edit Bobot Penilaian</div>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" class="id">
                        <div class="form-group">
                            <label>Bobot Penilaian</label><input type="text" class="form-control" name="bobot_penilaian" placeholder="Masukkan Bobot" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label><input type="text" class="form-control" name="keterangan" placeholder="Masukkan Keterangan" autocomplete="off">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default" type="button" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editkomponen">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editkomponen">
                    <div class="modal-header">
                        <div class="modal-title">Edit Komponen Penilaian</div>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" class="id">
                        <div class="form-group">
                            <label>Komponen Penilaian</label><input type="text" class="form-control" name="komponen_penilaian" placeholder="Masukkan Nama Komponen" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label><input type="text" class="form-control" name="keterangan" placeholder="Masukkan Keterangan" autocomplete="off">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default" type="button" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="hapus">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="hapus">
                    <div class="modal-header">
                        <div class="modal-title">Hapus Komponen Penilaian</div>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" class="id">
                        <p>Anda yakin menghapus komponen penilaian <strong class="komponen_penilaian">Komponen Penilaian</strong> ?</p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default" type="button" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="hapusbobot">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="hapusbobot">
                    <div class="modal-header">
                        <div class="modal-title">Hapus Bobot Penilaian</div>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" class="id">
                        <p>Anda yakin menghapus bobot penilaian <strong class="bobot_penilaian">Bobot Penilaian</strong> ?</p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default" type="button" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editdospem">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editdospem" method="post">
                <div class="modal-header">
                    <div class="modal-title">
                        Update jumlah dosen pembimbing
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" class="id">
                        <label for="nilai">Nilai</label>
                        <input type="text" name="nilai" id="nilai" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" type="button" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

    <div class="modal fade" id="editbimbingan">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editbimbingan" method="post">
                    <div class="modal-header">
                        <div class="modal-title">
                            Update Kuota Dosen Pembimbing
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" class="id">
                            <label for="nilai">Nilai</label>
                            <input type="text" name="nilai" id="nilai" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default" type="button" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id="loading-overlay" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:9999; text-align:center; color:white;">
        <div style="position:absolute; top:50%; left:50%; transform:translate(-50%, -50%);">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <p>Memproses...</p>
        </div>
    </div>
<?php $this->app->endSection('content') ?>

<?php $this->app->section() ?>
    <link rel="stylesheet" href="<?= base_url() ?>cdn/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <script src="<?= base_url() ?>cdn/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>cdn/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>

    <link rel="stylesheet" href="<?= base_url() ?>cdn/plugins/summernote/summernote-lite.min.css">
    <script src="<?= base_url() ?>cdn/plugins/summernote/summernote-lite.min.js"></script>
    <script src="<?= base_url() ?>cdn/plugins/canvas-resize/jquery.canvasResize.js"></script>
    <script src="<?= base_url() ?>cdn/plugins/canvas-resize/jquery.exif.js"></script>
    <script src="<?= base_url() ?>cdn/plugins/canvas-resize/canvasResize.js"></script>
    <script src="<?= base_url() ?>cdn/plugins/canvas-resize/exif.js"></script>
    <script src="<?= base_url() ?>cdn/plugins/canvas-resize/binaryajax.js"></script>
    <script src="<?= base_url() ?>cdn/plugins/canvas-resize/zepto.min.js"></script>
<script>
	$(document).ready(function() {

		$('.summernote').summernote({
			height: 200
		})

        function showkomponen() {
            $('#data-komponen').DataTable().destroy();
            $('#data-komponen').DataTable({
                "deferRender": true,
                "ajax": {
                    "url": base_url + "api/komponen",
                    "method": "POST",
                    "dataSrc": "data"
                },
                "columns": [{
                    data: null,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                    {
                        data: null,
                        render: function(data) {
                            return `
							<div class="">
								<button
									class="btn btn-editkomponen btn-info btn-sm"
									type="button"
									data-toggle="modal"
									data-target="#editkomponen"
									data-id="` + data.id + `"
									data-komponen_penilaian="` + data.komponen_penilaian + `"
									data-keterangan="` + data.keterangan + `"
								>
									<i class="fa fa-pen"></i>
								</button>
								<button
									class="btn btn-hapus btn-danger btn-sm"
									type="button"
									data-toggle="modal"
									data-target="#hapus"
									data-id="` + data.id + `"
									data-komponen_penilaian="` + data.komponen_penilaian + `">
									<i class="fa fa-trash"></i>
								</button>
							</div>
							`;
                        }
                    },
                    {
                        data: "komponen_penilaian"
                    },
                    {
                        data :"keterangan"
                    }
                ]
            })
        }

        function showBobot() {
            $('#data-bobot').DataTable().destroy();
            $('#data-bobot').DataTable({
                "deferRender": true,
                "ajax": {
                    "url": base_url + "api/bobot_penilaian",
                    "method": "POST",
                    "dataSrc": "data"
                },
                "columns": [{
                    data: null,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                    {
                        data: null,
                        render: function(data) {
                            return `
							<div class="">
								<button
									class="btn btn-editbobot btn-info btn-sm"
									type="button"
									data-toggle="modal"
									data-target="#editbobot"
									data-id="` + data.id + `"
									data-bobot_penilaian="` + data.bobot_penilaian + `"
									data-keterangan="` + data.keterangan + `"
								>
									<i class="fa fa-pen"></i>
								</button>
								<button
									class="btn btn-hapusbobot btn-danger btn-sm"
									type="button"
									data-toggle="modal"
									data-target="#hapusbobot"
									data-id="` + data.id + `"
									data-bobot_penilaian="` + data.bobot_penilaian + `">
									<i class="fa fa-trash"></i>
								</button>
							</div>
							`;
                        }
                    },
                    {
                        data: "bobot_penilaian"
                    },
                    {
                        data :"keterangan"
                    }
                ]
            })
        }

        showBobot()
        showkomponen();

        $(document).on('submit', 'form#tambah', function(e) {
            e.preventDefault();
            call('api/komponen/create', $(this).serialize()).done(function(req) {
                if (req.error == true) {
                    notif(req.message, 'error', true);
                } else {
                    notif(req.message, 'success');
                    $('form#tambah [name]').val('');
                    $('div#tambah').modal('hide');
                    showkomponen();
                }
            })
        })

        $(document).on('submit', 'form#tambahbobot', function(e) {
            e.preventDefault();
            $('#loading-overlay').show();
            call('api/bobot_penilaian/create', $(this).serialize()).done(function(req) {
                if (req.error == true) {
                    notif(req.message, 'error', true);
                } else {
                    notif(req.message, 'success');
                    $('form#tambahbobot [name]').val('');
                    $('div#tambahbobot').modal('hide');
                    showBobot();
                }
                $('#loading-overlay').hide();
            }).fail(function() {
                // Sembunyikan overlay loading jika terjadi error
                $('#loading-overlay').hide();
                alert('Terjadi kesalahan, silakan coba lagi.');
            });
        })


        function show() {
			call('api/pengaturan').done(function(res) {
				if (res.error == true) {
					notif(res.message, 'warning').then(function() {
						window.location = window.location.href;
					})
				} else {
					$('[name=nama]').val(res.data.nama);
					$('[name=instansi]').val(res.data.instansi);
					$('[name=informasi]').val(res.data.informasi);
					$('.note-editable').html(res.data.informasi);
					$('img.icongambar').attr('src', base_url + 'cdn/img/icons/' + (res.data.icon ? res.data.icon : 'default.png'));
				}
			})
		}

		show();

		$(document).on('change', '[name=pilih-icon]', function() {
			canvasResize(this.files[0], {
				width: 500,
				height: 500,
				crop: false,
				quality: 200,
				rotate: 0,
				callback: function(data) {
					$('[name=icon]').val(data);
					$('img.icongambar').attr('src', data);
				}
			})
		})


        // section untuk edit komponen
        $(document).on('click', 'button.btn-editkomponen', function() {
            $('form#editkomponen .id').val($(this).data('id'));
            $('form#editkomponen [name=komponen_penilaian]').val($(this).data('komponen_penilaian'));
            $('form#editkomponen [name=keterangan]').val($(this).data('keterangan'));
        })

        $(document).on('submit', 'form#editkomponen', function(e) {
            e.preventDefault();
            $('#loading-overlay').show();
            const id = $('form#editkomponen .id').val();
            call('api/komponen/update/'+ id, $(this).serialize()).done(function(req) {
                if (req.error == true) {
                    notif(req.message, 'error', true);
                } else {
                    notif(req.message, 'success');
                    $('form#editkomponen [name]').val('');
                    $('div#editkomponen').modal('hide');
                    showkomponen();
                }
                $('#loading-overlay').hide();

            }).fail(function() {
                // Sembunyikan overlay loading jika terjadi error
                $('#loading-overlay').hide();
                alert('Terjadi kesalahan, silakan coba lagi.');
            });
        })

        // end untuk section edit komponen


        // section untuk edit bobot
        $(document).on('click', 'button.btn-editbobot', function() {
            $('form#editbobot .id').val($(this).data('id'));
            $('form#editbobot [name=bobot_penilaian]').val($(this).data('bobot_penilaian'));
            $('form#editbobot [name=keterangan]').val($(this).data('keterangan'));
        })

        $(document).on('submit', 'form#editbobot', function(e) {
            e.preventDefault();
            const id = $('form#editbobot .id').val();
            call('api/bobot_penilaian/update/'+ id, $(this).serialize()).done(function(req) {
                if (req.error == true) {
                    notif(req.message, 'error', true);
                } else {
                    notif(req.message, 'success');
                    $('form#editbobot [name]').val('');
                    $('div#editbobot').modal('hide');
                    showBobot();
                }
            })
        })
        // end untuk section edit bobot

        $(document).on('submit', 'form#edit', function(e) {
			e.preventDefault();
			const data = {
				nama: $('[name=nama]').val(),
				instansi: $('[name=instansi]').val(),
				icon: $('[name=icon]').val(),
				informasi: $('.note-editable').html()
			};
			call('api/pengaturan/edit', data).done(function(res) {
				if (res.error == true) {
					notif(res.message, 'error', true);
				} else {
					notif(res.message, 'success').then(function() {
						window.location = window.location.href;
					})
				}
			})
		})


        $(document).on('click', 'button.btn-hapus', function() {
            $('form#hapus .id').val($(this).data('id'));
            $('form#hapus .komponen_penilaian').html($(this).data('komponen_penilaian'));
        })

        $(document).on('submit', 'form#hapus', function(e) {
            e.preventDefault();
            $('#loading-overlay').show();
            const id = $('form#hapus .id').val();
            call('api/komponen/destroy/'+ id).done(function(req) {
                if (req.error == true) {
                    notif(req.message, 'error', true);
                } else {
                    notif(req.message, 'success');
                    $('div#hapus').modal('hide');
                    showkomponen();
                }
                $('#loading-overlay').hide();
            }).fail(function() {
                // Sembunyikan overlay loading jika terjadi error
                $('#loading-overlay').hide();
                alert('Terjadi kesalahan, silakan coba lagi.');
            });
        })


        $(document).on('click', 'button.btn-hapusbobot', function() {
            $('form#hapusbobot .id').val($(this).data('id'));
            $('form#hapusbobot .bobot_penilaian').html($(this).data('bobot_penilaian'));
        })

        $(document).on('submit', 'form#hapusbobot', function(e) {
            e.preventDefault();
            const id = $('form#hapusbobot .id').val();
            call('api/bobot_penilaian/destroy/'+ id).done(function(req) {
                if (req.error == true) {
                    notif(req.message, 'error', true);
                } else {
                    notif(req.message, 'success');
                    $('div#hapusbobot').modal('hide');
                    showBobot();
                }
            })
        })

    })

    $(document).ready(function (){
        function showDospem() {
            $('#data-dospem').DataTable().destroy();
            $('#data-dospem').DataTable({
                "deferRender": true,
                "ajax": {
                    "url": base_url + "api/kuota_dospem",
                    "method": "POST",
                    "dataSrc": "data"
                },
                "columns": [{
                    data: null,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                    {
                        data: "nilai"
                    },
                    {
                        data: null,
                        render: function(data) {
                            return `
							<div class="">
								<button
									class="btn btn-editdospem btn-info btn-sm"
									type="button"
									data-toggle="modal"
									data-target="#editdospem"
									data-id="` + data.id + `"
									data-nilai="` + data.nilai + `"
								>
									<i class="fa fa-pen"></i>
								</button>
							</div>
							`;
                        }
                    },
                ]
            })
        }

        $(document).on('click', 'button.btn-editdospem', function() {
            $('form#editdospem .id').val($(this).data('id'));
            $('form#editdospem [name=nilai]').val($(this).data('nilai'));
        })

        $(document).on('submit', 'form#editdospem', function(e) {
            e.preventDefault();
            const id = $('form#editdospem .id').val();
            call('api/kuota_dospem/update/' + id, $(this).serialize()).done(function(req) {
                if (req.error == true) {
                    notif(req.message, 'error', true);
                } else {
                    notif(req.message, 'success');
                    $('form#editdospem [name]').val('');
                    $('div#editdospem').modal('hide');
                    showDospem();
                }
            })
        })
        showDospem();
    })

    $(document).ready(function (){
        function showSettingPredikat() {
            $('#data-predikat').DataTable().destroy();
            $('#data-predikat').DataTable({
                "deferRender": true,
                "ajax": {
                    "url": base_url + "api/predikat_penilaian",
                    "method": "POST",
                    "dataSrc": "data"
                },
                "columns": [{
                    data: null,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                    {
                      data:"nilai_minimum"
                    },
                    {
                      data:"nilai_maximum"
                    },
                    {
                        data: "nama_predikat"
                    },
                    {
                      data: "keterangan"
                    },
                    {
                        data: null,
                        render: function(data) {
                            return `
							<div class="">
								<button
									class="btn btn-hapuspredikat btn-danger btn-sm"
									type="button"
									data-toggle="modal"
									data-target="#hapuspredikat"
									data-id="` + data.id + `"
									data-nama_predikat="` + data.nama_predikat + `"
								>
									<i class="fa fa-trash"></i>
								</button>
							</div>
							`;
                        }
                    },
                ]
            })
        }

        $(document).on('submit', 'form#tambahpredikat', function(e) {
            e.preventDefault();

            $('#loading-overlay').show();

            call('api/predikat_penilaian/create', $(this).serialize()).done(function(req) {
                if (req.error == true) {
                    notif(req.message, 'error', true);
                } else {
                    notif(req.message, 'success');
                    $('form#tambahpredikat [name]').val('');
                    $('div#tambahpredikat').modal('hide');
                    showSettingPredikat();
                }
                // Sembunyikan overlay loading setelah proses selesai
                $('#loading-overlay').hide();
            }).fail(function() {
                // Sembunyikan overlay loading jika terjadi error
                $('#loading-overlay').hide();
                alert('Terjadi kesalahan, silakan coba lagi.');
            });
        })
        showSettingPredikat();

        $(document).on('click', 'button.btn-hapuspredikat', function() {
            $('form#hapuspredikat .id').val($(this).data('id'));
            $('form#hapuspredikat .nama_predikat').html($(this).data('nama_predikat'));
        })

        $(document).on('submit', 'form#hapuspredikat', function(e) {
            e.preventDefault();
            $('#loading-overlay').show();
            const id = $('form#hapuspredikat .id').val();
            call('api/predikat_penilaian/destroy/'+ id).done(function(req) {
                if (req.error == true) {
                    notif(req.message, 'error', true);
                } else {
                    notif(req.message, 'success');
                    $('div#hapuspredikat').modal('hide');
                    showSettingPredikat();
                }
                // Sembunyikan overlay loading setelah proses selesai
                $('#loading-overlay').hide();
            }).fail(function() {
                // Sembunyikan overlay loading jika terjadi error
                $('#loading-overlay').hide();
                alert('Terjadi kesalahan, silakan coba lagi.');
            });
        })
    })

    $(document).ready(function (){
        function showBimbingan() {
            $('#data-bimbingan').DataTable().destroy();
            $('#data-bimbingan').DataTable({
                "deferRender": true,
                "ajax": {
                    "url": base_url + "api/kuota_bimbingan",
                    "method": "POST",
                    "dataSrc": "data"
                },
                "columns": [{
                    data: null,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                    {
                        data: "nilai"
                    },
                    {
                        data: null,
                        render: function(data) {
                            return `
							<div class="">
								<button
									class="btn btn-editbimbingan btn-info btn-sm"
									type="button"
									data-toggle="modal"
									data-target="#editbimbingan"
									data-id="` + data.id + `"
									data-nilai="` + data.nilai + `"
								>
									<i class="fa fa-pen"></i>
								</button>
							</div>
							`;
                        }
                    },
                ]
            })
        }

        $(document).on('click', 'button.btn-editbimbingan', function() {
            $('form#editbimbingan .id').val($(this).data('id'));
            $('form#editbimbingan [name=nilai]').val($(this).data('nilai'));
        })

        $(document).on('submit', 'form#editbimbingan', function(e) {
            e.preventDefault();

            $('#loading-overlay').show();

            const id = $('form#editbimbingan .id').val();
            call('api/kuota_bimbingan/update/' + id, $(this).serialize()).done(function(req) {
                if (req.error == true) {
                    notif(req.message, 'error', true);
                } else {
                    notif(req.message, 'success');
                    $('form#editbimbingan [name]').val('');
                    $('div#editbimbingan').modal('hide');
                    showBimbingan();
                }
                // Sembunyikan overlay loading setelah proses selesai
                $('#loading-overlay').hide();
            }).fail(function() {
                // Sembunyikan overlay loading jika terjadi error
                $('#loading-overlay').hide();
                alert('Terjadi kesalahan, silakan coba lagi.');
            });
        })
        showBimbingan();
    })
</script>
<?php $this->app->endSection('script') ?>

<?php $this->app->init() ?>