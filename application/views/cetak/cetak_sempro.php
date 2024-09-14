<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Berita Acara Sempro</title>
    <style>
        @page {
            margin: 2cm;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10pt;
            line-height: 1.5;
            margin: 0;
            padding: 0;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .header img {
            width: 150px;
            height: auto;
        }

        .header-address {
            text-align: right;
            font-size: 10pt;
            line-height: 1.3;
            margin-top: -40px;
        }

        .title {
            text-align: center;
            font-size: 12pt;
            font-weight: bold;
            margin: 20px 0;
        }

        .content {
            margin-bottom: 10px;
        }

        .content-table {
            width: 100%;
            font-size: 10pt;
        }

        .content-table td {
            padding: 4px;
        }

        .content-table td:first-child {
            width: 120px;
        }

        .isi table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 10pt;
        }

        .isi th,
        .isi td {
            border: 1px solid #ddd;
            padding: 6px;
            text-align: left;
        }

        .isi th {
            background-color: #808080;
            color: white;
        }

        .signature-section {
            margin-top: 5px;
        }

        .signature-table {
            width: 100%;
            text-align: center;
            margin-top: 5px;
        }

        .signature-table td {
            padding-top: 10px;
        }

        .signature-name {
            font-weight: bold;
            text-decoration: underline;
        }

        .page-break {
            page-break-before: always;
        }

    </style>
</head>

<body>

<div class="header">
    <img src="<?= base_url('cdn/img/informatika.png'); ?>" alt="Logo">
    <div class="header-address">
        Jalan Olat Maras, Batu Alang, Kec. Moyo Hulu<br>
        Kab. Sumbawa, Nusa Tenggara Barat, 84371<br>
        Telp. (0371) 2629009<br>
        www.uts.ac.id
    </div>
</div>

<div class="title">Form Penilaian Seminar Proposal Skripsi</div>

<section class="content">
    <table class="content-table">
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
            <td><?= number_format($showData['penguji1_rata_nilai'], 2) ?></td>
        </tr>
    </table>
</section>

<section class="signature-section">
    <table class="signature-table">
        <tr>
            <td>
                Menyetujui<br>Penguji I
            </td>
        </tr>
        <tr>
            <td>
                <img src="<?= base_url('cdn/vendor/qrcodes/' . $showData['penguji1_barcode']); ?>" width="20%" alt="">
                <br><br><br>
                <span class="signature-name"><?= $showData['penguji1_nama']; ?></span>
                <br>
                NIDN. <?= $showData['penguji1_nip']; ?>
            </td>
        </tr>
    </table>
</section>

<div class="page-break"></div>

<!-- Header Baru untuk Penguji 2 -->
<div class="header">
    <img src="<?= base_url('cdn/img/informatika.png'); ?>" alt="Logo">
    <div class="header-address">
        Jalan Olat Maras, Batu Alang, Kec. Moyo Hulu<br>
        Kab. Sumbawa, Nusa Tenggara Barat, 84371<br>
        Telp. (0371) 2629009<br>
        www.uts.ac.id
    </div>
</div>

<div class="title">Form Penilaian Seminar Proposal Skripsi</div>

<section class="content">
    <table class="content-table">
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
            <td><?= number_format($showData['penguji2_rata_nilai'], 2) ?></td>
        </tr>
    </table>
</section>

<section class="signature-section">
    <table class="signature-table">
        <tr>
            <td>
                Menyetujui<br>Penguji II
            </td>
        </tr>
        <tr>
            <td>
                <img src="<?= base_url('cdn/vendor/qrcodes/' . $showData['penguji2_barcode']); ?>" width="20%" alt="">
                <br><br><br>
                <span class="signature-name"><?= $showData['penguji2_nama']; ?></span>
                <br>
                NIDN. <?= $showData['penguji2_nip']; ?>
            </td>
        </tr>
    </table>
</section>

