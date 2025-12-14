<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <span class="navbar-brand">ADMIN PANEL</span>
        <a href="/logout" class="btn btn-danger btn-sm">Logout</a>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <aside class="col-md-2 bg-light p-3 min-vh-100">
            <ul class="nav flex-column">
                <li class="nav-item"><a href="/admin" class="nav-link">Dashboard</a></li>
                <li class="nav-item"><a href="/admin/users" class="nav-link">User</a></li>
                <li class="nav-item"><a href="/admin/fakultas" class="nav-link">Fakultas</a></li>
                <li class="nav-item"><a href="/admin/jurusan" class="nav-link">Jurusan</a></li>
                <li class="nav-item"><a href="/admin/prodi" class="nav-link">Prodi</a></li>
                <li class="nav-item"><a href="/admin/mahasiswa" class="nav-link">Mahasiswa</a></li>
            </ul>
        </aside>

        <main class="col-md-10 p-4">
            <?= $this->renderSection('content') ?>
        </main>
    </div>
</div>

</body>
</html>
