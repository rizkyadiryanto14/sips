<?php $this->app->extend('template/dosen') ?>
<?php $this->app->setVar('title', 'Pengujian') ?>
<?php $this->app->section() ?>

<?php foreach ($listing_sempro as $item) { ?>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <tbody>
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
                    <tr>
                        <td>Pembimbing I</td>
                        <td>: <?= $item->nama_dosen_pembimbing_1 ?></td>
                    </tr>
                    <tr>
                        <td>Pembimbing II</td>
                        <td>: <?= $item->nama_dosen_pembimbing_2 ?></td>
                    </tr>
                    <tr>
                        <td>Penguji I</td>
                        <td>: <?= $item->nama_dosen_penguji_1 ?></td>
                    </tr>
                    <tr>
                        <td>Penguji II</td>
                        <td>: <?= $item->nama_dosen_penguji_2 ?></td>
                    </tr>
                    </tbody>
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
                                <li>Presentasi yang terstruktur dan mudah dipahami.</li>
                                <li>Penggunaan alat bantu seperti slide yang menarik dan informatif.</li>
                                <li>Penampilan yang profesional dan sikap percaya diri.</li>
                                <li>Penguasaan terhadap materi yang dipresentasikan.</li>
                                <li>Kelayakan proposal untuk lanjut ke tahap skripsi.</li>
                            </ol>
                        </td>
                        <td class="text-center">
                            <?php if ($item->status_pengujian == 1) { ?>
                                <p>Berhasil memberikan nilai</p>
                                <a href="<?= site_url('berita_acara/cetak_pdf/' . $item->seminar_id) ?>" class="btn btn-sm btn-success">Unduh Berita Acara</a>
                            <?php } else { ?>
                                <form id="tambah-<?= $item->seminar_id ?>" class="tambah-nilai" method="POST">
                                    <input type="hidden" name="id_sempro" value="<?= $item->seminar_id ?>">
                                    <input type="hidden" name="id_dosen" value="<?= $this->session->userdata('id') ?>">
                                    <ol>
                                        <li><input type="number" name="presentasi" class="form-control-sm" min="0" max="100" placeholder="0-100" required></li>
                                        <li><input type="number" name="alat_bantu" class="form-control-sm" min="0" max="100" placeholder="0-100" required></li>
                                        <li><input type="number" name="penampilan" class="form-control-sm" min="0" max="100" placeholder="0-100" required></li>
                                        <li><input type="number" name="penguasaan_materi" class="form-control-sm" min="0" max="100" placeholder="0-100" required></li>
                                        <li><input type="number" name="kelayakan_proposal" class="form-control-sm" min="0" max="100" placeholder="0-100" required></li>
                                    </ol>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
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
        $(document).on('submit', '.tambah-nilai', function(e) {
            e.preventDefault();

            // Tampilkan overlay loading
            $('#loading-overlay').show();

            // Ambil data dari form yang sedang disubmit
            var formData = $(this).serialize();

            $.ajax({
                url: '<?= site_url('dosen/pengujian_sempro') ?>',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(req) {
                    if (req.error == true) {
                        notif(req.message, 'error', true);
                    } else {
                        notif(req.message, 'success', false, true);

                        $('.tambah-nilai')[0].reset();
                    }
                    $('#loading-overlay').hide();
                },
                error: function() {
                    // Sembunyikan overlay loading jika terjadi error
                    $('#loading-overlay').hide();
                    alert('Terjadi kesalahan, silakan coba lagi.');
                }
            });
        });
    });
</script>

<?php $this->app->endSection('script') ?>
<?php $this->app->init() ?>
