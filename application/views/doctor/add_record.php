<?php include('application/views/templates/header.php'); ?>
<?php include('application/views/templates/sidebar.php'); ?>
<div class="container mt-3">
    <h2>Cari Pasien</h2>
    <form action="<?= base_url('doctor/save_record') ?>" method="post">
        <div class="mb-3">
        <label>Pilih Pasien</label>
            <select name="patient_id" class="form-control" required>
                <option value="">-- Pilih Pasien --</option>
                <?php foreach ($patients as $patient): ?>
                    <option value="<?= $patient->id; ?>"><?= $patient->name; ?> - <?= $patient->medical_record_number; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Gejala</label>
            <textarea name="symptoms" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>Diagnosa Awal</label>
            <input type="text" name="initial_diagnosis" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Kode ICD-11</label>
            <input type="text" id="icd_code" name="icd_code" class="form-control" required placeholder="Cari kode ICD-11...">
            <ul id="icd_suggestions" class="list-group"></ul>
        </div>
        <div class="mb-3">
            <label>Deskripsi ICD</label>
            <textarea id="icd_description" name="icd_description" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
<?php include('application/views/templates/footer.php'); ?>
