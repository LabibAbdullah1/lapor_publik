<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reports = Report::all();
        return view('dashboard', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('reports.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'category' => 'required|string|max:100',
                'priority' => 'required|in:low,medium,high',
                'latitude' => 'nullable|numeric',
                'longitude' => 'nullable|numeric',
                'address' => 'nullable|string|max:255',
                'is_anonymous' => 'sometimes|boolean',
            ],
            [   //buatkan pesan eror dalam bahsa indonesia
                'title.required' => 'Judul laporan harus diisi.',
                'description.required' => 'Silakan berikan deskripsi untuk laporan.',
                'category.required' => 'Kolom kategori tidak boleh kosong.',
                'priority.in' => 'Prioritas harus salah satu dari: rendah, sedang, tinggi.',
            ]
        );

        if (!isset($validatedData['is_anonymous'])) {
            $validatedData['is_anonymous'] = false;
        }
        if (!$request->latitude && !$request->address) {
            return back()->withErrors(['address' => 'Mohon sertakan alamat atau koordinat lokasi.'])->withInput();
        }

        $validatedData['user_id'] = $request->user()->id;
        $validatedData['status'] = 'submitted';

        Report::create($validatedData);

        return redirect()->route('reports.index')->with('success', 'Laporan berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {
        return view('reports.show', compact('report'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        return view('reports.edit', compact('report'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Report $report)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki izin untuk mengubah status laporan ini.');
        }


        $validatedData = $request->validate(
            [
                'status' => 'required|in:submitted,in_progress,resolved,rejected',
            ],
            [
                'status.in' => 'Status harus salah satu dari: submitted, in_progress, resolved, rejected.',
            ]
        );

        $report->update([
            'status' => $validatedData['status'],
        ]);

        return redirect()->route('reports.show', $report)->with('success', 'Status laporan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        $report->delete();
        return redirect()->route('reports.index')->with('success', 'Laporan berhasil dihapus.');
    }
}
