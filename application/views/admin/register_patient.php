<?php include('application/views/templates/header.php'); ?>
<?php include('application/views/templates/sidebar.php'); ?>

<div class="container mt-3">
    <h2>Registrasi Pasien</h2>

    <!-- Pilihan Registrasi -->
    <div class="mb-3">
        <label><input type="radio" name="patient_type" value="new" checked onclick="togglePatientForm('new')"> Pasien Baru</label>
        <label><input type="radio" name="patient_type" value="existing" onclick="togglePatientForm('existing')"> Pasien Lama</label>
    </div>

    <!-- Form Registrasi Pasien Baru -->
    <div id="new_patient_form">
        <form action="<?= base_url('admin/save_patient'); ?>" method="post">
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
            <button type="submit" class="btn btn-success">Simpan Pasien Baru</button>
        </form>
    </div>

    <!-- Form Registrasi Pasien Lama -->
    <div id="existing_patient_form" style="display: none;">
        <div class="mb-3">
            <label>Cari Pasien Lama (Nomor RM)</label>
            <input type="text" id="search_rm" class="form-control">
            <button type="button" class="btn btn-primary mt-2" onclick="searchPatient()">Cari</button>
        </div>
        <form action="<?= base_url('admin/register_existing_patient'); ?>" method="post" id="existing_patient_data" style="display: none;">
            <input type="hidden" name="patient_id" id="patient_id">
            <div class="mb-3">
                <label>Nama</label>
                <input type="text" id="patient_name" class="form-control" readonly>
            </div>
            <div class="mb-3">
                <label>Nomor RM</label>
                <input type="text" id="patient_rm" class="form-control" readonly>
            </div>
            <button type="submit" class="btn btn-success">Simpan Kunjungan</button>
        </form>
    </div>
</div>

<?php include('application/views/templates/footer.php'); ?>

<script>
function togglePatientForm(type) {
    if (type === 'new') {
        document.getElementById('new_patient_form').style.display = 'block';
        document.getElementById('existing_patient_form').style.display = 'none';
    } else {
        document.getElementById('new_patient_form').style.display = 'none';
        document.getElementById('existing_patient_form').style.display = 'block';
    }
}

function searchPatient() {
    let medicalRecordNumber = document.getElementById('search_rm').value;
    fetch("<?= base_url('admin/search_patient_by_rm'); ?>", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "medical_record_number=" + medicalRecordNumber
    })
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            alert(data.error);
        } else {
            document.getElementById('patient_id').value = data.id;
            document.getElementById('patient_name').value = data.name;
            document.getElementById('patient_rm').value = data.medical_record_number;
            document.getElementById('existing_patient_data').style.display = 'block';
        }
    })
    .catch(error => console.error("Error:", error));
}
</script>
