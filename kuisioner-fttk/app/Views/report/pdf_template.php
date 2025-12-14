<h3>Report Hasil Kuisioner</h3>

<table border="1" width="100%" cellpadding="6">
<tr>
    <th>Pertanyaan</th>
    <th>Pilihan Jawaban</th>
    <th>Total</th>
</tr>

<?php foreach ($summary as $row): ?>
<tr>
    <td><?= $row['pertanyaan'] ?></td>
    <td><?= $row['deskripsi_pilihan'] ?></td>
    <td><?= $row['total'] ?></td>
</tr>
<?php endforeach ?>
</table>