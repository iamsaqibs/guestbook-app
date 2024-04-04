<?php

namespace App\Repositories;

use App\Events\GuestbookEntryDeleting;
use App\Models\GuestbookEntry;
use App\Models\Submitter;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GuestbookRepository
{
    public function getAll(): Collection
    {
        return GuestbookEntry::with('submitter:id,email,display_name')->get();
    }

    public function getByUser($user): Collection
    {
        return GuestbookEntry::whereHas('submitter', function ($query) use ($user) {
            $query->where('email', $user->email);
        })->get();
    }

    public function findById($entryId)
    {
        return GuestbookEntry::where('id', '=', strval($entryId))->first();
    }

    public function delete($entryId): string
    {
        $entry = GuestbookEntry::findOrFail($entryId);
        event(new GuestbookEntryDeleting($entry));
        $entry->delete();
        return "Deleted";
    }

    public function create(array $data)
    {
        $submitter = Submitter::create([
            'email' => $data['email'],
            'display_name' => $data['name'],
            'real_name' => $data['real_name'],
        ]);

        return GuestbookEntry::create([
            'title' => $data['title'],
            'content' => $data['content'],
            'submitter_id' => $submitter->id,
        ]);
    }

    public function update(Request $request)
    {

        $user = $request->user();

        $entry = $this->findById($request->entryId);

        if ($user->email !== $entry->submitter->email) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $entry->update($request->only('title', 'content'));

        return response()->json($entry);
    }
}
