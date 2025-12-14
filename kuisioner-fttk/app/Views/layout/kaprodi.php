<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'KAPRODI - Kuisioner' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .sidebar {
            min-height: 100vh;
            background: #2c3e50;
        }
        .sidebar .nav-link {
            color: #ecf0f1;
            padding: 12px 20px;
            border-radius: 5px;
            margin: 5px 10px;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: #34495e;
            color: #fff;
        }
        .main-content {
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar">
                <div class="p-3">
                    <h4 class="text-white text-center mb-4">KAPRODI</h4>
                    <nav class="nav flex-column">
                        <a class="nav-link <?= ($activeMenu ?? '') == 'dashboard' ? 'active' : '' ?>" href="<?= base_url('kaprodi/dashboard') ?>">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                        <a class="nav-link <?= ($activeMenu ?? '') == 'periode' ? 'active' : '' ?>" href="<?= base_url('kaprodi/periode') ?>">
                            <i class="bi bi-calendar-range"></i> Periode
                        </a>
                        <a class="nav-link <?= ($activeMenu ?? '') == 'pertanyaan' ? 'active' : '' ?>" href="<?= base_url('kaprodi/pertanyaan') ?>">
                            <i class="bi bi-question-circle"></i> Pertanyaan
                        </a>
                        <a class="nav-link <?= ($activeMenu ?? '') == 'assign' ? 'active' : '' ?>" href="<?= base_url('kaprodi/assign') ?>">
                            <i class="bi bi-link-45deg"></i> Assign
                        </a>
                        <a class="nav-link <?= ($activeMenu ?? '') == 'summary' ? 'active' : '' ?>" href="<?= base_url('kaprodi/summary') ?>">
                            <i class="bi bi-bar-chart"></i> Summary
                        </a>
                        <a class="nav-link <?= ($activeMenu ?? '') == 'jawaban' ? 'active' : '' ?>" href="<?= base_url('kaprodi/jawaban') ?>">
                            <i class="bi bi-file-text"></i> Jawaban
                        </a>
                        <hr class="text-white">
                        <a class="nav-link" href="<?= base_url('logout') ?>">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-10 main-content">
                <?= $this->renderSection('content') ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <?= $this->renderSection('scripts') ?>
</body>
</html>
