<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'description',
        'duration',
        'task_date',
        'status',
        'client_id',
        'project_id',
    ];

    /**
     * Get the client that this task belongs to.
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Get the project that this task belongs to.
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}