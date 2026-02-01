<?php
$this->assign('title', 'My Complaints');
$currentUser = $this->request->getSession()->read('Auth');
?>
<link rel="stylesheet" href="<?= $this->Url->build('/css/custom.css') ?>">

<style>
.navbar-emerald {
    background: linear-gradient(135deg, #004d40 0%, #00251a 100%);
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
        <a class="navbar-brand fw-bold" href="<?= $this->Url->build(['controller' => 'Student', 'action' => 'dashboard']) ?>">
            <i class="bi bi-shield-lock-fill"></i> UPSI Complaint System
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= $this->Url->build(['controller' => 'Student', 'action' => 'dashboard']) ?>">
                        <i class="bi bi-house-door-fill"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $this->Url->build(['controller' => 'Complaints', 'action' => 'add']) ?>">
                        <i class="bi bi-plus-circle-fill"></i> Submit Complaint
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="<?= $this->Url->build(['controller' => 'Complaints', 'action' => 'index']) ?>">
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
        
        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #047857 0%, #065f46 100%);">
                    <div class="card-body text-white p-4">
                        <h4 class="mb-2">
                            <i class="bi bi-list-check"></i> My Complaints
                        </h4>
                        <p class="mb-0 opacity-75">
                            View and track all your submitted complaints
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
            <!-- Search & Actions -->
<div class="row mb-3">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="row align-items-center g-3">
                    <div class="col-lg-9">
                        <?= $this->Form->create(null, ['type' => 'get']) ?>
                        <div class="d-flex">
                            <!-- Search Icon -->
                            <div class="d-flex align-items-center justify-content-center px-3" style="background: linear-gradient(135deg, #047857 0%, #065f46 100%); border-radius: 8px 0 0 8px; height: 48px;">
                                <i class="bi bi-search text-white fs-5"></i>
                            </div>
                            
                            <!-- Search Input -->
                            <?= $this->Form->control('search', [
                                'class' => 'form-control',
                                'placeholder' => 'Search complaints...',
                                'label' => false,
                                'value' => $search ?? '',
                                'style' => 'border: 1px solid #d1d5db; border-radius: 0; height: 48px; border-left: none; border-right: none;'
                            ]) ?>
                            
                            <!-- Search Button -->
                            <button class="btn text-white fw-bold d-flex align-items-center justify-content-center" type="submit" style="background: linear-gradient(135deg, #047857 0%, #065f46 100%); border: none; min-width: 120px; height: 48px; border-radius: 0;">
                                <i class="bi bi-search me-1"></i>Search
                            </button>
                            
                            <!-- Clear Button (conditional) -->
                            <?php if (!empty($search)): ?>
                                <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-danger d-flex align-items-center justify-content-center" style="border: none; min-width: 100px; height: 48px; border-radius: 0 8px 8px 0;">
                                    <i class="bi bi-x-circle me-1"></i>Clear
                                </a>
                            <?php else: ?>
                                <!-- Invisible spacer to maintain rounded corner -->
                                <div style="width: 0; height: 48px; border-radius: 0 8px 8px 0;"></div>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Search Tips -->
                        <div class="mt-2">
                            <small class="text-muted">
                                <i class="bi bi-info-circle me-1"></i>
                                Search by: <strong>Type</strong> or <strong>Category</strong>
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
                    <div class="col-lg-3">
                        <a href="<?= $this->Url->build(['action' => 'add']) ?>" class="btn btn-emerald w-100" style="height: 48px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-plus-circle-fill me-2"></i>New Complaint
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        
        <!-- Results Info -->
        <?php if (!empty($search)): ?>
            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i> Search results for: <strong><?= h($search) ?></strong>
                (<?= count($complaints) ?> found)
            </div>
        <?php endif; ?>
        
        <!-- Complaints Table -->
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-0">
                        <?php if (count($complaints) > 0): ?>
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>ID</th>
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
                                                <td><span class="badge bg-primary"><?= h($complaint->complaint_type->type_name ?? 'N/A') ?></span></td>
                                                <td><span class="badge bg-info"><?= h($complaint->complaint_category->category_name ?? 'N/A') ?></span></td>
                                                <td><?= $this->Text->truncate(h($complaint->description), 50) ?></td>
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
                                                    <a href="<?= $this->Url->build(['action' => 'view', $complaint->complaint_id]) ?>" class="btn btn-sm btn-outline-primary">
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
                                <p class="text-muted mt-3">
                                    <?php if (!empty($search)): ?>
                                        No complaints found matching "<?= h($search) ?>"
                                    <?php else: ?>
                                        No complaints yet. Submit your first complaint!
                                    <?php endif; ?>
                                </p>
                                <a href="<?= $this->Url->build(['action' => 'add']) ?>" class="btn btn-emerald">
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