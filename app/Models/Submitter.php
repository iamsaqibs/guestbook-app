<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Submitter extends Model
{
    use HasFactory;
    use HasUuids;
    
    protected $fillable = [
        'email',
        'display_name',
        'real_name'
    ];
    
    public function guestbookEntries() : HasMany
    {
        return $this->hasMany(GuestbookEntry::class);
    }
}
