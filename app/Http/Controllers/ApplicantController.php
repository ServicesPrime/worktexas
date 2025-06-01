<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ApplicantController extends Controller
{
    public function index(Request $request): Response
    {
        $direction = $request->input('direction', 'desc');
        $order = $request->input('order', 'created_at');

        $applicants = Applicant::query()
            ->when($request->search, function ($query, $search) {
                $query->where('nombre', 'like', "%{$search}%")
                    ->orWhere('apellido', 'like', "%{$search}%")
                    ->orWhere('correo', 'like', "%{$search}%")
                    ->orWhere('numero', 'like', "%{$search}%");
            })
            ->orderBy($order, $direction)
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Applicant/Index', [
            'title' => 'Applicants',
            'routeName' => 'applicant.',
            'applicants' => $applicants,
            'search' => $request->search ?? '',
            'order' => $order,
            'direction' => $direction,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Applicant/Create', [
            'title' => 'Create applicant',
            'routeName' => 'applicant.'
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'surname' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|digits:10',
            'car' => 'required|in:Yes,No',
        ]);

        Applicant::create([
            'nombre' => $data['name'],
            'apellido' => $data['surname'],
            'correo' => $data['email'],
            'numero' => $data['phone'],
            'car' => $data['car'],
        ]);

        return redirect()->route('applicant.index')->with('success', 'Applicant created');
    }

    public function edit(Applicant $applicant): Response
    {
        return Inertia::render('Applicant/Edit', [
            'title' => 'Edit applicant',
            'routeName' => 'applicant.',
            'applicant' => [
                'id' => $applicant->id,
                'name' => $applicant->nombre,
                'surname' => $applicant->apellido,
                'email' => $applicant->correo,
                'phone' => $applicant->numero,
                'car' => $applicant->car,
            ],
        ]);
    }

    public function update(Request $request, Applicant $applicant)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'surname' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|digits:10',
            'car' => 'required|in:Yes,No',
        ]);

        $applicant->update([
            'nombre' => $data['name'],
            'apellido' => $data['surname'],
            'correo' => $data['email'],
            'numero' => $data['phone'],
            'car' => $data['car'],
        ]);

        return redirect()->route('applicant.index')->with('success', 'Applicant updated');
    }

    public function destroy(Applicant $applicant)
    {
        $applicant->delete();
        return redirect()->route('applicant.index')->with('success', 'Applicant deleted');
    }
}
