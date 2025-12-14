<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<h4>Manajemen User</h4>
<a href="/admin/users/create" class="btn btn-primary mb-2">Tambah User</a>

<table class="table table-bordered">
<tr>
    <th>Nama</th>
    <th>Role</th>
    <th>Aksi</th>
</tr>
<?php foreach ($users as $u): ?>
<tr>
    <td><?= esc($u['nama_user']) ?></td>
    <td><?= esc($u['role']) ?></td>
    <td>
        <a href="/admin/users/edit/<?= $u['id_user'] ?>" class="btn btn-warning btn-sm">Edit</a>
        <a href="/admin/users/delete/<?= $u['id_user'] ?>" class="btn btn-danger btn-sm"
           onclick="return confirm('Hapus user?')">Hapus</a>
    </td>
</tr>
<?php endforeach ?>
</table>

<?= $this->endSection() ?>
