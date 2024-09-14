<?php $this->app->extend('template/admin') ?>

<?php $this->app->setVar('title', "Report") ?>

<?php $this->app->section() ?>
<style>
    #chartdiv {
        width: 100%;
        height: 500px;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Data Report</div>
            </div>
            <div class="card-body">
                <div id="chartdiv"></div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">

                <!-- Form untuk filter semester -->
                <form method="GET" action="">
                    <div class="form-group row">
                        <label for="semester" class="col-sm-2 col-form-label">Filter Semester</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="semester" id="semester">
                                <option value="">-- Pilih Semester --</option>
                                <option value="ganjil" <?php echo ($this->input->get('semester') == 'ganjil') ? 'selected' : ''; ?>>Semester Ganjil</option>
                                <option value="genap" <?php echo ($this->input->get('semester') == 'genap') ? 'selected' : ''; ?>>Semester Genap</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-filter"></i> Terapkan Filter
                            </button>
                        </div>
                        <div class="col-sm-2">
                            <!-- Tombol unduh report -->
                            <a href="<?= base_url('report/download_pdf') ?>" methods="post" id="download-pdf" class="btn btn-primary">
                                <i class="fas fa-print"></i> Unduh
                            </a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
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
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Grafik Report Dosen</div>
                <button id="downloadChart" class="btn btn-primary">Unduh Grafik</button>
            </div>
            <div class="card-body">
                <canvas id="bentoChart"></canvas> <!-- Canvas untuk grafik -->
            </div>
        </div>
    </div>
</div>
<?php $this->app->endSection('content') ?>

<?php $this->app->section() ?>
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/frozen.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(document).ready(function() {

        // var barChartCanvas = $('#report').get(0).getContext('2d');

        const data = [];
        call('api/proposal_mahasiswa').done(function(res) {
            data.push(res.data.length)

            call('api/seminar').done(function(res) {
                data.push(res.data.length)

                call('api/skripsi/admin_index').done(function(res) {
                    data.push(res.data.length)

                    // Chart
                    am4core.ready(function() {

                        // Themes begin
                        am4core.useTheme(am4themes_frozen);
                        am4core.useTheme(am4themes_animated);
                        // Themes end

                        // Create chart instance
                        var chart = am4core.create("chartdiv", am4charts.XYChart);
                        chart.scrollbarX = new am4core.Scrollbar();

                        // Add data
                        chart.data = [{
                            "country": "Proposal",
                            "visits": data[0]
                        }, {
                            "country": "Seminar",
                            "visits": data[1]
                        }, {
                            "country": "Skripsi",
                            "visits": data[2]
                        }, ];

                        // Create axes
                        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
                        categoryAxis.dataFields.category = "country";
                        categoryAxis.renderer.grid.template.location = 0;
                        categoryAxis.renderer.minGridDistance = 30;
                        categoryAxis.renderer.labels.template.horizontalCenter = "right";
                        categoryAxis.renderer.labels.template.verticalCenter = "middle";
                        categoryAxis.renderer.labels.template.rotation = 270;
                        categoryAxis.tooltip.disabled = true;
                        categoryAxis.renderer.minHeight = 110;

                        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                        valueAxis.renderer.minWidth = 50;

                        // Create series
                        var series = chart.series.push(new am4charts.ColumnSeries());
                        series.sequencedInterpolation = true;
                        series.dataFields.valueY = "visits";
                        series.dataFields.categoryX = "country";
                        series.tooltipText = "[{categoryX}: bold]{valueY}[/]";
                        series.columns.template.strokeWidth = 0;

                        series.tooltip.pointerOrientation = "vertical";

                        series.columns.template.column.cornerRadiusTopLeft = 10;
                        series.columns.template.column.cornerRadiusTopRight = 10;
                        series.columns.template.column.fillOpacity = 0.8;

                        // on hover, make corner radiuses bigger
                        var hoverState = series.columns.template.column.states.create("hover");
                        hoverState.properties.cornerRadiusTopLeft = 0;
                        hoverState.properties.cornerRadiusTopRight = 0;
                        hoverState.properties.fillOpacity = 1;

                        series.columns.template.adapter.add("fill", function(fill, target) {
                            return chart.colors.getIndex(target.dataItem.index);
                        });

                        // Cursor
                        chart.cursor = new am4charts.XYCursor();

                    }); // end am4core.ready()
                    // End Chart
                })
            })
        })


    })

    $(document).ready(function() {
        const ctx = document.getElementById('bentoChart').getContext('2d');
        const bentoChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    <?php foreach ($report as $row) : ?> '<?php echo $row['nama_dosen']; ?>',
                    <?php endforeach; ?>
                ],
                datasets: [{
                    label: 'Jumlah Proposal',
                    data: [
                        <?php foreach ($report as $row) : ?>
                        <?php echo $row['jumlah_proposal']; ?>,
                        <?php endforeach; ?>
                    ],
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },
                    {
                        label: 'Jumlah Seminar',
                        data: [
                            <?php foreach ($report as $row) : ?>
                            <?php echo $row['jumlah_seminar']; ?>,
                            <?php endforeach; ?>
                        ],
                        backgroundColor: 'rgba(255, 206, 86, 0.6)',
                        borderColor: 'rgba(255, 206, 86, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Jumlah Skripsi',
                        data: [
                            <?php foreach ($report as $row) : ?>
                            <?php echo $row['jumlah_skripsi']; ?>,
                            <?php endforeach; ?>
                        ],
                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Tambahkan fungsi untuk mengunduh grafik saat tombol diklik
        document.getElementById('downloadChart').addEventListener('click', function() {
            // Konversi grafik canvas ke URL data image
            const imageLink = document.createElement('a');
            imageLink.href = document.getElementById('bentoChart').toDataURL('image/png');
            imageLink.download = 'grafik_report.png'; // Nama file yang akan diunduh
            imageLink.click();
        });
    });


</script>
<?php $this->app->endSection('script') ?>

<?php $this->app->init() ?>