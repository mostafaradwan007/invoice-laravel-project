<?php

namespace App\Http\Controllers;


use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Project as Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::paginate(10);


        return view('newprojects.index', [
            'projects' => $projects,
            'title'    => 'New Projects'
        ]);
    }

    public function create()
    {
        $clients = Client::all();
        $users   = User::all();

        return view('newprojects.create', [
            'clients' => $clients,
            'users'   => $users,
            'title'   => 'New Projects'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'client_id'      => 'required|exists:clients,id',
            'user_id'        => 'nullable|exists:users,id',
            'due_date'       => 'nullable|date',
            'budgeted_hours' => 'nullable|integer',
            'task_rate'      => 'nullable|numeric',
        ]);

        Project::create($request->all());

        return redirect()
            ->route('newprojects.index')  // updated route name
            ->with('success', 'New Project created successfully.');
    }
}
