<h2>Summary Hasil Kuisioner (Kaprodi)</h2>

<table border="1" width="100%" cellpadding="6">
<tr>
    <th>Pertanyaan</th>
    <th>Pilihan Jawaban</th>
    <th>Total</th>
</tr>

<?php foreach ($summary as $row): ?>
<tr>
    <td><?= esc($row['pertanyaan']) ?></td>
    <td><?= esc($row['deskripsi_pilihan']) ?></td>
    <td><?= esc($row['total']) ?></td>
</tr>
<?php endforeach ?>
</table>

<br>
<a href="<?= base_url('report/exportExcel/1') ?>">Export Excel</a> |
<a href="<?= base_url('report/exportPdf/1') ?>">Export PDF</a>