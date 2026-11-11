@extends('layouts.app')

@section('title', 'Akses Ditolak (403)')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="card border-0 shadow-sm p-5">
                <div class="card-body">
                    <div class="mb-4 text-danger">
                        <i class="bi bi-shield-exclamation display-1"></i>
                    </div>
                    <h1 class="h2 fw-bold mb-2">403 - Akses Ditolak</h1>
                    <p class="text-body-secondary mb-4">
                        Maaf, Anda tidak memiliki hak akses yang diperlukan untuk membuka halaman Pengguna atau bagian administrasi ini. Halaman ini khusus untuk peran Administrator.
                    </p>
                    <a href="{{ route('dashboard') }}" class="btn btn-primary">
                        <i class="bi bi-speedometer2 me-1"></i> Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection