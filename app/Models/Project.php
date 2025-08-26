<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'client_id',
        'due_date',
        'budgeted_hours',
        'task_rate',
        'public_notes',
        'private_notes',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
