<div class="mb-3">
    <x-form-input label="Kode MK" name="kode_mk" :value="$matakuliah->kode_mk"
        maxlength="10" required autofocus />
</div>
<div class="mb-3">
    <x-form-input label="Nama Mata Kuliah" name="nama_mk" :value="$matakuliah->nama_mk"
        maxlength="100" required />
</div>
<div class="mb-3">
    <x-form-input label="SKS" name="sks" type="number" :value="$matakuliah->sks"
        min="1" max="6" required />
</div>