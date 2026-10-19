<form action="#" method="post">
    @csrf
    <div class="row g-3">
        <div class="col-md-4">
            <x-form-input label="NIM" name="nim" />
        </div>
        <div class="col-md-8">
            <x-form-input label="Nama Lengkap" name="nama" />
        </div>
        <div class="col-md-6">
            <x-form-input label="Email" name="email" type="email" />
        </div>
        <div class="col-md-3">
            <x-form-input label="Angkatan" name="angkatan" type="number" />
        </div>
        <div class="col-md-3">
            <label for="status" class="form-label">Status</label>
            <select id="status" name="status" class="form-select">
                <option>Aktif</option>
                <option>Cuti</option>
                <option>Lulus</option>
            </select>
        </div>
        <div class="col-12">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea id="alamat" name="alamat" rows="2"
                class="form-control"></textarea>
        </div>
    </div>

    <div class="mt-3 d-flex gap-2">
        <button type="button" class="btn btn-primary">Simpan</button>
        <button type="reset" class="btn btn-outline-secondary">Reset</button>
    </div>
</form>