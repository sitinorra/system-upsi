<?php
$this->assign('title', 'Complaint Details');
$currentUser = $this->request->getSession()->read('Auth');
$userType = $currentUser['user_type'];

// Determine URLs based on user type
if ($userType == 'Student') {
    $backUrl = ['controller' => 'Complaints', 'action' => 'index'];
    $dashboardUrl = ['controller' => 'Student', 'action' => 'dashboard'];
} elseif ($userType == 'Staff') {
    $backUrl = ['controller' => 'Staff', 'action' => 'dashboard'];
    $dashboardUrl = ['controller' => 'Staff', 'action' => 'dashboard'];
} else { // Admin
    $backUrl = ['controller' => 'Admin', 'action' => 'dashboard'];
    $dashboardUrl = ['controller' => 'Admin', 'action' => 'dashboard'];
}
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
        <a class="navbar-brand fw-bold" href="<?= $this->Url->build($dashboardUrl) ?>">
            <i class="bi bi-shield-lock-fill"></i> UPSI Complaint System
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
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
        
        <!-- Back Button -->
        <div class="row mb-3">
            <div class="col-12">
                <a href="<?= $this->Url->build($backUrl) ?>" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>
        </div>
        
        <!-- Main Card -->
        <div class="row">
            <div class="col-lg-8">
                <!-- Complaint Details -->
                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0">
                            <i class="bi bi-file-text"></i> Complaint #<?= $complaint->complaint_id ?>
                            <?php if ($complaint->is_confidential): ?>
                                <i class="bi bi-lock-fill text-warning ms-2" title="Confidential"></i>
                            <?php endif; ?>
                        </h5>
                        <small class="text-muted">Submitted on <?= $complaint->created_at->format('l, F j, Y') ?></small>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="mb-1 text-muted small">Complaint ID:</p>
                                <p class="fw-bold">#<?= $complaint->complaint_id ?></p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1 text-muted small">Type:</p>
                                <p><span class="badge bg-primary"><?= h($complaint->complaint_type->type_name ?? 'N/A') ?></span></p>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="mb-1 text-muted small">Category:</p>
                                <p><span class="badge bg-info"><?= h($complaint->complaint_category->category_name ?? 'N/A') ?></span></p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1 text-muted small">Submission Date:</p>
                                <p class="fw-bold"><?= $complaint->submission_date ? $complaint->submission_date->format('d M Y') : 'N/A' ?></p>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="mb-1 text-muted small">Status:</p>
                                <p>
                                    <?php
                                    $statusColor = [
                                        'Pending' => 'warning',
                                        'In Progress' => 'info',
                                        'Resolved' => 'success',
                                        'Rejected' => 'danger'
                                    ];
                                    $color = $statusColor[$complaint->status] ?? 'secondary';
                                    ?>
                                    <span class="badge bg-<?= $color ?>" style="padding: 8px 16px; font-size: 1rem;">
                                        <?= h($complaint->status) ?>
                                    </span>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1 text-muted small">Confidential:</p>
                                <p>
                                    <?php if ($complaint->is_confidential): ?>
                                        <span class="badge bg-warning">
                                            <i class="bi bi-lock-fill"></i> Yes
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">
                                            <i class="bi bi-unlock-fill"></i> No
                                        </span>
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <div class="mb-0">
                            <p class="mb-2 text-muted small">
                                <i class="bi bi-chat-square-text"></i> Description:
                            </p>
                            <div class="p-3 bg-light rounded">
                                <p class="mb-0"><?= nl2br(h($complaint->description)) ?></p>
                            </div>
                        
            
            <!-- Attachments Section -->
            <?php
            $AttachmentsTable = \Cake\ORM\TableRegistry::getTableLocator()->get('Attachments');
            $attachments = $AttachmentsTable->find()
                ->where(['complaint_id' => $complaint->complaint_id])
                ->all();
            ?>

            <?php if ($attachments->count() > 0): ?>
                <hr class="my-4">
                <div class="mb-0">
                    <p class="mb-3 text-muted small">
                        <i class="bi bi-paperclip"></i> Attachments (<?= $attachments->count() ?>):
                    </p>
                    <div class="list-group">
                        <?php foreach ($attachments as $attachment): ?>
                            <a href="<?= $this->Url->build('/' . $attachment->file_path) ?>" 
                            target="_blank" 
                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="bi bi-file-earmark-<?= $this->getFileIcon($attachment->file_type) ?> me-2"></i>
                                    <?= h($attachment->file_name) ?>
                                </div>
                                <span class="badge bg-secondary"><?= strtoupper($attachment->file_type) ?></span>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Submitted By -->
                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-body">
                        <h6 class="mb-3">
                            <i class="bi bi-person"></i> Submitted By
                        </h6>
                        <p class="mb-1 fw-bold"><?= h($complaint->student->full_name ?? 'N/A') ?></p>
                        <p class="mb-1 text-muted small">
                            <i class="bi bi-credit-card"></i> <?= h($complaint->student->no_student ?? 'N/A') ?>
                        </p>
                        <p class="mb-0 text-muted small">
                            <i class="bi bi-envelope"></i> <?= h($complaint->student->email_address ?? 'N/A') ?>
                        </p>
                        
                        <!-- Feedback Section (For Staff) -->
                        <?php if ($userType == 'Staff'): ?>
                            <div class="card border-0 shadow-sm mb-3">
                                <div class="card-header bg-white border-0">
                                    <h6 class="mb-0">
                                        <i class="bi bi-chat-left-text"></i> Add Feedback
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <?= $this->Form->create(null, [
                                        'url' => ['controller' => 'Staff', 'action' => 'addFeedback', $complaint->complaint_id]
                                    ]) ?>
                                    
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Feedback Type</label>
                                        <?= $this->Form->select('feedback_type', [
                                            'Internal Note' => 'Internal Note',
                                            'Action Taken' => 'Action Taken',
                                            'Resolution' => 'Resolution',
                                            'Follow-up Required' => 'Follow-up Required'
                                        ], [
                                            'class' => 'form-select',
                                            'required' => true
                                        ]) ?>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Feedback</label>
                                        <?= $this->Form->textarea('feedback_text', [
                                            'class' => 'form-control',
                                            'rows' => 4,
                                            'placeholder' => 'Enter your feedback or notes here...',
                                            'required' => true
                                        ]) ?>
                                    </div>
                                    
                                    <?= $this->Form->button('Add Feedback', [
                                        'class' => 'btn btn-success w-100'
                                    ]) ?>
                                    
                                    <?= $this->Form->end() ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Feedback History -->
                        <?php
                        $FeedbackTable = \Cake\ORM\TableRegistry::getTableLocator()->get('Feedback');
                        $feedbacks = $FeedbackTable->find()
                            ->contain(['Staff'])
                            ->where(['complaint_id' => $complaint->complaint_id])
                            ->order(['created_at' => 'DESC'])
                            ->all();
                        ?>

                        <?php if ($feedbacks->count() > 0): ?>
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-white border-0">
                                    <h6 class="mb-0">
                                        <i class="bi bi-clock-history"></i> Feedback History (<?= $feedbacks->count() ?>)
                                    </h6>
                                </div>
                                <div class="card-body p-0">
                                    <div class="list-group list-group-flush">
                                        <?php foreach ($feedbacks as $feedback): ?>
                                            <div class="list-group-item">
                                                <div class="d-flex w-100 justify-content-between mb-2">
                                                    <h6 class="mb-1">
                                                        <?php
                                                        $typeColors = [
                                                            'Internal Note' => 'secondary',
                                                            'Action Taken' => 'primary',
                                                            'Resolution' => 'success',
                                                            'Follow-up Required' => 'warning'
                                                        ];
                                                        $color = $typeColors[$feedback->feedback_type] ?? 'secondary';
                                                        ?>
                                                        <span class="badge bg-<?= $color ?>"><?= h($feedback->feedback_type) ?></span>
                                                    </h6>
                                                    <small class="text-muted"><?= $feedback->created_at->format('d M Y, H:i') ?></small>
                                                </div>
                                                <p class="mb-2"><?= nl2br(h($feedback->feedback_text)) ?></p>
                                                <small class="text-muted">
                                                    <i class="bi bi-person-circle"></i> By: <?= h($feedback->staff->staff_name ?? 'Staff') ?>
                                                </small>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Actions -->
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="mb-3">
                            <i class="bi bi-lightning-charge-fill text-warning"></i> Actions
                        </h6>
                        <div class="d-grid gap-2">
                            <a href="<?= $this->Url->build($backUrl) ?>" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left"></i> Back to List
                            </a>
                            <a href="<?= $this->Url->build($dashboardUrl) ?>" class="btn btn-outline-primary">
                                <i class="bi bi-house-door"></i> Dashboard
                            </a>
                            <a href="<?= $this->Url->build(['controller' => 'Complaints', 'action' => 'exportPdf', $complaint->complaint_id]) ?>" class="btn btn-danger" target="_blank">
                                <i class="bi bi-file-pdf-fill"></i> Export to PDF
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>