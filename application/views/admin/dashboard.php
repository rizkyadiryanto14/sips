<?php $this->app->extend('template/admin') ?>
<?php $this->app->setVar('title', 'Dashboard') ?>
<?php $this->app->section() ?>

<div class="row">
    <div class="col-md-4">
        <div class="card card-stats">
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
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Total Usulan Proposal</h5>
                        <span class="h2 font-weight-bold mb-0 proposal-total">0</span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                            <i class="fas fa-book"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-stats">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Total Seminar</h5>
                        <span class="h2 font-weight-bold mb-0 seminar-total">0</span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-warning text-white rounded-circle shadow">
                            <i class="fas fa-bookmark"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-stats">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Total Skripsi</h5>
                        <span class="h2 font-weight-bold mb-0 skripsi-total">0</span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-indigo text-white rounded-circle shadow">
                            <i class="fas fa-book-open"></i>
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
        // Panggilan API untuk mengupdate jumlah total
        call('api/mahasiswa').done(function(res) {
            $('.mahasiswa-total').html(res.data.length);
        });

        call('api/dosen').done(function(res) {
            $('.dosen-total').html(res.data.length);
        });

        call('api/jabatan').done(function(res) {
            $('.jabatan-total').html(res.data.length);
        });

        var proposalCount = 0, seminarCount = 0, skripsiCount = 0;

        $.when(
            call('api/proposal_mahasiswa'),
            call('api/seminar'),
            call('api/skripsi')
        ).done(function(proposalRes, seminarRes, skripsiRes) {
            proposalCount = proposalRes[0].data.length;
            seminarCount = seminarRes[0].data.length;
            skripsiCount = skripsiRes[0].data.length;

            $('.proposal-total').html(proposalCount);
            $('.seminar-total').html(seminarCount);
            $('.skripsi-total').html(skripsiCount);

            updateChart(proposalCount, seminarCount, skripsiCount);
        });

        var ctx = $('#kegiatan-mahasiswa').get(0).getContext('2d');
        var barChart;

        function updateChart(proposalCount, seminarCount, skripsiCount) {
            var kegiatanData = {
                labels: ['Usulan Proposal', 'Seminar', 'Skripsi'],
                datasets: [{
                    label: 'Jumlah Mahasiswa',
                    data: [proposalCount, seminarCount, skripsiCount],
                    backgroundColor: ['#f56954', '#00a65a', '#3c8dbc'],
                }]
            };

            if (!barChart) {
                barChart = new Chart(ctx, {
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
            } else {
                barChart.data.datasets[0].data = [proposalCount, seminarCount, skripsiCount];
                barChart.update();
            }
        }
    });

</script>

<?php $this->app->endSection('script') ?>
<?php $this->app->init() ?>
