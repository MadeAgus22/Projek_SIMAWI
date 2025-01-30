<?php include('application/views/templates/header.php'); ?>
<?php include('application/views/templates/sidebar.php'); ?>
<div class="container mt-3">
    <h2>Edit User</h2>
    <form action="<?= base_url('admin/update_user/'.$user->id) ?>" method="post">
    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="name" class="form-control" value="<?= $user->name ?>" required>
    </div>
    <div class="mb-3">
        <label>Username</label>
        <input type="text" name="username" class="form-control" value="<?= $user->username ?>" required>
    </div>
    <div class="mb-3">
        <label>Password (Opsional)</label>
        <input type="password" name="password" class="form-control">
    </div>
    <div class="mb-3">
        <label>Role</label>
        <select name="role" class="form-control">
            <option value="admin" <?= $user->role == 'admin' ? 'selected' : '' ?>>Admin</option>
            <option value="doctor" <?= $user->role == 'doctor' ? 'selected' : '' ?>>Dokter</option>
        </select>
    </div>
    <button type="submit" class="btn btn-warning">Update</button>
</form>

</div>
<?php include('application/views/templates/footer.php'); ?>
