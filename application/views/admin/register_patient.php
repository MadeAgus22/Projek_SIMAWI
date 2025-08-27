<?php include('application/views/templates/header.php'); ?>
<?php include('application/views/templates/sidebar.php'); ?>

<div class="container mt-3">
    <h2>Registrasi Kunjungan Pasien</h2>
    <hr>

    <div class="mb-3">
        <label class="me-3"><input type="radio" name="patient_type" value="new" checked onclick="togglePatientForm('new')"> Pasien Baru</label>
        <label><input type="radio" name="patient_type" value="existing" onclick="togglePatientForm('existing')"> Pasien Lama</label>
    </div>

    <div id="new_patient_form">
        <?= form_open('admin/add_patient'); ?>
        
        <div class="mb-3">
            <label class="form-label">Nomor Rekam Medis</label>
            <input type="text" name="medical_record_number" class="form-control" value="<?= isset($next_rm) ? $next_rm : ''; ?>" readonly>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="name" class="form-control" value="<?= set_value('name'); ?>" placeholder="Masukkan nama lengkap">
            <?= form_error('name', '<div class="text-danger small mt-1">', '</div>'); ?>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">NIK</label>
                <input type="text" name="nik" class="form-control" maxlength="16" value="<?= set_value('nik'); ?>" placeholder="Masukkan 16 digit NIK">
                <?= form_error('nik', '<div class="text-danger small mt-1">', '</div>'); ?>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" value="<?= set_value('phone'); ?>" placeholder="Contoh: 08123456789">
                <?= form_error('phone', '<div class="text-danger small mt-1">', '</div>'); ?>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Address</label>
            <textarea name="address" class="form-control" placeholder="Masukkan alamat lengkap"><?= set_value('address'); ?></textarea>
            <?= form_error('address', '<div class="text-danger small mt-1">', '</div>'); ?>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="birth" class="form-label">Tanggal Lahir</label>
                <input type="date" name="birth" id="birth" class="form-control" value="<?= set_value('birth'); ?>">
                <?= form_error('birth', '<div class="text-danger small mt-1">', '</div>'); ?>
            </div>
            
            <div class="col-md-2 mb-3">
                <label for="age_view" class="form-label">Umur</label>
                <input type="text" id="age_view" class="form-control" value="0" readonly>
            </div>
            
            <div class="col-md-6 mb-3">
                <label for="gender" class="form-label">Jenis Kelamin</label>
                <select name="gender" id="gender" class="form-control">
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="Male" <?= set_select('gender', 'Male'); ?>>Laki-laki</option>
                    <option value="Female" <?= set_select('gender', 'Female'); ?>>Perempuan</option>
                </select>
                <?= form_error('gender', '<div class="text-danger small mt-1">', '</div>'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Golongan Darah</label>
                <select name="blood_type" class="form-control">
                    <option value="">-- Pilih --</option>
                    <option value="A" <?= set_select('blood_type', 'A'); ?>>A</option>
                    <option value="B" <?= set_select('blood_type', 'B'); ?>>B</option>
                    <option value="AB" <?= set_select('blood_type', 'AB'); ?>>AB</option>
                    <option value="O" <?= set_select('blood_type', 'O'); ?>>O</option>
                </select>
                <?= form_error('blood_type', '<div class="text-danger small mt-1">', '</div>'); ?>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Berat Badan (kg)</label>
                <input type="number" name="weight" class="form-control" value="<?= set_value('weight'); ?>" placeholder="Contoh: 65">
                <?= form_error('weight', '<div class="text-danger small mt-1">', '</div>'); ?>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Tinggi Badan (cm)</label>
                <input type="number" name="height" class="form-control" value="<?= set_value('height'); ?>" placeholder="Contoh: 170">
                <?= form_error('height', '<div class="text-danger small mt-1">', '</div>'); ?>
            </div>
        </div>
        
        <button type="submit" class="btn btn-success">Simpan Pasien Baru</button>
        </form>
    </div>

    <div id="existing_patient_form" style="display: none;">
        </div>
</div>

<?php include('application/views/templates/footer.php'); ?>

<script>
// Menunggu sampai seluruh halaman web selesai dimuat
document.addEventListener('DOMContentLoaded', function() {
    // Mengambil elemen input tanggal lahir dan umur
    const birthInput = document.getElementById('birth');
    const ageViewInput = document.getElementById('age_view');

    // Fungsi untuk menghitung dan menampilkan umur
    function calculateAge() {
        const birthDate = new Date(birthInput.value);
        if (!isNaN(birthDate.getTime())) { // Cek jika tanggal valid
            const today = new Date();
            let age = today.getFullYear() - birthDate.getFullYear();
            const m = today.getMonth() - birthDate.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            ageViewInput.value = age < 0 ? 0 : age; // Tampilkan umur, minimal 0
        } else {
            ageViewInput.value = 0; // Jika tanggal tidak valid, umur 0
        }
    }

    // Panggil fungsi calculateAge saat nilai tanggal lahir berubah
    birthInput.addEventListener('change', calculateAge);

    // Panggil juga saat halaman dimuat, jika tanggal lahir sudah terisi (misal saat validasi error)
    calculateAge();
});

// Fungsi Javascript tidak diubah
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