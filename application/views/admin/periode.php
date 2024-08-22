<?php $this->app->extend('template/admin') ?>

<?php $this->app->setVar('title', 'Jadwal Skripsi') ?>

<?php $this->app->section() ?>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <div class="card-title">Data Periode</div>
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
                    <table class="table table-hover" id="data-periode">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Periode</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="tambah">
                <div class="modal-header">
                    <div class="modal-title">Tambah Periode</div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Periode</label><input type="text" class="form-control" name="periode" placeholder="Masukkan Periode" autocomplete="off">
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
                    <div class="form-group">
                        <label>Periode</label><input type="text" class="form-control" name="periode" placeholder="Masukkan Periode" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" id="status" class="form-control">
                            <option selected disabled>Pilih Status</option>
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
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
                    <div class="modal-title">Hapus Periode</div>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="id">
                    <p>Anda yakin menghapus Periode <strong class="periode">Periode</strong> ?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" type="button" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="setujui">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="setujui">
                <div class="modal-header">
                    <div class="modal-title">Status Periode</div>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="id">
                    <input type="hidden" class="status">
                    <p>Anda yakin <span class="status">mengaktifkan / batal mengaktifkan</span> Periode <strong class="judul">periode</strong> ?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" type="button" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-konfirmasi">Konfirmasi</button>
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

        function show() {
            $('#data-periode').DataTable().destroy();
            $('#data-periode').DataTable({
                "deferRender": true,
                "ajax": {
                    "url": base_url + "api/periode/admin_index",
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
                        data: "periode"
                    },
                    {
                        data: null,
                        render: function(data) {
                            if (data.status == '1') {
                                status = '\
                            <button class="btn btn-sm btn-setuju btn-success" type="button" data-id="' + data.id + '" data-periode="' + data.periode + '" data-status="' + data.status + '" data-toggle="modal" data-target="#setujui">\
                                Aktif\
                            </button>\
                            ';
                            } else {
                                status = '\
                            <button class="btn btn-sm btn-setuju btn-danger" type="button" data-id="' + data.id + '" data-periode="' + data.periode + '" data-status="' + data.status + '" data-toggle="modal" data-target="#setujui">\
                              Tidak Aktif\
                            </button>\
                            ';
                            }
                            return '\
                            <div>' + status + '</div>\
                            ';
                        }
                    },
                    {
                        data: null,
                        render: function(data) {
                            return `
							<div>
								<button
									class="btn btn-hapus btn-danger btn-sm"
									type="button"
									data-toggle="modal"
									data-target="#hapus"
									data-id="` + data.id + `"
									data-periode="` + data.periode + `"
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
            call('api/periode/create', $(this).serialize()).done(function(req) {
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

        $(document).on('click', 'button.btn-hapus', function() {
            $('form#hapus .id').val($(this).data('id'));
            $('form#hapus .periode').html($(this).data('periode'));
        })

        $(document).on('submit', 'form#hapus', function(e) {
            e.preventDefault();
            const id = $('form#hapus .id').val();
            call('api/periode/destroy/' + id).done(function(req) {
                if (req.error == true) {
                    notif(req.message, 'error', true);
                } else {
                    notif(req.message, 'success');
                    $('div#hapus').modal('hide');
                    show();
                }
            })
        })

        $(document).on('click', 'button.btn-setuju', function() {
            $('form#setujui .id').val($(this).data('id'));
            $('form#setujui input.status').val($(this).data('status'));
            $('form#setujui span.status').html(($(this).data('status') == '1') ? 'batal mengaktifkan' : 'mengaktifkan');
            $('form#setujui .judul').html($(this).data('periode'));
        })

        $(document).on('submit', 'form#setujui', function(e) {
            e.preventDefault();
            $(".btn-konfirmasi").attr('disabled', true).html('Loading...')
            const id = $('form#setujui .id').val();
            call('api/periode/' + (($('form#setujui .status').val() == '1') ? 'disagree' : 'agree') + '/' + id).done(function(req) {
                if (req.error == true) {
                    notif(req.message, 'error', true);
                    $(".btn-konfirmasi").attr('disabled', false).html('Konfirmasi')
                } else {
                    notif(req.message, 'success');
                    $('div#setujui').modal('hide');
                    show();
                    $(".btn-konfirmasi").attr('disabled', false).html('Konfirmasi')
                }
            })
        })
    })

</script>

<?php $this->app->endSection('script') ?>

<?php $this->app->init() ?>
