<?php $this->app->extend('template/admin') ?>

<?php $this->app->setVar('title', 'Dosen') ?>

<?php $this->app->section() ?>

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-6">
                <div class="card-title">Data Dosen</div>
            </div>
            <div class="col-6 text-right">
                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#tambah">
                    <i class="fa fa-plus"></i>
                    Tambah
                </button>
            </div>
        </div>
    </div>
    <div class="card-body">

    </div>
</div>

<?php $this->app->endSection('content') ?>

<?php $this->app->section() ?>
<link rel="stylesheet" href="<?= base_url() ?>cdn/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<script src="<?= base_url() ?>cdn/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>cdn/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>


<?php $this->app->endSection('script') ?>

<?php $this->app->init() ?>
