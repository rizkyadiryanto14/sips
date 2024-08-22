<?php
$id_user = $this->session->userdata('id');
$verifikasi = '';
$dataUser = $this->db->get_where('mahasiswa', array('id' => $id_user))->result();
foreach ($dataUser as $du) {
    $verifikasi = $du->status;
}
?>
<?php $this->app->extend('template/mahasiswa') ?>

<?php $this->app->setVar('title', "Dashboard") ?>

<?php $this->app->section() ?>
<?php if ($verifikasi == 1) { ?>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title text-uppercase text-muted mb-0">Deadline Proposal Sampai Skripsi</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table dataTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Deadline Skripsi Countdown</th>
                            <th>Tanggal Deadline</th>
                            <th>Judul Proposal</th>
                        </tr>
                    </thead>
                    <tbody id="_tbody">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card card-stats">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Total Proposal</h5>
                    <span class="h2 font-weight-bold mb-0 total-proposal">0</span>
                </div>
                <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                        <i class="ni ni-active-40"></i>
                    </div>
                </div>
            </div>
            <p class="mt-3 mb-0 text-sm">
                <a href="<?= base_url() ?>mahasiswa/proposal" class="text-success mr-2"><i class="fa fa-arrow-left"></i> Selengkapnya</a>
            </p>
        </div>
    </div>
<?php } ?>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Cek Judul Skripsi</h5>
        </div>
        <div class="card-body">
            <form id="formCekJudul">
                <div class="form-group">
                    <label for="judulSkripsi">Masukkan Judul Skripsi</label>
                    <input type="text" class="form-control" id="judulSkripsi" name="judulSkripsi" placeholder="Masukkan Judul Skripsi">
                </div>
                <button type="submit" class="btn btn-primary">Cek Judul</button>
            </form>
            <div id="hasilCekJudul" class="mt-4"></div>
        </div>
    </div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-3 mb-3">
                <img src="<?= base_url() ?>cdn/img/mahasiswa/default.png" class="foto card-img">
            </div>
            <div class="col-md-9">
                <div class="row p-2">
                    <div class="col-6">Nama</div>
                    <div class="col-6"><strong class="nama">Nama Mahasiswa</strong></div>
                </div>
                <div class="row p-2">
                    <div class="col-6">Prodi</div>
                    <div class="col-6"><strong class="prodi_nama">Nama Prodi</strong></div>
                </div>
                <div class="row p-2">
                    <div class="col-6">Fakultas</div>
                    <div class="col-6"><strong class="prodi_fakultas_nama">Nama Fakultas</strong></div>
                </div>
                <div class="row p-2">
                    <div class="col-6">Email</div>
                    <div class="col-6"><strong class="email">Email Mahasiswa</strong></div>
                </div>
                <div class="row p-2 mb-5">
                    <div class="col-6">Nomor Telepon</div>
                    <div class="col-6"><strong class="nomor_telepon">Nomor Telepon Mahasiswa</strong></div>
                </div>
                <div style="position: absolute; bottom: 10px; right: 10px;">
                    <a href="<?= base_url() ?>mahasiswa/profil" class="btn btn-primary btn-sm">
                        Selengkapnya
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->app->endSection('content') ?>

