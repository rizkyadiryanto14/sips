<?php $this->app->extend('template/admin') ?>

<?php $this->app->setVar('title', 'Daftar Judul') ?>

<?php $this->app->section() ?>

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-6">
                <div class="card-title">Daftar Judul</div>
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
            <table class="table table-hover" id="data-daftarjudul">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nim</th>
                    <th>Judul Skripsi</th>
                    <th>Nama</th>
                    <th>Abstrak</th>
                    <th>Tahun Lulus</th>
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
                    <div class="modal-title">Tambah Daftar Judul</div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nim">Nim</label>
                        <input type="text" name="nim" id="nim" class="form-control" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="judul_skripsi">Judul Skripsi</label>
                        <input type="text" name="judul_skripsi" id="judul_skripsi" class="form-control" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Mahasiswa</label>
                        <input type="text" name="nama" id="nama" class="form-control" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="abstrak">Abstrak</label>
                        <input type="text" name="abstrak" id="abstrak" class="form-control" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="tahun_lulus">Tahun Lulus</label>
                        <input type="text" name="tahun_lulus" id="tahun_lulus" class="form-control" autocomplete="off">
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
                    <div class="modal-title">Tambah Daftar Judul</div>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="id">
                    <div class="form-group">
                        <label for="nim">Nim</label>
                        <input type="text" name="nim" id="nim" class="form-control" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="judul_skripsi">Judul Skripsi</label>
                        <input type="text" name="judul_skripsi" id="judul_skripsi" class="form-control" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Mahasiswa</label>
                        <input type="text" name="nama" id="nama" class="form-control" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="abstrak">Abstrak</label>
                        <input type="text" name="abstrak" id="abstrak" class="form-control" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="tahun_lulus">Tahun Lulus</label>
                        <input type="text" name="tahun_lulus" id="tahun_lulus" class="form-control" autocomplete="off">
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
                    <div class="modal-title">Hapus Daftar Judul</div>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="id">
                    <p>Anda yakin menghapus dosen <strong class="nama">Nama Mahasiswa</strong> ?</p>
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
        function show() {
            $('#data-daftarjudul').DataTable().destroy();
            $('#data-daftarjudul').DataTable({
                "deferRender": true,
                "ajax": {
                    "url": base_url + "api/daftar_judul",
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
                        data: "nim"
                    },
                    {
                        data :"judul_skripsi"
                    },
                    {
                        data :"nama"
                    },
                    {
                        data :"abstrak"
                    },
                    {
                        data :"tahun_lulus"
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
                                data-nama="` + data.nama + `"
                                data-judul_skripsi="` + data.judul_skripsi + `"
                                data-nim="` + data.nim + `"
                                data-tahun_lulus="` + data.tahun_lulus + `"
                                data-abstrak="` + data.abstrak + `"
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
            call('api/daftar_judul/create', $(this).serialize()).done(function(req) {
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
            $('form#edit [name=nim]').val($(this).data('nim'));
            $('form#edit [name=judul_skripsi]').val($(this).data('judul_skripsi'));
            $('form#edit [name=nama]').val($(this).data('nama'));
            $('form#edit [name=abstrak]').val($(this).data('abstrak'));
            $('form#edit [name=tahun_lulus]').val($(this).data('tahun_lulus'));
        })

        $(document).on('submit', 'form#edit', function(e) {
            e.preventDefault();
            const id = $('form#edit .id').val();
            call('api/daftar_judul/update/' + id, $(this).serialize()).done(function(req) {
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
            call('api/daftar_judul/destroy/' + id).done(function(req) {
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

</script>



<?php $this->app->endSection('script') ?>

<?php $this->app->init() ?>
