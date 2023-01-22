<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Action extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'user_id',
        'target_id',
        'target_name',
    ];

    public const ACTION_READ_RESOURCE = 'read_resource';
    public const ACTION_SOLVED_TASK = 'solved_task';
    public const ACTION_CREATED_TASK = 'created_task';
    public const ACTION_CREATED_RESOURCE = 'created_resource';

    public const ACTION_TYPES = [
        'read_resource' => 'прочитал статью',
        'solved_task' => 'решил задачу',
        'created_task' => 'добавил новую задачу',
        'created_resource' => 'добавил новую статью',
    ];

    public const ACTION_ICONS = [
        'read_resource' => 'fa-book-open',
        'solved_task' => 'fa-clipboard-check',
        'created_task' => 'fa-folder-plus',
        'created_resource' => 'fa-folder-plus',
        'undefined' => 'fa-question-circle',
    ];

    public function getActionTypeAttribute(): string
    {
        return self::ACTION_TYPES[$this->type] ?? 'нет данного типа';
    }

    public function getActionIconAttribute(): string
    {
        return self::ACTION_ICONS[$this->type] ?? self::ACTION_ICONS['undefined'];
    }

    public function getActionTargetNameAttribute()
    {
        if (str_contains($this->type, 'task')) {
            return $this->belongsTo(Task::class, 'target_id')->first();
        }

        if (str_contains($this->type, 'resource')) {
            return $this->belongsTo(Resource::class, 'target_id')->first();
        }

        return 'произошла ошибка';
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
