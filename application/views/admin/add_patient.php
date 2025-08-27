<?php include('application/views/templates/header.php'); ?>
<?php include('application/views/templates/sidebar.php'); ?>

<div class="container mt-3">
    <h2>Registrasi Pasien</h2>
    <hr>
    
    <form action="<?= base_url('admin/add_patient') ?>" method="post">
        
        <div class="mb-3">
            <label for="medical_record_number" class="form-label">Nomor Rekam Medis</label>
            <input type="text" name="medical_record_number" id="medical_record_number" class="form-control" value="<?= isset($next_rm) ? $next_rm : ''; ?>" readonly>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input type="text" name="name" id="name" class="form-control" value="<?= set_value('name') ?>" placeholder="Masukkan nama lengkap">
            <?= form_error('name', '<div class="text-danger small mt-1">', '</div>') ?>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="nik" class="form-label">NIK</label>
                <input type="text" name="nik" id="nik" class="form-control" maxlength="16" value="<?= set_value('nik') ?>" placeholder="Masukkan 16 digit NIK">
                <?= form_error('nik', '<div class="text-danger small mt-1">', '</div>') ?>
            </div>
            <div class="col-md-6 mb-3">
                <label for="phone" class="form-label">Nomor Telepon</label>
                <input type="text" name="phone" id="phone" class="form-control" value="<?= set_value('phone') ?>" placeholder="Contoh: 08123456789">
                <?= form_error('phone', '<div class="text-danger small mt-1">', '</div>') ?>
            </div>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Alamat</label>
            <textarea name="address" id="address" class="form-control" placeholder="Masukkan alamat lengkap"><?= set_value('address') ?></textarea>
            <?= form_error('address', '<div class="text-danger small mt-1">', '</div>') ?>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="birth" class="form-label">Tanggal Lahir</label>
                <input type="date" name="birth" id="birth" class="form-control" value="<?= set_value('birth') ?>">
                <?= form_error('birth', '<div class="text-danger small mt-1">', '</div>') ?>
            </div>
            
            <div class="col-md-6 mb-3">
                <label for="gender" class="form-label">Jenis Kelamin</label>
                <select name="gender" id="gender" class="form-control">
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="Male" <?= set_select('gender', 'Male') ?>>Laki-laki</option>
                    <option value="Female" <?= set_select('gender', 'Female') ?>>Perempuan</option>
                </select>
                <?= form_error('gender', '<div class="text-danger small mt-1">', '</div>') ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="blood_type" class="form-label">Golongan Darah</label>
                <select name="blood_type" id="blood_type" class="form-control">
                    <option value="">-- Pilih --</option>
                    <option value="A" <?= set_select('blood_type', 'A') ?>>A</option>
                    <option value="B" <?= set_select('blood_type', 'B') ?>>B</option>
                    <option value="AB" <?= set_select('blood_type', 'AB') ?>>AB</option>
                    <option value="O" <?= set_select('blood_type', 'O') ?>>O</option>
                </select>
                <?= form_error('blood_type', '<div class="text-danger small mt-1">', '</div>') ?>
            </div>
            <div class="col-md-4 mb-3">
                <label for="weight" class="form-label">Berat Badan (kg)</label>
                <input type="number" name="weight" id="weight" class="form-control" value="<?= set_value('weight') ?>" placeholder="Contoh: 65">
                <?= form_error('weight', '<div class="text-danger small mt-1">', '</div>') ?>
            </div>
            <div class="col-md-4 mb-3">
                <label for="height" class="form-label">Tinggi Badan (cm)</label>
                <input type="number" name="height" id="height" class="form-control" value="<?= set_value('height') ?>" placeholder="Contoh: 170">
                <?= form_error('height', '<div class="text-danger small mt-1">', '</div>') ?>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Simpan Pasien</button>
        <a href="<?= base_url('admin/patients') ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>

<?php include('application/views/templates/footer.php'); ?>