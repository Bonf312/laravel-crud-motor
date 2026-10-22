@extends('layouts.app')

@section('title', 'Detail Motor')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Detail Motor</h2>

    <div class="d-flex gap-2">
        <a href="{{ route('motors.edit', $motor) }}"
            class="btn btn-warning">Edit</a>

        <a href="{{ route('motors.index') }}"
            class="btn btn-secondary">Kembali</a>
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <div class="row g-4">
            <div class="col-md-5">
                @if ($motor->gambar)
                    <img src="{{ asset('storage/' . $motor->gambar) }}"
                        alt="Foto {{ $motor->nama }}"
                        class="img-fluid rounded"
                        style="max-height: 350px; width: 100%; object-fit: contain;">
                @else
                    <div class="bg-light rounded p-5 text-center">
                        <span class="text-muted">Belum ada foto motor</span>
                    </div>
                @endif
            </div>

            <div class="col-md-7">
                <h3>{{ $motor->nama }}</h3>
                <p class="text-muted">{{ $motor->merek }} · {{ $motor->tahun }}</p>

                <h4 class="text-primary mb-3">
                    Rp {{ number_format($motor->harga, 0, ',', '.') }}
                </h4>

                <p><strong>Stok:</strong> {{ $motor->stok }} unit</p>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header">
        <h5 class="mb-0">Spesifikasi Teknis</h5>
    </div>

    <div class="card-body table-responsive">
        <table class="table table-bordered align-middle mb-0">
            <tbody>
                <tr>
                    <th style="width: 40%">Kapasitas Mesin</th>
                    <td>{{ $motor->spesifikasi?->kapasitas_cc !== null ? $motor->spesifikasi->kapasitas_cc . ' cc' : '-' }}</td>
                </tr>
                <tr>
                    <th>Transmisi</th>
                    <td>{{ $motor->spesifikasi?->transmisi ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Bahan Bakar</th>
                    <td>{{ $motor->spesifikasi?->bahan_bakar ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Berat Motor</th>
                    <td>{{ $motor->spesifikasi?->berat_motor !== null ? $motor->spesifikasi->berat_motor . ' kg' : '-' }}</td>
                </tr>
                <tr>
                    <th>Kapasitas Tangki</th>
                    <td>{{ $motor->spesifikasi?->kapasitas_tangki !== null ? $motor->spesifikasi->kapasitas_tangki . ' liter' : '-' }}</td>
                </tr>
                <tr>
                    <th>Rem ABS</th>
                    <td>{{ $motor->spesifikasi ? ($motor->spesifikasi->rem_abs ? 'Ya' : 'Tidak') : '-' }}</td>
                </tr>
                <tr>
                    <th>Sistem Pendingin</th>
                    <td>{{ $motor->spesifikasi?->sistem_pendingin ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Tenaga Mesin</th>
                    <td>{{ $motor->spesifikasi?->tenaga_mesin !== null ? $motor->spesifikasi->tenaga_mesin . ' PS' : '-' }}</td>
                </tr>
                <tr>
                    <th>Torsi</th>
                    <td>{{ $motor->spesifikasi?->torsi !== null ? $motor->spesifikasi->torsi . ' Nm' : '-' }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection