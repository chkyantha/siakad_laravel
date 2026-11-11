@extends('layouts.app')

@section('title', 'Tambah Dosen')

@section('content')
    <x-page-header judul="Tambah Dosen"
        deskripsi="Isi data dosen baru. NIDN dan email harus unik." />

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body fw-semibold">Form Tambah Dosen</div>
        <div class="card-body">
            <form method="POST" action="{{ route('dosen.store') }}" novalidate>
                @csrf
                @include('dosen._form')

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Simpan
                </button>
                <a href="{{ route('dosen.index') }}"
                    class="btn btn-outline-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection