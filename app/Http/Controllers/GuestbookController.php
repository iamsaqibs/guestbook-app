<?php

namespace App\Http\Controllers;

use App\Services\GuestbookService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class GuestbookController extends Controller
{
    protected GuestbookService $guestbookService;

    public function __construct(GuestbookService $guestbookService)
    {
        $this->guestbookService = $guestbookService;
    }

    public function index(Request $request) : View | JsonResponse
    {
        $entries = $this->guestbookService->getAllEntries();

        if ($request->is('api/*')) {
            return response()->json($entries);
        }

        return view('index', ['entries' => $entries]);
    }

    public function showSubmitForm() : View
    {
        return view('form');
    }

    public function createEntry(Request $request) : RedirectResponse
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'real_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'content' => 'required|string',
        ]);

        try {
            $this->guestbookService->createEntry($validatedData);
            return redirect()->route('index')->with('status', 'Entry submitted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function getMyEntries(Request $request) : Collection
    {
        return $this->guestbookService->getEntriesByUser($request->user());
    }

    public function getEntry(Request $request, string $entry)
    {
        return $this->guestbookService->getEntryById($entry);
    }

    public function deleteEntry($entryId) : string
    {
        return $this->guestbookService->deleteEntry($entryId);
    }

    public function sign(Request $request): RedirectResponse
    {
        return $this->createEntry($request);
    }

    public function updateEntry(Request $request){
        return $this->guestbookService->updateEntry($request);
    }
}
