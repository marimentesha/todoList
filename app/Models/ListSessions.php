<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ListSessions extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'list_sessions';

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
