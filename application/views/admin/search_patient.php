<?php include('application/views/templates/header.php'); ?>
<?php include('application/views/templates/sidebar.php'); ?>

<div class="container mt-3">
    <h2>Registrasi Pasien Lama</h2>
    <form action="<?= base_url('admin/find_patient'); ?>" method="post">
        <div class="mb-3">
            <label>Masukkan Nomor RM</label>
            <input type="text" name="medical_record_number" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Cari Pasien</button>
    </form>
</div>

<?php include('application/views/templates/footer.php'); ?>
