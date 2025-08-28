<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Client; // Assuming you have a Client model
use App\Models\Project; // Assuming you have a Project model
use Illuminate\Http\Request;
use Exception;

class TaskController extends Controller
{

    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 1); // default = 1
        $tasks = Task::paginate($perPage);

        return view('tasks.index', compact('tasks'));
    }

    public function create(){
        $clients = Client::orderBy('name')->get();
        $projects = Project::orderBy('name')->get();

        $breadcrumbs = [
            ['title' => 'Tasks', 'url' => route('tasks.index')],
            ['title' => 'Create Task'] // current page
        ];

        return view('tasks.create', [
            'clients' => $clients,
            'projects' => $projects,
            'breadcrumbs' => $breadcrumbs,
            'pageTitle' => 'Create Task',
        ]);
}


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'description' => 'required|string',
            'duration' => 'nullable|string|max:255',
            'task_date' => 'nullable|date',
            'client_id' => 'nullable|exists:clients,id',
            'project_id' => 'nullable|exists:projects,id',
        ]);

        Task::create($validatedData);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function edit(Task $task)
    {
        $clients = Client::orderBy('name')->get();
        $projects = Project::orderBy('name')->get();
        $task = Task::find($task->id);
        $breadcrumbs = [
            ['title' => 'Tasks', 'url' => route('tasks.index')],
            ['title' => 'Edit Task'] // current page
        ];

        return view('tasks.edit', [
            'clients' => $clients,
            'projects' => $projects,
            'breadcrumbs' => $breadcrumbs,
            'pageTitle' => 'Edit Task',
            'task' => $task,
        ]);
    }
   

        

    public function update(Request $request, Task $task)
    {
        $validatedData = $request->validate([
            'description' => 'required|string',
            'duration' => 'nullable|string|max:255',
            'task_date' => 'nullable|date',
            'client_id' => 'nullable|exists:clients,id',
            'project_id' => 'nullable|exists:projects,id',
            'status' => 'nullable|string|max:255'
        ]);

        $task->update($validatedData);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }

    public function showImportForm()
    {
        return view('tasks.import');
    }


        public function handleImport(Request $request)
    {
        // 1. Validate that a file was uploaded and it's a CSV.
        $request->validate([
            'csvFile' => 'required|file|mimes:csv,txt',
        ]);

        $path = $request->file('csvFile')->getRealPath();

        try {
            // 2. Open the file for reading.
            $file = fopen($path, 'r');

            // 3. Read the header row to skip it.
            $header = fgetcsv($file);

            // 4. Loop through the rest of the rows in the file.
            while (($row = fgetcsv($file)) !== false) {
                // Combine the header with the row data to create an associative array.
                $data = array_combine($header, $row);
                
                // Optional: Find client by name to get the ID
                $client = Client::where('name', $data['Client Name'] ?? '')->first();

                Task::create([
                    'description' => $data['Description'] ?? null,
                    'task_date' => $data['Task Date'] ?? null,
                    'duration' => $data['Duration'] ?? null,
                    'client_id' => $client->id ?? null,
                ]);
            }

            fclose($file);

        } catch (Exception $e) {
            // If anything goes wrong, redirect back with an error message.
            return redirect()->route('tasks.import')->with('error', 'An error occurred during import: ' . $e->getMessage());
        }

        // 6. If the import is successful, redirect back with a success message.
        return redirect()->route('tasks.index')->with('success', 'tasks imported successfully.');
    }


    public function destroyMultiple(Request $request)
    {
        // Get the array of IDs from the form submission
        $taskIds = $request->input('task_ids');

        // Check if any IDs were actually selected
        if (empty($taskIds)) {
            return redirect()->route('tasks.index')->with('error', 'No tasks were selected for deletion.');
        }

        // Delete the tasks with the selected IDs
        Task::whereIn('id', $taskIds)->delete();

        // Redirect back with a success message
        return redirect()->route('tasks.index')->with('success', 'Selected tasks have been deleted successfully.');
    }

    
}
