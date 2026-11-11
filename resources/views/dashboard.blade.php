@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <x-page-header judul="Dashboard"
        deskripsi="Ringkasan data akademik (data sementara)." />

    <div class="row g-3 mb-4">
        @foreach ($statistik as $item)
            <div class="col-12 col-sm-6 col-md-4 col-xl">
                <x-stat-card :judul="$item['judul']" :jumlah="$item['jumlah']"
                    :ikon="$item['ikon']" :warna="$item['warna']" />
            </div>
        @endforeach
    </div>

    <div class="row g-3">
        <div class="col-12 col-xl-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-body fw-semibold">KRS Terbaru</div>
                <div class="card-body p-0">
                    <x-tabel :kolom="$kolomKrs" :baris="$krsTerbaru" />
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-body fw-semibold">Status KRS</div>
                <div class="card-body">
                    @foreach ($statusKrs as $s)
                        <div class="mb-3">
                            <div class="d-flex justify-content-between small mb-1">
                                <span>{{ $s['label'] }}</span>
                                <span>{{ $s['persen'] }}%</span>
                            </div>
                            <div class="progress" role="progressbar"
                                aria-valuenow="{{ $s['persen'] }}"
                                aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar bg-{{ $s['warna'] }}"
                                    style="width: {{ $s['persen'] }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @push('scripts')
                <script>
                    document.getElementById('themeToggle').addEventListener('click', function () {
                        const html = document.documentElement;
                        const currentTheme = html.getAttribute('data-bs-theme');
                        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                        html.setAttribute('data-bs-theme', newTheme);
                        this.innerHTML = newTheme === 'dark' 
                            ? '<i class="bi bi-sun-fill"></i> Mode Light' 
                            : '<i class="bi bi-moon-stars-fill"></i> Mode Dark';
                    });
                </script>
                @endpush
            </div>
        </div>
    </div>
@endsection