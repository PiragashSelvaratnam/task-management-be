<?php

namespace App\Models;

use App\Enums\TaskPriorityType;
use App\Enums\TaskTypes;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $fillable = [
        'title',
        'description',
        'status',
        'priority',
        'due_date',
        'assigned_to',
    ];

    protected function casts(): array
    {
        return [
            'status' => TaskTypes::class,
            'priority' => TaskPriorityType::class,
        ];
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
