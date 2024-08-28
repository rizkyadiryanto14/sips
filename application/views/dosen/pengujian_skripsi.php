<?php $this->app->extend('template/dosen') ?>
<?php $this->app->setVar('title', 'Pengujian Skripsi') ?>
<?php $this->app->section() ?>

<?php foreach ($listing_skripsi as $item) { ?>
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
                        <td>: <?= $item->nim ?></td>
                    </tr>
                    <tr>
                        <td>Judul Skripsi</td>
                        <td>: <?= $item->judul_skripsi ?></td>
                    </tr>
                    <br>
                    <tr>
                        <td>Pembimbing I</td>
                        <td>: <?= $item->nama_pembimbing1 ?></td>
                    </tr>
                    <tr>
                        <td>Pembimbing II</td>
                        <td>: <?= $item->nama_pembimbing2 ?></td>
                    </tr>
                    <tr>
                        <td>Penguji I</td>
                        <td>: <?= $item->nama_penguji1 ?></td>
                    </tr>
                    <tr>
                        <td>Penguji II</td>
                        <td>: <?= $item->nama_penguji2 ?></td>
                    </tr>
                    </thead>
                </table>
            </div>

            <?php if ($item->status_pengujian == 1) { ?>
                <div class="text-center mt-4">
                    <a href="<?= site_url('berita_acara/cetak_pdf_skripsi/' . $item->id_skripsi) ?>" class="btn btn-sm btn-success">Unduh Berita Acara</a>
                </div>
            <?php } else { ?>
                <form id="tambah" method="POST">
                    <input type="hidden" name="id_skripsi" value="<?= $item->id_skripsi ?>">
                    <input type="hidden" name="id_dosen" id="id_dosen" value="<?= $this->session->userdata('id') ?>">
                    <input type="hidden" name="nilai_rata_rata" id="input_nilai_rata_rata">
                    <div class="table-responsive pt-3">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>NO</th>
                                <th>KOMPONEN PENILAIAN</th>
                                <th>BOBOT</th>
                                <th>NILAI</th>
                                <th>BOBOT X NILAI</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td rowspan="7" class="text-center">A</td>
                                <td>NASKAH SKRIPSI</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>a. Pokok permasalahan</td>
                                <td class="text-center">1</td>
                                <td class="text-center">
                                    <input type="text" name="pokok_permasalahan" class="form-control-sm nilai" data-bobot="1" autocomplete="off">
                                </td>
                                <td class="text-center bobot-nilai"></td>
                            </tr>
                            <tr>
                                <td>b. Kerangka Pemikiran</td>
                                <td class="text-center">2</td>
                                <td class="text-center">
                                    <input type="text" name="kerangka_pemikiran" class="form-control-sm nilai" data-bobot="2" autocomplete="off">
                                </td>
                                <td class="text-center bobot-nilai"></td>
                            </tr>
                            <tr>
                                <td>c. Metode penelitian</td>
                                <td class="text-center">1</td>
                                <td class="text-center">
                                    <input type="text" name="metode_penelitian" class="form-control-sm nilai" data-bobot="1" autocomplete="off">
                                </td>
                                <td class="text-center bobot-nilai"></td>
                            </tr>
                            <tr>
                                <td>d. Hasil Penelitian</td>
                                <td class="text-center">2</td>
                                <td class="text-center">
                                    <input type="text" name="hasil_penelitian" class="form-control-sm nilai" data-bobot="2" autocomplete="off">
                                </td>
                                <td class="text-center bobot-nilai"></td>
                            </tr>
                            <tr>
                                <td>e. Bahasa</td>
                                <td class="text-center">1</td>
                                <td class="text-center">
                                    <input type="text" name="bahasa" class="form-control-sm nilai" data-bobot="1" autocomplete="off">
                                </td>
                                <td class="text-center bobot-nilai"></td>
                            </tr>
                            <tr>
                                <td>f. Teknik penulisan</td>
                                <td class="text-center">1</td>
                                <td class="text-center">
                                    <input type="text" name="teknik_penulisan" class="form-control-sm nilai" data-bobot="1" autocomplete="off">
                                </td>
                                <td class="text-center bobot-nilai"></td>
                            </tr>
                            <tr>
                                <td class="text-center">B</td>
                                <td>Manfaat akademis dan praktis</td>
                                <td class="text-center">2</td>
                                <td class="text-center">
                                    <input type="text" name="manfaat_akademis_praktis" class="form-control-sm nilai" data-bobot="2" autocomplete="off">
                                </td>
                                <td class="text-center bobot-nilai"></td>
                            </tr>
                            <tr>
                                <td rowspan="4" class="text-center">C</td>
                                <td>Ujian Lisan</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>a. Penguasaan Materi</td>
                                <td class="text-center">2</td>
                                <td class="text-center">
                                    <input type="text" name="penguasaan_materi" class="form-control-sm nilai" data-bobot="2" autocomplete="off">
                                </td>
                                <td class="text-center bobot-nilai"></td>
                            </tr>
                            <tr>
                                <td>b. Penguasaan Metode</td>
                                <td class="text-center">1</td>
                                <td class="text-center">
                                    <input type="text" name="penguasaan_metode" class="form-control-sm nilai" data-bobot="1" autocomplete="off">
                                </td>
                                <td class="text-center bobot-nilai"></td>
                            </tr>
                            <tr>
                                <td>c. Kemampuan argumentasi</td>
                                <td class="text-center">2</td>
                                <td class="text-center">
                                    <input type="text" name="kemampuan_argumentasi" class="form-control-sm nilai" data-bobot="2" autocomplete="off">
                                </td>
                                <td class="text-center bobot-nilai"></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-center font-weight-bold">Jumlah</td>
                                <td class="text-center font-weight-bold">15</td>
                                <td id="total_nilai" class="text-center"></td>
                                <td id="total_bobot_nilai" class="text-center"></td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-center font-weight-bold">Nilai Rata-rata dari Dosen Penguji</td>
                                <td id="nilai_rata_rata" class="text-center font-weight-bold"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center mt-3">
                        <button class="btn btn-primary btn-sm">Kirim Penilaian</button>
                    </div>
                </form>
            <?php } ?>
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
        function calculateBobotNilai() {
            var totalNilai = 0;
            var totalBobotNilai = 0;
            var totalBobot = 15; // Sesuaikan dengan total bobot yang ada

            // Iterasi melalui setiap input nilai
            $('input.nilai').each(function() {
                var nilai = parseFloat($(this).val()) || 0;
                var bobot = parseFloat($(this).data('bobot')) || 0;
                var bobotNilai = nilai * bobot;

                // Tampilkan hasil Bobot x Nilai pada kolom terkait
                $(this).closest('tr').find('.bobot-nilai').text(bobotNilai.toFixed(2));

                // Tambahkan ke total nilai dan total Bobot x Nilai
                totalNilai += nilai;
                totalBobotNilai += bobotNilai;
            });

            // Hitung nilai rata-rata dosen penguji
            var nilaiRataRata = totalBobotNilai / totalBobot;

            // Tampilkan hasil total
            $('#total_nilai').text(totalNilai.toFixed(2));
            $('#total_bobot_nilai').text(totalBobotNilai.toFixed(2));
            $('#nilai_rata_rata').text(nilaiRataRata.toFixed(2));

            // Set nilai rata-rata ke input hidden untuk pengiriman ke API
            $('#input_nilai_rata_rata').val(nilaiRataRata.toFixed(2));
        }

        // Panggil fungsi ketika nilai input diubah
        $(document).on('input', 'input.nilai', function() {
            calculateBobotNilai();
        });

        // Handle form submit
        $(document).on('submit', 'form#tambah', function(e) {
            e.preventDefault();

            // Mengambil data dari form dan mengirimkan ke API
            var formData = $(this).serialize();

            call('api/pengujian_skripsi/create', formData).done(function(req) {
                if (req.error == true) {
                    // Jika ada error, tampilkan notifikasi error
                    notif(req.message, 'error', true);
                } else {
                    // Jika berhasil, tampilkan notifikasi sukses dengan callback
                    notif(req.message, 'success', false).then(function() {
                        // Bersihkan semua input di dalam form
                        $('form#tambah')[0].reset();

                        // Refresh halaman setelah klik "OK"
                        location.reload();
                    });
                }
            });
        });

    });
</script>

<?php $this->app->endSection('script') ?>

<?php $this->app->init() ?>
