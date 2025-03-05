<?php

declare(strict_types=1);

namespace App\Todo\Infrastructure\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TodoModel extends Model
{
    use HasFactory;
    protected $table = 'todos';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = ['title', 'description', 'due_date', 'completed'];

    protected $casts = [
        'completed' => 'boolean',
        'due_date' => 'datetime',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->id) {
                $model->id = (string) Str::ulid();
            }
        });
    }

    protected static function newFactory(): TodoModelFactory
    {
        return new TodoModelFactory();
    }
}
