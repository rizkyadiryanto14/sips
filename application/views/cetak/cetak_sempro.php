<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita Acara Sempro</title>
    <style>
        .left-item {
            position: absolute;
            left: auto;
        }

        #tabel-header {
            background-color: #808080;
            color: #ffffff;
        }

        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background-color: #808080;
            color: #ffffff;
        }
    </style>
</head>

<body>
<section class="header">
    <div style="text-align:center;" class="header font-weight-300">
        <h3>Form Penilaian Seminar Proposal Skripsi</h3>
    </div>
</section>

<section class="content">
    <table class="table table-hover" style="margin-left: 40px;">
        <tr>
            <td>Nama</td>
            <td>: <?= $showData['nama_mahasiswa']; ?></td>
        </tr>
        <tr>
            <td>Nim</td>
            <td>: <?= $showData['nim']; ?></td>
        </tr>
        <tr>
            <td>Judul</td>
            <td>: <?= $showData['proposal_mahasiswa_judul']; ?></td>
        </tr>
        <tr>
            <td>Hari, Tanggal</td>
            <td>: <?= hariIndo(getDay($showData['tanggal'])) . ', ' . tgl_indo($showData['tanggal']); ?></td>
        </tr>
    </table>
</section>

<br>

<section class="isi">
    <table id="customers">
        <tr>
            <th>ASPEK YANG DINILAI</th>
            <th>KETERANGAN</th>
            <th>Nilai (0-100)</th>
        </tr>

        <!-- Nilai dari Penguji 1 -->
        <tr>
            <td>1. Presentasi</td>
            <td>Komunikatif, Ketepatan Waktu, Kejelasan dan Kerunutan dalam penyampaian materi</td>
            <td><?= $showData['penguji1_presentasi']; ?></td>
        </tr>
        <tr>
            <td>2. Alat Bantu Presentasi</td>
            <td>Kejelasan dan tampilan dari powerpoint</td>
            <td><?= $showData['penguji1_alat_bantu']; ?></td>
        </tr>
        <tr>
            <td>3. Penampilan</td>
            <td>Cara berpakaian, etika, sopan santun</td>
            <td><?= $showData['penguji1_penampilan']; ?></td>
        </tr>
        <tr>
            <td>4. Penguasaan Materi</td>
            <td>Cara merespons pertanyaan dan kualitas jawaban</td>
            <td><?= $showData['penguji1_penguasaan_materi']; ?></td>
        </tr>
        <tr>
            <td>5. Kelayakan Proposal</td>
            <td>Ide penelitian, tinjauan pustaka, bahan dan metode penelitian</td>
            <td><?= $showData['penguji1_kelayakan_proposal']; ?></td>
        </tr>
        <tr>
            <td></td>
            <td><strong>Jumlah Rata-Rata</strong></td>
            <td><?= $showData['penguji1_jumlah_rata_nilai'] ?></td>
        </tr>
        <tr>
            <td></td>
            <td><strong>Rata-Rata Nilai</strong></td>
            <td><?= $showData['penguji1_rata_nilai'] ?></td>
        </tr>
    </table>

    <section class="tanda_tangan">
        <table class="table table-hover" style="width:100%; margin-left:500px; margin-top:150px;">
            <tr class="font-weight">
                <td style="font-weight: bold">
                    Menyetujui<br>Penguji I
                </td>
            </tr>
            <tr class="font-weight">
                <td style="font-weight: bold">
                    <img src="<?= base_url('cdn/vendor/qrcodes/' . $showData['penguji1_barcode']); ?>" width="20%" alt="">
                    <br><br><br><br>
                    (<?= $showData['penguji1_nama']; ?>)
                    <br>
                    NIDN. <?= $showData['penguji1_nip']; ?>
                </td>
            </tr>
        </table>
    </section>
</section>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<section class="header">
    <div style="text-align:center;" class="header font-weight-300">
        <h3>Form Penilaian Seminar Proposal Skripsi</h3>
    </div>
</section>

<section class="content">
    <table class="table table-hover" style="margin-left: 40px;">
        <tr>
            <td>Nama</td>
            <td>: <?= $showData['nama_mahasiswa']; ?></td>
        </tr>
        <tr>
            <td>Nim</td>
            <td>: <?= $showData['nim']; ?></td>
        </tr>
        <tr>
            <td>Judul</td>
            <td>: <?= $showData['proposal_mahasiswa_judul']; ?></td>
        </tr>
        <tr>
            <td>Hari, Tanggal</td>
            <td>: <?= hariIndo(getDay($showData['tanggal'])) . ', ' . tgl_indo($showData['tanggal']); ?></td>
        </tr>
    </table>
</section>

<br>

