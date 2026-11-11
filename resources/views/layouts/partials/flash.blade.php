@foreach ([
    'success' => 'success',
    'error'   => 'danger',
    'warning' => 'warning',
    'info'    => 'info',
] as $kunci => $kelas)
    @if (session($kunci))
    @if ($kunci === 'success' || $kunci === 'error')
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: '{{ $kunci === 'success' ? 'success' : 'error' }}',
                        title: @json(session($kunci)),
                        showConfirmButton: false,
                        timer: {{ $kunci === 'success' ? 3000 : 4000 }},
                        timerProgressBar: true
                    });
                });
            </script>
        @endif
        <div class="alert alert-{{ $kelas }} alert-dismissible fade show"
            role="alert">
            {{ session($kunci) }}
            <button type="button" class="btn-close"
                data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif
@endforeach


