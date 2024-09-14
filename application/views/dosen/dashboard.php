<?php $this->app->extend('template/dosen') ?>

<?php $this->app->setVar('title', 'Dashboard') ?>

<?php $this->app->section() ?>
    <div class="row">
        <div class="col-md-4">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Total Mahasiswa</h5>
                            <span class="h2 font-weight-bold mb-0 mahasiswa-total">0</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                <i class="fa fa-users"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Total Dosen</h5>
                            <span class="h2 font-weight-bold mb-0 dosen-total">0</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                <i class="fa fa-user-tie"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Total Jabatan</h5>
                            <span class="h2 font-weight-bold mb-0 jabatan-total">0</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                <i class="ni ni-money-coins"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Total Usulan Proposal</h5>
                            <span class="h2 font-weight-bold mb-0 proposal-total">0</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                <i class="fas fa-book"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Total Seminar</h5>
                            <span class="h2 font-weight-bold mb-0 seminar-total">0</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                <i class="ni ni-money-coins"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Total Skripsi</h5>
                            <span class="h2 font-weight-bold mb-0 skripsi-total">0</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                <i class="ni ni-money-coins"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="card-title">Grafik Kegiatan Mahasiswa</div>
        </div>
        <div class="card-body">
            <canvas id="kegiatan-mahasiswa" style="width: 100%; text-align: center; max-height: 300px;"></canvas>
        </div>
    </div>
<?php $this->app->endSection('content') ?>

<?php $this->app->section() ?>
<link rel="stylesheet" href="<?= base_url() ?>cdn/plugins/chartjs/Chart.min.css">
<script src="<?= base_url() ?>cdn/plugins/chartjs/Chart.min.js"></script>
    <script>
        $(document).ready(function() {

            call('api/mahasiswa').done(function(res) {
                $('.mahasiswa-total').html(res.data.length)
            })

            call('api/dosen').done(function(res) {
                $('.dosen-total').html(res.data.length)
            })

            call('api/prodi').done(function(res) {
                $('.prodi-total').html(res.data.length)
            })

            call('api/proposal_mahasiswa').done(function(res) {
                $('.proposal-total').html(res.data.length)
            })

            call('api/seminar').done(function(res) {
                $('.seminar-total').html(res.data.length)
            })

            call('api/skripsi').done(function(res) {
                $('.skripsi-total').html(res.data.length)
            })

            call('api/jabatan').done(function(res) {
                $('.jabatan-total').html(res.data.length)
            })


        })

        $(document).ready(function() {
            var proposalCount = 0;
            var seminarCount = 0;
            var skripsiCount = 0;

            // Mengambil data jumlah usulan proposal
            call('api/proposal_mahasiswa').done(function(res) {
                proposalCount = res.data.length;
                $('.proposal-total').html(proposalCount);

                // Setelah mendapatkan data, panggil fungsi untuk menampilkan grafik
                updateChart();
            });

            // Mengambil data jumlah seminar
            call('api/seminar').done(function(res) {
                seminarCount = res.data.length;
                $('.seminar-total').html(seminarCount);

                // Setelah mendapatkan data, panggil fungsi untuk menampilkan grafik
                updateChart();
            });

            // Mengambil data jumlah skripsi
            call('api/skripsi').done(function(res) {
                skripsiCount = res.data.length;
                $('.skripsi-total').html(skripsiCount);

                // Setelah mendapatkan data, panggil fungsi untuk menampilkan grafik
                updateChart();
            });

            // Fungsi untuk memperbarui grafik batang
            function updateChart() {
                var ctx = $('#kegiatan-mahasiswa').get(0).getContext('2d');
                var kegiatanData = {
                    labels: ['Usulan Proposal', 'Seminar', 'Skripsi'],
                    datasets: [{
                        label: 'Jumlah Mahasiswa',
                        data: [proposalCount, seminarCount, skripsiCount],
                        backgroundColor: ['#f56954', '#00a65a', '#3c8dbc'],
                    }]
                };

                var barChart = new Chart(ctx, {
                    type: 'bar',
                    data: kegiatanData,
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            }

            // Handle form cek judul

        });
    </script>
<?php $this->app->endSection('script') ?>

<?php $this->app->init() ?>