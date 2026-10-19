/* Sidebar menempel di bawah navbar pada layar lebar */
@media (min-width: 992px) {
    .sidebar-col {
        position: sticky;
        top: 56px;
        align-self: flex-start;
        height: calc(100vh - 56px);
        overflow-y: auto;
    }
}

/* Kartu statistik sedikit terangkat saat disorot */
.stat-card {
    transition: transform .15s ease, box-shadow .15s ease;
}
.stat-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--bs-box-shadow) !important;
}