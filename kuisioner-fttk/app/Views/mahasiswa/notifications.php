<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h2>Notifikasi (<?= esc($nim) ?>)</h2>

<ul>
<?php foreach($rows as $r): ?>
  <li style="margin-bottom:10px;">
    <strong><?= esc($r['judul']) ?></strong>
    <?php if((int)$r['is_read'] === 0): ?>
      <span style="color:#d11;">(baru)</span>
    <?php endif; ?>
    <div><?= esc($r['pesan']) ?></div>
    <small><?= esc($r['created_at'] ?? '') ?></small><br>
    <?php if((int)$r['is_read'] === 0): ?>
      <a href="<?= base_url('mahasiswa/notifications/read/'.$r['id_notif']) ?>">Tandai dibaca</a>
    <?php endif; ?>
  </li>
<?php endforeach; ?>
</ul>

<a href="<?= base_url('mahasiswa') ?>">Kembali</a>

<?= $this->endSection() ?>
