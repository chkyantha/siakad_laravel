@extends('layouts.app')

@section('title', 'Detail Mata Kuliah')

@section('content')
<x-page-header judul="Detail Mata Kuliah" deskripsi="Informasi lengkap satu mata kuliah." />

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body fw-semibold">{{ $matakuliah->nama_mk }}</div>
        <div class="card-body">
            <dl class="row mb-3">
                <dt class="col-sm-3">Kode MK</dt>
                <dd class="col-sm-9">{{ $matakuliah->kode_mk }}</dd>

                <dt class="col-sm-3">Nama Mata Kuliah</dt>
                <dd class="col-sm-9">{{ $matakuliah->nama_mk }}</dd>

                <dt class="col-sm-3">SKS</dt>
                <dd class="col-sm-9">{{ $matakuliah->sks }}</dd>
            </dl>

            <a href="{{ route('matakuliah.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            @if (Auth::user()->role === 'admin')
                <a href="{{ route('matakuliah.edit', $matakuliah) }}" class="btn btn-warning">
                    <i class="bi bi-pencil-square"></i> Ubah
                </a>
            @endif
        </div>
    </div>
@endsection