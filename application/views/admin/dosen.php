<?php $this->app->extend('template/admin') ?>

<?php $this->app->setVar('title', 'Dosen') ?>

<?php $this->app->section() ?>
<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col-6">
				<div class="card-title">Data Dosen</div>
			</div>
			<div class="col-6 text-right">
				<button class="btn btn-primary" type="button" data-toggle="modal" data-target="#tambah">
					<i class="fa fa-plus"></i>
					Tambah
				</button>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-hover" id="data-dosen">
				<thead>
					<tr>
						<th>No</th>
						<th>NIP</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Fokus</th>
                        <th>No.Japung</th>
                        <th>Tema Riset</th>
						<th>Nomor Telepon</th>
						<th>Email</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>
<div class="modal fade" id="tambah">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="tambah">
				<div class="modal-header">
					<div class="modal-title">Tambah Dosen</div>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>NIP</label><input type="text" class="form-control" name="nip" placeholder="Masukkan NIP" autocomplete="off">
					</div>
					<div class="form-group">
						<label>Nama</label><input type="text" class="form-control" name="nama" placeholder="Masukkan Nama" autocomplete="off">
					</div>
                   <div class="form-group">
                       <label for="jabatan">Jabatan</label>
                       <select name="id_jabatan" class="form-control" id="jabatan">
                           <option value="">- Pilih Jabatan -</option>
                       </select>
                   </div>
					<div class="form-group">
						<label>Nomor Telepon</label><input type="text" class="form-control" name="nomor_telepon" placeholder="Masukkan Nomor Telepon" autocomplete="off">
					</div>
					<div class="form-group">
						<label>Email</label><input type="email" class="form-control" name="email" placeholder="Masukkan Email" autocomplete="off">
					</div>
                    <div class="form-group">
                        <label for="no_japung">Nomor Japung</label>
                        <input type="text" name="no_japung" id="no_japung" class="form-control" placeholder="Masukan Nomor Japung" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="tema_riset">Tema Riset</label>
                        <input type="text" name="tema_riset" id="tema_riset" class="form-control" placeholder="MasukanTema Riset" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="fokus">Fokus Studi</label>
                        <input type="text" name="fokus" id="fokus" class="form-control" placeholder="Masukan Fokus Studi" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Masukan Password" autocomplete="off">
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

<div class="modal fade" id="edit">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="edit">
				<div class="modal-header">
					<div class="modal-title">Edit Dosen</div>
				</div>
				<div class="modal-body">
					<input type="hidden" class="id">
					<div class="form-group">
						<label>NIP</label><input type="text" class="form-control" name="nip" placeholder="Masukkan NIP" autocomplete="off">
					</div>
					<div class="form-group">
						<label>Nama</label><input type="text" class="form-control" name="nama" placeholder="Masukkan Nama" autocomplete="off">
					</div>
                    <div class="form-group">
                        <label for="jabatan">Jabatan</label>
                        <select name="id_jabatan" class="form-control">
                            <option value="">- Pilih Jabatan -</option>
                        </select>
                    </div>
					<div class="form-group">
						<label>Nomor Telepon</label><input type="text" class="form-control" name="nomor_telepon" placeholder="Masukkan Nomor Telepon" autocomplete="off">
					</div>
					<div class="form-group">
						<label>Email</label><input type="email" class="form-control" name="email" placeholder="Masukkan Email" autocomplete="off">
					</div>
                    <div class="form-group">
                        <label for="no_japung">Nomor Japung</label>
                        <input type="text" name="no_japung" id="no_japung" class="form-control" placeholder="Masukan Nomor Japung" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="tema_riset">Tema Riset</label>
                        <input type="text" name="tema_riset" id="tema_riset" class="form-control" placeholder="MasukanTema Riset" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="fokus">Fokus Studi</label>
                        <input type="text" name="fokus" id="fokus" class="form-control" placeholder="Masukan Fokus Studi" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Masukan Password" autocomplete="off">
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
					<div class="modal-title">Hapus Dosen</div>
				</div>
				<div class="modal-body">
					<input type="hidden" class="id">
					<p>Anda yakin menghapus dosen <strong class="nama">Nama Dosen</strong> ?</p>
				</div>
				<div class="modal-footer">
					<button class="btn btn-default" typpe="button" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-danger">Hapus</button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php $this->app->endSection('content') ?>

<?php $this->app->section() ?>
<link rel="stylesheet" href="<?= base_url() ?>cdn/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<script src="<?= base_url() ?>cdn/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>cdn/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script>
	$(document).ready(function() {

        call('api/jabatan').done(function(req) {
            let jabatan = '<option value="">- Pilih Jabatan -</option>';
            if (req.data) {
                req.data.forEach(obj => {
                    jabatan += '<option value="'+obj.id+'">'+obj.nama_jabatan+'</option>'
                })
            }
            $('[name=id_jabatan]').html(jabatan);
        })

		function show() {
			$('#data-dosen').DataTable().destroy();
			$('#data-dosen').DataTable({
				"deferRender": true,
				"ajax": {
					"url": base_url + "api/dosen",
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
						data: "nip"
					},
                    {
                        data: "nama"
                    },
                    {
                        data : "jabatan",
                        render : function(data) {
                            return data.nama_jabatan
                        }
                    },
                    {
                      data :"fokus"
                    },
                    {
                        data : "no_japung"
                    },
                    {
                        data : "tema_riset"
                    },
					{
						data: "nomor_telepon",
						render: function(data) {
							return '<a href="tel:' + data + '">' + data + '</a>';
						}
					},
					{
						data: "email",
						render: function(data) {
							return '<a href="mailto:' + data + '">' + data + '</a>';
						}
					},
					{
						data: null,
						render: function(data) {
							return `
							<div class="text-center">
								<a 
									class="btn btn-edit btn-primary btn-sm" 
									href="` + base_url + 'lihat-selengkapnya/' + data.id + `"
								>
									Lihat <i class="fa fa-chevron-right"></i>
								</a>
								<button 
									class="btn btn-edit btn-info btn-sm" 
									type="button" 
									data-toggle="modal" 
									data-target="#edit"
									data-id="` + data.id + `"
									data-nip="` + data.nip + `"
									data-nama="` + data.nama + `"
									data-nomor_telepon="` + data.nomor_telepon + `"
									data-email="` + data.email + `"
                                    data-fokus="` + data.fokus + `"
                                    data-tema_riset="` + data.tema_riset + `"
                                    data-no_japung="` + data.no_japung + `"
                                    data-password="` + data.password + `"
                                    data-id_jabatan="` + data.id_jabatan + `"
								>
									<i class="fa fa-pen"></i>
								</button>
								<button 
									class="btn btn-hapus btn-danger btn-sm" 
									type="button" 
									data-toggle="modal" 
									data-target="#hapus"
									data-id="` + data.id + `"
									data-nama="` + data.nama + `"
								>
									<i class="fa fa-trash"></i>
								</button>
							</div>
							`;
						}
					}
				]
			})
		}

		show();

		$(document).on('submit', 'form#tambah', function(e) {
			e.preventDefault();
			call('api/dosen/create', $(this).serialize()).done(function(req) {
				if (req.error == true) {
					notif(req.message, 'error', true);
				} else {
					notif(req.message, 'success');
					$('form#tambah [name]').val('');
					$('div#tambah').modal('hide');
					show();
				}
			})
		})

        $(document).on('click', 'button.btn-edit', function() {
			$('form#edit .id').val($(this).data('id'));
			$('form#edit [name=nip]').val($(this).data('nip'));
			$('form#edit [name=nama]').val($(this).data('nama'));
			$('form#edit [name=nomor_telepon]').val($(this).data('nomor_telepon'));
			$('form#edit [name=email]').val($(this).data('email'));
            $('form#edit [name=no_japung]').val($(this).data('no_japung'));
            $('form#edit [name=fokus]').val($(this).data('fokus'));
            $('form#edit [name=tema_riset]').val($(this).data('tema_riset'));
            $('form#edit [name=id_jabatan]').val($(this).data('id_jabatan'));
		})

		$(document).on('submit', 'form#edit', function(e) {
			e.preventDefault();
			const id = $('form#edit .id').val();
			call('api/dosen/update/' + id, $(this).serialize()).done(function(req) {
				if (req.error == true) {
					notif(req.message, 'error', true);
				} else {
					notif(req.message, 'success');
					$('form#edit [name]').val('');
					$('div#edit').modal('hide');
					show();
				}
			})
		})

		$(document).on('click', 'button.btn-hapus', function() {
			$('form#hapus .id').val($(this).data('id'));
			$('form#hapus .nama').html($(this).data('nama'));
		})

		$(document).on('submit', 'form#hapus', function(e) {
			e.preventDefault();
			const id = $('form#hapus .id').val();
			call('api/dosen/destroy/' + id).done(function(req) {
				if (req.error == true) {
					notif(req.message, 'error', true);
				} else {
					notif(req.message, 'success');
					$('div#hapus').modal('hide');
					show();
				}
			})
		})

	})
</script>
<?php $this->app->endSection('script') ?>

<?php $this->app->init() ?>