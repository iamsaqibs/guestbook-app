<?php

namespace App\Listeners;

use App\Events\GuestbookEntryDeleting;
use App\Services\GuestbookEntryDeletionService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HandleGuestbookEntryDeleting
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    protected GuestbookEntryDeletionService $deletionService;

    public function __construct(GuestbookEntryDeletionService $deletionService)
    {
        $this->deletionService = $deletionService;
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle(GuestbookEntryDeleting $event)
    {
        $entry = $event->entry;
        
        $this->deletionService->notifyUserOfDeletion($entry->submitter->email);
        $this->deletionService->generateNewReport();
        $this->deletionService->performCleanupTasks();
    }
}
