<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
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
            'last_name'  => 'required|string',
            'email'      => 'required|email',
            'number'     => 'required|string',
            'car'        => 'required|string',
        ]);

        Applicant::create([
            'nombre'   => $data['first_name'],
            'apellido' => $data['last_name'],
            'correo'   => $data['email'],
            'numero'   => $data['number'],
            'car'      => $data['car'],
        ]);

        return redirect()->route("{$this->routeName}index")->with('success', 'Applicant created');
    }

    public function edit(Applicant $applicant): Response
    {
        return Inertia::render("{$this->source}Edit", [
            'title'     => 'Edit Applicant',
            'applicant' => $applicant,
            'routeName' => $this->routeName,
        ]);
    }

    public function update(Request $request, Applicant $applicant): RedirectResponse
    {
        $data = $request->validate([
            'first_name' => 'required|string',
            'last_name'  => 'required|string',
            'email'      => 'required|email',
            'number'     => 'required|string',
            'car'        => 'required|string',
        ]);

        $applicant->update([
            'nombre'   => $data['first_name'],
            'apellido' => $data['last_name'],
            'correo'   => $data['email'],
            'numero'   => $data['number'],
            'car'      => $data['car'],
        ]);

        return redirect()->route("{$this->routeName}index")->with('success', 'Applicant updated');
    }

    public function destroy(Applicant $applicant): RedirectResponse
    {
        $applicant->delete();

        return redirect()->route("{$this->routeName}index")->with('success', 'Applicant deleted');
    }

    public function show(Applicant $applicant)
    {
        abort(404); // si no lo necesitas, puedes eliminarlo
    }
}
