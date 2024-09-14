<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Berita Acara Ujian Skripsi</title>
    <style>
        @page {
            margin: 2cm;
        }
        body {
            font-family: Times New Roman, serif;
            font-size: 12pt;
            line-height: 1.5;
            margin: 0;
            padding: 0;
        }

        .page-break {
            page-break-before: always;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .header img {
            width: 300px;
            height: auto;
        }

        .header-text {
            text-align: center;
            font-size: 14pt;
            font-weight: bold;
        }

        .header-address {
            text-align: right;
            font-size: 10pt;
            line-height: 1.3;
            margin-top: -80px;
        }

        .title {
            text-align: center;
            font-size: 14pt;
            font-weight: bold;
            margin: 20px 0;
        }

        .content {
            margin-bottom: 20px;
        }

        .content-table {
            width: 100%;
        }

        .content-table td:first-child {
            width: 120px;
        }

        .memutuskan {
            text-align: center;
            font-weight: bold;
            margin: 20px 0;
        }

        .signature-table {
            width: 100%;
            margin-top: 50px;
        }

        .signature-table td {
            width: 50%;
            vertical-align: top;
            padding-bottom: 20px;
        }

        .signature-name {
            font-weight: bold;
            text-decoration: underline;
            margin-top: 40px;
        }

        .catatan {
            margin-top: 20px;
        }

        .catatan-line {
            border-bottom: 1px solid black;
            height: 20px;
        }

        .rekap-title {
            text-align: center;
            font-size: 14pt;
            font-weight: bold;
            margin: 20px 0;
        }

        .rekap-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .rekap-table, .rekap-table th, .rekap-table td {
            border: 1px solid black;
        }

        .rekap-table th, .rekap-table td {
            padding: 8px;
            text-align: left;
        }

        .rekap-table th {
            text-align: center;
        }

        .footer-text {
            margin-top: 20px;
        }

        .footer-text p {
            text-align: center;
        }

        .footer-signature {
            text-align: center;
            margin-top: 50px;
        }

        .footer-signature img {
            margin-top: 30px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .footer-signature p {
            text-align: center;
            font-weight: bold;
        }

        .footer-signature .signature-name {
            margin-top: 50px;
            text-decoration: underline;
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

<div class="title">BERITA ACARA UJIAN SKRIPSI</div>

<div class="content">
    <p>Telah dilaksanakan Ujian Skripsi pada:</p>
    <table class="content-table">
        <tr>
            <td>Hari, Tanggal</td>
            <td>: <?= tgl_indo($showData['jadwal_skripsi']) ?></td>
        </tr>
        <tr>
            <td>Pukul</td>
            <td>: <?= date('H:i', strtotime($showData['jadwal_skripsi'])); ?> WITA</td>
        </tr>
        <tr>
            <td>Tempat</td>
            <td>: <?= $showData['tempat_skripsi'] ?></td>
        </tr>
        <tr>
            <td>Judul</td>
            <td>: <?= $showData['judul_skripsi'] ?></td>
        </tr>
        <tr>
            <td>Oleh</td>
            <td>: <?= $showData['nama_mahasiswa'] ?></td>
        </tr>
        <tr>
            <td>NIM</td>
            <td>: <?= $showData['nim'] ?></td>
        </tr>
        <tr>
            <td>Program Studi</td>
            <td>: <?= $showData['nama_prodi'] ?></td>
        </tr>
    </table>
</div>

<div class="memutuskan">MEMUTUSKAN</div>

<div class="content">
    <table class="content-table">
        <tr>
            <td>Nama</td>
            <td>: <?= $showData['nama_mahasiswa'] ?></td>
        </tr>
        <tr>
            <td>NIM</td>
            <td>: <?= $showData['nim'] ?></td>
        </tr>
        <tr>
            <td>Judul Skripsi</td>
            <td>: <?= $showData['judul_skripsi'] ?></td>
        </tr>
    </table>
    <p style="text-align: center;">
        Dinyatakan :
        <?php if($showData['nama_predikat'] == 'A' || $showData['nama_predikat'] == 'A-' || $showData['nama_predikat'] == 'B+' || $showData['nama_predikat'] == 'B-' || $showData['nama_predikat'] == 'B' || $showData['nama_predikat'] == 'C+' || $showData['nama_predikat'] == 'C') { ?>
            <strong>LULUS</strong>
        <?php } else { ?>
            <strong>TIDAK LULUS</strong>
        <?php } ?>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        dengan Nilai : <?= $showData['total_rata_rata'] ?>
    </p>

</div>

<div class="catatan">
    <p>Catatan :</p>
    <div class="catatan-line"></div>
    <div class="catatan-line"></div>
    <div class="catatan-line"></div>
</div>

<table class="signature-table">
    <tr>
        <td>
            <p>Menyetujui Tim Penguji,</p>
            <p><strong>Pembimbing Utama</strong></p>
            <img src="<?= base_url('cdn/vendor/qrcodes/' . $showData['barcode_penguji1']); ?>" width="20%" alt="">
            <p class="signature-name">(<?= $showData['nama_penguji1'] ?>)</p>
            <p>NIDN. <?= $showData['nip_penguji1'] ?></p>
        </td>
        <td>
            <p><strong>Sekretaris</strong></p>
            <img src="<?= base_url('cdn/vendor/qrcodes/' . $showData['barcode_penguji2']); ?>" width="20%" alt="">
            <p class="signature-name">(<?= $showData['nama_penguji2'] ?>)</p>
            <p>NIDN. <?= $showData['nip_penguji2'] ?></p>
        </td>
    </tr>
    <tr>
        <td>
            <p><strong>Ketua Penguji</strong></p>
            <img src="<?= base_url('cdn/vendor/qrcodes/' . $showData['barcode_pembimbing1']); ?>" width="20%" alt="">
            <p class="signature-name">(<?= $showData['nama_pembimbing1'] ?>)</p>
            <p>NIDN. <?= $showData['nip_pembimbing1'] ?></p>
        </td>
        <td>
            <p><strong>Mengetahui,</strong></p>
            <p><strong>Ketua Program Studi Informatika</strong></p>
            <p class="signature-name">Rodianto, M.Kom</p>
            <p>NIP. 198107082014011014</p>
        </td>
    </tr>
</table>

<div class="page-break"></div>

<div class="header">
    <img src="<?= base_url('cdn/img/informatika.png'); ?>" alt="Logo">
    <div class="header-address">
        Jalan Olat Maras, Batu Alang, Kec. Moyo Hulu<br>
        Kab. Sumbawa, Nusa Tenggara Barat, 84371<br>
        Telp. (0371) 2629009<br>
        www.uts.ac.id
    </div>
</div>

<div class="rekap-title">REKAP DATA PENILAIAN UJIAN SKRIPSI</div>

<div class="content">
    <table class="content-table">
        <tr>
            <td>Nama Mahasiswa</td>
            <td>: <?= $showData['nama_mahasiswa'] ?></td>
        </tr>
        <tr>
            <td>NIM</td>
            <td>: <?= $showData['nim'] ?></td>
        </tr>
        <tr>
            <td>Program Studi</td>
            <td>: <?= $showData['nama_prodi'] ?></td>
        </tr>
        <tr>
            <td>Fakultas</td>
            <td>: Rekayasa Sistem</td>
        </tr>
        <tr>
            <td>Judul Skripsi</td>
            <td>: <?= $showData['judul_skripsi'] ?></td>
        </tr>
    </table>
</div>

<table class="rekap-table">
    <tr>
        <th>NO</th>
        <th>NAMA DOSEN PENGUJI</th>
        <th>NILAI</th>
        <th>KETERANGAN</th>
    </tr>
    <tr>
        <td>1</td>
        <td><?= $showData['nama_penguji1'] ?></td>
        <td><?= $showData['penguji1_nilai_rata_rata'] ?></td>
        <td></td>
    </tr>
    <tr>
        <td>2</td>
        <td><?= $showData['nama_penguji2'] ?></td>
        <td><?= $showData['penguji2_nilai_rata_rata']?></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td>Jumlah Nilai Ujian</td>
        <td>
            <?php echo $showData['penguji1_nilai_rata_rata'] + $showData['penguji2_nilai_rata_rata'] ?>
        </td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td>Jumlah Nilai rata-rata Ujian</td>
        <td><?php echo ($showData['penguji1_nilai_rata_rata'] + $showData['penguji2_nilai_rata_rata']) / 2 ?></td>
        <td></td>
    </tr>
</table>

<table class="rekap-table">
    <tr>
        <th>NO</th>
        <th>NAMA DOSEN PEMBIMBING</th>
        <th>NILAI</th>
        <th>KETERANGAN</th>
    </tr>
    <tr>
        <td>1</td>
        <td><?= $showData['nama_pembimbing1'] ?></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td>Jumlah Nilai Bimbingan</td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td>Jumlah Nilai rata-rata Ujian</td>
        <td><?= $showData['pembimbing1_nilai_rata_rata'] ?></td>
        <td></td>
    </tr>
</table>

<div class="footer-text">
    <p>Nilai rata-rata ujian Skripsi = <?php echo ($showData['penguji1_nilai_rata_rata'] + $showData['penguji2_nilai_rata_rata']) / 2 ?> +  <?= $showData['pembimbing1_nilai_rata_rata']  ?> : 2 = <?php echo (($showData['penguji1_nilai_rata_rata'] + $showData['penguji2_nilai_rata_rata']) / 2 + $showData['pembimbing1_nilai_rata_rata']) / 2 ?></p>
    <p>Berdasarkan batas nilai Kelulusan, maka mahasiswa tersebut dinyatakan:</p>
    <p>
        <?php if($showData['nama_predikat'] == 'A' || $showData['nama_predikat'] == 'A-' || $showData['nama_predikat'] == 'B+' || $showData['nama_predikat'] == 'B-' || $showData['nama_predikat'] == 'B' || $showData['nama_predikat'] == 'C+' || $showData['nama_predikat'] == 'C') { ?>
            <strong>LULUS</strong>
        <?php } else { ?>
            <strong>TIDAK LULUS</strong>
        <?php } ?>
    </p>
</div>

<div class="footer-text">
    <p>Sumbawa, <?= tgl_indo($showData['jadwal_skripsi']) ?></p>
    <p>Ketua Sidang</p>
</div>

<div class="footer-signature">
    <img src="<?= base_url('cdn/vendor/qrcodes/' . $showData['barcode_penguji1']); ?>" width="20%" alt="">
    <p class="signature-name">(<?= $showData['nama_penguji1'] ?>)</p>
    <p>NIDN. <?= $showData['nip_penguji1'] ?></p>
</div>

<div class="page-break"></div>

<div class="header">
    <img src="<?= base_url('cdn/img/informatika.png'); ?>" alt="Logo">
    <div class="header-address">
        Jalan Olat Maras, Batu Alang, Kec. Moyo Hulu<br>
        Kab. Sumbawa, Nusa Tenggara Barat, 84371<br>
        Telp. (0371) 2629009<br>
        www.uts.ac.id
    </div>
</div>

<div class="rekap-title">LEMBAR BLANGKO UJIAN SKRIPSI</div>

<div class="content">
    <table class="content-table">
        <tr>
            <td>Nama Mahasiswa</td>
            <td>: <?= $showData['nama_mahasiswa'] ?></td>
        </tr>
        <tr>
            <td>NIM</td>
            <td>: <?= $showData['nim'] ?></td>
        </tr>
        <tr>
            <td>Program Studi</td>
            <td>: <?= $showData['nama_prodi'] ?></td>
        </tr>
        <tr>
            <td>Fakultas</td>
            <td>: Rekayasa Sistem</td>
        </tr>
        <tr>
            <td>Judul Skripsi</td>
            <td>: <?= $showData['judul_skripsi'] ?></td>
        </tr>
    </table>
</div>

<table class="rekap-table">
    <tr>
        <th>NO</th>
        <th>KOMPONEN PENILAIAN</th>
        <th>BOBOT</th>
        <th>NILAI</th>
        <th>BOBOT X NILAI</th>
    </tr>
    <tr>
        <td colspan="5" style="text-align: center;"><strong>A. NASKAH SKRIPSI</strong></td>
    </tr>
    <tr>
        <td>1</td>
        <td>a. Pokok permasalahan</td>
        <td>1</td>
        <td><?= $showData['penguji1_pokok_permasalahan'] ?></td>
        <td><?= $showData['penguji1_pokok_permasalahan'] * 1 ?></td>
    </tr>
    <tr>
        <td>2</td>
        <td>b. Kerangka Pemikiran</td>
        <td>2</td>
        <td><?= $showData['penguji1_kerangka_pemikiran'] ?></td>
        <td><?= $showData['penguji1_kerangka_pemikiran'] * 2 ?></td>
    </tr>
    <tr>
        <td>3</td>
        <td>c. Metode penelitian</td>
        <td>2</td>
        <td><?= $showData['penguji1_metode_penelitian'] ?></td>
        <td><?= $showData['penguji1_metode_penelitian'] * 2 ?></td>
    </tr>
    <tr>
        <td>4</td>
        <td>d. Hasil Penelitian</td>
        <td>2</td>
        <td><?= $showData['penguji1_hasil_penelitian'] ?></td>
        <td><?= $showData['penguji1_hasil_penelitian'] * 2 ?></td>
    </tr>
    <tr>
        <td>5</td>
        <td>e. Bahasa</td>
        <td>2</td>
        <td><?= $showData['penguji1_bahasa'] ?></td>
        <td><?= $showData['penguji1_bahasa'] * 2 ?></td>
    </tr>
    <tr>
        <td>6</td>
        <td>f. Teknik penulisan</td>
        <td>1</td>
        <td><?= $showData['penguji1_teknik_penulisan'] ?></td>
        <td><?= $showData['penguji1_teknik_penulisan'] * 1 ?></td>
    </tr>
    <tr>
        <td colspan="5" style="text-align: center;"><strong>B. Manfaat akademis dan praktis</strong></td>
    </tr>
    <tr>
        <td>1</td>
        <td>Ujian Lisan</td>
        <td>2</td>
        <td><?= $showData['penguji1_manfaat_akademis_praktis'] ?></td>
        <td><?= $showData['penguji1_manfaat_akademis_praktis'] * 2 ?></td>
    </tr>
    <tr>
        <td colspan="5" style="text-align: center;"><strong>C. Ujian Lisan</strong></td>
    </tr>
    <tr>
        <td>1</td>
        <td>a. Penguasaan Materi</td>
        <td>2</td>
        <td><?= $showData['penguji1_penguasaan_materi'] ?></td>
        <td><?= $showData['penguji1_penguasaan_materi'] * 2 ?></td>
    </tr>
    <tr>
        <td>2</td>
        <td>b. Penguasaan Metode</td>
        <td>2</td>
        <td><?= $showData['penguji1_penguasaan_metode'] ?></td>
        <td><?= $showData['penguji1_penguasaan_metode'] * 2 ?></td>
    </tr>
    <tr>
        <td>3</td>
        <td>c. Kemampuan argumentasi</td>
        <td>2</td>
        <td><?= $showData['penguji1_kemampuan_argumentasi'] ?></td>
        <td><?= $showData['penguji1_kemampuan_argumentasi'] * 2 ?></td>
    </tr>
    <tr>
        <td colspan="4"><strong>Jumlah</strong></td>
        <td><?= $showData['penguji1_jumlah'] ?></td>
    </tr>
</table>

<div class="footer-text">
    <p>Nilai rata-rata dari dosen penguji = <?= $showData['penguji1_nilai_rata_rata'] ?></p>
</div>

<div class="footer-text">
    <p>Sumbawa,  <?= tgl_indo($showData['jadwal_skripsi']) ?></p>
    <p>Ketua Sidang</p>
</div>

<div class="footer-signature">
    <img src="<?= base_url('cdn/vendor/qrcodes/' . $showData['barcode_penguji1']); ?>" width="20%" alt="">
    <p class="signature-name">(<?= $showData['nama_penguji1'] ?>)</p>
    <p>NIDN. <?= $showData['nip_penguji1'] ?></p>
</div>

<div class="page-break"></div>
<!--sekretaris sidang -->
<div class="header">
    <img src="<?= base_url('cdn/img/informatika.png'); ?>" alt="Logo">
    <div class="header-address">
        Jalan Olat Maras, Batu Alang, Kec. Moyo Hulu<br>
        Kab. Sumbawa, Nusa Tenggara Barat, 84371<br>
        Telp. (0371) 2629009<br>
        www.uts.ac.id
    </div>
</div>

<div class="rekap-title">LEMBAR BLANGKO UJIAN SKRIPSI</div>

<div class="content">
    <table class="content-table">
        <tr>
            <td>Nama Mahasiswa</td>
            <td>: <?= $showData['nama_mahasiswa'] ?></td>
        </tr>
        <tr>
            <td>NIM</td>
            <td>: <?= $showData['nim'] ?></td>
        </tr>
        <tr>
            <td>Program Studi</td>
            <td>: <?= $showData['nama_prodi'] ?></td>
        </tr>
        <tr>
            <td>Fakultas</td>
            <td>: Rekayasa Sistem</td>
        </tr>
        <tr>
            <td>Judul Skripsi</td>
            <td>: <?= $showData['judul_skripsi'] ?></td>
        </tr>
    </table>
</div>

<table class="rekap-table">
    <tr>
        <th>NO</th>
        <th>KOMPONEN PENILAIAN</th>
        <th>BOBOT</th>
        <th>NILAI</th>
        <th>BOBOT X NILAI</th>
    </tr>
    <tr>
        <td colspan="5" style="text-align: center;"><strong>A. NASKAH SKRIPSI</strong></td>
    </tr>
    <tr>
        <td>1</td>
        <td>a. Pokok permasalahan</td>
        <td>1</td>
        <td><?= $showData['penguji2_pokok_permasalahan'] ?></td>
        <td><?= $showData['penguji2_pokok_permasalahan'] * 1 ?></td>
    </tr>
    <tr>
        <td>2</td>
        <td>b. Kerangka Pemikiran</td>
        <td>2</td>
        <td><?= $showData['penguji2_kerangka_pemikiran'] ?></td>
        <td><?= $showData['penguji2_kerangka_pemikiran'] * 2 ?></td>
    </tr>
    <tr>
        <td>3</td>
        <td>c. Metode penelitian</td>
        <td>2</td>
        <td><?= $showData['penguji2_metode_penelitian'] ?></td>
        <td><?= $showData['penguji2_metode_penelitian'] * 2 ?></td>
    </tr>
    <tr>
        <td>4</td>
        <td>d. Hasil Penelitian</td>
        <td>2</td>
        <td><?= $showData['penguji2_hasil_penelitian'] ?></td>
        <td><?= $showData['penguji2_hasil_penelitian'] * 2 ?></td>
    </tr>
    <tr>
        <td>5</td>
        <td>e. Bahasa</td>
        <td>2</td>
        <td><?= $showData['penguji2_bahasa'] ?></td>
        <td><?= $showData['penguji2_bahasa'] * 2 ?></td>
    </tr>
    <tr>
        <td>6</td>
        <td>f. Teknik penulisan</td>
        <td>1</td>
        <td><?= $showData['penguji2_teknik_penulisan'] ?></td>
        <td><?= $showData['penguji2_teknik_penulisan'] * 1 ?></td>
    </tr>
    <tr>
        <td colspan="5" style="text-align: center;"><strong>B. Manfaat akademis dan praktis</strong></td>
    </tr>
    <tr>
        <td>1</td>
        <td>Ujian Lisan</td>
        <td>2</td>
        <td><?= $showData['penguji2_manfaat_akademis_praktis'] ?></td>
        <td><?= $showData['penguji2_manfaat_akademis_praktis'] * 2 ?></td>
    </tr>
    <tr>
        <td colspan="5" style="text-align: center;"><strong>C. Ujian Lisan</strong></td>
    </tr>
    <tr>
        <td>1</td>
        <td>a. Penguasaan Materi</td>
        <td>2</td>
        <td><?= $showData['penguji2_penguasaan_materi'] ?></td>
        <td><?= $showData['penguji2_penguasaan_materi'] * 2 ?></td>
    </tr>
    <tr>
        <td>2</td>
        <td>b. Penguasaan Metode</td>
        <td>2</td>
        <td><?= $showData['penguji2_penguasaan_metode'] ?></td>
        <td><?= $showData['penguji2_penguasaan_metode'] * 2 ?></td>
    </tr>
    <tr>
        <td>3</td>
        <td>c. Kemampuan argumentasi</td>
        <td>2</td>
        <td><?= $showData['penguji2_kemampuan_argumentasi'] ?></td>
        <td><?= $showData['penguji2_kemampuan_argumentasi'] * 2 ?></td>
    </tr>
    <tr>
        <td colspan="4"><strong>Jumlah</strong></td>
        <td><?= $showData['penguji2_jumlah'] ?></td>
    </tr>
</table>

<div class="footer-text">
    <p>Nilai rata-rata dari dosen penguji = <?= $showData['penguji2_nilai_rata_rata'] ?></p>
</div>

<div class="footer-text">
    <p>Sumbawa,  <?= tgl_indo($showData['jadwal_skripsi']) ?></p>
    <p>Sekretaris Sidang</p>
</div>

<div class="footer-signature">
    <img src="<?= base_url('cdn/vendor/qrcodes/' . $showData['barcode_penguji2']); ?>" width="20%" alt="">
    <p class="signature-name">(<?= $showData['nama_penguji2'] ?>)</p>
    <p>NIDN.<?= $showData['nip_penguji2'] ?></p>
</div>

<div class="page-break"></div>

<!--pembimbing utama-->
<div class="header">
    <img src="<?= base_url('cdn/img/informatika.png'); ?>" alt="Logo">
    <div class="header-address">
        Jalan Olat Maras, Batu Alang, Kec. Moyo Hulu<br>
        Kab. Sumbawa, Nusa Tenggara Barat, 84371<br>
        Telp. (0371) 2629009<br>
        www.uts.ac.id
    </div>
</div>

<div class="rekap-title">LEMBAR BLANGKO UJIAN SKRIPSI</div>

<div class="content">
    <table class="content-table">
        <tr>
            <td>Nama Mahasiswa</td>
            <td>: <?= $showData['nama_mahasiswa'] ?></td>
        </tr>
        <tr>
            <td>NIM</td>
            <td>: <?= $showData['nim'] ?></td>
        </tr>
        <tr>
            <td>Program Studi</td>
            <td>: <?= $showData['nama_prodi'] ?></td>
        </tr>
        <tr>
            <td>Fakultas</td>
            <td>: Rekayasa Sistem</td>
        </tr>
        <tr>
            <td>Judul Skripsi</td>
            <td>: <?= $showData['judul_skripsi'] ?></td>
        </tr>
    </table>
</div>

<table class="rekap-table">
    <tr>
        <th>NO</th>
        <th>KOMPONEN PENILAIAN</th>
        <th>BOBOT</th>
        <th>NILAI</th>
        <th>BOBOT X NILAI</th>
    </tr>
    <tr>
        <td colspan="5" style="text-align: center;"><strong>A. NASKAH SKRIPSI</strong></td>
    </tr>
    <tr>
        <td>1</td>
        <td>a. Pokok permasalahan</td>
        <td>1</td>
        <td><?= $showData['pembimbing1_pokok_permasalahan'] ?></td>
        <td><?= $showData['pembimbing1_pokok_permasalahan'] * 1 ?></td>
    </tr>
    <tr>
        <td>2</td>
        <td>b. Kerangka Pemikiran</td>
        <td>2</td>
        <td><?= $showData['pembimbing1_kerangka_pemikiran'] ?></td>
        <td><?= $showData['pembimbing1_kerangka_pemikiran'] * 2 ?></td>
    </tr>
    <tr>
        <td>3</td>
        <td>c. Metode penelitian</td>
        <td>2</td>
        <td><?= $showData['pembimbing1_metode_penelitian'] ?></td>
        <td><?= $showData['pembimbing1_metode_penelitian'] * 2 ?></td>
    </tr>
    <tr>
        <td>4</td>
        <td>d. Hasil Penelitian</td>
        <td>2</td>
        <td><?= $showData['pembimbing1_hasil_penelitian'] ?></td>
        <td><?= $showData['pembimbing1_hasil_penelitian'] * 2 ?></td>
    </tr>
    <tr>
        <td>5</td>
        <td>e. Bahasa</td>
        <td>2</td>
        <td><?= $showData['pembimbing1_bahasa'] ?></td>
        <td><?= $showData['pembimbing1_bahasa'] * 2 ?></td>
    </tr>
    <tr>
        <td>6</td>
        <td>f. Teknik penulisan</td>
        <td>1</td>
        <td><?= $showData['pembimbing1_teknik_penulisan'] ?></td>
        <td><?= $showData['pembimbing1_teknik_penulisan'] * 1 ?></td>
    </tr>
    <tr>
        <td colspan="5" style="text-align: center;"><strong>B. Manfaat akademis dan praktis</strong></td>
    </tr>
    <tr>
        <td>1</td>
        <td>Ujian Lisan</td>
        <td>2</td>
        <td><?= $showData['pembimbing1_manfaat_akademis_praktis'] ?></td>
        <td><?= $showData['pembimbing1_manfaat_akademis_praktis'] * 2 ?></td>
    </tr>
    <tr>
        <td colspan="5" style="text-align: center;"><strong>C. Ujian Lisan</strong></td>
    </tr>
    <tr>
        <td>1</td>
        <td>a. Penguasaan Materi</td>
        <td>2</td>
        <td><?= $showData['pembimbing1_penguasaan_materi'] ?></td>
        <td><?= $showData['pembimbing1_penguasaan_materi'] * 2 ?></td>
    </tr>
    <tr>
        <td>2</td>
        <td>b. Penguasaan Metode</td>
        <td>2</td>
        <td><?= $showData['pembimbing1_penguasaan_metode'] ?></td>
        <td><?= $showData['pembimbing1_penguasaan_metode'] * 2 ?></td>
    </tr>
    <tr>
        <td>3</td>
        <td>c. Kemampuan argumentasi</td>
        <td>2</td>
        <td><?= $showData['pembimbing1_kemampuan_argumentasi'] ?></td>
        <td><?= $showData['pembimbing1_kemampuan_argumentasi'] * 2 ?></td>
    </tr>
    <tr>
        <td colspan="4"><strong>Jumlah</strong></td>
        <td><?= $showData['pembimbing1_jumlah'] ?></td>
    </tr>
</table>

<div class="footer-text">
    <p>Nilai rata-rata dari dosen pembimbing = <?= $showData['pembimbing1_nilai_rata_rata'] ?></p>
</div>

<div class="footer-text">
    <p>Sumbawa, <?= tgl_indo($showData['jadwal_skripsi']) ?></p>
    <p><strong>Pembimbing Utama</strong></p>
</div>

<div class="footer-signature">
    <img src="<?= base_url('cdn/vendor/qrcodes/' . $showData['barcode_pembimbing1']); ?>" width="20%" alt="">
    <p class="signature-name">(<?= $showData['nama_pembimbing1'] ?>)</p>
    <p>NIDN.<?= $showData['nip_pembimbing1']  ?></p>
</div>

</body>
</html>
