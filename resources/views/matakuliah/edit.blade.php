@extends('layouts.app')

@section('title', 'Ubah Mata Kuliah')

@section('content')
    <x-page-header judul="Ubah Mata Kuliah" 
        deskripsi="Perbarui data mata kuliah." />
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body fw-semibold">Form Ubah Mata Kuliah</div>
        <div class="card-body">
            <form method="POST" action="{{ route('matakuliah.update', $matakuliah) }}" novalidate>
                @csrf
                @method('PUT')
                @include('matakuliah._form')

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Perbarui
                </button>
                <a href="{{ route('matakuliah.index') }}" 
                    class="btn btn-outline-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection