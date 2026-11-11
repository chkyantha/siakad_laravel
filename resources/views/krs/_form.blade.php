<div class="mb-3">
    <x-form-input label="ID Mahasiswa" name="mahasiswa_id" type="number" :value="$kr->mahasiswa_id"
    required autofocus />
</div>
<div class="mb-3">
    <x-form-input label="Tahun Akademik" name="tahun_akademik" :value="$kr->tahun_akademik"
     maxlength="9" placeholder="2025/2026" required />
</div>

<div class="mb-3">
    <label for="semester" class="form-label">Semester</label>
    <select name="semester" id="semester" class="form-select @error('semester') is-invalid @enderror" required>
        <option value="">Pilih Semester</option>
        <option value="Ganjil" {{ old('semester', $kr->semester) === 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
        <option value="Genap" {{ old('semester', $kr->semester) === 'Genap' ? 'selected' : '' }}>Genap</option>
    </select>
    @error('semester')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="status" class="form-label">Status</label>
    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
        <option value="draft" {{ old('status', $kr->status) === 'draft' ? 'selected' : '' }}>Draft</option>
        <option value="diajukan" {{ old('status', $kr->status) === 'diajukan' ? 'selected' : '' }}>Diajukan</option>
        <option value="disetujui" {{ old('status', $kr->status) === 'disetujui' ? 'selected' : '' }}>Disetujui</option>
        <option value="ditolak" {{ old('status', $kr->status) === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
    </select>
    @error('status')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>