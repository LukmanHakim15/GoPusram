@extends('layouts.admin')
@section('title', 'Jam Operasional')
@section('page-title', 'Pengaturan Jam Operasional')

@section('content')
<div class="row justify-content-center">
<div class="col-lg-6">

    {{-- Status toko saat ini --}}
    <div class="card border-0 shadow-sm mb-4
         {{ $setting->isCurrentlyOpen() ? 'border-success' : 'border-danger' }}"
         style="border-left: 4px solid {{ $setting->isCurrentlyOpen() ? '#198754' : '#dc3545' }} !important">
        <div class="card-body d-flex align-items-center gap-4 py-4">
            <div class="rounded-circle p-3
                 {{ $setting->isCurrentlyOpen() ? 'bg-success' : 'bg-danger' }} bg-opacity-10">
                <i class="bi bi-shop-window fs-2
                   {{ $setting->isCurrentlyOpen() ? 'text-success' : 'text-danger' }}"></i>
            </div>
            <div>
                <h5 class="fw-bold mb-1">
                    Pusram Saat Ini:
                    <span class="{{ $setting->isCurrentlyOpen() ? 'text-success' : 'text-danger' }}">
                        {{ $setting->isCurrentlyOpen() ? 'BUKA' : 'TUTUP' }}
                    </span>
                </h5>
                <p class="text-muted mb-0">
                    Jam operasional:
                    {{ \Carbon\Carbon::parse($setting->jam_buka)->format('H:i') }} –
                    {{ \Carbon\Carbon::parse($setting->jam_tutup)->format('H:i') }} WIB
                </p>
                @if(!$setting->is_open)
                    <small class="text-danger">Toko dinonaktifkan manual oleh admin.</small>
                @endif
            </div>
        </div>
    </div>

    {{-- Form pengaturan --}}
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 pt-4 px-4">
            <h6 class="fw-bold mb-0">Atur Jadwal Operasional</h6>
        </div>
        <div class="card-body px-4 pb-4">
            <form action="{{ route('admin.operating-hours.update') }}" method="POST">
                @csrf
                @method('PATCH')

                {{-- Toggle buka/tutup manual --}}
                <div class="mb-4 p-3 bg-light rounded-3">
                    <div class="form-check form-switch d-flex align-items-center gap-3">
                        <input class="form-check-input" type="checkbox" role="switch"
                               name="is_open" id="is_open" style="width:3rem;height:1.5rem"
                               {{ $setting->is_open ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold" for="is_open">
                            Aktifkan Toko (izinkan pemesanan)
                        </label>
                    </div>
                    <small class="text-muted d-block mt-2 ms-5">
                        Jika dimatikan, siswa tidak bisa memesan meskipun masih dalam jam operasional.
                    </small>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Jam Buka</label>
                        <input type="time" name="jam_buka" class="form-control @error('jam_buka') is-invalid @enderror"
                               value="{{ \Carbon\Carbon::parse($setting->jam_buka)->format('H:i') }}">
                        @error('jam_buka')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Jam Tutup</label>
                        <input type="time" name="jam_tutup" class="form-control @error('jam_tutup') is-invalid @enderror"
                               value="{{ \Carbon\Carbon::parse($setting->jam_tutup)->format('H:i') }}">
                        @error('jam_tutup')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-save me-2"></i>Simpan Pengaturan
                </button>
            </form>
        </div>
    </div>

</div>
</div>
@endsection