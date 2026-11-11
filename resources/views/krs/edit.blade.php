@extends('layouts.app')

@section('title', 'Ubah KRS')

@section('content')
    <x-page-header judul="Ubah KRS"
        deskripsi="Perbarui data KRS." />

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body fw-semibold">Form Ubah KRS</div>
        <div class="card-body">
            <form method="POST" action="{{ route('krs.update', $kr) }}" novalidate>
                @csrf
                @method('PUT')
                @include('krs._form')

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Perbarui
                </button>
                <a href="{{ route('krs.index') }}" 
                    class="btn btn-outline-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection