<h3>Daftar Jenis Layanan</h3>
<a href="/admin/jenis/tambah" class="btn btn-primary mb-3">Tambah Jenis</a>
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Nama Jenis</th>
        <th>Aksi</th>
    </tr>

    <?php foreach ($jenis as $j): ?>
    <tr>
        <td><?= $j['id'] ?></td>
        <td><?= $j['nama_jenis'] ?></td>
        <td>
            <a href="/admin/jenis/edit/<?= $j['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
            <a href="/admin/jenis/delete/<?= $j['id'] ?>"
   class="btn btn-danger btn-sm"
   onclick="return confirm('Yakin ingin menghapus jenis ini?')">
   Hapus
</a>
        </td>
    </tr>
    <?php endforeach ?>
</table>
