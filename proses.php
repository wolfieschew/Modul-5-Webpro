<?php
session_start();

// Tambah barang
if (isset($_GET['action']) && $_GET['action'] == 'add') {
    $newBarang = array(
        'id' => uniqid(),
        'nama' => $_POST['nama'],
        'harga' => $_POST['harga'],
        'kategori' => $_POST['kategori']
    );
    array_push($_SESSION['barang'], $newBarang);
    header('Location: index.php');
    exit();
}

// Edit barang
if (isset($_GET['action']) && $_GET['action'] == 'edit') {
    $id = $_POST['id'];
    foreach ($_SESSION['barang'] as $key => $barang) {
        if ($barang['id'] == $id) {
            $_SESSION['barang'][$key]['nama'] = $_POST['nama'];
            $_SESSION['barang'][$key]['harga'] = $_POST['harga'];
            $_SESSION['barang'][$key]['kategori'] = $_POST['kategori'];
        }
    }
    header('Location: index.php');
    exit();
}

// Hapus barang
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = $_GET['id'];
    foreach ($_SESSION['barang'] as $key => $barang) {
        if ($barang['id'] == $id) {
            unset($_SESSION['barang'][$key]);
        }
    }
    header('Location: index.php');
    exit();
}
