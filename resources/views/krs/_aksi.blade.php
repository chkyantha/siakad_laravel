<div class="btn-group btn-group-sm" role="group">
    <a href="{{ route('krs.show', $kr) }}" class="btn btn-outline-info"
        title="Detail">
        <i class="bi bi-eye"></i>
    </a>
    @if (Auth::user()->role === 'admin')
        <a href="{{ route('krs.edit', $kr) }}" class="btn btn-outline-warning"
            title="Ubah">
            <i class="bi bi-pencil-square"></i>
        </a>
        <button type="button" class="btn btn-outline-danger btn-hapus"
        data-url="{{ route('krs.destroy', $kr, false) }}" 
        data-id="{{ $kr->id }}" title="Hapus">
        <i class="bi bi-trash"></i>
    </button>
    @endif
</div>