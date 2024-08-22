<?php $this->app->extend('template/admin') ?>

<?php $this->app->setVar('title', "Proposal") ?>

<?php $this->app->section() ?>
<div class="card">
    <div class="card-body">
        <div class="card-title">Cari Mahasiswa : </div>
        <form id="form_cari" action="<?= base_url('hasil-pencarian-mahasiswa'); ?>" method="POST" onsubmit="disableBtn()">
            <input type="hidden" name="level" value="Admin">
            <select class="select2" name="id" required id="wadah_select2"> </select>
            <button class="btn btn-primary mt-3 btn-act" type="sumbit">Lihat Selengkapnya <i class="fa fa-chevron-right"></i></button>
        </form>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col">
                <div class="card-title">Data Proposal</div>
            </div>
            <div class="col text-right">
                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#tambah">
                    <i class="fa fa-plus"></i>
                    Tambah
                </button>
            </div>
        </div>
        <div class="card-tools mt-2">
            <span class="badge badge-success"><i class="fa fa-check"></i> Disetujui</span>
            <span class="badge badge-danger ml-3"><i class="fa fa-times"></i> Belum/Tidak Disetujui</span>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="data-proposal">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Mahasiswa</th>
                        <th>Nama Prodi</th>
                        <th>Judul</th>
                        <th>Pembimbing</th>
                        <th>KRS</th>
                        <th>Outline</th>
                        <th>Transkip</th>
                        <th>Metopen</th>
                        <th>Mk.Wajib</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="tambah">
                <div class="modal-header">
                    <div class="modal-title">Tambah Proposal</div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Mahasiswa</label>
                        <select name="mahasiswa_id" class="form-control"></select>
                    </div>
                    <div class="form-group">
                        <label>Judul</label>
                        <input name="judul" placeholder="Masukkan Judul" autocomplete="off" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Dosen Pembimbing 1</label>
                        <select name="dosen_id" class="form-control">
                            <option value="">- Pilih Dosen -</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Dosen Pembimbing 2</label>
                        <select name="dosen2_id" class="form-control">
                            <option value="">- Pilih Dosen -</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="krs">File KRS</label>
                        <input type="file" class="form-control" name="pilih-krs" accept="application/pdf">
                        <input type="hidden" name="krs">
                    </div>
                    <div class="form-group">
                        <label for="outline">File Outline</label>
                        <input type="file" class="form-control" name="pilih-outline" accept="application/pdf">
                        <input type="hidden" name="outline">
                    </div>
                    <div class="form-group">
                        <label for="transkip">File Transkip</label>
                        <input type="file" class="form-control" name="pilih-transkip" accept="application/pdf">
                        <input type="hidden" name="transkip">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="lulus_metopen" name="lulus_metopen" value="1">
                        <label class="form-check-label" for="lulus_metopen">Lulus Metopen</label>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="lulus_mkwajib" name="lulus_mkwajib" value="1">
                        <label class="form-check-label" for="lulus_mkwajib">Lulus MK Wajib</label>
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
                    <div class="modal-title">Edit Proposal</div>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="id">
                    <div class="form-group">
                        <label>Mahasiswa</label>
                        <select name="mahasiswa_id" class="form-control"></select>
                    </div>
                    <div class="form-group">
                        <label>Judul</label>
                        <input name="judul" placeholder="Masukkan Judul" autocomplete="off" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Dosen Pembimbing 1</label>
                        <select name="dosen_id" class="form-control">
                            <option value="">- Pilih Dosen -</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Dosen Pembimbing 2</label>
                        <select name="dosen2_id" class="form-control">
                            <option value="">- Pilih Dosen -</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="krs">File KRS</label>
                        <input type="file" class="form-control" name="pilih-krs" accept="application/pdf">
                        <input type="hidden" name="krs">
                        <input type="hidden" name="def_krs">
                    </div>
                    <div class="form-group">
                        <label for="outline">File Outline</label>
                        <input type="file" class="form-control" name="pilih-outline" accept="application/pdf">
                        <input type="hidden" name="outline">
                        <input type="hidden" name="def_outline">
                    </div>
                    <div class="form-group">
                        <label for="transkip">File Transkip</label>
                        <input type="file" class="form-control" name="pilih-transkip" accept="application/pdf">
                        <input type="hidden" name="transkip">
                        <input type="hidden" name="def_transkip">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="lulus_metopen" name="lulus_metopen" value="1">
                        <label class="form-check-label" for="lulus_metopen">Lulus Metopen</label>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="lulus_mkwajib" name="lulus_mkwajib" value="1">
                        <label class="form-check-label" for="lulus_mkwajib">Lulus MK Wajib</label>
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
                    <div class="modal-title">Hapus Proposal</div>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="id">
                    <p>Anda yakin menghapus proposal <strong class="judul">Judul Proposal</strong> ?</p>
                    <li>Konsultasi proposal juga akan terhapus</li>
                    <li>Seminar proposal juga akan terhapus</li>
                    <li>Penelitian proposal juga akan terhapus</li>
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
                    <div class="modal-title">Status Proposal</div>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="id">
                    <input type="hidden" class="status">
                    <p>Anda yakin <span class="status">mengetujui / batal menyetujui</span> proposal <strong class="judul">Judul Proposal</strong> ?</p>
                    <div id="wadah_jadwal"></div>
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
        getDataSelect()
        call('api/mahasiswa').done(function(req) {
            mahasiswa = '<option value="">- Pilih Mahasiswa -</option>';
            if (req.data) {
                req.data.forEach((obj) => {
                    mahasiswa += '<option value="' + obj.id + '">' + obj.nama + '</option>';
                })
            }
            $('[name=mahasiswa_id]').html(mahasiswa);
        })

        function show() {
            $('#data-proposal').DataTable().destroy();
            $('#data-proposal').DataTable({
                "deferRender": true,
                "ajax": {
                    "url": base_url + 'api/proposal_mahasiswa',
                    "method": "POST",
                    "dataSrc": "data"
                },
                "columns": [{
                        data: null,
                        render: function(data, type, row, meta) {
                            console.log(data)
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: "mahasiswa",
                        render: function(data) {
                            return data.nim;
                        }
                    },
                    {
                        data: "mahasiswa",
                        render: function(data) {
                            return data.nama;
                        }
                    },
                    {
                        data: "mahasiswa",
                        render: function(data) {
                            return data.nama_prodi;
                        }
                    },
                    {
                        data: "judul"
                    },
                    {
                        data: null,
                        render: function(data) {
                            return '1. ' + data.pembimbing.nama + ' <br>2. ' + data.pembimbing2.nama
                        }
                    },
                    {
                        data: "krs",
                        render: function(data) {
                            return '<a href="' + base_url + 'cdn/vendor/krs/' + data + '">' + data + '</a>';
                        }
                    },
                    {
                        data: "outline",
                        render: function(data) {
                            return '<a href="' + base_url + 'cdn/vendor/outline/' + data + '">' + data + '</a>';
                        }
                    },
                    {
                        data: "transkip",
                        render: function(data) {
                            return '<a href="' + base_url + 'cdn/vendor/transkip/' + data + '">' + data + '</a>';
                        }
                    },
                    {
                        data: "lulus_metopen",
                        render: function (data) {
                            if (data == 1) {
                                return '<span class="badge badge-success">Lulus</span>';
                            } else {
                                return '<span class="badge badge-danger">Belum Lulus</span>';
                            }
                        }
                    },
                    {
                        data: "lulus_mkwajib",
                        render: function (data) {
                            if (data == 1) {
                                return '<span class="badge badge-success">Lulus</span>';
                            } else {
                                return '<span class="badge badge-danger">Belum Lulus</span>';
                            }
                        }
                    },
                    {
                        data: null,
                        render: function(data) {
                            if (data.status == '1') {
                                status = '\
                            <button class="btn btn-sm btn-setuju btn-success" type="button" data-id="' + data.id + '" data-judul="' + data.judul + '" data-status="' + data.status + '" data-toggle="modal" data-target="#setujui">\
                                <i class="fa fa-check"></i>\
                            </button>\
                            ';
                            } else {
                                status = '\
                            <button class="btn btn-sm btn-setuju btn-danger" type="button" data-id="' + data.id + '" data-judul="' + data.judul + '" data-status="' + data.status + '" data-toggle="modal" data-target="#setujui">\
                                <i class="fa fa-times"></i>\
                            </button>\
                            ';
                            }
                            return '\
                            <div class="text-center">' + status + '</div>\
                            ';
                        }
                    },
                    {
                        data: null,
                        render: function(data) {
                            if (level == '1') {
                                return '\
                                <div class="text-center">\
                                <button class="btn btn-sm btn-info btn-edit" type="button" data-toggle="modal" data-target="#edit" data-id="' + data.id + '" data-mahasiswa_id="' + data.mahasiswa_id + '" data-judul="' + data.judul + '" data-dosen_id="' + data.dosen_id + '" data-dosen2_id="' + data.dosen2_id + '" data-lulus_metopen="' + data.lulus_metopen + '" data-lulus_mkwajib="' + data.lulus_mkwajib + '" >\
                                    <i class="fa fa-pen"></i>\
                                </button>\
                                <button class="btn btn-sm btn-danger btn-hapus" type="button" data-toggle="modal" data-target="#hapus" data-id="' + data.id + '" data-judul="' + data.judul + '">\
                                    <i class="fa fa-trash"></i>\
                                </button>\
                                </div>\
                                ';
                            } else {
                                return '-';
                            }
                        }
                    }
                ],
                "language": {
                    "zeroRecords": "data tidak tersedia"
                },
            });
        }

        show();

        call('api/dosen').done(function(req) {
            dosen = '<option value="">- Pilih Dosen -</option>';
            if (req.data) {
                $.each(req.data, function(index, obj) {
                    dosen += '<option value="' + obj.id + '">' + obj.nama + '</option>';
                })
            }
            $('[name=dosen_id]').html(dosen);
            $('[name=dosen2_id]').html(dosen);
        })

        $(document).on('submit', 'form#tambah', function(e) {
            e.preventDefault();

            // Tampilkan overlay loading
            $('#loading-overlay').show();

            call('api/proposal_mahasiswa/create', $(this).serialize()).done(function(req) {
                if (req.error == true) {
                    notif(req.message, 'error', true);
                } else {
                    notif(req.message, 'success');
                    $('form#tambah [name]').val('');
                    $('div#tambah').modal('hide');
                    show();
                }
                // Sembunyikan overlay loading setelah proses selesai
                $('#loading-overlay').hide();
            }).fail(function() {
                // Sembunyikan overlay loading jika terjadi error
                $('#loading-overlay').hide();
                alert('Terjadi kesalahan, silakan coba lagi.');
            });
        });


        $(document).on('change', 'form#tambah [name=pilih-krs]', function() {
            read('form#tambah [name=pilih-krs]', function(data) {
                $('form#tambah [name=krs]').val(data.result);
            })
        })

        $(document).on('change', 'form#tambah [name=pilih-outline]', function() {
            read('form#tambah [name=pilih-outline]', function(data) {
                $('form#tambah [name=outline]').val(data.result);
            })
        })

        $(document).on('change', 'form#tambah [name=pilih-transkip]', function() {
            read('form#tambah [name=pilih-transkip]', function(data) {
                $('form#tambah [name=transkip]').val(data.result);
            })
        })

        $(document).on('change', 'form#edit [name=pilih-krs]', function() {
            read('form#edit [name=pilih-krs]', function(data) {
                $('form#edit [name=krs]').val(data.result);
            })
        })

        $(document).on('change', 'form#edit [name=pilih-outline]', function() {
            read('form#edit [name=pilih-outline]', function(data) {
                $('form#edit [name=outline]').val(data.result);
            })
        })

        $(document).on('change', 'form#edit [name=pilih-transkip]', function() {
            read('form#edit [name=pilih-transkip]', function(data) {
                $('form#edit [name=transkip]').val(data.result);
            })
        })

        $(document).on('click', 'button.btn-edit', function() {
            $('form#edit .id').val($(this).data('id'));
            $('form#edit [name=mahasiswa_id]').val($(this).data('mahasiswa_id'));
            $('form#edit [name=judul]').val($(this).data('judul'));
            $('form#edit [name=dosen_id]').val($(this).data('dosen_id'));
            $('form#edit [name=dosen2_id]').val($(this).data('dosen2_id'));
            $('form#edit [name=lulus_mkwajib]').val($(this).data('lulus_mkwajib'));
            $('form#edit [name=lulus_metopen]').val($(this).data('lulus_metopen'));
            $('form#edit [name=def_krs]').val($(this).data('krs'));
            $('form#edit [name=def_outline]').val($(this).data('outline'));
            $('form#edit [name=def_transkip]').val($(this).data('transkip'));
        })

        $(document).on('submit', 'form#edit', function(e) {
            e.preventDefault();

            $('form#edit [name=lulus_metopen]').val($('form#edit [name=lulus_metopen]').prop('checked') ? 1 : 0);
            $('form#edit [name=lulus_mkwajib]').val($('form#edit [name=lulus_mkwajib]').prop('checked') ? 1 : 0);
            console.log( $('form#edit [name=def_krs]').val($(this).data('krs')));

            let formData = $(this).serialize();
            console.log('Form Data: ', formData);  // Untuk debugging

            var id = $('form#edit .id').val();
            call('api/proposal_mahasiswa/update/' + id, $(this).serialize()).done(function(req) {
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
            $('form#hapus .judul').html($(this).data('judul'));
        });

        $(document).on('submit', 'form#hapus', function(e) {
            e.preventDefault();

            // Tampilkan overlay loading
            $('#loading-overlay').show();

            var id = $('form#hapus .id').val();
            call('api/proposal_mahasiswa/destroy/' + id).done(function(req) {
                if (req.error == true) {
                    notif(req.message, 'error', true);
                } else {
                    notif(req.message, 'success');
                    $('form#hapus [name]').val('');
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
        });


        $(document).on('click', 'button.btn-setuju', function() {
            $('form#setujui .id').val($(this).data('id'));
            $('form#setujui input.status').val($(this).data('status'));
            $('form#setujui span.status').html(($(this).data('status') == '1') ? 'batal menyetujui dan deadline skripsi akan direset untuk ' : 'menyetujui');
            $('form#setujui .judul').html($(this).data('judul'));
            if ($(this).data('status') == 1) {
                $("#wadah_jadwal").html('');
            } else {
                $("#wadah_jadwal").html('<input name="deadline_skripsi" type="text" class="form-control dateTime" placeholder="Masukkan Deadline Skripsi" readonly required>');
                $(".dateTime").flatpickr({
                    enableTime: true,
                    dateFormat: "Y-m-d H:i",
                });
            }
        });

        $(document).on('submit', 'form#setujui', function(e) {
            e.preventDefault();
            $(".btn-konfirmasi").attr('disabled', true).html('Loading...');

            // Tampilkan overlay loading
            $('#loading-overlay').show();

            if ($('form#setujui .status').val() != 1) {
                if ($("form#setujui input[name=deadline_skripsi]").val() == "") {
                    alert('Harap Isi Deadline Skripsi Terlebih Dahulu');
                    $(".btn-konfirmasi").attr('disabled', false).html('Konfirmasi');
                    $('#loading-overlay').hide();  // Sembunyikan overlay jika gagal validasi
                } else {
                    action();
                }
            } else {
                action();
            }

            function action() {
                const id = $('form#setujui .id').val();
                call('api/proposal_mahasiswa/' + (($('form#setujui .status').val() == '1') ? 'disagree' : 'agree') + '/' + id, $('form#setujui').serialize()).done(function(req) {
                    if (req.error == true) {
                        notif(req.message, 'error', true);
                        $(".btn-konfirmasi").attr('disabled', false).html('Konfirmasi');
                    } else {
                        notif(req.message, 'success');
                        $('div#setujui').modal('hide');
                        show();
                    }
                    $('#loading-overlay').hide();  // Sembunyikan overlay setelah proses selesai
                }).fail(function() {
                    $('#loading-overlay').hide();  // Sembunyikan overlay jika terjadi error
                    alert('Terjadi kesalahan, silakan coba lagi.');
                    $(".btn-konfirmasi").attr('disabled', false).html('Konfirmasi');
                });
            }
        });



    })

    function getDataSelect() {
        $.ajax({
            url: base_url + 'getAllData/mahasiswa',
            dataType: 'json',
            type: 'get',
            success: function(res) {
                data = '<option value=""></option>'
                $.each(res, function(i, item) {
                    data += '<option value="' + item.id + '">(' + item.nim + ') ' + item.nama + '</option>'
                })
                $("#wadah_select2").html(data)
            }
        })
    }

    function disableBtn() {
        $(".btn-act").attr('disabled', true).html('Loading ...')
    }
</script>
<?php $this->app->endSection('script') ?>

<?php $this->app->init() ?>