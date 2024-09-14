<?php $this->app->extend('template/mahasiswa') ?>

<?php $this->app->setVar('title', 'Konsultasi') ?>

<?php $this->app->section() ?>
<div class="card">
    <div class="card-header">
        <div class="card-title">Data Bimbingan</div>
        <div class="col text-right">
                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#tambah">
                    <i class="fa fa-plus"></i>
                    Tambah
                </button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="data-konsultasi">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Proposal / Skripsi</th>
                        <th>Isi</th>
                        <th>Waktu</th>
                        <th>Bukti</th>
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
                    <div class="modal-title">Tambah Bimbingan</div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Proposal</label>
                        <select name="proposal_mahasiswa_id" class="form-control">
                            <option value="">- Pilih Proposal -</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal" class="form-control">
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-group">
                                <label>Jam</label>
                                <input type="time" name="jam" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Isi</label>
                        <textarea name="isi" rows="3" class="form-control" placeholder="Masukkan Isi Bimbingan"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Bukti</label>
                        <input type="file" class="form-control" name="pilih-bukti" accept="application/pdf">
                        <input type="hidden" name="bukti">
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
<div class="modal fade" id="detail">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">Detail Konsultasi</div>
            </div>
            <div class="modal-body">
              <div class="table-responsive">
                  <table class="table">
                      <tr>
                          <td>Laporan Kaprodi</td>
                          <th class="persetujuan_kaprodi"></th>
                      </tr>
                      <tr>
                          <td>Laporan Pembimbing</td>
                          <th class="persetujuan_pembimbing"></th>
                      </tr>
                  </table>
              </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" type="button" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="hapus">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="hapus">
                <div class="modal-header">
                    <div class="modal-title">Hapus Konsultasi</div>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="id">
                    <p>Anda yakin menghapus konsultasi terpilih ?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" type="button" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Hapus</button>
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
        console.log('Mahasiswa ID:', '<?= $this->session->userdata('id') ?>');

        $.ajax({
            url: base_url + 'getData/proposal_mahasiswa',
            type: 'post',
            data: {
                mahasiswa_id: <?= $this->session->userdata('id') ?>
            },
            dataType: 'json',
            success: function(res) {
                proposal = `<option value="">- Pilih Proposal -</option>`;
                $.each(res, function(i, item) {
                    if (item.status == '1') {
                        proposal += `<option value="` + item.id + `">` + item.judul + `</option>`;
                    }
                })
                $('[name=proposal_mahasiswa_id]').html(proposal);
            }
        })

        function show() {
            $('#data-konsultasi').DataTable().destroy();
            $('#data-konsultasi').DataTable({
                "deferRender": true,
                "ajax": {
                    "url": base_url + 'api/konsultasi',
                    "method": "POST",
                    "data": {
                        mahasiswa_id: '<?= $this->session->userdata('id') ?>',
                    },
                    "dataSrc": "data"
                },
                "columns": [{
                        data: null,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: "proposal_mahasiswa_judul"
                    },
                    {
                        data: "isi"
                    },
                    {
                        data: null,
                        render: function(data) {
                            return data.tanggal + ' ' + data.jam
                        }
                    },
                    {
                        data: "bukti",
                        render: function(data) {
                            return '\
                            <a href="' + base_url + 'cdn/vendor/bukti/' + data + '" target="_blank">' + data + '</a>\
                            '
                        }
                    },
                    {
                        data: null,
                        render: function(data) {
                            hapus = `
                            <button class="btn btn-hapus btn-danger btn-sm" data-id="`+data.id+`" type="button" data-toggle="modal" data-target="#hapus">
                                <i class="fa fa-trash"></i>
                            </button>
                            `;
                            return '\
                            <div class="text-center">\
                                <button class="btn btn-sm btn-success btn-detail" data-persetujuan_kaprodi="' + data.persetujuan_kaprodi + '" data-persetujuan_pembimbing="' + data.persetujuan_pembimbing + '" data-komentar_kaprodi="' + data.komentar_kaprodi + '" data-komentar_pembimbing="' + data.komentar_pembimbing + '" data-sk_tim="' + data.sk_tim + '" type="button" data-toggle="modal" data-target="#detail">\
                                    <i class="fa fa-search"></i>\
                                </button>\
                                ' + hapus + '\
                            </div>\
                            '
                        }
                    }
                ],
                "language" : {
                    "zeroRecords" : "data tidak tersedia"
                }
            });
        }

        show();

        $(document).on('submit', 'form#tambah', function(e) {
            e.preventDefault();

            // Tampilkan overlay loading
            $('#loading-overlay').show();

            call('api/konsultasi/create', $(this).serialize()).done(function(res) {
                if (res.error == true) {
                    notif(res.message, 'error', true);
                } else {
                    notif(res.message, 'success');
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
        })

        $(document).on('change', '[name=pilih-bukti]', function() {
            read('[name=pilih-bukti]', function(data) {
                $('[name=bukti]').val(data.result);
            })
        })

        $(document).on('click', 'button.btn-detail', function() {
            persetujuan_kaprodi = ($(this).data('persetujuan_kaprodi') == '1') ? '<span class="badge badge-success">Disetujui</span>' : $(this).data('komentar_kaprodi');
            persetujuan_pembimbing = ($(this).data('persetujuan_pembimbing') == '1') ? '<span class="badge badge-success">Disetujui</span>' : $(this).data('komentar_pembimbing');
            sk_tim = (!$(this).data('sk_tim')) ? '<span class="badge badge-danger">Belum Tersedia</span>' : '<a class="btn btn-primary btn-sm" href="' + base_url + 'cdn/vendor/sk_tim/' + $(this).data('sk_tim') + '">' + $(this).data('sk_tim') + '</a>'
            $('th.persetujuan_kaprodi').html(persetujuan_kaprodi);
            $('th.persetujuan_pembimbing').html(persetujuan_pembimbing);
            $('th.sk_tim').html(sk_tim);
        })

        $(document).on('click', 'button.btn-hapus', function() {
            $('form#hapus .id').val($(this).data('id'));
        })

        $(document).on('submit', 'form#hapus', function(e) {
            e.preventDefault();

            // Tampilkan overlay loading
            $('#loading-overlay').show();

            const id = $('form#hapus .id').val();
            call('api/konsultasi/destroy/'+id).done(function (req) {
                if (req.error == true) {
                    notif(req.message, 'error', true);
                } else {
                    notif(req.message, 'success');
                    show();
                    $('div#hapus').modal('hide');
                }
                // Tampilkan overlay loading
                $('#loading-overlay').show();
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