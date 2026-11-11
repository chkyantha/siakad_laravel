@extends('layouts.app')

@section('title', 'Ubah Dosen')

@section('content')
    <x-page-header judul="Ubah Dosen"
        deskripsi="Perbarui data dosen. NIDN dan email harus tetap unik." />

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body fw-semibold">Form Ubah Dosen</div>
        <div class="card-body">
            <form method="POST" action="{{ route('dosen.update', $dosen) }}" novalidate>
                @csrf
                @method('PUT')
                @include('dosen._form')

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Perbarui
                </button>
                <a href="{{ route('dosen.index') }}"
                    class="btn btn-outline-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection