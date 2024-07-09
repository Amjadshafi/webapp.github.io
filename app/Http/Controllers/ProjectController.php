<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use App\Models\UserProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    public function create()
    {
        $userObj = new User();
        $users = $userObj->getUserDDL();
        return view('projects.create', compact('users'));
    }
    public function index()
    {
        $projects = [];
        // dd(Auth::user()->roles->pluck('name')->toArray());
        // $projects = $this->project->getAllProjectsByUser(Auth()->user()->id);
        if(in_array('Admin',Auth::user()->roles->pluck('name')->toArray())){
            $projects = Project::all();
        } else {
            $user = User::find(Auth()->user()->id);
            $projects = $user->projects;
        }
        
        return view('projects.index')->with('projects', $projects);
    }

    public function store(Request $request)
{
    $project = $this->project->create($request->except(['_token', 'members']));
    
    if ($project) {
        // Attach selected members to the project
        $project->users()->attach($request->members);
        
        return redirect()->route('projectsList')
            ->withSuccess('Successfully Created.');
    }
}

    // public function index()
    // {
    //     // Retrieve all projects from the database
    //     $projects = Project::all();
    //     return view('projects.index', compact('projects'));
    // }

    // public function store()
    // {
    //     // Show the form to create a new project
    //     return view('projects.create');
    // }

    public function show(Project $project)
    {
        // Show details of a specific project
        $project = $this->project->with('users')->find($project->id);
        return view('projects.show', compact('project'));
    }
    public function edit(Project $project)
    {
        // Fetch users for the dropdown
        $userObj = new User();
        $users = $userObj->getUserDDL();
        
        // Pass both $project and $users to the view
        return view('projects.edit', compact('project', 'users'));
    }
    public function update(Request $request, Project $project)
{
    // Update project details
    $project->update($request->except(['_token', '_method', 'members']));
    
    // Sync selected members with the project's users
    $project->users()->sync($request->members);

    return redirect()->route('projectsList')
                    ->with('success', 'Project updated successfully');
}


    public function destroy($id)
    {
        $project = $this->project->findOrFail($id);
        $project->delete();
        return redirect()->route('projectsList')->withSuccess('project successfully deleted.');
    }
}


