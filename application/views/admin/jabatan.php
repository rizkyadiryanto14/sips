<?php $this->app->extend('template/admin') ?>

<?php $this->app->setVar('title', 'Jabatan') ?>

<?php $this->app->section() ?>

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-6">
                <div class="card-title">Data Jabatan</div>
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
            <table class="table table-hover" id="data-jabatan">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Jabatan</th>
                    <th>Keterangan</th>
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
                    <div class="modal-title">Tambah Jabatan</div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Jabatan</label><input type="text" class="form-control" name="nama_jabatan" placeholder="Masukkan Nama Jabatan" autocomplete="off">
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
                        <label>NIP</label><input type="text" class="form-control" name="nama_jabatan" placeholder="Masukkan Nama Jabatan" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Nama</label><input type="text" class="form-control" name="keterangan" placeholder="Masukkan Keterangan" autocomplete="off">
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
                    <div class="modal-title">Hapus Jabatan</div>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="id">
                    <p>Anda yakin menghapus jabatan <strong class="nama_jabatan">Nama Jabatan</strong> ?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" type="button" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
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
<script>
    $(document).ready(function() {

        function show() {
            $('#data-jabatan').DataTable().destroy();
            $('#data-jabatan').DataTable({
                "deferRender": true,
                "ajax": {
                    "url": base_url + "api/jabatan",
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
                        data: "nama_jabatan"
                    },
                    {
                        data :"keterangan"
                    },
                    {
                        data: null,
                        render: function(data) {
                            return `
							<div class="text-center">
								<button
									class="btn btn-edit btn-info btn-sm"
									type="button"
									data-toggle="modal"
									data-target="#edit"
									data-id="` + data.id + `"
									data-nama_jabatan="` + data.nama_jabatan + `"
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
									data-nama_jabatan="` + data.nama_jabatan + `"
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

            // Tampilkan overlay loading
            $('#loading-overlay').show();

            call('api/jabatan/create', $(this).serialize()).done(function(req) {
                if (req.error == true) {
                    notif(req.message, 'error', true);
                } else {
                    notif(req.message, 'success');
                    $('form#tambah [name]').val('');
                    $('div#tambah').modal('hide');
                    show();
                }
                $('#loading-overlay').hide();
            }).fail(function() {
                // Sembunyikan overlay loading jika terjadi error
                $('#loading-overlay').hide();
                alert('Terjadi kesalahan, silakan coba lagi.');
            });
        })

        $(document).on('click', 'button.btn-edit', function() {
            $('form#edit .id').val($(this).data('id'));
            $('form#edit [name=nama_jabatan]').val($(this).data('nama_jabatan'));
            $('form#edit [name=keterangan]').val($(this).data('keterangan'));
        })

        $(document).on('submit', 'form#edit', function(e) {
            e.preventDefault();

            $('#loading-overlay').show();

            const id = $('form#edit .id').val();
            call('api/jabatan/update/' + id, $(this).serialize()).done(function(req) {
                if (req.error == true) {
                    notif(req.message, 'error', true);
                } else {
                    notif(req.message, 'success');
                    $('form#edit [name]').val('');
                    $('div#edit').modal('hide');
                    show();
                }
                // Sembunyikan overlay loading setelah proses selesai
                $('#loading-overlay').hide();
            }).fail(function() {
                // Sembunyikan overlay loading jika terjadi error
                $('#loading-overlay').hide();
                alert('Terjadi kesalahan, silakan coba lagi.');
            });
        })

        $(document).on('click', 'button.btn-hapus', function() {
            $('form#hapus .id').val($(this).data('id'));
            $('form#hapus .nama_jabatan').html($(this).data('nama_jabatan'));
        })

        $(document).on('submit', 'form#hapus', function(e) {
            e.preventDefault();

            // Tampilkan overlay loading
            $('#loading-overlay').show();

            const id = $('form#hapus .id').val();
            call('api/jabatan/destroy/' + id).done(function(req) {
                if (req.error == true) {
                    notif(req.message, 'error', true);
                } else {
                    notif(req.message, 'success');
                    $('div#hapus').modal('hide');
                    show();
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
</script>
<?php $this->app->endSection('script') ?>

<?php $this->app->init() ?>
