<?php
$this->assign('title', 'Add New Student');
$currentUser = $this->request->getSession()->read('Auth');
?>

<style>
.navbar-emerald {
    background: linear-gradient(135deg, #047857 0%, #065f46 100%);
}
.btn-emerald {
    background: linear-gradient(135deg, #047857 0%, #065f46 100%);
    border: none;
    color: white;
}
.btn-emerald:hover {
    background: linear-gradient(135deg, #065f46 0%, #047857 100%);
    color: white;
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
                    <a class="nav-link active" href="<?= $this->Url->build(['controller' => 'Admin', 'action' => 'students']) ?>">
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
        
        <!-- Back Button -->
        <div class="mb-3">
            <a href="<?= $this->Url->build(['action' => 'students']) ?>" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Back to Students List
            </a>
        </div>
        
        <!-- Form Card -->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header" style="background: linear-gradient(135deg, #047857 0%, #065f46 100%);">
                        <h5 class="mb-0 text-white">
                            <i class="bi bi-person-plus-fill"></i> Add New Student
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        
                        <?= $this->Flash->render() ?>
                        
                        <?= $this->Form->create($student, ['class' => 'needs-validation']) ?>
                        
                        <h6 class="text-muted mb-3">Account Information</h6>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <?= $this->Form->control('username', [
                                    'class' => 'form-control',
                                    'placeholder' => 'e.g., student5',
                                    'required' => true,
                                    'label' => 'Username *'
                                ]) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $this->Form->control('password', [
                                    'type' => 'password',
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter password',
                                    'required' => true,
                                    'label' => 'Password *'
                                ]) ?>
                            </div>
                        </div>
                        
                        <hr class="my-4">
                        
                        <h6 class="text-muted mb-3">Personal Information</h6>
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <?= $this->Form->control('full_name', [
                                    'class' => 'form-control',
                                    'placeholder' => 'e.g., Ahmad Bin Ali',
                                    'required' => true,
                                    'label' => 'Full Name *'
                                ]) ?>
                            </div>
                            <div class="col-md-4">
                                <?= $this->Form->control('no_student', [
                                    'class' => 'form-control',
                                    'placeholder' => 'e.g., A20001234',
                                    'required' => true,
                                    'label' => 'Student Number *'
                                ]) ?>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <?= $this->Form->control('gender', [
                                    'type' => 'select',
                                    'options' => ['Male' => 'Male', 'Female' => 'Female'],
                                    'empty' => '-- Select Gender --',
                                    'class' => 'form-select',
                                    'required' => true,
                                    'label' => 'Gender *'
                                ]) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $this->Form->control('semester', [
                                    'type' => 'number',
                                    'min' => 1,
                                    'max' => 14,
                                    'class' => 'form-control',
                                    'placeholder' => 'e.g., 1',
                                    'required' => true,
                                    'label' => 'Semester *'
                                ]) ?>
                            </div>
                        </div>
                        
                        <hr class="my-4">
                        
                        <h6 class="text-muted mb-3">Contact Information</h6>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <?= $this->Form->control('email_address', [
                                    'type' => 'email',
                                    'class' => 'form-control',
                                    'placeholder' => 'student@upsi.edu.my',
                                    'required' => true,
                                    'label' => 'Email Address *'
                                ]) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $this->Form->control('phone_number', [
                                    'class' => 'form-control',
                                    'placeholder' => '0123456789',
                                    'required' => true,
                                    'label' => 'Phone Number *'
                                ]) ?>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <?= $this->Form->control('address', [
                                'type' => 'textarea',
                                'rows' => 2,
                                'class' => 'form-control',
                                'placeholder' => 'Street address',
                                'label' => 'Address'
                            ]) ?>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <?= $this->Form->control('postcode', [
                                    'class' => 'form-control',
                                    'placeholder' => 'e.g., 35900',
                                    'label' => 'Postcode'
                                ]) ?>
                            </div>
                            <div class="col-md-4">
                                <?= $this->Form->control('city', [
                                    'class' => 'form-control',
                                    'placeholder' => 'e.g., Tanjong Malim',
                                    'label' => 'City'
                                ]) ?>
                            </div>
                            <div class="col-md-4">
                                <?= $this->Form->control('state', [
                                    'type' => 'select',
                                    'options' => $states,
                                    'empty' => '-- Select State --',
                                    'class' => 'form-select',
                                    'label' => 'State'
                                ]) ?>
                            </div>
                        </div>
                        
                        <hr class="my-4">
                        
                        <div class="d-grid gap-2">
                            <?= $this->Form->button('Register Student', [
                                'class' => 'btn btn-emerald btn-lg'
                            ]) ?>
                            <a href="<?= $this->Url->build(['action' => 'students']) ?>" class="btn btn-outline-secondary btn-lg">
                                Cancel
                            </a>
                        </div>
                        
                        <?= $this->Form->end() ?>
                        
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>