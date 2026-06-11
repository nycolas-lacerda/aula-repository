<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    protected $fillable = [
        'lesson_id',
        'reviewer_id',
        'status',
        'comments',
    ];

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }

    public function statusLabel(): string
    {
        return match ($this->status) {
            'approved' => 'Aprovada',
            'rejected' => 'Rejeitada',
            default => ucfirst($this->status),
        };
    }
}
