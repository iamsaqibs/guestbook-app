<?php

namespace App\Services;
use App\Repositories\GuestbookRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class GuestbookService
{
    protected GuestbookRepository $guestbookRepository;

    public function __construct(GuestbookRepository $guestbookRepository)
    {
        $this->guestbookRepository = $guestbookRepository;
    }

    public function getAllEntries(): Collection
    {
        return $this->guestbookRepository->getAll();
    }

    public function getEntriesByUser($user): Collection
    {
        return $this->guestbookRepository->getByUser($user);
    }

    public function getEntryById($entryId)
    {
        return $this->guestbookRepository->findById($entryId);
    }

    public function deleteEntry($entryId): string
    {
        return $this->guestbookRepository->delete($entryId);
    }

    public function createEntry(array $data)
    {
        return $this->guestbookRepository->create($data);
    }

    public function updateEntry(Request $request)
    {
        $entryId = @$request->entryId;

        if (!$entryId){
            return response()->json(['error' => 'Entry not found'], 404);
        }

        return $this->guestbookRepository->update($request);
    }
}