<?php $this->app->section() ?>
<link rel="stylesheet" href="<?= base_url() ?>cdn/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<script src="<?= base_url() ?>cdn/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>cdn/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>assets/countdown/jquery.countdown.min.js"></script>
    <script>
        $(document).ready(function() {
            // Fungsi untuk memuat detail mahasiswa
            function loadMahasiswaDetails() {
                call('api/mahasiswa/detail/<?= $this->session->userdata('id') ?>')
                    .done(function(response) {
                        if (response && response.data) {
                            const data = response.data;
                            $('.nama').html(data.nama || 'N/A');
                            $('.prodi_nama').html(data.prodi.nama || 'N/A');
                            $('.prodi_fakultas_nama').html(data.prodi.fakultas.nama || 'N/A');
                            $('.email').html(data.email || 'N/A');
                            $('.nomor_telepon').html(data.nomor_telepon || 'N/A');
                            $('img.foto').attr('src', base_url + 'cdn/img/mahasiswa/' + (data.foto ? data.foto : 'default.png'));
                            $('.total-proposal').html(data.proposal ? data.proposal.length : 0);
                        } else {
                            console.error('Data mahasiswa tidak ditemukan.');
                        }
                    })
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        console.error('Error saat mengambil data mahasiswa:', textStatus, errorThrown);
                    });
            }

            // Fungsi untuk memuat data deadline skripsi
            function loadDeadlineData() {
                $.ajax({
                    url: base_url + '/getDeadline',
                    data: {
                        mahasiswa_id: <?= $this->session->userdata('id') ?>
                    },
                    type: 'POST',
                    dataType: 'json',
                    success: function(response) {
                        if (response && response.length > 0) {
                            let no = 1;
                            $.each(response, function(i, item) {
                                const deadlineDate = new Date(item.deadline);
                                const now = new Date();

                                let statusText = '';
                                if (now > deadlineDate) {
                                    statusText = 'Waktu Habis';
                                    cekDeadline(item.mahasiswa_id, item.id);
                                } else {
                                    statusText = `<span id="deadline_${item.id}"></span>`;
                                }

                                const formattedDate = formatDate(deadlineDate);

                                const row = `
                                <tr>
                                    <td>${no++}</td>
                                    <td>${statusText}</td>
                                    <td>${formattedDate}</td>
                                    <td>${item.judul}</td>
                                </tr>
                            `;
                                $("#_tbody").append(row);

                                if (now <= deadlineDate) {
                                    initializeCountdown(item.deadline, item.id, item.mahasiswa_id);
                                }
                            });
                            $(".dataTable").dataTable();
                        } else {
                            $("#_tbody").html('<tr><td colspan="4" class="text-center">Tidak ada data deadline.</td></tr>');
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error saat mengambil data deadline:', textStatus, errorThrown);
                        $("#_tbody").html('<tr><td colspan="4" class="text-center text-danger">Gagal memuat data deadline.</td></tr>');
                    }
                });
            }

            // Fungsi untuk memformat tanggal
            function formatDate(date) {
                const options = { day: 'numeric', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit' };
                return date.toLocaleDateString('id-ID', options);
            }

            // Fungsi untuk menginisialisasi countdown
            function initializeCountdown(deadline, id, mahasiswa_id) {
                $("#deadline_" + id)
                    .countdown(deadline, function(event) {
                        $(this).text(
                            event.strftime('Waktu Tersisa %D Hari %H Jam %M Menit %S Detik')
                        );
                    })
                    .on('finish.countdown', function() {
                        $(this).html('Waktu Habis');
                        cekDeadline(mahasiswa_id, id);
                    });
            }

            // Fungsi untuk mengecek deadline setelah waktu habis
            function cekDeadline(mahasiswa_id, id) {
                $.ajax({
                    url: base_url + 'cekdeadline/' + mahasiswa_id,
                    dataType: 'json',
                    type: 'GET',
                    success: function(response) {
                        if (response === 'waktu habis') {
                            alert('Waktu habis dan data skripsi tidak ada, akun anda dinon-verifikasi');
                            location.reload();
                        } else if (response === 'aman') {
                            $("#deadline_" + id).html('Waktu habis dan data skripsi ada');
                        } else {
                            console.error('Response tidak dikenali dari cekdeadline:', response);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error saat melakukan cek deadline:', textStatus, errorThrown);
                    }
                });
            }

            // Fungsi untuk menangani submit form cek judul skripsi
            $('#formCekJudul').on('submit', function(e) {
                e.preventDefault();
                const judulSkripsi = $('#judulSkripsi').val().trim();

                if (judulSkripsi === '') {
                    $('#hasilCekJudul').html('<div class="alert alert-warning">Silakan masukkan judul skripsi.</div>');
                    return;
                }

                $('#hasilCekJudul').html('<div class="text-center"><i class="fa fa-spinner fa-spin"></i> Memeriksa judul...</div>');

                call('api/daftar_judul/cek_judul', { judul_skripsi: judulSkripsi })
                    .done(function(response) {
                        if (response) {
                            if (response.error) {
                                $('#hasilCekJudul').html(`<div class="alert alert-danger">${response.message}</div>`);
                            } else if (response.length > 0) {
                                let output = '<ul class="list-group">';
                                response.forEach(item => {
                                    const similarity = parseFloat(item.kemiripan).toFixed(2);
                                    const warna = similarity >= 80 ? 'list-group-item-danger' : (similarity >= 50 ? 'list-group-item-warning' : 'list-group-item-success');
                                    const pesan = similarity >= 80 ? ' (Sangat Mirip)' : (similarity >= 50 ? ' (Cukup Mirip)' : ' (Tidak Mirip)');
                                    output += `
                                    <li class="list-group-item ${warna}">
                                        <strong>${item.judul_skripsi}</strong><br>
                                        <small>Kesamaan: ${similarity}% ${pesan}</small><br>
                                        <small>Nama: ${item.nama} | NIM: ${item.nim} | Tahun Lulus: ${item.tahun_lulus}</small>
                                    </li>
                                `;
                                });
                                output += '</ul>';
                                $('#hasilCekJudul').html(output);
                            } else {
                                $('#hasilCekJudul').html('<div class="alert alert-success">Judul skripsi dapat diajukan, tidak ada kemiripan yang signifikan.</div>');
                            }
                        } else {
                            $('#hasilCekJudul').html('<div class="alert alert-danger">Terjadi kesalahan saat memproses data.</div>');
                        }
                    })
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        console.error('Error saat melakukan pengecekan judul:', textStatus, errorThrown);
                        $('#hasilCekJudul').html('<div class="alert alert-danger">Gagal melakukan pengecekan judul. Silakan coba lagi nanti.</div>');
                    });
            });

            // Memanggil fungsi saat document ready
            loadMahasiswaDetails();
            loadDeadlineData();
        });
    </script>


<?php $this->app->endSection('script') ?>

<?php $this->app->init() ?>