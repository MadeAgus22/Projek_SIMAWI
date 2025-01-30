<?php include('application/views/templates/header.php'); ?>
<?php include('application/views/templates/sidebar.php'); ?>

<div class="container mt-3">
    <h2>Edit Rekam Medis</h2>
    <form action="<?= base_url('doctor/update_record/'.$record->id) ?>" method="post">
    <div class="mb-3">
        <label>Gejala</label>
        <textarea name="symptoms" class="form-control"><?= $record->symptoms; ?></textarea>
    </div>
    <div class="mb-3">
        <label>Diagnosa Awal</label>
        <input type="text" name="initial_diagnosis" class="form-control" value="<?= $record->initial_diagnosis; ?>" required>
    </div>
    <div class="mb-3">
        <label>Kode ICD-10</label>
        <input type="text" id="icd_code" name="icd_code" class="form-control" autocomplete="off">
        <ul id="icd_suggestions" class="list-group" style="position: absolute; z-index: 1000;"></ul>
    </div>

    <div class="mb-3">
        <label>Deskripsi ICD</label>
        <textarea name="icd_description" class="form-control"><?= $record->icd_description; ?></textarea>
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
</form>

</div>

<?php include('application/views/templates/footer.php'); ?>
