<?php
$this->assign('title', 'Student Dashboard');
$currentUser = $this->request->getSession()->read('Auth');
?>
<link rel="stylesheet" href="<?= $this->Url->build('/css/custom.css') ?>">

<style>
.navbar-emerald {
    background: linear-gradient(135deg, #004d40 0%, #00251a 100%);
}

.stat-card {
    border-left: 4px solid #047857;
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.stat-icon {
    width: 50px;
    height: 50px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
}

.btn-emerald {
    background: linear-gradient(135deg, #004d40 0%, #00251a 100%);
    border: none;
    color: white;
}

.btn-emerald:hover {
    background: linear-gradient(135deg, #00695c 0%, #004d40 100%);
    color: #ffd700;
}

.badge-status {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.85rem;
}
</style>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-emerald shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="#">
            <i class="bi bi-shield-lock-fill"></i> COSIM (UPSI Complaint System)
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="<?= $this->Url->build(['controller' => 'Student', 'action' => 'dashboard']) ?>">
                        <i class="bi bi-house-door-fill"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $this->Url->build(['controller' => 'Complaints', 'action' => 'add']) ?>">
                        <i class="bi bi-plus-circle-fill"></i> Submit Complaint
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $this->Url->build(['controller' => 'Complaints', 'action' => 'index']) ?>">
                        <i class="bi bi-list-ul"></i> My Complaints
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
       
        <!-- Welcome Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #047857 0%, #065f46 100%);">
                    <div class="card-body text-white p-4">
                        <div class="d-flex align-items-center">
                        <div class="stat-icon me-3" style="background: rgba(255,255,255,0.2); padding: 15px; border-radius: 10px;">
                            <i class="bi bi-person-circle" style="font-size: 2rem;"></i>
                        </div>
                        <div>
                        <h4 class="mb-2">Welcome back, <?= h($currentUser['username']) ?>!
                        </h4>
                        <p class="mb-0 opacity-75">
                            <i class="bi bi-calendar3"></i> <?= date('l, F j, Y') ?>
                        </p>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="card stat-card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1 small">Total Complaints</p>
                                <h2 class="mb-0 fw-bold"><?= $totalComplaints ?></h2>
                            </div>
                            <div class="stat-icon" style="background: rgba(4, 120, 87, 0.1);">
                                <i class="bi bi-file-text-fill" style="color: #047857;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-3">
                <div class="card stat-card border-0 shadow-sm" style="border-left-color: #f59e0b !important;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1 small">Pending</p>
                                <h2 class="mb-0 fw-bold"><?= $pendingComplaints ?></h2>
                            </div>
                            <div class="stat-icon" style="background: rgba(245, 158, 11, 0.1);">
                                <i class="bi bi-clock-fill" style="color: #f59e0b;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-3">
                <div class="card stat-card border-0 shadow-sm" style="border-left-color: #10b981 !important;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1 small">Resolved</p>
                                <h2 class="mb-0 fw-bold"><?= $resolvedComplaints ?></h2>
                            </div>
                            <div class="stat-icon" style="background: rgba(16, 185, 129, 0.1);">
                                <i class="bi bi-check-circle-fill" style="color: #10b981;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-3">
                            <i class="bi bi-lightning-charge-fill text-warning"></i> Quick Actions
                        </h5>
                        <div class="d-grid gap-2 d-md-flex">
                            <a href="<?= $this->Url->build(['controller' => 'Complaints', 'action' => 'add']) ?>" class="btn btn-emerald">
                                <i class="bi bi-plus-circle"></i> Submit New Complaint
                            </a>
                            <a href="<?= $this->Url->build(['controller' => 'Complaints', 'action' => 'index']) ?>" class="btn btn-outline-secondary">
                                <i class="bi bi-list"></i> View All Complaints
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Recent Complaints -->
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0">
                            <i class="bi bi-clock-history"></i> Recent Complaints
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        <?php if ($complaints->count() > 0): ?>
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Type</th>
                                            <th>Category</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($complaints as $complaint): ?>
                                            <tr>
                                                <td><strong>#<?= $complaint->complaint_id ?></strong></td>
                                                <td><?= h($complaint->complaint_type->type_name ?? 'N/A') ?></td>
                                                <td><?= h($complaint->complaint_category->category_name ?? 'N/A') ?></td>
                                                <td><?= $complaint->created_at->format('d M Y') ?></td>
                                                <td>
                                                    <?php
                                                    $statusColor = [
                                                        'Pending' => 'warning',
                                                        'In Progress' => 'info',
                                                        'Resolved' => 'success',
                                                        'Rejected' => 'danger'
                                                    ];
                                                    $color = $statusColor[$complaint->status] ?? 'secondary';
                                                    ?>
                                                    <span class="badge bg-<?= $color ?> badge-status">
                                                        <?= h($complaint->status) ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="<?= $this->Url->build(['controller' => 'Complaints', 'action' => 'view', $complaint->complaint_id]) ?>" class="btn btn-sm btn-outline-primary">
                                                        <i class="bi bi-eye"></i> View
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="text-center py-5">
                                <i class="bi bi-inbox" style="font-size: 4rem; color: #d1d5db;"></i>
                                <p class="text-muted mt-3">No complaints yet. Submit your first complaint!</p>
                                <a href="<?= $this->Url->build(['controller' => 'Complaints', 'action' => 'add']) ?>" class="btn btn-emerald">
                                    <i class="bi bi-plus-circle"></i> Submit Complaint
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>