<?php include('application/views/templates/header.php'); ?>
<?php include('application/views/templates/sidebar.php'); ?>
<div class="container mt-3">
    <h2>Tambah User</h2>
    <form action="<?= base_url('admin/save_user') ?>" method="post">
    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Username</label>
        <input type="text" name="username" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Role</label>
        <select name="role" class="form-control">
            <option value="admin">Admin</option>
            <option value="doctor">Dokter</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
</form>
</div>
<?php include('application/views/templates/footer.php'); ?>
