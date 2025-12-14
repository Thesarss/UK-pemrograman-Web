<?= $this->extend('layout/kaprodi') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Kelola Pilihan Jawaban</h2>
        <a href="<?= base_url('kaprodi/pertanyaan') ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card mb-3">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Pertanyaan</h5>
        </div>
        <div class="card-body">
            <p class="mb-0"><?= esc($pertanyaan['teks_pertanyaan'] ?? '') ?></p>
        </div>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Daftar Pilihan</h5>
        </div>
        <div class="card-body">
            <form id="pilihanForm">
                <div id="pilihanContainer">
                    <?php if (!empty($pilihanList)): ?>
                        <?php foreach ($pilihanList as $index => $pilihan): ?>
                            <div class="input-group mb-2 pilihan-item">
                                <span class="input-group-text"><?= chr(65 + $index) ?></span>
                                <input type="text" class="form-control" value="<?= esc($pilihan['teks_pilihan']) ?>" readonly>
                                <button type="button" class="btn btn-danger" onclick="deletePilihan(<?= $pilihan['id'] ?>)">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                
                <div id="newPilihanContainer"></div>
                
                <button type="button" class="btn btn-success" onclick="addPilihan()">
                    <i class="bi bi-plus-circle"></i> Tambah Pilihan
                </button>
                <button type="button" class="btn btn-primary" onclick="savePilihan()">
                    <i class="bi bi-save"></i> Simpan Semua
                </button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
let pilihanCount = <?= count($pilihanList ?? []) ?>;

function addPilihan() {
    const container = document.getElementById('newPilihanContainer');
    const div = document.createElement('div');
    div.className = 'input-group mb-2 new-pilihan-item';
    div.innerHTML = `
        <span class="input-group-text">${String.fromCharCode(65 + pilihanCount)}</span>
        <input type="text" class="form-control new-pilihan" placeholder="Masukkan teks pilihan" required>
        <button type="button" class="btn btn-danger" onclick="this.parentElement.remove()">
            <i class="bi bi-x"></i>
        </button>
    `;
    container.appendChild(div);
    pilihanCount++;
}

function savePilihan() {
    const newPilihan = [];
    document.querySelectorAll('.new-pilihan').forEach(input => {
        if (input.value.trim()) {
            newPilihan.push(input.value.trim());
        }
    });
    
    if (newPilihan.length === 0) {
        alert('Tidak ada pilihan baru untuk disimpan');
        return;
    }
    
    fetch('<?= base_url('kaprodi/pertanyaan/pilihan/store/' . ($pertanyaan['id'] ?? '')) ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({ pilihan: newPilihan })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert(data.message || 'Gagal menyimpan pilihan');
        }
    })
    .catch(error => {
        alert('Terjadi kesalahan');
        console.error(error);
    });
}

function deletePilihan(id) {
    if (!confirm('Hapus pilihan ini?')) return;
    
    window.location.href = '<?= base_url('kaprodi/pertanyaan/pilihan/delete/') ?>' + id;
}
</script>
<?= $this->endSection() ?>
