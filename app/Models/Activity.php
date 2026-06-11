<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Activity extends Model
{
    protected $fillable = [
        'title',
        'description',
        'content',
        'subject_id',
        'grade_id',
        'created_by',
        'status',
    ];

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function grade(): BelongsTo
    {
        return $this->belongsTo(Grade::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function files(): HasMany
    {
        return $this->hasMany(ActivityFile::class);
    }

    public function lessons(): BelongsToMany
    {
        return $this->belongsToMany(Lesson::class, 'lesson_activity')
            ->withPivot('position')
            ->withTimestamps();
    }

    public function statusLabel(): string
    {
        return match ($this->status) {
            'draft' => 'Rascunho',
            'published' => 'Publicada',
            'archived' => 'Arquivada',
            default => ucfirst($this->status),
        };
    }
}
