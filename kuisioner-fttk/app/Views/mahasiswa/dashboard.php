<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h2>Dashboard Mahasiswa (<?= esc($nim) ?>)</h2>

<?php if(session()->getFlashdata('success')): ?>
  <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>
<?php if(session()->getFlashdata('error')): ?>
  <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<p>
  <a href="<?= base_url('mahasiswa/notifications') ?>">Notifikasi</a>
  <strong>(<?= (int)$unread ?> belum dibaca)</strong>
</p>

<h4>Periode Kuisioner Aktif</h4>
<ul>
  <?php foreach($periode as $p): ?>
    <li>
      <?= esc($p['keterangan']) ?> |
      <a href="<?= base_url('mahasiswa/periode/'.$p['id_periode']) ?>">Isi / Lihat</a>
    </li>
  <?php endforeach; ?>
</ul>

<?= $this->endSection() ?>
