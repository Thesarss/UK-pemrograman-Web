<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h2>Isi Kuisioner (Periode <?= (int)$idPeriode ?>)</h2>

<?php if(session()->getFlashdata('error')): ?>
  <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<style>
.progress-wrap { width: 100%; background: #eee; border-radius: 10px; overflow: hidden; height: 14px; margin: 12px 0; }
.progress-bar  { height: 14px; width: 0%; background: #ff7ab6; transition: width .2s; }
.q-card { padding: 12px; border: 1px solid #f2b7d3; border-radius: 12px; margin-bottom: 12px; background:#fff; }
</style>

<div class="progress-wrap"><div id="pbar" class="progress-bar"></div></div>
<div id="ptext">0% terisi</div>

<form method="post" action="<?= base_url('mahasiswa/submit/'.$idPeriode) ?>">
  <?= csrf_field() ?>

  <?php foreach($pertanyaan as $i => $q): 
      $qid = (int)$q['id_pertanyaan'];
      $selected = $prefill[$qid] ?? null; // prefill
      $opsi = $opsiMap[$qid] ?? [];
  ?>
    <div class="q-card">
      <strong><?= ($i+1).'. '.esc($q['pertanyaan']) ?></strong>
      <div style="margin-top:8px">
        <?php foreach($opsi as $o):
          $oid = (int)$o['id_pilihan_jawaban'];
          $checked = ($selected === $oid) ? 'checked' : '';
        ?>
          <label style="display:block; margin:6px 0;">
            <input class="ans" type="radio"
              name="jawaban[<?= $qid ?>]"
              value="<?= $oid ?>" <?= $checked ?>>
            <?= esc($o['deskripsi_pilihan']) ?>
          </label>
        <?php endforeach; ?>
      </div>
    </div>
  <?php endforeach; ?>

  <button type="submit">Simpan Jawaban</button>
  <a href="<?= base_url('mahasiswa') ?>" style="margin-left:10px">Kembali</a>
</form>

<script>
(function(){
  const totalQ = <?= count($pertanyaan) ?>;
  const pbar = document.getElementById('pbar');
  const ptext = document.getElementById('ptext');

  function calc(){
    let answered = 0;
    // hitung per pertanyaan: ada radio yg kepilih?
    const cards = document.querySelectorAll('.q-card');
    cards.forEach(card => {
      if(card.querySelector('input.ans:checked')) answered++;
    });
    const pct = totalQ ? Math.round((answered/totalQ)*100) : 0;
    pbar.style.width = pct + '%';
    ptext.textContent = pct + '% terisi ('+answered+'/'+totalQ+')';
  }

  document.addEventListener('change', (e) => {
    if(e.target.classList.contains('ans')) calc();
  });

  // initial (biar prefill langsung kelihatan di progress)
  calc();
})();
</script>

<?= $this->endSection() ?>
