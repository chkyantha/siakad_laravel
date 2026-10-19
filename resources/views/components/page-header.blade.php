@props(['judul', 'deskripsi' => null])

<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
    <div>
        <h1 class="h3 mb-1">{{ $judul }}</h1>
        @if ($deskripsi)
            <p class="text-body-secondary mb-0">{{ $deskripsi }}</p>
        @endif
    </div>
    <div>{{ $slot }}</div>
</div>