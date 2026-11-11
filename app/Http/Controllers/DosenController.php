<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class DosenController extends Controller
{
    public function index(): View
    {
        return view('dosen.index');
    }

    public function data(): JsonResponse
    {
        // Menyertakan jabatan_fungsional ke dalam kolom yang diambil dari database
        $query = Dosen::query()->select(['id', 'nidn', 'nama', 'jabatan_fungsional', 'email', 'telepon', 'alamat']);

        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->addColumn('aksi', function (Dosen $dosen) {
                return view('dosen._aksi', compact('dosen'))->render();
            })
            ->rawColumns(['aksi'])
            ->toJson();
    }

    public function create(): View
    {
        return view('dosen.create', ['dosen' => new Dosen()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $dosen = Dosen::create($this->validated($request));

        return redirect()
            ->route('dosen.index')
            ->with('success', 'Data dosen ' . $dosen->nama . ' berhasil ditambahkan.');
    }

    public function show(Dosen $dosen): View
    {
        return view('dosen.show', compact('dosen'));
    }

    public function edit(Dosen $dosen): View
    {
        return view('dosen.edit', compact('dosen'));
    }

    public function update(Request $request, Dosen $dosen): RedirectResponse
    {
        $dosen->update($this->validated($request, $dosen));

        return redirect()
            ->route('dosen.index')
            ->with('success', 'Data dosen ' . $dosen->nama . ' berhasil diperbarui.');
    }

    public function destroy(Dosen $dosen): JsonResponse
    {
        try {
            $dosen->delete();
        } catch (QueryException $e) {
            // misalnya masih dirujuk foreign key dari tabel lain
            return response()->json([
                'message' => 'Data dosen tidak dapat dihapus: masih dipakai data lain.',
            ], 409);
        }

        return response()->json([
            'message' => 'Data dosen ' . $dosen->nama . ' berhasil dihapus.',
        ]);
    }

    /** Aturan validasi bersama untuk store dan update. */
    private function validated(Request $request, ?Dosen $dosen = null): array
    {
        return $request->validate([
            'nidn' => [
                'required', 'string', 'max:20',
                Rule::unique(Dosen::class, 'nidn')->ignore($dosen?->id)
            ],
            'nama' => ['required', 'string', 'max:120'],
            'jabatan_fungsional' => [
                'nullable', 
                Rule::in(['Asisten Ahli', 'Lektor', 'Lektor Kepala', 'Guru Besar'])
            ],
            'email' => [
                'required', 'email', 'max:120',
                Rule::unique(Dosen::class, 'email')->ignore($dosen?->id)
            ],
            'telepon' => ['nullable', 'string', 'max:20'],
            'alamat' => ['nullable', 'string', 'max:500'],
        ], [
            'nidn.required' => 'NIDN wajib diisi.',
            'nidn.max' => 'NIDN maksimal 20 karakter.',
            'nidn.unique' => 'NIDN sudah dipakai dosen lain.',
            'nama.required' => 'Nama dosen wajib diisi.',
            'nama.max' => 'Nama dosen maksimal 120 karakter.',
            'jabatan_fungsional.in' => 'Pilihan jabatan fungsional tidak valid.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email maksimal 120 karakter.',
            'email.unique' => 'Email sudah dipakai dosen lain.',
            'telepon.max' => 'Nomor telepon maksimal 20 karakter.',
            'alamat.max' => 'Alamat maksimal 500 karakter.',
        ]);
    }
}