<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ApplicantController extends Controller
{
    private string $routeName = 'applicants.';
    private string $source = 'Applicant/';

    public function index(Request $request): Response
    {
        $records = Applicant::query()->paginate(8);
        return Inertia::render("{$this->source}Index", [
            'title' => 'Applicants',
            'records' => $records,
            'routeName' => $this->routeName,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render("{$this->source}Create", [
            'title' => 'Add Applicant',
            'routeName' => $this->routeName,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'number' => 'required|string',
            'car' => 'required|string',
        ]);

        Applicant::create([
            'nombre' => $data['first_name'],
            'apellido' => $data['last_name'],
            'correo' => $data['email'],
            'numero' => $data['number'],
            'car' => $data['car'],
        ]);

        return redirect()->route('applicants.index')->with('success', 'Applicant created');
    }

    public function show(Applicant $applicant)
    {
        abort(404);
    }

    public function edit(Applicant $applicant): Response
    {
        return Inertia::render("{$this->source}Edit", [
            'title' => 'Edit Applicant',
            'applicant' => $applicant,
            'routeName' => $this->routeName,
        ]);
    }

    public function update(Request $request, Applicant $applicant): RedirectResponse
    {
        $data = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'number' => 'required|string',
            'car' => 'required|string',
        ]);

        $applicant->update([
            'nombre' => $data['first_name'],
            'apellido' => $data['last_name'],
            'correo' => $data['email'],
            'numero' => $data['number'],
            'car' => $data['car'],
        ]);

        return redirect()->route('applicants.index')->with('success', 'Applicant updated');
    }

    public function destroy(Applicant $applicant): RedirectResponse
    {
        $applicant->delete();

        return redirect()->route('applicants.index')->with('success', 'Applicant deleted');
    }
}
