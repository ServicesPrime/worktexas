<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Illuminate\Http\Request;

use Inertia\Inertia;
use Inertia\Response;

class ApplicantController extends Controller
{
    private Applicant $model;
    private string $source;
    private string $routeName;

    public function __construct()
    {
        $this->middleware('auth');
        $this->model = new Applicant();
        $this->source = 'Applicant/';
        $this->routeName = 'applicant.';
    }

    public function index(Request $request): Response
    {
        $direction = $request->direction ?? 'desc';
        $order = $request->order ?? 'created_at';

        $records = $this->model->query()->when($request->search, function ($query, $search) {
            if ($search !== '') {
                $query->where('nombre', 'LIKE', "%{$search}%")
                    ->orWhere('apellido', 'LIKE', "%{$search}%")
                    ->orWhere('correo', 'LIKE', "%{$search}%")
                    ->orWhere('numero', 'LIKE', "%{$search}%")
                    ->orWhere('car', 'LIKE', "%{$search}%");
            }
        });

        $records = $records->orderBy($order, $direction)
            ->paginate(10)
            ->withQueryString();

        return Inertia::render("{$this->source}Index", [
            'title'      => 'Applicants',
            'routeName'  => $this->routeName,
            'applicants' => $records,
            'search'     => $request->search ?? '',
            'order'      => $order,
            'direction'  => $direction,
        ]);
=======

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
