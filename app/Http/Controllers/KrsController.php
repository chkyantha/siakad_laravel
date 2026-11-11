<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use App\Models\Krs;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class KrsController extends Controller
{
    public function index(): View
    {
        return view('krs.index');
    }

    public function data(): JsonResponse
    {
        // Menyertakan jabatan_fungsional ke dalam kolom yang diambil dari database
        $query = Krs::query()->select(['id', 'mahasiswa_id', 'tahun_akademik', 'semester', 'status']);

        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->addColumn('aksi', function (Krs $kr) {
                return view('krs._aksi', compact('kr'))->render();
            })
            ->rawColumns(['aksi'])
            ->toJson();
    }

    public function create(): View
    {
        return view('krs.create', ['kr' => new Krs()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $kr = Krs::create($this->validated($request));

        return redirect()
            ->route('krs.index')
            ->with('success', 'Data KRS berhasil ditambahkan.');
    }

    public function show(Krs $kr): View
    {
        return view('krs.show', compact('kr'));
    }

    public function edit(Krs $kr): View
    {
        return view('krs.edit', compact('kr'));
    }

    public function update(Request $request, Krs $kr): RedirectResponse
    {
        $kr->update($this->validated($request, $kr));

        return redirect()
            ->route('krs.index')
            ->with('success', 'Data KRS berhasil diperbarui.');
    }

    public function destroy(Krs $kr): JsonResponse
    {
        try {
            $kr->delete();

        } catch (QueryException $e) {
            // misalnya masih dirujuk foreign key dari tabel lain
            return response()->json([
                'message' => 'Data KRS tidak dapat dihapus: masih dipakai data lain.',
            ], 409);
        }

        return response()->json([
            'message' => 'Data KRS berhasil dihapus.',
        ]);
    }

    /** Aturan validasi bersama untuk store dan update. */
    private function validated(Request $request, ?Krs $kr = null): array
    {
        // TAMBAHAN: Mengambil ID KRS saat ini jika sedang proses edit (agar tidak mendeteksi data miliknya sendiri sebagai duplikat)
        $krsId = $kr ? $kr->id : null;

        return $request->validate([
            'mahasiswa_id' => [
                'required', 
                'integer',
                // TAMBAHAN: Validasi unique gabungan untuk mencegah mahasiswa mengambil KRS ganda di tahun & semester yang sama
                Rule::unique('krs')->where(function ($query) use ($request) {
                    return $query->where('tahun_akademik', $request->tahun_akademik)
                                 ->where('semester', $request->semester);
                })->ignore($krsId),
            ],
            'tahun_akademik' => ['required', 'string', 'max:9'],
            'semester' => ['required', Rule::in(['Ganjil', 'Genap'])],
            'status' => ['required', Rule::in(['draft', 'diajukan', 'disetujui', 'ditolak'])],
        ], [
            'mahasiswa_id.required' => 'Mahasiswa wajib diisi.',
            'mahasiswa_id.unique' => 'Mahasiswa ini sudah memiliki KRS pada tahun akademik dan semester yang sama.',
            'tahun_akademik.required' => 'Tahun akademik wajib diisi.',
            'semester.required' => 'Semester wajib diisi.',
            'status.required' => 'Status wajib diisi.',
        ]);
    }
}