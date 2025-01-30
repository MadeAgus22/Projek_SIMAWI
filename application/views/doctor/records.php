<?php include('application/views/templates/header.php'); ?> 
<?php include('application/views/templates/sidebar.php'); ?>

<div class="container mt-3">
    <h2>Rekam Medis</h2>
    <a href="<?= base_url('doctor/add_record'); ?>" class="btn btn-primary mb-3">Cari Pasien</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nomor RM</th> <!-- Tambahkan kolom Nomor RM -->
                <th>Nama Pasien</th>
                <th>Gejala</th>
                <th>Diagnosa Awal</th>
                <th>Kode ICD</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($records as $record): ?>
            <tr>
                <td><?= $record->medical_record_number; ?></td> <!-- Tampilkan Nomor RM -->
                <td><?= $record->patient_name; ?></td>
                <td><?= $record->symptoms; ?></td>
                <td><?= $record->initial_diagnosis; ?></td>
                <td><?= $record->icd_code; ?></td>
                <td><?= ucfirst($record->status); ?></td> <!-- Status pending/completed -->
                <td>
                    <a href="<?= base_url('doctor/edit_record/'.$record->id); ?>" class="btn btn-warning btn-sm">Edit</a>
                    
                    <a href="<?= base_url('doctor/delete_record/'.$record->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include('application/views/templates/footer.php'); ?>

