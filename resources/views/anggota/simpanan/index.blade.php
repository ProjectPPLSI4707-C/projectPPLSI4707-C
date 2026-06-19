@extends('layouts.app')
@section('title', 'Riwayat Transaksi')
@section('page-title', 'Riwayat Transaksi')

@section('content')
<div class="page-header" style="display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:12px;">
    <div>
        <h2>Riwayat Transaksi</h2>
        <p>Daftar seluruh transaksi simpanan dan angsuran Anda</p>
    </div>
    <div style="display:flex;gap:10px;flex-wrap:wrap;">
        <a href="{{ route('anggota.simpanan.create') }}" class="btn btn-primary">
            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Bayar Simpanan
        </a>
        <a href="{{ route('anggota.angsuran.create') }}" class="btn btn-outline">
            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Bayar Angsuran
        </a>
    </div>
</div>

{{-- Summary Cards --}}
<div class="stat-grid" style="grid-template-columns:repeat(auto-fit,minmax(160px,1fr));margin-bottom:20px;">
    <div class="stat-card">
        <div class="stat-icon gold">
            <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" width="22" height="22"><path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2z"/></svg>
        </div>
        <div class="stat-info">
            <div class="stat-label">Simpanan Pokok</div>
            <div class="stat-value sm">Rp {{ number_format($totalPokok,0,',','.') }}</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green">
            <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" width="22" height="22"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        </div>
        <div class="stat-info">
            <div class="stat-label">Simpanan Wajib</div>
            <div class="stat-value sm">Rp {{ number_format($totalWajib,0,',','.') }}</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon blue">
            <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" width="22" height="22"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div class="stat-info">
            <div class="stat-label">Simpanan Sukarela</div>
            <div class="stat-value sm">Rp {{ number_format($totalSukarela,0,',','.') }}</div>
        </div>
    </div>
</div>

{{-- Filter --}}
<div class="card" style="margin-bottom:16px;padding:14px 18px;">
    <div style="display:flex;gap:8px;align-items:center;flex-wrap:wrap;">
        <span style="font-size:13px;font-weight:500;color:var(--gray-500);">Filter:</span>
        @foreach([''=>'Semua','Pokok'=>'Pokok','Wajib'=>'Wajib','Sukarela'=>'Sukarela'] as $j=>$jLabel)
            <a href="{{ route('anggota.simpanan.index', $j ? ['jenis'=>$j] : []) }}"
               style="padding:5px 14px;border-radius:20px;font-size:13px;font-weight:500;text-decoration:none;transition:all .15s;
                      {{ ($jenis===$j || ($j===''&&!$jenis)) ? 'background:var(--navy-light);color:#fff;' : 'background:var(--gray-100);color:var(--gray-600);border:1px solid var(--gray-200);' }}">
                {{ $jLabel }}
            </a>
        @endforeach
    </div>
</div>

{{-- Table --}}
<div class="card" style="padding:0;">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tipe</th>
                    <th>Deskripsi</th>
                    <th>Tanggal</th>
                    <th>Nominal</th>
                    <th>Bukti</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($simpanan as $i => $s)
                    @php $tanggal = \Illuminate\Support\Carbon::parse($s->created_at); @endphp
                    <tr>
                        <td style="color:var(--gray-500);">{{ $simpanan->firstItem() + $i }}</td>
                        <td><span style="font-weight:600;color:var(--gray-800);">{{ $s->tipe }}</span></td>
                        <td><span style="font-weight:500;color:var(--gray-700);">{{ $s->deskripsi }}</span></td>
                        <td style="color:var(--gray-500);font-size:13px;">{{ $tanggal->format('d M Y, H:i') }}</td>
                        <td style="font-weight:700;color:var(--navy-light);font-family:'JetBrains Mono',monospace;font-size:13.5px;">
                            Rp {{ number_format($s->jumlah,0,',','.') }}
                        </td>
                        <td>
                            @if($s->bukti_bayar)
                                <a href="{{ asset($s->bukti_bayar) }}" target="_blank" class="btn btn-sm btn-outline" style="gap:5px;">
                                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/></svg>
                                    Lihat
                                </a>
                            @else
                                <span style="color:var(--gray-400);font-size:12px;">—</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge {{ $s->status==='Success' ? 'badge-success' : 'badge-pending' }}">
                                {{ $s->status }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align:center;padding:48px;color:var(--gray-500);">
                            <svg style="margin:0 auto 12px;color:var(--gray-400);" width="40" height="40" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                            <div style="font-size:14px;font-weight:600;color:var(--gray-700);margin-bottom:4px;">Belum ada transaksi.</div>
                            <div style="margin-top:12px;display:flex;gap:8px;justify-content:center;flex-wrap:wrap;">
                                <a href="{{ route('anggota.simpanan.create') }}" class="btn btn-primary btn-sm">Bayar Simpanan</a>
                                <a href="{{ route('anggota.angsuran.create') }}" class="btn btn-outline btn-sm">Bayar Angsuran</a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if($simpanan->hasPages())
    <div class="pagination-wrap">{{ $simpanan->appends(request()->query())->links() }}</div>
@endif
@endsection
