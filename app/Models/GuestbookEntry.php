<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GuestbookEntry extends Model
{
    use HasFactory;
    use HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'title',
        'content',
        'submitter_email',
        'submitter_display_name',
        'submitter_real_name',
        'submitter_id'
    ];

    protected $dispatchesEvents = [
        'deleting' => 'App\Events\GuestbookEntryDeleting',
    ];

    public function submitter() : BelongsTo
    {
        return $this->belongsTo(Submitter::class);
    }
}
