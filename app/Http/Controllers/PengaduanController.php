<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    public function store(Request $request)
    {
        try {
            // dd($request->all());
            // Validasi data
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'number' => 'required|numeric',
                'content' => 'required|string',
                'bukti_pengaduan' => 'required|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120',
            ]);
            // dd("masuk");
            // Handle file upload
            if($request->hasFile('bukti_pengaduan')) {
                $filePath = $request->file('bukti_pengaduan')->store('pengaduan_files', 'public');
            } else {
                throw new \Exception('File bukti pengaduan wajib diupload');
            }

            // Simpan ke database
            Pengaduan::create([
                'name' => $validated['name'],
                'number' => $validated['number'],
                'content' => $validated['content'],
                'bukti_pengaduan' => $filePath,
            ]);

            return redirect()->back()->with('success', 'Pengaduan berhasil dikirim.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();

        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])
                ->withInput();
        }
    }
}
