<?php include('application/views/templates/header.php'); ?>
<?php include('application/views/templates/sidebar.php'); ?>
<div class="container mt-3">
    <h2>Manajemen User</h2>
    <a href="<?= base_url('admin/add_user'); ?>" class="btn btn-primary mb-3">Tambah User</a>
    <table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Role</th>
            <th>Dibuat Pada</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user->id; ?></td>
            <td><?= $user->name; ?></td>
            <td><?= $user->username; ?></td>
            <td><?= ucfirst($user->role); ?></td>
            <td><?= $user->created_at; ?></td>
            <td>
                <a href="<?= base_url('admin/edit_user/'.$user->id); ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="<?= base_url('admin/delete_user/'.$user->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</div>
<?php include('application/views/templates/footer.php'); ?>
