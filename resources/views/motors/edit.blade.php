@extends('layouts.app')

@section('title', 'Edit Motor')

@section('content')
<div class="card shadow-sm">
    <div class="card-header">
        <h4 class="mb-0">Edit Motor</h4>
    </div>

    <div class="card-body">
        <form action="{{ route('motors.update', $motor) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @include('motors._form')

            <button type="submit" class="btn btn-primary">
                Simpan Perubahan
            </button>

            <a href="{{ route('motors.show', $motor) }}"
                class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection