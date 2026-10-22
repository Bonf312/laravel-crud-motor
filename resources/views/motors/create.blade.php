@extends('layouts.app')

@section('title', 'Tambah Motor')

@section('content')
<div class="card shadow-sm">
    <div class="card-header">
        <h4 class="mb-0">Tambah Motor</h4>
    </div>

    <div class="card-body">
        <form action="{{ route('motors.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf

            @include('motors._form')

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('motors.index') }}" class="btn btn-secondary">
                Kembali
            </a>
        </form>
    </div>
</div>
@endsection