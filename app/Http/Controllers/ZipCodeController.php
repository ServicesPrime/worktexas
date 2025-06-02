<?php

namespace App\Http\Controllers;

use App\Models\ZipCode;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ZipCodeController extends Controller
{
    private string $routeName;
    private string $source;
    private ZipCode $model;

    public function __construct()
    {
        $this->middleware('auth');
        $this->routeName = 'zipcode.';
        $this->source = 'ZipCode/';
        $this->model = new ZipCode();
    }

    public function index(Request $request): Response
    {
        $direction = $request->direction ?? 'desc';
        $order = $request->order ?? 'created_at';

        $records = $this->model->query()
            ->when($request->search, function ($query, $search) {
                $query->where('zip', 'like', "%{$search}%")
                      ->orWhere('city', 'like', "%{$search}%")
                      ->orWhere('state', 'like', "%{$search}%");
            })
            ->orderBy($order, $direction)
            ->paginate(10)
            ->withQueryString();

        return Inertia::render("{$this->source}Index", [
            'title' => 'Zip Codes',
            'routeName' => $this->routeName,
            'zipcodes' => $records,
            'search' => $request->search ?? '',
            'order' => $order,
            'direction' => $direction,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render("{$this->source}Create", [
            'title' => 'Add Zip Code',
            'routeName' => $this->routeName,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'county' => 'nullable|string',
            'id_state' => 'nullable|integer',
            'id_county' => 'nullable|integer',
            'zip' => 'nullable|string',
        ]);

        $this->model->create($validated);

        return redirect()->route('zipcode.index')
            ->with('success', 'Zip Code created successfully');
    }

    public function edit(ZipCode $zipcode): Response
    {
        return Inertia::render("{$this->source}Edit", [
            'title' => 'Edit Zip Code',
            'routeName' => $this->routeName,
            'zipcode' => $zipcode,
        ]);
    }

    public function update(Request $request, ZipCode $zipcode)
    {
        $validated = $request->validate([
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'county' => 'nullable|string',
            'id_state' => 'nullable|integer',
            'id_county' => 'nullable|integer',
            'zip' => 'nullable|string',
        ]);

        $zipcode->update($validated);

        return redirect()->route('zipcode.index')
            ->with('success', 'Zip Code updated successfully');
    }

    public function destroy(ZipCode $zipcode)
    {
        $zipcode->delete();

        return redirect()->route('zipcode.index')
            ->with('success', 'Zip Code deleted successfully');
    }
}
