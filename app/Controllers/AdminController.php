<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JenisLoketModel;
use App\Models\LoketModel;
use App\Models\UserModel;

class AdminController extends BaseController
{
    public function __construct()
    {
        helper(['url', 'form']);
    }

    // ================================
    // DASHBOARD ADMIN
    // ================================
    public function dashboard()
    {
        // Cek apakah role = admin
        $session = session();
        if ($session->get('role') !== 'admin') {
            return redirect()->to('/login')->with('error', 'Akses ditolak!');
        }

        $jenisModel = new JenisLoketModel();
        $loketModel = new LoketModel();
        $userModel  = new UserModel();

        $data = [
            'countJenis'    => $jenisModel->countAllResults(),
            'countLoket'    => $loketModel->countAllResults(),
            'countOperator' => $userModel->where('role', 'operator')->countAllResults(),
        ];

        return view('admin/admin_dashboard', $data);
    }

    // ================================
    // HALAMAN DAFTAR JENIS LAYANAN
    // ================================
    public function jenis()
    {
        $session = session();
        if ($session->get('role') !== 'admin') {
            return redirect()->to('/login')->with('error', 'Akses ditolak!');
        }

        $model = new JenisLoketModel();
        $data['jenis'] = $model->findAll();

        return view('admin/jenis/index', $data);
    }

    public function jenisTambah()
{
    return view('admin/jenis/add');
}

public function jenisSave()
{
    $model = new JenisLoketModel();
    $model->insert([
        'nama_jenis' => $this->request->getPost('nama_jenis')
    ]);

    return redirect()->to('/admin/jenis')->with('success', 'Jenis layanan ditambahkan');
}

public function jenisEdit($id)
{
    $model = new JenisLoketModel();

    $data['jenis'] = $model->find($id);

    return view('admin/jenis/edit', $data);
}

public function jenisUpdate($id)
{
    $model = new JenisLoketModel();

    $model->update($id, [
        'nama_jenis' => $this->request->getPost('nama_jenis')
    ]);

    return redirect()->to('/admin/jenis')->with('success', 'Jenis layanan diupdate');
}

public function JenisDelete($id)
{
    $session = session();
    if ($session->get('role') !== 'admin') {
        return redirect()->to('/login')->with('error', 'Akses ditolak!');
    }

    $model = new \App\Models\JenisLoketModel();

    // Cek apakah ID valid
    $loketModel = new \App\Models\LoketModel();
    $dipakai = $loketModel->where('kode_jenis', $jenis['kode_jenis'])->countAllResults();

    if ($dipakai > 0) {
    return redirect()->to('/admin/jenis')
        ->with('error', 'Tidak dapat menghapus! Jenis ini digunakan oleh ' . $dipakai . ' loket.');
}

    $jenis = $model->find($id);
    if (!$jenis) {
        return redirect()->to('/admin/jenis')->with('error', 'Jenis layanan tidak ditemukan.');
    }

    // Hapus data
    $model->delete($id);

    return redirect()->to('/admin/jenis')->with('success', 'Jenis layanan berhasil dihapus!');
}

    // ================================
    // LOGOUT
    // ================================
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

}
