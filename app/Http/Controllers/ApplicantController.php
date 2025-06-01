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
    }
}
