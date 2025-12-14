<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<h4>Data Fakultas</h4>
<a href="/admin/fakultas/create" class="btn btn-primary mb-2">Tambah</a>

<table class="table table-bordered">
<tr><th>Nama Fakultas</th><th>Aksi</th></tr>
<?php foreach ($data as $r): ?>
<tr>
    <td><?= esc($r['nama_fakultas']) ?></td>
    <td>
        <a href="/admin/fakultas/edit/<?= $r['id_fakultas'] ?>" class="btn btn-warning btn-sm">Edit</a>
        <a href="/admin/fakultas/delete/<?= $r['id_fakultas'] ?>" class="btn btn-danger btn-sm">Hapus</a>
    </td>
</tr>
<?php endforeach ?>
</table>

<?= $this->endSection() ?>
