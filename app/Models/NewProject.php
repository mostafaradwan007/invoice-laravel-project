<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewProject extends Model
{
    use HasFactory;

    // Explicitly define the table name
    protected $table = 'projects';

    protected $fillable = [
        'name',
        'client_id',
        'user_id',
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
