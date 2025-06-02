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
        $direction = $request->direction ?? 'desc';
        $order = $request->order ?? 'created_at';

        $records = Applicant::query()
            ->when($request->search, function ($query, $search) {
                if ($search !== '') {
                    $query->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('surname', 'LIKE', "%{$search}%")
                        ->orWhere('email', 'LIKE', "%{$search}%")
                        ->orWhere('phone', 'LIKE', "%{$search}%");
                }
            })
            ->orderBy($order, $direction)
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Applicant/Index', [
            'title'      => 'Applicants',
            'routeName'  => 'applicants.',
            'records'    => $records,
            'search'     => $request->search ?? '',
            'order'      => $order,
            'direction'  => $direction,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Applicant/Create', [
            'title'     => 'Create Applicant',
            'routeName' => 'applicants.'
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string',
            'surname' => 'required|string',
            'email'   => 'required|email',
            'phone'   => 'required|string',
            'car'     => 'required|string',
        ]);
        Applicant::create($data);
        return redirect()->route('applicants.index')->with('success', 'Applicant created');
    }

    public function edit(Applicant $applicant): Response
    {
        return Inertia::render('Applicant/Edit', [
            'title'     => 'Edit Applicant',
            'routeName' => 'applicants.',
            'applicant' => $applicant,
        ]);
    }

    public function update(Request $request, Applicant $applicant)
    {
        $data = $request->validate([
            'name'    => 'required|string',
            'surname' => 'required|string',
            'email'   => 'required|email',
            'phone'   => 'required|string',
            'car'     => 'required|string',
        ]);
        $applicant->update($data);
        return redirect()->route('applicants.index')->with('success', 'Applicant updated');
    }

    public function destroy(Applicant $applicant)
    {
        $applicant->delete();
        return redirect()->route('applicants.index')->with('success', 'Applicant deleted');
    }
}
