<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class MahasiswaController extends Controller
{
    public function index(): View
    {
        return view('mahasiswa.index');
    }

    public function data(): JsonResponse
    {
        // Hanya kolom yang dibutuhkan tabel yang diambil dari database
        $query = Mahasiswa::query()->select(['id', 'nim', 'nama', 'jenis_kelamin', 'email', 'angkatan', 'program_studi']);

        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->addColumn('aksi', function (Mahasiswa $mahasiswa) {
                return view('mahasiswa._aksi', compact('mahasiswa'))->render();
            })
            ->rawColumns(['aksi'])
            ->toJson();
    }

    public function create(): View
    {
        return view('mahasiswa.create', ['mahasiswa' => new Mahasiswa()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $mahasiswa = Mahasiswa::create($this->validated($request));

        return redirect()
            ->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa ' . $mahasiswa->nama . ' berhasil ditambahkan.');
    }

    public function show(Mahasiswa $mahasiswa): View
    {
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    public function edit(Mahasiswa $mahasiswa): View
    {
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa): RedirectResponse
    {
        $mahasiswa->update($this->validated($request, $mahasiswa));

        return redirect()
            ->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa ' . $mahasiswa->nama . ' berhasil diperbarui.');
    }

    public function destroy(Mahasiswa $mahasiswa): JsonResponse
    {
        try {
            $mahasiswa->delete();
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Data mahasiswa tidak dapat dihapus: masih dipakai data lain.',
            ], 409);
        }

        return response()->json([
            'message' => 'Data mahasiswa ' . $mahasiswa->nama . ' berhasil dihapus.',
        ]);
    }

    /** Aturan validasi bersama untuk store dan update. */
    private function validated(Request $request, ?Mahasiswa $mahasiswa = null): array
    {
        return $request->validate([
            'nim' => [
                'required', 'string', 'max:15',
                Rule::unique(Mahasiswa::class, 'nim')->ignore($mahasiswa?->id)
            ],
            'nama' => ['required', 'string', 'max:100'],
            'jenis_kelamin' => ['required', Rule::in(['L', 'P'])],
            'email' => [
                'required', 'email', 'max:100',
                Rule::unique(Mahasiswa::class, 'email')->ignore($mahasiswa?->id)
            ],
            'angkatan' => ['required', 'integer', 'min:2000', 'max:2100'],
            'program_studi' => ['required', 'string', 'max:100'],
        ], [
            'nim.required' => 'NIM wajib diisi.',
            'nim.max' => 'NIM maksimal 15 karakter.',
            'nim.unique' => 'NIM sudah dipakai mahasiswa lain.',
            'nama.required' => 'Nama mahasiswa wajib diisi.',
            'nama.max' => 'Nama mahasiswa maksimal 100 karakter.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in' => 'Pilihan jenis kelamin tidak valid.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email maksimal 100 karakter.',
            'email.unique' => 'Email sudah dipakai mahasiswa lain.',
            'angkatan.required' => 'Angkatan wajib diisi.',
            'program_studi.required' => 'Program studi wajib diisi.',
        ]);
    }
}