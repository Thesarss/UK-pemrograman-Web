<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<h3>Dashboard Admin</h3>
<p>Selamat datang, <b><?= session('nama_user') ?></b></p>

<div class="alert alert-info">
    Gunakan menu di samping untuk mengelola data sistem kuisioner.
</div>

<?= $this->endSection() ?>
