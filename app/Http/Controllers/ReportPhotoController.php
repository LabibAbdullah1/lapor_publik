<?php

namespace App\Http\Controllers;

use App\Models\ReportPhoto;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ReportPhotoController extends Controller
{
    /**
     * Simpan foto laporan ke database & storage.
     */
    public function store(Request $request, $reportId)
    {
        $request->validate([
            'photo' => 'required|image|max:5120', // Maks 5MB
        ]);

        $report = Report::findOrFail($reportId);

        $path = $request->file('photo')->store('report_photos', 'public');

        ReportPhoto::create([
            'report_id' => $report->id,
            'file_path' => $path,
            'uploaded_by' => Auth::id(),
        ]);

        return back()->with('success', 'Foto laporan berhasil diunggah.');
    }

    /**
     * Hapus foto laporan.
     */
    public function destroy($id)
    {
        $photo = ReportPhoto::findOrFail($id);

        // Hanya admin atau pemilik laporan yang boleh hapus
        if (Auth::user()->role !== 'admin' && Auth::id() !== $photo->uploaded_by) {
            abort(403, 'Anda tidak memiliki izin untuk menghapus foto ini.');
        }

        // Hapus file dari storage
        if (Storage::disk('public')->exists($photo->file_path)) {
            Storage::disk('public')->delete($photo->file_path);
        }

        $photo->delete();

        return back()->with('success', 'Foto berhasil dihapus.');
    }
}
