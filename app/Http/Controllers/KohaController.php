<?php

namespace App\Http\Controllers;

use App\Services\KohaService;
use Illuminate\Http\Request;

class KohaController extends Controller
{
    protected $kohaService;

    public function __construct(KohaService $kohaService)
    {
        $this->kohaService = $kohaService;
    }

    /**
     * Show the search page.
     */
    public function showSearchPage()
    {
        return view('librarian.search-dues');
    }

    /**
     * Handle the search request.
     */
    public function searchDues(Request $request)
    {
        $request->validate([
            'studentId' => 'required|string',
        ]);

        $studentId = $request->input('studentId');
        $dues = $this->kohaService->getPatronDues($studentId);

        if (isset($dues['error'])) {
            return back()->withErrors($dues['error'])->withInput();
        }

        return view('librarian.search-dues', ['dues' => $dues, 'studentId' => $studentId]);
    }
}

