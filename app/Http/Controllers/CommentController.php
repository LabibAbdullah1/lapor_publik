<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $reportId)
    {
        $validatedData = $request->validate(
            [
                'content' => 'required|string|max:255',
            ]
        );
        $report = Report::findOrFail($reportId);

        Comment::create([
            'report_id' => $report->id,
            'user_id' => $request->user()->id,
            'message' => $validatedData['message'],
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment, $id)
    {
        $comment = Comment::findOrFail($id);
        // Hanya admin atau pemilik laporan yang boleh hapus
        if (Auth::user()->role !== 'admin' && Auth::id() !== $comment->user_id) {
            abort(403, 'Anda tidak memiliki izin untuk menghapus komentar ini.');
        }

        $comment->delete();

        return back()->with('success', 'Komentar berhasil dihapus.');
    }
}
