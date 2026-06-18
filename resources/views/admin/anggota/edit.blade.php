@extends('layouts.app')
@section('title', 'Edit Anggota')
@section('page-title', 'Edit Anggota')

@section('content')
<div class="page-header flex items-center justify-between">
    <div>
        <h2>Edit Anggota: {{ $user->name }}</h2>
        <p>Ubah data informasi anggota koperasi</p>
    </div>
    <a href="{{ route('admin.anggota.index') }}" class="btn btn-outline">⬅️ Kembali</a>
</div>

<div class="card" style="max-width: 800px;">
    <form action="{{ route('admin.anggota.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label class="form-label">Nama <span class="req">*</span></label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="form-control @error('name') is-invalid @enderror">
            @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Email <span class="req">*</span></label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="form-control @error('email') is-invalid @enderror">
            @error('email')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Telepon</label>
            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="form-control @error('phone') is-invalid @enderror" placeholder="Contoh: 08123456789">
            @error('phone')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Alamat</label>
            <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="3" placeholder="Alamat lengkap anggota">{{ old('address', $user->address) }}</textarea>
            @error('address')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div style="display:flex;gap:10px;margin-top:28px;">
            <button type="submit" class="btn btn-primary" style="padding:10px 24px;font-size:15px;">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="16" height="16"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                Simpan Perubahan
            </button>
            <a href="{{ route('admin.anggota.index') }}" class="btn btn-outline" style="padding:10px 24px;font-size:15px;">Batal</a>
        </div>
    </form>
</div>
@endsection
