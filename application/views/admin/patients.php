<?php include('application/views/templates/header.php'); ?>
<?php include('application/views/templates/sidebar.php'); ?>

<div class="container mt-3">
    <h2>Manajemen Pasien</h2>

    <!-- Form Pencarian -->
    <form action="<?= base_url('admin/patients'); ?>" method="get" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari pasien berdasarkan RM atau Nama">
            <button type="submit" class="btn btn-primary">Cari</button>
        </div>
    </form>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nomor RM</th>
                <th>Nama</th>
                <th>Usia</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($patients as $patient): ?>
            <tr>
                <td><?= $patient->medical_record_number; ?></td>
                <td><?= $patient->name; ?></td>
                <td><?= $patient->age; ?> Tahun</td>
                <td><?= $patient->gender; ?></td>
                <td><?= $patient->address; ?></td>
                <td>
                    <a href="<?= base_url('admin/edit_patient/'.$patient->id); ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="<?= base_url('admin/delete_patient/'.$patient->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus pasien ini?');">Hapus</a>
                </td>

            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include('application/views/templates/footer.php'); ?>
