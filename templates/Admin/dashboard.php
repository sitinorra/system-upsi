<?php
$this->assign('title', 'Admin Dashboard');
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
                    <a class="nav-link active" href="<?= $this->Url->build(['controller' => 'Admin', 'action' => 'dashboard']) ?>">
                        <i class="bi bi-house-door-fill"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $this->Url->build(['controller' => 'Admin', 'action' => 'students']) ?>">
                        <i class="bi bi-people-fill"></i> Students
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $this->Url->build(['controller' => 'Admin', 'action' => 'staff']) ?>">
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
        
        <!-- Welcome Section -->
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #047857 0%, #065f46 100%);">
        <div class="card-body text-white p-4">
            <div class="d-flex align-items-center">
                <div class="stat-icon me-3" style="background: rgba(255,255,255,0.2); padding: 15px; border-radius: 10px;">
                    <i class="bi bi-person-circle" style="font-size: 2rem;"></i>
                </div>
                <div>
                    <h4 class="mb-1">Welcome, <?= h($admin->first_name . ' ' . $admin->last_name) ?>!
                    </h4>
                    <p class="mb-0 opacity-75">
                        <i class="bi bi-building"></i> Department: <strong><?= h($admin->departmentName ?? 'N/A') ?></strong>
                    </p>
                </div>
            </div>
        </div>
    </div>
        
        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="card stat-card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1 small">Total</p>
                                <h2 class="mb-0 fw-bold"><?= $totalComplaints ?></h2>
                            </div>
                            <div class="stat-icon" style="background: rgba(4, 120, 87, 0.1);">
                                <i class="bi bi-file-text-fill" style="color: #047857;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 mb-3">
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
            
            <div class="col-md-3 mb-3">
                <div class="card stat-card border-0 shadow-sm" style="border-left-color: #3b82f6 !important;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1 small">In Progress</p>
                                <h2 class="mb-0 fw-bold"><?= $inProgressComplaints ?></h2>
                            </div>
                            <div class="stat-icon" style="background: rgba(59, 130, 246, 0.1);">
                                <i class="bi bi-hourglass-split" style="color: #3b82f6;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 mb-3">
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
        
        <!-- Search Box -->
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <?= $this->Form->create(null, ['type' => 'get']) ?>
                        <div class="d-flex">
                            <!-- Search Icon -->
                            <div class="d-flex align-items-center justify-content-center px-3" style="background: linear-gradient(135deg, #047857 0%, #065f46 100%); border-radius: 8px 0 0 8px; height: 48px;">
                                <i class="bi bi-search text-white fs-5"></i>
                            </div>
                            
                            <?= $this->Form->control('search', [
                                'class' => 'form-control',
                                'placeholder' => 'Search by student name or keywords...',
                                'label' => false,
                                'value' => $search ?? '',
                                'style' => 'border: 1px solid #d1d5db; border-radius: 0; height: 48px; border-left: none; border-right: none;'
                            ]) ?>
                            
                            <!-- Search Button -->
                            <button class="btn text-white fw-bold d-flex align-items-center justify-content-center" type="submit" style="background: linear-gradient(135deg, #047857 0%, #065f46 100%); border: none; min-width: 120px; height: 48px; border-radius: 0;">
                                <i class="bi bi-search me-1"></i>Search
                            </button>
                            
                            <!-- Clear Button -->
                            <?php if (!empty($search)): ?>
                                <a href="<?= $this->Url->build(['action' => 'dashboard']) ?>" class="btn btn-danger d-flex align-items-center justify-content-center" style="border: none; min-width: 100px; height: 48px; border-radius: 0 8px 8px 0;">
                                    <i class="bi bi-x-circle me-1"></i>Clear
                                </a>
                            <?php else: ?>
                                <div style="width: 0; height: 48px; border-radius: 0 8px 8px 0;"></div>
                            <?php endif; ?>
                        </div>
                        
                       <!-- Search Tips -->
                        <div class="mt-2">
                            <small class="text-muted">
                                <i class="bi bi-info-circle me-1"></i>
                                Search by: <strong>Student Name</strong> or <strong>Description</strong>
                            </small>
                        </div>
                        
                        <?php if (!empty($search)): ?>
                            <div class="alert alert-info mt-3 mb-0 py-2 d-flex align-items-center">
                                <i class="bi bi-info-circle-fill me-2"></i>
                                <span>
                                    Results for: <strong>"<?= h($search) ?>"</strong> 
                                    <span class="badge bg-primary ms-2"><?= count($complaints) ?></span>
                                </span>
                            </div>
                        <?php endif; ?>
                        <?= $this->Form->end() ?>
                        </div>
                    </div>
                </div>
            </div>

        <!-- All Complaints Table -->
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0">
                            <i class="bi bi-list-check"></i> All Complaints
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        <?php if (count($complaints) > 0): ?>
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Student</th>
                                            <th>Type</th>
                                            <th>Category</th>
                                            <th>Description</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($complaints as $complaint): ?>
                                            <tr>
                                                <td><strong>#<?= $complaint->complaint_id ?></strong></td>
                                                <td><?= h($complaint->student->full_name ?? 'N/A') ?></td>
                                                <td><span class="badge bg-primary"><?= h($complaint->complaint_type->type_name ?? 'N/A') ?></span></td>
                                                <td><span class="badge bg-info"><?= h($complaint->complaint_category->category_name ?? 'N/A') ?></span></td>
                                                <td><?= $this->Text->truncate(h($complaint->description), 40) ?></td>
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
                                                    <span class="badge bg-<?= $color ?>">
                                                        <?= h($complaint->status) ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="<?= $this->Url->build(['controller' => 'Complaints', 'action' => 'view', $complaint->complaint_id]) ?>" class="btn btn-sm btn-outline-primary me-1">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <?= $this->Form->postLink(
                                                        '<i class="bi bi-trash"></i>',
                                                        ['controller' => 'Admin', 'action' => 'delete', $complaint->complaint_id],
                                                        [
                                                            'confirm' => 'Are you sure you want to delete complaint #' . $complaint->complaint_id . '?',
                                                            'class' => 'btn btn-sm btn-outline-danger',
                                                            'escape' => false
                                                        ]
                                                    ) ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="text-center py-5">
                                <i class="bi bi-inbox" style="font-size: 4rem; color: #d1d5db;"></i>
                                <p class="text-muted mt-3">No complaints in the system yet.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>