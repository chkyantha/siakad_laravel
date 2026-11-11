@extends('layouts.app')

@section('title', 'Ubah Mahasiswa')

@section('content')
    <x-page-header judul="Ubah Mahasiswa"
        deskripsi="Perbarui data mahasiswa. NIM dan email harus tetap unik." />

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body fw-semibold">Form Ubah Mahasiswa</div>
        <div class="card-body">
            <form method="POST" action="{{ route('mahasiswa.update', $mahasiswa) }}" novalidate>
                @csrf
                @method('PUT')
                @include('mahasiswa._form')

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Perbarui
                </button>
                <a href="{{ route('mahasiswa.index') }}" 
                    class="btn btn-outline-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection