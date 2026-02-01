<?php
$this->assign('title', 'Submit Complaint');
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

.form-control:focus, .form-select:focus {
    border-color: #047857;
    box-shadow: 0 0 0 0.2rem rgba(4, 120, 87, 0.15);
}

.required-field::after {
    content: " *";
    color: #dc3545;
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
                    <a class="nav-link active" href="<?= $this->Url->build(['controller' => 'Complaints', 'action' => 'add']) ?>">
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
        
        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex align-items-center">
                    <a href="<?= $this->Url->build(['controller' => 'Student', 'action' => 'dashboard']) ?>" class="btn btn-outline-secondary me-3">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>
                    <div>
                        <h2 class="mb-0"><i class="bi bi-file-earmark-plus"></i> Submit New Complaint</h2>
                        <p class="text-muted mb-0">Please fill in the form below to submit your complaint</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Form Card -->
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <?= $this->Flash->render() ?>
                        
                        <?= $this->Form->create($complaint, ['class' => 'needs-validation', 'type' => 'file']) ?>
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold required-field">Complaint Type</label>
                            <?= $this->Form->control('type_id', [
                                'options' => $complaintTypes,
                                'empty' => '-- Select Type --',
                                'class' => 'form-select form-select-lg',
                                'label' => false,
                                'required' => true
                            ]) ?>
                            <small class="text-muted">Choose the type of your feedback</small>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold required-field">Category</label>
                            <?= $this->Form->control('category_id', [
                                'options' => $complaintCategories,
                                'empty' => '-- Select Category --',
                                'class' => 'form-select form-select-lg',
                                'label' => false,
                                'required' => true
                            ]) ?>
                            <small class="text-muted">Select the relevant category for your complaint</small>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold required-field">Description</label>
                            <?= $this->Form->control('description', [
                                'type' => 'textarea',
                                'class' => 'form-control',
                                'rows' => 8,
                                'placeholder' => 'Please provide detailed information about your complaint...',
                                'label' => false,
                                'required' => true
                            ]) ?>
                            <small class="text-muted">Minimum 20 characters. Be as detailed as possible.</small>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Attachments (Optional)</label>
                            <?= $this->Form->control('attachments[]', [
                                'type' => 'file',
                                'class' => 'form-control',
                                'label' => false,
                                'multiple' => true,
                                'accept' => '.pdf,.doc,.docx,.jpg,.jpeg,.png'
                            ]) ?>
                            <small class="text-muted">
                                <i class="bi bi-info-circle"></i> You can upload multiple files (PDF, Word, Images). Max 5MB per file.
                            </small>
                        </div>
                        
                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <?= $this->Form->checkbox('is_confidential', [
                                    'class' => 'form-check-input',
                                    'id' => 'confidentialCheck',
                                    'role' => 'switch'
                                ]) ?>
                                <label class="form-check-label" for="confidentialCheck">
                                    <i class="bi bi-lock-fill"></i> Mark as Confidential
                                    <small class="d-block text-muted">Your identity will be protected</small>
                                </label>
                            </div>
                        </div>
                        
                        <hr class="my-4">
                        
                        <div class="d-flex gap-2">
                            <?= $this->Form->button('Submit Complaint', [
                                'class' => 'btn btn-emerald btn-lg px-5',
                                'type' => 'submit'
                            ]) ?>
                            
                            <a href="<?= $this->Url->build(['controller' => 'Student', 'action' => 'dashboard']) ?>" class="btn btn-outline-secondary btn-lg">
                                Cancel
                            </a>
                        </div>
                        
                        <?= $this->Form->end() ?>
                    </div>
                </div>
                
                <!-- Info Card -->
                <div class="card border-0 bg-light mt-3">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3"><i class="bi bi-info-circle-fill text-primary"></i> Information</h6>
                        <ul class="mb-0">
                            <li class="mb-2">Your complaint will be reviewed by our team within 2-3 working days</li>
                            <li class="mb-2">You will receive updates via email and in your dashboard</li>
                            <li class="mb-2">For urgent matters, please contact USAU directly at <strong>usau@upsi.edu.my</strong></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>