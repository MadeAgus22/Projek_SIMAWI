<div class="d-flex">
    <div class="col-md-3">
        <ul class="list-group">
            <?php if ($this->session->userdata('role') == 'admin'): ?>
                <li class="list-group-item"><a href="<?= base_url('admin/dashboard'); ?>">Dashboard</a></li>
                <li class="list-group-item"><a href="<?= base_url('admin/register_patient'); ?>">Registrasi Pasien</a></li>
                <li class="list-group-item"><a href="<?= base_url('admin/users'); ?>">Manajemen User</a></li>
                <li class="list-group-item"><a href="<?= base_url('admin/patients'); ?>">Manajemen Pasien</a></li>
            <?php elseif ($this->session->userdata('role') == 'doctor'): ?>
                <li class="list-group-item"><a href="<?= base_url('doctor/dashboard'); ?>">Dashboard</a></li>
                <li class="list-group-item"><a href="<?= base_url('doctor/records'); ?>">Rekam Medis</a></li>
            <?php endif; ?>
            <li class="list-group-item"><a href="<?= base_url('auth/logout'); ?>" onclick="confirmLogout(event)">Logout</a></li>
        </ul>
    </div>
    <div class="col-md-9">
