<?php

namespace App\Http\Controllers;

use App\Mail\PengaduanMail;
use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;  // ← import


class PengaduanController extends Controller
{
    public function store(Request $request)
    {
        try {
            \Log::info('Pengaduan request received:', $request->all());

            // Validasi data
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'number' => 'required|numeric',
                'content' => 'required|string',
                'bukti_pengaduan' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120',
            ]);

            \Log::info('Validation passed');

            // Handle file upload
            $filePath = null;
            if ($request->hasFile('bukti_pengaduan')) {
                $file = $request->file('bukti_pengaduan');
                $filename = time() . '_' . $file->getClientOriginalName();
                $destinationPath = public_path('uploads/pengaduan_files');

                // Pastikan foldernya ada
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                $file->move($destinationPath, $filename);
                $filePath = 'uploads/pengaduan_files/' . $filename;
            }


            // Simpan ke database
            $pengaduan = Pengaduan::create([
                'name' => $validated['name'],
                'number' => $validated['number'],
                'content' => $validated['content'],
                'bukti_pengaduan' => $filePath,
            ]);

            // $toEmail = 'galowtunasbangsa@gmail.com';
            // Mail::to($toEmail)->send(new PengaduanMail($pengaduan));

            \Log::info('Pengaduan saved successfully:', ['id' => $pengaduan->id]);

            return redirect()->back()->with('success', 'Pengaduan berhasil dikirim.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation failed:', $e->errors());
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();

        } catch (\Exception $e) {
            \Log::error('Error saving pengaduan:', ['error' => $e->getMessage()]);
            return redirect()->back()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])
                ->withInput();
        }
    }
}
