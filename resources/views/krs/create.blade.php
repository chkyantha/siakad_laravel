@extends('layouts.app')

@section('title', 'Tambah KRS')

@section('content')
    <x-page-header judul="Tambah KRS"
        deskripsi="Isi data KRS baru." />

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body fw-semibold">Form Tambah KRS</div>
        <div class="card-body">
            <form method="POST" action="{{ route('krs.store') }}" novalidate>
                @csrf
                @include('krs._form')

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Simpan
                </button>
                <a href="{{ route('krs.index') }}"
                    class="btn btn-outline-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection