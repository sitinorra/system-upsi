<?php
$this->assign('title', 'Staff List');
$currentUser = $this->request->getSession()->read('Auth');
?>
<link rel="stylesheet" href="<?= $this->Url->build('/css/custom.css') ?>">

<style>
.navbar-emerald {
    background: linear-gradient(135deg, #004d40 0%, #00251a 100%);
}
</style>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-emerald shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="#">
            <i class="bi bi-shield-lock-fill"></i> UPSI Complaint System - Admin
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= $this->Url->build(['controller' => 'Admin', 'action' => 'dashboard']) ?>">
                        <i class="bi bi-house-door-fill"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $this->Url->build(['controller' => 'Admin', 'action' => 'students']) ?>">
                        <i class="bi bi-people-fill"></i> Students
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="<?= $this->Url->build(['controller' => 'Admin', 'action' => 'staff']) ?>">
                        <i class="bi bi-person-badge-fill"></i> Staff
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle"></i> <?= h($currentUser['username']) ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'logout']) ?>">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="container-fluid py-4" style="background-color: #f8f9fa; min-height: calc(100vh - 56px);">
    <div class="container">
        
        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #047857 0%, #065f46 100%);">
                    <div class="card-body text-white p-4">
                        <h4 class="mb-2">
                            <i class="bi bi-person-badge-fill"></i> Staff List
                        </h4>
                        <p class="mb-0 opacity-75">
                            Total Staff: <strong><?= count($staff) ?></strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Staff Table -->
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-0">
                        <?php if (count($staff) > 0): ?>
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Staff No</th>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Category</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Username</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($staff as $s): ?>
                                            <tr>
                                                <td><strong><?= $s->staff_id ?></strong></td>
                                                <td><?= h($s->no_staff) ?></td>
                                                <td><?= h($s->staff_name) ?></td>
                                                <td><?= h($s->position) ?></td>
                                                <td>
                                                    <span class="badge bg-info">
                                                        <?= h($s->complaint_category->category_name ?? 'N/A') ?>
                                                    </span>
                                                </td>
                                                <td><?= h($s->email) ?></td>
                                                <td><?= h($s->phone_number) ?></td>
                                                <td>
                                                    <span class="badge bg-success">
                                                        <?= h($s->user->username ?? 'N/A') ?>
                                                    </span>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="text-center py-5">
                                <i class="bi bi-person-badge" style="font-size: 4rem; color: #d1d5db;"></i>
                                <p class="text-muted mt-3">No staff in the system yet.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>