<?php include('application/views/templates/header.php'); ?>
<?php include('application/views/templates/sidebar.php'); ?>

<div class="container mt-3">
    <h2>Konfirmasi Registrasi Pasien Lama</h2>
    <p>Nama: <?= $patient->name; ?></p>
    <p>Nomor RM: <?= $patient->medical_record_number; ?></p>
    <p>Usia: <?= $patient->age; ?> Tahun</p>
    <p>Alamat: <?= $patient->address; ?></p>

    <form action="<?= base_url('admin/register_existing_patient'); ?>" method="post">
        <input type="hidden" name="patient_id" value="<?= $patient->id; ?>">
        <button type="submit" class="btn btn-success">Daftarkan Pasien</button>
    </form>
</div>

<?php include('application/views/templates/footer.php'); ?>
