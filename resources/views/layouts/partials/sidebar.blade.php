<div class="sidebar-col col-lg-3 col-xl-2 p-0 border-end bg-body">
    <div class="offcanvas-lg offcanvas-start" tabindex="-1" id="sidebarMenu"
         aria-labelledby="sidebarMenuLabel">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="sidebarMenuLabel">Menu SIAKAD</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                    data-bs-target="#sidebarMenu" aria-label="Tutup"></button>
        </div>

        <div class="offcanvas-body d-flex flex-column p-3">
            <small class="text-uppercase text-body-secondary fw-semibold mb-2">
                Utama
            </small>
            <ul class="nav nav-pills flex-column gap-1 mb-4">
                <x-sidebar-link route="dashboard" ikon="bi-speedometer2">
                    Dashboard
                </x-sidebar-link>
            </ul>

            <small class="text-uppercase text-body-secondary fw-semibold mb-2">
                Data Akademik
            </small>
            <ul class="nav nav-pills flex-column gap-1">
                <x-sidebar-link route="mahasiswa.index" pola="mahasiswa.*"
                                ikon="bi-people-fill">
                    Mahasiswa
                </x-sidebar-link>
                <x-sidebar-link route="dosen.index" pola="dosen.*"
                                ikon="bi-person-badge-fill">
                    Dosen
                </x-sidebar-link>
                <x-sidebar-link route="matakuliah.index" pola="matakuliah.*"
                                ikon="bi-book-fill">
                    Mata Kuliah
                </x-sidebar-link>
                <x-sidebar-link route="krs.index" pola="krs.*"
                                ikon="bi-journal-check">
                    KRS
                </x-sidebar-link>
            </ul>
        </div>
    </div>
</div>