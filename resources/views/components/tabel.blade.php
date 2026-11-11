@props(['kolom' => [], 'baris' => []])

<div class="table-responsive">
    <table class="table table-striped table-hover align-middle mb-0">
        <thead class="table-light">
            <tr>
                <th scope="col" style="width: 50px">#</th>
                @foreach ($kolom as $judul)
                    <th scope="col">{{ $judul }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @forelse ($baris as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    @foreach ($kolom as $kunci => $judul)
                        <td>
                            @if ($kunci === 'nim')
                                {{-- Menautkan NIM ke route mahasiswa.show --}}
                                <a href="{{ route('mahasiswa.show', $item['nim']) }}" class="text-decoration-none fw-semibold">
                                    {{ $item[$kunci] }}
                                </a>
                            @elseif ($kunci === 'status')
                                @php
                                    $warna = match ($item[$kunci]) {
                                        'Aktif', 'Disetujui' => 'success',
                                        'Menunggu', 'Cuti' => 'warning',
                                        'Ditolak' => 'danger',
                                        default => 'secondary',
                                    };
                                @endphp
                                <span class="badge text-bg-{{ $warna }}">
                                    {{ $item[$kunci] }}
                                </span>
                            @else
                                {{ $item[$kunci] }}
                            @endif
                        </td>
                    @endforeach
                </tr>
            @empty
                <tr>
                    <td colspan="{{ count($kolom) + 1 }}" class="text-center text-body-secondary py-4">
                        Belum ada data.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>