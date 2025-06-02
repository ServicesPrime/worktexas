<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;

class JobController extends Controller
{
    private Job $model;
    private string $source = 'Job/';
    private string $routeName = 'job.';

    public function __construct()
    {
        $this->middleware('auth');
        $this->model = new Job();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        $direction = $request->direction ?? 'desc';
        $order = $request->order ?? 'created_at';

        $records = $this->model->query()
            ->when($request->search, function ($query, $search) {
                if ($search !== '') {
                    $query->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('description', 'LIKE', "%{$search}%");
                }
            })
            ->orderBy($order, $direction)
            ->paginate(10)
            ->withQueryString();

        return Inertia::render("{$this->source}Index", [
            'title'      => 'Jobs',
            'routeName'  => $this->routeName,
            'jobs'       => $records,
            'search'     => $request->search ?? '',
            'order'      => $order,
            'direction'  => $direction,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render("{$this->source}Create", [
            'title'     => 'Add Job',
            'routeName' => $this->routeName,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $this->model->create($validated);

        return redirect()->route('job.index')->with('success', 'Job created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job): Response
    {
        return Inertia::render("{$this->source}Edit", [
            'title'     => 'Edit Job',
            'routeName' => $this->routeName,
            'job'       => $job,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $job->update($validated);

        return redirect()->route('job.index')->with('success', 'Job updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job): RedirectResponse
    {
        $job->delete();

        return redirect()->route('job.index')->with('success', 'Job deleted successfully!');
    }
}