<section class="isi">
    <table id="customers">
        <tr>
            <th>ASPEK YANG DINILAI</th>
            <th>KETERANGAN</th>
            <th>Nilai (0-100)</th>
        </tr>

        <!-- Nilai dari Penguji 2 -->
        <tr>
            <td>1. Presentasi</td>
            <td>Komunikatif, Ketepatan Waktu, Kejelasan dan Kerunutan dalam penyampaian materi</td>
            <td><?= $showData['penguji2_presentasi']; ?></td>
        </tr>
        <tr>
            <td>2. Alat Bantu Presentasi</td>
            <td>Kejelasan dan tampilan dari powerpoint</td>
            <td><?= $showData['penguji2_alat_bantu']; ?></td>
        </tr>
        <tr>
            <td>3. Penampilan</td>
            <td>Cara berpakaian, etika, sopan santun</td>
            <td><?= $showData['penguji2_penampilan']; ?></td>
        </tr>
        <tr>
            <td>4. Penguasaan Materi</td>
            <td>Cara merespons pertanyaan dan kualitas jawaban</td>
            <td><?= $showData['penguji2_penguasaan_materi']; ?></td>
        </tr>
        <tr>
            <td>5. Kelayakan Proposal</td>
            <td>Ide penelitian, tinjauan pustaka, bahan dan metode penelitian</td>
            <td><?= $showData['penguji2_kelayakan_proposal']; ?></td>
        </tr>
        <tr>
            <td></td>
            <td><strong>Jumlah Rata-Rata</strong></td>
            <td><?= $showData['penguji2_jumlah_rata_nilai'] ?></td>
        </tr>
        <tr>
            <td></td>
            <td><strong>Rata-Rata Nilai</strong></td>
            <td><?= $showData['penguji2_rata_nilai'] ?></td>
        </tr>
    </table>

    <section class="tanda_tangan">
        <table class="table table-hover" style="width:100%; margin-left:500px; margin-top:150px;">
            <tr class="font-weight">
                <td style="font-weight: bold">
                    Menyetujui<br>Penguji II
                </td>
            </tr>
            <tr class="font-weight">
                <td style="font-weight: bold">
                    <img src="<?= base_url('cdn/vendor/qrcodes/' . $showData['penguji2_barcode']); ?>" width="20%" alt="">
                    <br><br><br>
                    (<?= $showData['penguji2_nama']; ?>)
                    <br>
                    NIDN. <?= $showData['penguji2_nip']; ?>
                </td>
            </tr>
        </table>
    </section>
</section>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<section class="header">
    <div style="text-align:center;" class="header font-weight-300">
        <h3>Form Penilaian Seminar Proposal Skripsi</h3>
    </div>
</section>

<section class="content">
    <table class="table table-hover" style="margin-left: 40px;">
        <tr>
            <td>Nama</td>
            <td>: <?= $showData['nama_mahasiswa']; ?></td>
        </tr>
        <tr>
            <td>Nim</td>
            <td>: <?= $showData['nim']; ?></td>
        </tr>
        <tr>
            <td>Judul</td>
            <td>: <?= $showData['proposal_mahasiswa_judul']; ?></td>
        </tr>
        <tr>
            <td>Hari, Tanggal</td>
            <td>: <?= hariIndo(getDay($showData['tanggal'])) . ', ' . tgl_indo($showData['tanggal']); ?></td>
        </tr>
    </table>
</section>

<br>

<section class="isi">
    <table id="customers">
        <tr>
            <th>ASPEK YANG DINILAI</th>
            <th>KETERANGAN</th>
            <th>Nilai (0-100)</th>
        </tr>

        <!-- Nilai dari Pembimbing -->
        <tr>
            <td>1. Presentasi</td>
            <td>Komunikatif, Ketepatan Waktu, Kejelasan dan Kerunutan dalam penyampaian materi</td>
            <td><?= $showData['pembimbing_presentasi']; ?></td>
        </tr>
        <tr>
            <td>2. Alat Bantu Presentasi</td>
            <td>Kejelasan dan tampilan dari powerpoint</td>
            <td><?= $showData['pembimbing_alat_bantu']; ?></td>
        </tr>
        <tr>
            <td>3. Penampilan</td>
            <td>Cara berpakaian, etika, sopan santun</td>
            <td><?= $showData['pembimbing_penampilan']; ?></td>
        </tr>
        <tr>
            <td>4. Penguasaan Materi</td>
            <td>Cara merespons pertanyaan dan kualitas jawaban</td>
            <td><?= $showData['pembimbing_penguasaan_materi']; ?></td>
        </tr>
        <tr>
            <td>5. Kelayakan Proposal</td>
            <td>Ide penelitian, tinjauan pustaka, bahan dan metode penelitian</td>
            <td><?= $showData['pembimbing_kelayakan_proposal']; ?></td>
        </tr>
        <tr>
            <td></td>
            <td><strong>Jumlah Rata-Rata</strong></td>
            <td><?= $showData['pembimbing_jumlah_rata_nilai'] ?></td>
        </tr>
        <tr>
            <td></td>
            <td><strong>Rata-Rata Nilai</strong></td>
            <td><?= $showData['pembimbing_rata_nilai'] ?></td>
        </tr>
    </table>

    <section class="tanda_tangan">
        <table class="table table-hover" style="width:100%; margin-left:500px; margin-top:150px;">
            <tr class="font-weight">
                <td style="font-weight: bold">
                    Mengetahui<br>Pembimbing Utama
                </td>
            </tr>
            <tr class="font-weight">
                <td style="font-weight: bold">
                    <img src="<?= base_url('cdn/vendor/qrcodes/' . $showData['pembimbing_barcode']); ?>" width="20%" alt="">
                    <br><br><br>
                    (<?= $showData['pembimbing_nama']; ?>)
                    <br>
                    NIDN. <?= $showData['pembimbing_nip']; ?>
                </td>
            </tr>
        </table>
    </section>
