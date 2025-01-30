<?php include('application/views/templates/header.php'); ?>
<?php include('application/views/templates/sidebar.php'); ?>

<div class="container mt-3">
    <h2>Dashboard</h2>

    <!-- Statistik Total Pasien -->
    <div class="card text-white bg-primary mb-3">
        <div class="card-header">Total Pasien</div>
        <div class="card-body">
            <h5 class="card-title"><?= $total_patients; ?> Pasien</h5>
        </div>
    </div>

    <!-- 5 Kode ICD-10 Terbanyak -->
    <div class="card mb-3">
    <div class="card-header">Kode ICD-10 yang Paling Banyak Digunakan</div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Kode ICD</th>
                    <th>Deskripsi Penyakit</th>
                    <th>Jumlah Kasus</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($top_icd_codes as $icd): ?>
                <tr>
                    <td><?= $icd->icd_code; ?></td>
                    <td><?= $icd->icd_description ? $icd->icd_description : '-'; ?></td> <!-- Gunakan deskripsi jika ada -->
                    <td><?= $icd->count; ?> Kasus</td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Daftar 5 Pasien Terbaru -->
<div class="card mb-3">
    <div class="card-header">Pasien Terbaru</div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Nomor RM</th>
                    <th>Nama</th>
                    <th>Tanggal Pendaftaran</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($recent_patients as $patient): ?>
                <tr>
                    <td><?= $patient->medical_record_number; ?></td>
                    <td><?= $patient->name; ?></td>
                    <td><?= date('d-m-Y H:i', strtotime($patient->created_at)); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>



<?php include('application/views/templates/footer.php'); ?>
