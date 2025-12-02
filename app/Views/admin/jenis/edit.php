<h3>Edit Jenis Layanan</h3>

<a href="/admin/jenis" class="btn btn-secondary mb-3">Kembali</a>

<form method="post" action="/admin/jenis/update/<?= $jenis['id'] ?>">
    <div class="mb-3">
        <label for="nama_jenis" class="form-label">Nama Jenis Layanan</label>
        <input type="text" id="nama_jenis" name="nama_jenis" class="form-control" 
               value="<?= esc($jenis['nama_jenis']) ?>" required>
    </div>

    <button class="btn btn-primary">Simpan Perubahan</button>
</form>
