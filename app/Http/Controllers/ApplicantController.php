<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Illuminate\Http\Request;

class ApplicantController extends Controller
{
    public function index()
    {
        return response()->json(Applicant::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'number' => 'required|string|max:255',
            'car' => 'required|string|max:255',
        ]);

        $applicant = Applicant::create($data);

        return response()->json($applicant, 201);
    }

    public function show(Applicant $applicant)
    {
        return response()->json($applicant);
    }

    public function update(Request $request, Applicant $applicant)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'number' => 'required|string|max:255',
            'car' => 'required|string|max:255',
        ]);

        $applicant->update($data);

        return response()->json($applicant);
    }

    public function destroy(Applicant $applicant)
    {
        $applicant->delete();

        return response()->noContent();
    }
}
