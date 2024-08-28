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

        .footer-signature img {
            margin-top: 50px;
            align-items: center;
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
            <td>: <?= $showData['jadwal_skripsi']; ?></td>
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
            <td>: <?= $showData['tempat_skripsi'] ?></td>
        </tr>
    </table>
    <p>Dinyatakan : LULUS/TIDAK LULUS dengan Nilai :</p>
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
            <p class="signature-name">(<?= $showData['nama_penguji1'] ?>)</p>
            <p>NIDN. <?= $showData['nip_penguji1'] ?></p>
        </td>
        <td>
            <p><strong>Sekretaris</strong></p>
            <p class="signature-name">(<?= $showData['nama_penguji2'] ?>)</p>
            <p>NIDN. <?= $showData['nip_penguji2'] ?></p>
        </td>
    </tr>
    <tr>
        <td>
            <p><strong>Ketua Penguji</strong></p>
            <p class="signature-name">(<?= $showData['nama_pembimbing1'] ?>)</p>
            <p>NIDN. <?= $showData['nip_pembimbing1'] ?>></p>
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
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>2</td>
        <td><?= $showData['nama_penguji2'] ?></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td>Jumlah Nilai Ujian</td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td>Jumlah Nilai rata-rata Ujian</td>
        <td></td>
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
        <td></td>
        <td></td>
    </tr>
</table>

<div class="footer-text">
    <p>Nilai rata-rata ujian Skripsi = _____ + _____ = _____</p>
    <p>Berdasarkan batas nilai Kelulusan, maka mahasiswa tersebut dinyatakan:</p>
    <p><strong>LULUS/TIDAK LULUS</strong></p>
</div>

<div class="footer-text">
    <p>Sumbawa, __________</p>
    <p>Ketua Sidang</p>
</div>

<div class="footer-signature">
    <p class="signature-name">(Nora Dery Sofya, M.M.Inov)</p>
    <p>NIDN. 0816069501</p>
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
        <td></td>
    </tr>
    <tr>
        <td>2</td>
        <td>b. Kerangka Pemikiran</td>
        <td>2</td>
        <td><?= $showData['penguji1_kerangka_pemikiran'] ?></td>
        <td></td>
    </tr>
    <tr>
        <td>3</td>
        <td>c. Metode penelitian</td>
        <td>2</td>
        <td><?= $showData['penguji1_metode_penelitian'] ?></td>
        <td></td>
    </tr>
    <tr>
        <td>4</td>
        <td>d. Hasil Penelitian</td>
        <td>2</td>
        <td><?= $showData['penguji1_hasil_penelitian'] ?></td>
        <td></td>
    </tr>
    <tr>
        <td>5</td>
        <td>e. Bahasa</td>
        <td>2</td>
        <td><?= $showData['penguji1_bahasa'] ?></td>
        <td></td>
    </tr>
    <tr>
        <td>6</td>
        <td>f. Teknik penulisan</td>
        <td>1</td>
        <td><?= $showData['penguji1_teknik_penulisan'] ?></td>
        <td></td>
    </tr>
    <tr>
        <td colspan="5" style="text-align: center;"><strong>B. Manfaat akademis dan praktis</strong></td>
    </tr>
    <tr>
        <td>1</td>
        <td>Ujian Lisan</td>
        <td>2</td>
        <td><?= $showData['penguji1_manfaat_akademis_praktis'] ?></td>
        <td></td>
    </tr>
    <tr>
        <td colspan="5" style="text-align: center;"><strong>C. Ujian Lisan</strong></td>
    </tr>
    <tr>
        <td>1</td>
        <td>a. Penguasaan Materi</td>
        <td>2</td>
        <td><?= $showData['penguji1_penguasaan_materi'] ?></td>
        <td></td>
    </tr>
    <tr>
        <td>2</td>
        <td>b. Penguasaan Metode</td>
        <td>2</td>
        <td><?= $showData['penguji1_penguasaan_metode'] ?></td>
        <td></td>
    </tr>
    <tr>
        <td>3</td>
        <td>c. Kemampuan argumentasi</td>
        <td>2</td>
        <td><?= $showData['penguji1_kemampuan_argumentasi'] ?></td>
        <td></td>
    </tr>
    <tr>
        <td colspan="4"><strong>Jumlah</strong></td>
        <td></td>
    </tr>
</table>

<div class="footer-text">
    <p>Nilai rata-rata dari dosen penguji = _____</p>
</div>

<div class="footer-text">
    <p>Sumbawa, __________</p>
    <p>Ketua Sidang</p>
</div>

<div class="footer-signature">
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
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>2</td>
        <td>b. Kerangka Pemikiran</td>
        <td>2</td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>3</td>
        <td>c. Metode penelitian</td>
        <td>2</td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>4</td>
        <td>d. Hasil Penelitian</td>
        <td>2</td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>5</td>
        <td>e. Bahasa</td>
        <td>2</td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>6</td>
        <td>f. Teknik penulisan</td>
        <td>1</td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td colspan="5" style="text-align: center;"><strong>B. Manfaat akademis dan praktis</strong></td>
    </tr>
    <tr>
        <td>1</td>
        <td>Ujian Lisan</td>
        <td>2</td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td colspan="5" style="text-align: center;"><strong>C. Ujian Lisan</strong></td>
    </tr>
    <tr>
        <td>1</td>
        <td>a. Penguasaan Materi</td>
        <td>2</td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>2</td>
        <td>b. Penguasaan Metode</td>
        <td>2</td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>3</td>
        <td>c. Kemampuan argumentasi</td>
        <td>2</td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td colspan="4"><strong>Jumlah</strong></td>
        <td></td>
    </tr>
</table>

<div class="footer-text">
    <p>Nilai rata-rata dari dosen penguji = _____</p>
</div>

<div class="footer-text">
    <p>Sumbawa, __________</p>
    <p>Sekretaris Sidang</p>
</div>

<div class="footer-signature">
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
        <td></td>
    </tr>
    <tr>
        <td>2</td>
        <td>b. Kerangka Pemikiran</td>
        <td>2</td>
        <td><?= $showData['pembimbing1_kerangka_pemikiran'] ?></td>
        <td></td>
    </tr>
    <tr>
        <td>3</td>
        <td>c. Metode penelitian</td>
        <td>2</td>
        <td><?= $showData['pembimbing1_metode_penelitian'] ?></td>
        <td></td>
    </tr>
    <tr>
        <td>4</td>
        <td>d. Hasil Penelitian</td>
        <td>2</td>
        <td><?= $showData['pembimbing1_hasil_penelitian'] ?></td>
        <td></td>
    </tr>
    <tr>
        <td>5</td>
        <td>e. Bahasa</td>
        <td>2</td>
        <td><?= $showData['pembimbing1_bahasa'] ?></td>
        <td></td>
    </tr>
    <tr>
        <td>6</td>
        <td>f. Teknik penulisan</td>
        <td>1</td>
        <td><?= $showData['pembimbing1_teknik_penulisan'] ?></td>
        <td></td>
    </tr>
    <tr>
        <td colspan="5" style="text-align: center;"><strong>B. Manfaat akademis dan praktis</strong></td>
    </tr>
    <tr>
        <td>1</td>
        <td>Ujian Lisan</td>
        <td>2</td>
        <td><?= $showData['pembimbing1_manfaat_akademis_praktis'] ?></td>
        <td></td>
    </tr>
    <tr>
        <td colspan="5" style="text-align: center;"><strong>C. Ujian Lisan</strong></td>
    </tr>
    <tr>
        <td>1</td>
        <td>a. Penguasaan Materi</td>
        <td>2</td>
        <td><?= $showData['pembimbing1_penguasaan_materi'] ?></td>
        <td></td>
    </tr>
    <tr>
        <td>2</td>
        <td>b. Penguasaan Metode</td>
        <td>2</td>
        <td><?= $showData['pembimbing1_penguasaan_metode'] ?></td>
        <td></td>
    </tr>
    <tr>
        <td>3</td>
        <td>c. Kemampuan argumentasi</td>
        <td>2</td>
        <td><?= $showData['pembimbing1_kemampuan_argumentasi'] ?></td>
        <td></td>
    </tr>
    <tr>
        <td colspan="4"><strong>Jumlah</strong></td>
        <td></td>
    </tr>
</table>

<div class="footer-text">
    <p>Nilai rata-rata dari dosen penguji = _____</p>
</div>

<div class="footer-text">
    <p>Sumbawa, __________</p>
    <p><strong>Pembimbing Utama</strong></p>
</div>

<div class="footer-signature">
    <img src="<?= base_url('cdn/vendor/qrcodes/' . $showData['barcode_pembimbing1']); ?>" width="20%" alt="" style="align-items: center">
    <p class="signature-name">(<?= $showData['nama_pembimbing1'] ?>)</p>
    <p>NIDN.<?= $showData['nip_pembimbing1']  ?></p>
</div>
</body>
</html>
