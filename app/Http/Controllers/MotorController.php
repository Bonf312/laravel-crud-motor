<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class MotorController extends Controller
{
   
public function index(Request $request)
{
    $search = $request->input('search');

    $motors = Motor::query()
        ->when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('merek', 'like', "%{$search}%")
                  ->orWhere('tipe', 'like', "%{$search}%")
                  ->orWhere('tahun', 'like', "%{$search}%");
            });
        })
        ->latest()
        ->paginate(8)
        ->withQueryString();

    return view('motors.index', compact('motors', 'search'));
}



public function create()
{
    $motor = new Motor();

    return view('motors.create', compact('motor'));
}

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'merek' => 'required|string|max:100',
            'tipe' => 'required|string|max:100',
            'tahun' => 'required|integer|min:1900|max:2100',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'spesifikasi.kapasitas_cc' => 'nullable|integer|min:0',
            'spesifikasi.transmisi' => 'nullable|string|max:50',
            'spesifikasi.bahan_bakar' => 'nullable|string|max:50',
            'spesifikasi.berat_motor' => 'nullable|numeric|min:0',
            'spesifikasi.kapasitas_tangki' => 'nullable|numeric|min:0',
            'spesifikasi.rem_abs' => 'nullable|boolean',
            'spesifikasi.sistem_pendingin' => 'nullable|string|max:100',
            'spesifikasi.tenaga_mesin' => 'nullable|numeric|min:0',
            'spesifikasi.torsi' => 'nullable|numeric|min:0',
        ]);

        $dataSpesifikasi = $validated['spesifikasi'] ?? [];
        unset($validated['spesifikasi']);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')
                ->store('motors', 'public');
        }

   $modelBaru = new Motor();
$modelBaru->fill($validated);

DB::listen(function ($query) {
    logger()->debug('SQL MOTOR', [
        'sql' => $query->sql,
        'bindings' => $query->bindings,
    ]);
});

$motor = Motor::create($validated);
        

        // Simpan spesifikasi dengan motor_id milik motor ini.
        $motor->spesifikasi()->create($dataSpesifikasi);

        return redirect()
            ->route('motors.index')
            ->with('success', 'Data motor berhasil ditambahkan.');
    }

    public function show(Motor $motor): View
    {
        $motor->load('spesifikasi');

        return view('motors.show', compact('motor'));
    }

    public function edit(Motor $motor): View
    {
        $motor->load('spesifikasi');

        return view('motors.edit', compact('motor'));
    }

    public function update(
        Request $request,
        Motor $motor
    ): RedirectResponse {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'merek' => 'required|string|max:100',
            'tipe' => 'required|string|max:100',
            'tahun' => 'required|integer|min:1900|max:2100',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'spesifikasi.kapasitas_cc' => 'nullable|integer|min:0',
            'spesifikasi.transmisi' => 'nullable|string|max:50',
            'spesifikasi.bahan_bakar' => 'nullable|string|max:50',
            'spesifikasi.berat_motor' => 'nullable|numeric|min:0',
            'spesifikasi.kapasitas_tangki' => 'nullable|numeric|min:0',
            'spesifikasi.rem_abs' => 'nullable|boolean',
            'spesifikasi.sistem_pendingin' => 'nullable|string|max:100',
            'spesifikasi.tenaga_mesin' => 'nullable|numeric|min:0',
            'spesifikasi.torsi' => 'nullable|numeric|min:0',
        ]);

        $dataSpesifikasi = $validated['spesifikasi'] ?? [];
        unset($validated['spesifikasi']);

        // Pertahankan foto lama jika tidak ada foto baru.
        unset($validated['gambar']);

        if ($request->hasFile('gambar')) {
            $gambarLama = $motor->gambar;

            $gambarBaru = $request->file('gambar')
                ->store('motors', 'public');

            $validated['gambar'] = $gambarBaru;

            if ($gambarLama) {
                Storage::disk('public')->delete($gambarLama);
            }
        }

        $motor->update($validated);

        // Perbarui spesifikasi, atau buat jika belum tersedia.
        $motor->spesifikasi()->updateOrCreate(
            ['motor_id' => $motor->id],
            $dataSpesifikasi
        );

        return redirect()
            ->route('motors.show', $motor)
            ->with('success', 'Data motor berhasil diperbarui.');
    }

    public function destroy(Motor $motor): RedirectResponse
    {
        if ($motor->gambar) {
            Storage::disk('public')->delete($motor->gambar);
        }

        // Spesifikasi ikut terhapus melalui cascadeOnDelete().
        $motor->delete();

        return redirect()
            ->route('motors.index')
            ->with('success', 'Data motor berhasil dihapus.');
    }
}