<div class="page-break"></div>

<!-- Header Baru untuk Pembimbing -->
<div class="header">
    <img src="<?= base_url('cdn/img/informatika.png'); ?>" alt="Logo">
    <div class="header-address">
        Jalan Olat Maras, Batu Alang, Kec. Moyo Hulu<br>
        Kab. Sumbawa, Nusa Tenggara Barat, 84371<br>
        Telp. (0371) 2629009<br>
        www.uts.ac.id
    </div>
</div>

<div class="title">Form Penilaian Seminar Proposal Skripsi</div>

<section class="content">
    <table class="content-table">
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
            <td><?= number_format($showData['pembimbing_rata_nilai'], 2) ?></td>
        </tr>
    </table>
</section>

<section class="signature-section">
    <table class="signature-table">
        <tr>
            <td>
                Mengetahui<br>Pembimbing Utama
            </td>
        </tr>
        <tr>
            <td>
                <img src="<?= base_url('cdn/vendor/qrcodes/' . $showData['pembimbing_barcode']); ?>" width="20%" alt="">
                <br><br><br>
                <span class="signature-name"><?= $showData['pembimbing_nama']; ?></span>
                <br>
                NIDN. <?= $showData['pembimbing_nip']; ?>
            </td>
        </tr>
    </table>
</section>

<div class="page-break"></div>

<!-- Header Baru untuk Berita Acara -->
<div class="header">
    <img src="<?= base_url('cdn/img/informatika.png'); ?>" alt="Logo">
    <div class="header-address">
        Jalan Olat Maras, Batu Alang, Kec. Moyo Hulu<br>
        Kab. Sumbawa, Nusa Tenggara Barat, 84371<br>
        Telp. (0371) 2629009<br>
        www.uts.ac.id
    </div>
</div>

<div class="title">BERITA ACARA SEMINAR PROPOSAL</div>

<section class="content">
    <table class="content-table">
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

<section class="content">
    <p>Telah Dilaksanakan Seminar Proposal dengan judul:</p>
    <table class="content-table">
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
    <div class="title">MEMUTUSKAN</div>
    <table class="content-table">
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
            <?php if($showData['nama_predikat'] == 'A' || $showData['nama_predikat'] == 'A-' || $showData['nama_predikat'] == 'B+' || $showData['nama_predikat'] == 'B-' || $showData['nama_predikat'] == 'B' || $showData['nama_predikat'] == 'C+' ||$showData['nama_predikat'] == 'C') { ?>
                <td>: DITERIMA untuk meneruskan penelitian dengan proposal Skripsi tersebut diatas</td>
            <?php } else { ?>
            <td>: TIDAK DITERIMA untuk meneruskan penelitian dengan proposal Skripsi tersebut diatas</td>
            <?php } ?>
        </tr>
        <tr>
            <td>Dengan Nilai</td>
            <td>: <?= number_format($showData['total_rata_rata'], 2) ?> </td>
        </tr>
        <tr>
            <td>Dengan Predikat</td>
            <td>: <?= $showData['nama_predikat'] ?></td>
        </tr>
    </table>
    <div class="page-break"></div>

    <!-- Header Baru untuk Berita Acara -->
    <div class="header">
        <img src="<?= base_url('cdn/img/informatika.png'); ?>" alt="Logo">
        <div class="header-address">
            Jalan Olat Maras, Batu Alang, Kec. Moyo Hulu<br>
            Kab. Sumbawa, Nusa Tenggara Barat, 84371<br>
            Telp. (0371) 2629009<br>
            www.uts.ac.id
        </div>
    </div>

    <table class="signature-table">
        <tr>
            <td style="font-weight: bold">Menyetujui<br>Penguji 1</td>
            <td style="font-weight: bold">Penguji 2</td>
            <td style="font-weight: bold">Pembimbing Utama</td>
        </tr>
        <tr>
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
        <tr>
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
