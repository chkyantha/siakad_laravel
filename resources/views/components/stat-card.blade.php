@props(['judul', 'jumlah', 'ikon' => 'bi-bar-chart', 'warna' => 'primary'])

<div class="card stat-card border-0 shadow-sm h-100">
    <div class="card-body d-flex align-items-center">
        <div class="rounded-3 bg-{{ $warna }}-subtle text-{{ $warna }}-emphasis p-3 me-3 fs-3 lh-1">
            <i class="bi {{ $ikon }}"></i>
        </div>
        <div>
            <div class="text-body-secondary small">{{ $judul }}</div>
            <div class="fs-3 fw-semibold">
                {{ number_format($jumlah, 0, ',', '.') }}
            </div>
        </div>
    </div>
</div>