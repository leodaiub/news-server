<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Preferences extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'categories',
        'sources',
    ];

    /**
     * Get the user associated with the preferences.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}