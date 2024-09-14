<!DOCTYPE html>
<html>
<head>
    <style>

        body {
            font-family: Times New Roman, serif;
            font-size: 12pt;
            line-height: 1.5;
            margin: 0;
            padding: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .chart-image {
            text-align: center;
            margin-top: 20px;
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
    </style>
</head>
<body>
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
<div class="title">REPORT DOSEN</div>

<table>
    <thead>
    <tr>
        <th>Nama Dosen</th>
        <th>Jumlah Proposal</th>
        <th>Jumlah Seminar</th>
        <th>Jumlah Skripsi</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($report as $row) : ?>
        <tr>
            <td><?php echo $row['nama_dosen']; ?></td>
            <td><?php echo $row['jumlah_proposal']; ?></td>
            <td><?php echo $row['jumlah_seminar']; ?></td>
            <td><?php echo $row['jumlah_skripsi']; ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>
