<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use App\Models\MataKuliah;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class MataKuliahController extends Controller
{
    public function index(): View
    {
        return view('matakuliah.index');
    }

    public function data(): JsonResponse
    {
        // Menyertakan jabatan_fungsional ke dalam kolom yang diambil dari database
        $query = MataKuliah::query()->select(['id', 'kode_mk', 'nama_mk', 'sks']);

        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->addColumn('aksi', function (MataKuliah $matakuliah) {
                return view('matakuliah._aksi', compact('matakuliah'))->render();
            })
            ->rawColumns(['aksi'])
            ->toJson();
    }

    public function create(): View
    {
        return view('matakuliah.create', ['matakuliah' => new MataKuliah()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $matakuliah = MataKuliah::create($this->validated($request));

        return redirect()
            ->route('matakuliah.index')
            ->with('success', 'Data mata kuliah ' . $matakuliah->nama_mk . ' berhasil ditambahkan.');
    }

    public function show(MataKuliah $matakuliah): View
    {
        return view('matakuliah.show', compact('matakuliah'));
    }

    public function edit(MataKuliah $matakuliah): View
    {
        return view('matakuliah.edit', compact('matakuliah'));
    }

    public function update(Request $request, MataKuliah$matakuliah): RedirectResponse
    {
        $matakuliah->update($this->validated($request,$matakuliah));

        return redirect()
            ->route('matakuliah.index')
            ->with('success', 'Data mata kuliah ' . $matakuliah->nama_mk . ' berhasil diperbarui.');
    }

    public function destroy(MataKuliah $matakuliah): JsonResponse
    {
        try {
            $matakuliah->delete();
        } catch (QueryException $e) {
            // misalnya masih dirujuk foreign key dari tabel lain
            return response()->json([
                'message' => 'Data mata kuliah tidak dapat dihapus: masih dipakai data lain.',
            ], 409);
        }

        return response()->json([
            'message' => 'Data mata kuliah ' . $matakuliah->nama_mk . ' berhasil dihapus.',
        ]);
    }

    /** Aturan validasi bersama untuk store dan update. */
    private function validated(Request $request, ?MataKuliah $matakuliah = null): array
    {
        return $request->validate([
            'kode_mk' => [
                'required', 'string', 'max:10',
                Rule::unique(MataKuliah::class, 'kode_mk')->ignore($matakuliah?->id)
            ],
            'nama_mk' => ['required', 'string', 'max:100'],
            'sks' => ['required', 'integer', 'min:1', 'max:6'],
        ], [
            'kode_mk.required' => 'Kode MK wajib diisi.',
            'kode_mk.max' => 'Kode MK maksimal 10 karakter.',
            'kode_mk.unique' => 'Kode MK sudah dipakai mata kuliah lain.',
            'nama_mk.required' => 'Nama mata kuliah wajib diisi.',
            'nama_mk.max' => 'Nama mata kuliah maksimal 100 karakter.',
            'sks.required' => 'SKS wajib diisi.',
            'sks.integer' => 'SKS harus berupa angka.',
        ]);
    }
}