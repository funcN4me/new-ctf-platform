<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'path',
        'task_id',
    ];

    public function getDownloadUrlAttribute(): string
    {
        return $this->path ? Storage::url($this->path) : '';
    }

    public function task(): BelongsTo
    {
        return $this->belongsTo(File::class);
    }
}
