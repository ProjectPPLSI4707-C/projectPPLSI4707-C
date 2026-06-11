@extends('layouts.app')
@section('title', 'Tambah Data Alat')
@section('page-title', 'Tambah Data Alat')

@section('content')
<div class="page-header flex items-center justify-between">
    <div>
        <h2>Tambah Inventaris Baru</h2>
        <p>Masukkan data alat penyewaan baru</p>
    </div>
    <a href="{{ route('admin.inventaris-alat.index') }}" class="btn btn-outline">⬅️ Kembali</a>
</div>

<div class="card" style="max-width: 800px;">
    <form action="{{ route('admin.inventaris-alat.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div style="margin-bottom: 20px;">
            <label style="display:block; font-weight: 500; margin-bottom: 8px;">Nama Alat <span style="color:red">*</span></label>
            <input type="text" name="nama_alat" value="{{ old('nama_alat') }}" required class="form-control" style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px;">
            @error('nama_alat') <span style="color:red; font-size: 12px;">{{ $message }}</span> @enderror
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display:block; font-weight: 500; margin-bottom: 8px;">Jenis Alat <span style="color:red">*</span></label>
            <input type="text" name="jenis" value="{{ old('jenis') }}" required class="form-control" placeholder="Contoh: Tenda, Kompor, dll." style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px;">
            @error('jenis') <span style="color:red; font-size: 12px;">{{ $message }}</span> @enderror
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display:block; font-weight: 500; margin-bottom: 8px;">Harga Sewa / Hari (Rp) <span style="color:red">*</span></label>
            <input type="number" name="harga_sewa" value="{{ old('harga_sewa') }}" required min="0" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px;">
            @error('harga_sewa') <span style="color:red; font-size: 12px;">{{ $message }}</span> @enderror
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display:block; font-weight: 500; margin-bottom: 8px;">Stok <span style="color:red">*</span></label>
            <input type="number" name="stok" value="{{ old('stok', 1) }}" required min="0" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px;">
            @error('stok') <span style="color:red; font-size: 12px;">{{ $message }}</span> @enderror
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display:block; font-weight: 500; margin-bottom: 8px;">Deskripsi <span style="color:red">*</span></label>
            <textarea name="deskripsi" required rows="4" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px;">{{ old('deskripsi') }}</textarea>
            @error('deskripsi') <span style="color:red; font-size: 12px;">{{ $message }}</span> @enderror
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display:block; font-weight: 500; margin-bottom: 8px;">Gambar Alat</label>
            <input type="file" name="gambar" accept="image/*" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px; background: #fff;">
            @error('gambar') <span style="color:red; font-size: 12px;">{{ $message }}</span> @enderror
        </div>

        <div style="margin-top: 30px;">
            <button type="submit" class="btn btn-primary" style="padding: 10px 24px; font-size: 15px;">💾 Simpan Alat</button>
        </div>
    </form>
</div>
@endsection
