<?php $this->app->extend('template/admin') ?>

<?php $this->app->setVar('title', 'Jadwal Seminar') ?>

<?php $this->app->section() ?>
<div class="card">
    <form id="edit" action="<?= base_url() ?>admin/seminar/updatestatus/<?= $seminar_id ?>" method="POST">
        <div class="card-header">
            <div class="card-title">Update Seminar </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="">Tempat Seminar</label>
                <input type="text" name="tempat" id="" class="form-control" placeholder="Tempat A" required>
            </div>
            <div class="form-group">
                <label for="">Tanggal Seminar</label>
                <input type="date" name="tanggal" id="" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Jam Mulai</label>
                <input type="time" name="jam_mulai" id="" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Jam Selesai</label>
                <input type="time" name="jam_selesai" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Nama Dosen Penguji 1</label>
                <select name="dosen_penguji_id" class="form-control" id="">
                    <option value=""> -pilih Dosen Penguji 1- </option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Nama Dosen Penguji 2</label>
                <select name="dosen_penguji2_id" class="form-control" id="">
                    <option value=""> -pilih dosen penguji 2- </option>
                </select>
            </div>
            <div class="form-group text-right">
                <input type="submit" class="btn btn-primary" value="Update">
            </div>
        </div>
    </form>
</div>

<!-- Loading Overlay -->
<div id="loading-overlay" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:9999; text-align:center; color:white;">
    <div style="position:absolute; top:50%; left:50%; transform:translate(-50%, -50%);">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <p>Memproses...</p>
    </div>
</div>
<?php $this->app->endSection('content') ?>

<?php $this->app->section() ?>
<link rel="stylesheet" href="<?= base_url() ?>cdn/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<script src="<?= base_url() ?>cdn/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>cdn/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function(res) {
        // Load data dosen untuk dropdown
        call('api/dosen').done(function(res) {
            let dosen = '<option value="">- Pilih Dosen penguji -</option>';
            if (res.data) {
                res.data.forEach(obj => {
                    dosen += '<option value="' + obj.id + '">' + obj.nama + '</option>';
                })
            }
            $('[name=dosen_penguji_id]').html(dosen);
            $('[name=dosen_penguji2_id').html(dosen);
        });

        // Event submit form untuk memunculkan loading overlay
        $('#edit').on('submit', function(e) {
            // Menampilkan overlay loading
            $('#loading-overlay').fadeIn();
        });
    });
</script>

<?php if ($this->session->flashdata('error')) { ?>
    <script>
        let mess = "<?= $this->session->flashdata('error'); ?>"
        notif(mess, 'error', true);
    </script>
<?php } ?>

<?php $this->app->endSection('script') ?>

<?php $this->app->init() ?>
