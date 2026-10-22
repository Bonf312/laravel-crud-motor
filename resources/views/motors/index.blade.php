
@extends('layouts.app')

@section('title', 'Katalog Motor')

@section('content')
<div class="container py-4">

    {{-- Header --}}
    <div class="d-flex flex-wrap justify-content-between
        align-items-center gap-3 mb-4">
        <div>
            <h2 class="fw-bold mb-1">LARAVEL CRUD MOTOR</h2>
            <p class="text-secondary mb-0">
                Kelola dan temukan motor dengan mudah.
            </p>
        </div>

        <a href="{{ route('motors.create') }}"
            class="btn btn-primary">
            <i class="bi bi-plus-lg"></i>
            Tambah Motor
        </a>
    </div>

    {{-- Pesan sukses --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close"
                data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Pencarian --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('motors.index') }}"
                method="GET">
                <div class="row g-2">
                    <div class="col-md-10">
                        <input type="search"
                            name="search"
                            class="form-control form-control-lg"
                            placeholder="Cari nama, merek, tipe, atau tahun motor..."
                            value="{{ $search ?? '' }}">
                    </div>

                    <div class="col-md-2 d-grid">
                        <button type="submit"
                            class="btn btn-primary btn-lg">
                            <i class="bi bi-search"></i>
                            Cari
                        </button>
                    </div>
                </div>

                @if (!empty($search))
                    <div class="mt-2">
                        <span class="text-secondary small">
                            Kata pencarian: "{{ $search }}"
                        </span>
                        <a href="{{ route('motors.index') }}"
                            class="small ms-2 text-decoration-none">
                            Hapus pencarian
                        </a>
                    </div>
                @endif
            </form>
        </div>
    </div>

    {{-- Jumlah hasil --}}
    <div class="d-flex justify-content-between
        align-items-center mb-3">
        <h5 class="fw-semibold mb-0">Daftar Motor</h5>
        <span class="badge text-bg-light border">
            {{ $motors->total() }} motor
        </span>
    </div>

    {{-- Kartu motor --}}
    <div class="row g-4">
        @forelse ($motors as $motor)
            <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                <div class="card h-100 border-0 shadow-sm
                    motor-card">

                    @if ($motor->gambar)
                        <img
                            src="{{ asset('storage/' . $motor->gambar) }}"
                            class="card-img-top motor-image"
                            alt="{{ $motor->nama }}">
                    @else
                        <div class="motor-image-placeholder
                            d-flex align-items-center justify-content-center">
                            <i class="bi bi-bicycle display-3
                                text-secondary"></i>
                        </div>
                    @endif

                    <div class="card-body d-flex flex-column">
                        <span class="badge text-bg-light border
                            align-self-start mb-2">
                            {{ $motor->tipe }}
                        </span>

                        <h5 class="card-title fw-bold">
                            {{ $motor->nama }}
                        </h5>

                        <p class="text-secondary mb-2">
                            {{ $motor->merek }}
                            · Tahun {{ $motor->tahun }}
                        </p>

                        <h5 class="text-primary fw-bold mb-2">
                            Rp {{ number_format(
                                $motor->harga, 0, ',', '.'
                            ) }}
                        </h5>

                        <p class="small text-secondary mb-3">
                            Stok: {{ $motor->stok }}
                        </p>

                        <div class="mt-auto d-flex flex-wrap gap-2">
                            <a href="{{ route('motors.show', $motor->id) }}"
                                class="btn btn-outline-primary btn-sm flex-fill">
                                Detail
                            </a>

                            <a href="{{ route('motors.edit', $motor->id) }}"
                                class="btn btn-outline-warning btn-sm flex-fill">
                                Edit
                            </a>

                            <form
                                action="{{ route('motors.destroy', $motor->id) }}"
                                method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Yakin ingin menghapus motor ini?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="btn btn-outline-danger btn-sm flex-fill">
                                    <i class="bi bi-trash"></i>Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center py-5">
                        <i class="bi bi-search display-4
                            text-secondary"></i>

                        <h5 class="mt-3">Motor tidak ditemukan</h5>

                        <p class="text-secondary">
                            Coba gunakan nama, merek, tipe,
                            atau tahun yang berbeda.
                        </p>

                        <a href="{{ route('motors.index') }}"
                            class="btn btn-outline-primary">
                            Tampilkan Semua Motor
                        </a>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if ($motors->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $motors->links() }}
        </div>
    @endif

</div>
@endsection
