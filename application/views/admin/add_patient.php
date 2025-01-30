<?php include('application/views/templates/header.php'); ?>
<?php include('application/views/templates/sidebar.php'); ?>

<div class="container mt-3">
    <h2>Registrasi Pasien</h2>
    <form action="<?= base_url('admin/save_patient') ?>" method="post">
        <div class="mb-3">
            <label>Nomor Rekam Medis</label>
            <input type="text" name="medical_record_number" class="form-control" value="<?= isset($next_rm) ? $next_rm : 'RM0001'; ?>" readonly>
        </div>
        <div class="mb-3">
            <label>Nama Lengkap</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>NIK</label>
            <input type="text" name="nik" class="form-control" maxlength="16" required>
        </div>
        <div class="mb-3">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Address</label>
            <textarea name="address" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>Tanggal Lahir</label>
            <input type="date" name="birth" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Golongan Darah</label>
            <select name="blood_type" class="form-control">
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="AB">AB</option>
                <option value="O">O</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Berat Badan (kg)</label>
            <input type="number" name="weight" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tinggi Badan (cm)</label>
            <input type="number" name="height" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>

<?php include('application/views/templates/footer.php'); ?>
