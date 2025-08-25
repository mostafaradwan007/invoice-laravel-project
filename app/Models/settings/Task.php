<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'task_settings';

    protected $fillable = [

        'currency',
        'default_task_rate',

        'auto_start_task',
 'show_task_end_date',
        'task_document',
        'show_project_on_tasks',

        'round_to_nearest',

          'default_task_type',

        'lock_invoiced_tasks',


    ];
}
