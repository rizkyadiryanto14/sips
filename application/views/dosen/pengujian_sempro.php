<?php $this->app->extend('template/dosen') ?>
<?php $this->app->setVar('title', 'Pengujian') ?>
<?php $this->app->section() ?>

<?php foreach ($listing_sempro as $item) { ?>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table>
                    <thead>
                    <tr>
                        <td>Nama</td>
                        <td>: <?= $item->nama_mahasiswa ?></td>
                    </tr>
                    <tr>
                        <td>Nim</td>
                        <td>: <?= $item->mahasiswa_nim ?></td>
                    </tr>
                    <tr>
                        <td>Judul Skripsi</td>
                        <td>: <?= $item->judul_proposal ?></td>
                    </tr>
                    <br>
                    <tr>
                        <td>Pembimbing 1</td>
                        <td>: <?= $item->nama_dosen_pembimbing_1 ?></td>
                    </tr>
                    <tr>
                        <td>Pembimbing 2</td>
                        <td>: <?= $item->nama_dosen_pembimbing_2 ?></td>
                    </tr>
                    <tr>
                        <td>Penguji 1</td>
                        <td>: <?= $item->nama_dosen_penguji_1 ?></td>
                    </tr>
                    <tr>
                        <td>Penguji 2</td>
                        <td>: <?= $item->nama_dosen_penguji_2 ?></td>
                    </tr>
                    </thead>
                </table>
            </div>
            <div class="table-responsive pt-3">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>ASPEK YANG DINILAI</th>
                        <th>KETERANGAN</th>
                        <th>NILAI (0-100)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <ol>
                                <li>Presentasi</li>
                                <li>Alat Bantu Presentasi</li>
                                <li>Penampilan</li>
                                <li>Penguasaan Materi</li>
                                <li>Kelayakan Proposal</li>
                            </ol>
                        </td>
                        <td>
                            <ol>
                                <li>Presentasi</li>
                                <li>Alat Bantu Presentasi</li>
                                <li>Penampilan</li>
                                <li>Penguasaan Materi</li>
                                <li>Kelayakan Proposal</li>
                            </ol>
                        </td>
                        <td class="text-center">
                            <?php if ($item->status_pengujian == 1) { ?>
                                <p>Berhasil memberikan nilai</p>
                                <a href="<?= site_url('berita_acara/cetak_pdf/' . $item->seminar_id) ?>" class="btn btn-sm btn-success">Unduh Berita Acara</a>
                            <?php } else { ?>
                                <form id="tambah">
                                    <input type="hidden" name="id_sempro" id="id_sempro" value="<?= $item->seminar_id ?>">
                                    <input type="hidden" name="id_dosen" id="id_dosen" value="<?= $this->session->userdata('id') ?>">
                                    <ol>
                                        <li><input type="text" name="presentasi" class="form-control-sm" autocomplete="off"></li>
                                        <li><input type="text" name="alat_bantu" class="form-control-sm" autocomplete="off"></li>
                                        <li><input type="text" name="penampilan" class="form-control-sm" autocomplete="off"></li>
                                        <li><input type="text" name="penguasaan_materi" class="form-control-sm" autocomplete="off"></li>
                                        <li><input type="text" name="kelayakan_proposal" id="kelayakan_proposal" class="form-control-sm" autocomplete="off"></li>
                                    </ol>
                                    <div class="text-center">
                                        <button class="btn btn-primary btn-sm">Simpan</button>
                                    </div>
                                </form>
                            <?php } ?>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php } ?>


<?php $this->app->endSection('content') ?>
<?php $this->app->section() ?>
    <link rel="stylesheet" href="<?= base_url() ?>cdn/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <script src="<?= base_url() ?>cdn/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>cdn/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            $(document).on('submit', 'form#tambah', function(e) {
                e.preventDefault();

                // Mengambil data dari form dan mengirimkan ke API
                var formData = $(this).serialize();

                call('api/pengujian_sempro/create', formData).done(function(req) {
                    if (req.error == true) {
                        // Jika ada error, tampilkan notifikasi error
                        notif(req.message, 'error', true);
                    } else {
                        // Jika berhasil, tampilkan notifikasi sukses
                        notif(req.message, 'success');

                        // Bersihkan semua input di dalam form
                        $('form#tambah')[0].reset();

                        // Sembunyikan modal
                        $('div#tambah').modal('hide');

                        // Refresh halaman
                        location.reload();
                    }
                });
            });
        })
    </script>

<?php $this->app->endSection('script') ?>

<?php $this->app->init() ?>