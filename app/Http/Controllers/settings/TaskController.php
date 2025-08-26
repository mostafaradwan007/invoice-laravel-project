<?php


namespace App\Http\Controllers\settings;

use App\Http\Controllers\controller;

use App\Models\settings\Task; // ✅ Singular Model name (Laravel convention)
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $task = Task::first();


        return view('settings.tasksettings.index', compact(var_name: 'task'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
           'default_task_rate' => 'nullable|numeric',
            'currency' =>  'in:USD - US Dollar,EUR - Euro,GBP - British Pound,CAD - Canadian Dollar',


            'auto_start_task' => 'nullable|in:Yes,No',
            'show_task_end_date' => 'nullable|in:Yes,No',
            'task_document' => 'nullable|in:Yes,No',
            'show_project_on_tasks' => 'nullable|in:Yes,No',

            'round_to_nearest' =>  'in:No Rounding,5 Minutes,10 Minutes,15 Minutes,30 Minutes,1 Hour',

            'default_task_type' =>  'in:Development,Design,Testing,Meeting,Research',

            'lock_invoiced_tasks' => 'nullable|in:Yes,No',



        ]);

        // 2️⃣ Always fetch the first (and only) record
        $task = Task::first();

        if ($task) {
            // If it exists → update it
            $task->update($validated);
        } else {
            // If not → create the first row
            Task::create($validated);
        }



        return redirect()->route('settings.index');
    }
}