</section>

<div style="text-align:center; margin-top:520px;" class="header font-weight-300">
    <h3>BERITA ACARA</h3>
    <h3>SEMINAR PROPOSAL</h3>
</div>

<section class="content">
    <p>Pada</p>
    <table class="table table-hover" style="margin-left: 40px;">
        <tr>
            <td>Hari, Tanggal</td>
            <td>: <?= hariIndo(getDay($showData['tanggal'])) . ', ' . tgl_indo($showData['tanggal']); ?></td>
        </tr>
        <tr>
            <td>Jam</td>
            <td>: <?= $showData['jam_mulai']; ?> - <?= $showData['jam_selesai'] ?> (WITA)</td>
        </tr>
        <tr>
            <td>Tempat</td>
            <td>: <?= $showData['tempat']; ?></td>
        </tr>
    </table>
</section>

<section class="isi">
    <p>Telah Dilaksanakan Seminar Proposal</p>
    <table class="table table-hover" style="margin-left: 40px;">
        <tr>
            <td>Judul</td>
            <td>: <?= $showData['proposal_mahasiswa_judul']; ?></td>
        </tr>
        <tr>
            <td>Oleh</td>
            <td>: <?= $showData['nama_mahasiswa']; ?></td>
        </tr>
        <tr>
            <td>Nim</td>
            <td>: <?= $showData['nim']; ?></td>
        </tr>
        <tr>
            <td>Program Studi</td>
            <td>: <?= $showData['nama_prodi']; ?></td>
        </tr>
    </table>
</section>

<section>
    <h3 style="text-align: center;">MEMUTUSKAN</h3>
    <table class="table table-hover" style="margin-left: 40px;">
        <tr>
            <td>Menetapkan Nama/Nim</td>
            <td>: <?= $showData['nama_mahasiswa'] . '/' . $showData['nim']; ?></td>
        </tr>
        <tr>
            <td>Tempat/Tanggal Lahir</td>
            <td>: <?= $showData['tempat_lahir'] . ', ' . tgl_indo($showData['tanggal_lahir']); ?></td>
        </tr>
        <tr>
            <td>Judul Skripsi</td>
            <td>: <?= $showData['proposal_mahasiswa_judul']; ?></td>
        </tr>
        <tr>
            <td>Dinyatakan</td>
            <td>: DITERIMA / TIDAK DITERIMA untuk meneruskan penelitian dengan proposal Skripsi tersebut diatas</td>
        </tr>
        <tr>
            <td>Dengan Nilai</td>
            <td>: ..............</td>
        </tr>
        <tr>
            <td>Dengan Predikat</td>
            <td>: .............</td>
        </tr>
    </table>

    <table class="table table-hover" style="margin-left: 40px;width:100%;">
        <tr class="font-weight">
            <td style="font-weight: bold">Menyetujui<br>Penguji 1</td>
            <td style="font-weight: bold">Penguji 2</td>
            <td style="font-weight: bold">Pembimbing Utama</td>
        </tr>
        <tr class="font-weight">
            <td style="height: 150px;">
                <img src="<?= base_url('cdn/vendor/qrcodes/' . $showData['penguji1_barcode']); ?>" width="40%" alt="">
            </td>
            <td style="height: 150px;">
                <img src="<?= base_url('cdn/vendor/qrcodes/' . $showData['penguji2_barcode']); ?>" width="40%" alt="">
            </td>
            <td style="height: 150px;">
                <img src="<?= base_url('cdn/vendor/qrcodes/' . $showData['pembimbing_barcode']); ?>" width="40%" alt="">
            </td>
        </tr>
        <tr class="font-weight">
            <td style="font-weight: bold">
                (<?= $showData['penguji1_nama']; ?>)
                <br>
                NIDN. <?= $showData['penguji1_nip']; ?>
            </td>
            <td style="font-weight: bold">
                (<?= $showData['penguji2_nama']; ?>)
                <br>
                NIDN. <?= $showData['penguji2_nip']; ?>
            </td>
            <td style="font-weight: bold">
                (<?= $showData['pembimbing_nama']; ?>)
                <br>
                NIDN. <?= $showData['pembimbing_nip']; ?>
            </td>
        </tr>
        <tr>
            <td class="left-item" style="font-weight: bold">
                Mengetahui<br>Ketua Program Studi <?= $showData['nama_prodi']; ?>
            </td>
            <td style="font-weight: bold"></td>
            <td style="font-weight: bold"></td>
        </tr>
        <tr>
            <th style="height: 90px;"><br /></th>
        </tr>
        <tr>
            <td style="font-weight: bold">(Rodianto, M.Kom)<br>NIDN. 0808078101</td>
        </tr>
    </table>
</section>
</body>

</html>
