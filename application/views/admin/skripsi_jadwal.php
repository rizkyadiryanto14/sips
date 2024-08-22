<?php $this->app->extend('template/admin') ?>

<?php $this->app->setVar('title', 'Jadwal Skripsi') ?>

<?php $this->app->section() ?>
    <div class="card">
        <form id="edit" action="<?= base_url() ?>admin/skripsi/updatestatus/<?= $skripsi_id ?>" method="POST">
            <div class="card-header">
                <div class="card-title">Update Skripsi </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="">Tempat Seminar</label>
                    <input type="text" name="tempat" id="" class="form-control" placeholder="Tempat A" required>
                </div>
                <div class="form-group">
                    <label for="">Jadwal Sidang</label>
                    <input type="datetime-local" name="jadwal_skripsi" id="" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Nama Dosen Penguji 1</label>
                    <select name="dosen_penguji_id" class="form-control" id="">
                        <option value=""> -pilih Dosen Penguji 1- </option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Nama Dosen Penguji 2</label>
                    <select name="dosen_penguji_id2" class="form-control" id="">
                        <option value=""> -pilih dosen penguji 2- </option>
                    </select>
                </div>
                <div class="form-group text-right">
                    <input type="submit" class="btn btn-primary" value="Update">
                </div>
            </div>
        </form>
    </div>
<?php $this->app->endSection('content') ?>

<?php $this->app->section() ?>
    <link rel="stylesheet" href="<?= base_url() ?>cdn/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <script src="<?= base_url() ?>cdn/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>cdn/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function(res) {
            call('api/dosen').done(function(res) {
                dosen = '<option value="">- Pilih Dosen penguji -</option>';
                if (res.data) {
                    res.data.forEach(obj => {
                        dosen += '<option value="' + obj.id + '">' + obj.nama + '</option>';
                    })
                }
                $('[name=dosen_penguji_id]').html(dosen);
                $('[name=dosen_penguji_id2').html(dosen);
            })
        })
    </script>

<?php if ($this->session->flashdata('error')) { ?>
    <script>
        let mess = "<?= $this->session->flashdata('error'); ?>"
        notif(mess, 'error', true);
    </script>
<?php } ?>

<?php $this->app->endSection('script') ?>

<?php $this->app->init() ?>