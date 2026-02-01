<?php
$this->assign('title', 'Login');
?>

<style>

<link rel="stylesheet" href="<?= $this->Url->build('/css/custom.css') ?>">

body {
    background-color: #ffffff;
}

.login-wrapper {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.card-header-emerald {
    background: linear-gradient(135deg, #004d40 0%, #00251a 100%);
    border: none;
}

.form-control-custom:focus {
    border-color: #047857;
    box-shadow: 0 0 0 0.2rem rgba(4, 120, 87, 0.15);
}

.btn-emerald {
    background: linear-gradient(135deg, #004d40 0%, #00251a 100%);
    border: none;
    transition: all 0.3s ease;
}

.btn-emerald:hover {
    background: linear-gradient(135deg, #004d40 0%, #00251a 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(4, 120, 87, 0.3);
}

.gold-accent {
    color: #d97706;
}

.credential-box {
    background: linear-gradient(135deg, #004d40 0%, #00251a 100%);
    border-left: 4px solid #d97706;
}
</style>

<div class="login-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <!-- Main Card -->
                <div class="card shadow-lg border-0 rounded-3">
                    <!-- Header -->
                    <div class="card-header-emerald text-white text-center py-4">
                        <div class="mb-3">
                            <i class="bi bi-shield-lock-fill" style="font-size: 3rem;"></i>
                        </div>
                        <h3 class="mb-2 fw-bold">COSIM</h3>
                        <p class="mb-0">UPSI Complaint System</p>
                    </div>
                    
                    <!-- Body -->
                    <div class="card-body p-4">
                        <?= $this->Flash->render() ?>
                        
                        <?= $this->Form->create(null) ?>
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold text-dark">
                                <i class="bi bi-person-circle text-success"></i> Username
                            </label>
                            <?= $this->Form->control('username', [
                                'class' => 'form-control form-control-lg form-control-custom',
                                'placeholder' => 'Enter your username',
                                'label' => false,
                                'required' => true
                            ]) ?>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold text-dark">
                                <i class="bi bi-key-fill text-success"></i> Password
                            </label>
                            <?= $this->Form->control('password', [
                                'type' => 'password',
                                'class' => 'form-control form-control-lg form-control-custom',
                                'placeholder' => 'Enter your password',
                                'label' => false,
                                'required' => true
                            ]) ?>
                        </div>
                        
                        <div class="d-grid mb-3">
                            <?= $this->Form->button('Login', [
                                'class' => 'btn btn-emerald btn-lg text-white fw-bold'
                            ]) ?>
                        </div>
                        
                        <?= $this->Form->end() ?>
                        
                        <hr class="my-3">
                        
                        <div class="text-center">
                            <small class="text-muted">
                                <i class="bi bi-info-circle gold-accent"></i> 
                                For support, contact UPSI COSIM at <strong>cosim@upsi.edu.my</strong>
                            </small>
                        </div>
                    </div>
                </div>
                
                <!-- Footer -->
                <div class="text-center mt-4">
                    <small class="text-muted">
                        &copy; 2026 UPSI | All Rights Reserved.
                    </small>
                </div>