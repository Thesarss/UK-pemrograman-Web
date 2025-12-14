<?= $this->extend('layout/kaprodi') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <h2 class="mb-4">Assign Pertanyaan ke Periode</h2>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Assign Pertanyaan</h5>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('kaprodi/assign/store') ?>" method="POST">
                        <?= csrf_field() ?>
                        
                        <div class="mb-3">
                            <label for="periode_id" class="form-label">Pilih Periode <span class="text-danger">*</span></label>
                            <select class="form-select" id="periode_id" name="periode_id" required onchange="loadAssigned()">
                                <option value="">-- Pilih Periode --</option>
                                <?php if (!empty($periodeList)): ?>
                                    <?php foreach ($periodeList as $periode): ?>
                                        <option value="<?= $periode['id'] ?>"><?= esc($periode['keterangan']) ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Pilih Pertanyaan <span class="text-danger">*</span></label>
                            <div class="border rounded p-3" style="max-height: 300px; overflow-y: auto;">
                                <?php if (!empty($pertanyaanList)): ?>
                                    <?php foreach ($pertanyaanList as $pertanyaan): ?>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="pertanyaan_id[]" value="<?= $pertanyaan['id'] ?>" id="pertanyaan<?= $pertanyaan['id'] ?>">
                                            <label class="form-check-label" for="pertanyaan<?= $pertanyaan['id'] ?>">
                                                <?= esc($pertanyaan['teks_pertanyaan']) ?>
                                            </label>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p class="text-muted">Belum ada pertanyaan tersedia</p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Simpan Assignment
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Pertanyaan yang Sudah Di-Assign</h5>
                </div>
                <div class="card-body">
                    <div id="assignedList">
                        <p class="text-muted">Pilih periode untuk melihat pertanyaan yang sudah di-assign</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
function loadAssigned() {
    const periodeId = document.getElementById('periode_id').value;
    if (!periodeId) {
        document.getElementById('assignedList').innerHTML = '<p class="text-muted">Pilih periode untuk melihat pertanyaan yang sudah di-assign</p>';
        return;
    }
    
    fetch('<?= base_url('kaprodi/assign/get/') ?>' + periodeId)
        .then(response => response.json())
        .then(data => {
            let html = '';
            if (data.length > 0) {
                html = '<ul class="list-group">';
                data.forEach((item, index) => {
                    html += `
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>${index + 1}. ${item.teks_pertanyaan}</span>
                            <button class="btn btn-sm btn-danger" onclick="unassign(${item.assign_id})">
                                <i class="bi bi-x"></i>
                            </button>
                        </li>
                    `;
                });
                html += '</ul>';
            } else {
                html = '<p class="text-muted">Belum ada pertanyaan di-assign</p>';
            }
            document.getElementById('assignedList').innerHTML = html;
        })
        .catch(error => {
            console.error(error);
            document.getElementById('assignedList').innerHTML = '<p class="text-danger">Gagal memuat data</p>';
        });
}

function unassign(assignId) {
    if (!confirm('Hapus assignment ini?')) return;
    window.location.href = '<?= base_url('kaprodi/assign/delete/') ?>' + assignId;
}
</script>
<?= $this->endSection() ?>
