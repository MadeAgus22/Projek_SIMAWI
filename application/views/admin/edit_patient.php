<?php include('application/views/templates/header.php'); ?>
<?php include('application/views/templates/sidebar.php'); ?>

<div class="container mt-3">
    <h2>Edit Pasien</h2>
    <form action="<?= base_url('admin/update_patient/'.$patient->id); ?>" method="post">
        <div class="mb-3">
            <label>Nama Lengkap</label>
            <input type="text" name="name" class="form-control" value="<?= $patient->name; ?>" required>
        </div>
        <div class="mb-3">
            <label>NIK</label>
            <input type="text" name="nik" class="form-control" value="<?= $patient->nik; ?>" required>
        </div>
        <div class="mb-3">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control" value="<?= $patient->phone; ?>" required>
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="address" class="form-control"><?= $patient->address; ?></textarea>
        </div>
        <div class="mb-3">
            <label>Golongan Darah</label>
            <select name="blood_type" class="form-control">
                <option value="A" <?= ($patient->blood_type == 'A') ? 'selected' : ''; ?>>A</option>
                <option value="B" <?= ($patient->blood_type == 'B') ? 'selected' : ''; ?>>B</option>
                <option value="AB" <?= ($patient->blood_type == 'AB') ? 'selected' : ''; ?>>AB</option>
                <option value="O" <?= ($patient->blood_type == 'O') ? 'selected' : ''; ?>>O</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
    </form>
</div>

<?php include('application/views/templates/footer.php'); ?>
