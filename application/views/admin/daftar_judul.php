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
                <button class="btn btn-success" data-toggle="modal" data-target="#importexcel">
                    <i class="fas fa-book"></i>
                    Import Excel
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

<div class="modal fade" id="importexcel">
    <div class="modal-dialog">
        <div class="modal-content bg-gradient-primary">
            <div class="modal-header">
                <div class="modal-title text-white">Form Import Daftar Judul</div>
            </div>
            <form id="form-import-excel" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="jumbotron">
                        <h1 class="display-4">Panduan !!</h1>
                        <p class="lead">Sebelum melakukan import file excel untuk daftar judul, harap mendownload templatenya terlebih dahulu, dan isikan file daftar judulnya ke template yang telah di berikan</p>
                        <hr class="my-4">
                        <p>Template Daftar Judul</p>
                        <a class="btn btn-primary btn-lg" href="<?= base_url('assets/format.xlsx') ?>" role="button">
                            <i class="fas fa-print"></i>
                            Download Template
                        </a>
                    </div>
                    <div class="form-group">
                        <label for="importexcel" class="text-white">Import Excel</label>
                        <input type="file" name="importexcel" id="importexcel" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-success">Import</button>
                </div>
            </form>
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
                    <p>Anda yakin menghapus judul dari <strong class="nama">Nama Mahasiswa</strong> ?</p>
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

        // Proses Import Excel menggunakan AJAX
        $(document).on('submit', '#form-import-excel', function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            var button = $(this).find('button[type="submit"]');

            // Ubah teks tombol menjadi "Loading" dan nonaktifkan tombol
            button.text('Loading...');
            button.prop('disabled', true);

            // Buat layar buram dan tidak bisa diklik
            $('body').css({
                'pointer-events': 'none',
                'opacity': '0.5'
            });

            $.ajax({
                url: '<?= base_url("admin/importdaftar") ?>',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    response = JSON.parse(response);

                    $('body').css({
                        'pointer-events': 'auto',
                        'opacity': '1'
                    });
                    button.text('Import');
                    button.prop('disabled', false);

                    if (response.error == true) {
                        notif(response.message, 'error', true);
                    } else {
                        notif(response.message, 'success');
                        $('#form-import-excel')[0].reset();
                        $('#importexcel').modal('hide');
                        show();
                    }
                },
                error: function() {
                    $('body').css({
                        'pointer-events': 'auto',
                        'opacity': '1'
                    });
                    button.text('Import');
                    button.prop('disabled', false);
                    notif('Terjadi kesalahan saat import, silahkan coba lagi.', 'error', true);
                }
            });
        });

    })
</script>

</script>



<?php $this->app->endSection('script') ?>

<?php $this->app->init() ?>
