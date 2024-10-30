<?php
session_start();

// Cek apakah sudah ada data barang dalam session, jika belum, buat array kosong
if (!isset($_SESSION['barang'])) {
    $_SESSION['barang'] = array();
}

// Jika mengedit, cari barang berdasarkan ID
$barangToEdit = null;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    foreach ($_SESSION['barang'] as $barang) {
        if ($barang['id'] == $id) {
            $barangToEdit = $barang;
            break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Data Barang</title>
</head>
<body>
    <h1>Manajemen Data Barang</h1>

    <!-- Form Tambah Barang -->
    <h2>Tambah Barang</h2>
    <form action="proses.php?action=add" method="post">
        <label for="nama">Nama Barang:</label><br>
        <input type="text" name="nama" id="nama" required>
        <br>
        <label for="harga">Harga Barang:</label><br>
        <input type="number" name="harga" id="harga" required><br>
        <label for="harga">Kategori Barang:</label><br>
        <input type="text" name="kategori" id="kategori" required><br>
        <br>
        <button type="submit">Tambah Barang</button>
    </form>

    <!-- Form Edit Barang (Hanya tampil jika mengedit) -->
    <?php if ($barangToEdit): ?>
        <h2>Edit Barang</h2>
        <form action="proses.php?action=edit" method="post">
            <input type="hidden" name="id" value="<?php echo $barangToEdit['id']; ?>">
            <label for="nama_edit">Nama Barang:</label>
            <input type="text" name="nama" id="nama_edit" value="<?php echo $barangToEdit['nama']; ?>" required>
            <br>
            <label for="harga_edit">Harga Barang:</label>
            <input type="number" name="harga" id="harga_edit" value="<?php echo $barangToEdit['harga']; ?>" required>
            <br>
            <label for="harga_edit">Kategori Barang:</label>
            <input type="text" name="kategori" id="harga_edit" value="<?php echo $barangToEdit['kategori']; ?>" required>
            <br>
            <button type="submit">Update Barang</button>
        </form>
    <?php endif; ?>

    <h2>Daftar Barang</h2>
    <table border="1">
        <tr>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Kategori</th>
            <th>Aksi</th>
        </tr>
        <?php if (!empty($_SESSION['barang'])): ?>
            <?php foreach ($_SESSION['barang'] as $barang): ?>
                <tr>
                    <td><?php echo $barang['nama']; ?></td>
                    <td><?php echo $barang['harga']; ?></td>
                    <td><?php echo $barang['kategori']; ?></td>
                    <td>
                        <a href="index.php?id=<?php echo $barang['id']; ?>">Edit</a>
                        <a href="proses.php?action=delete&id=<?php echo $barang['id']; ?>" onclick="return confirm('Yakin ingin menghapus barang ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="3">Belum ada data barang.</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>
