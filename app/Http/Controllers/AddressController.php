<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\ZipCode;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class AddressController extends Controller
{
    private string $routeName;
    private string $source;
    private Address $model;

    public function __construct()
    {
        $this->middleware('auth');
        $this->routeName = 'address.';
        $this->source = 'Address/';
        $this->model = new Address();
    }

    public function index(Request $request): Response
    {
        $direction = $request->direction ?? 'desc';
        $order = $request->order ?? 'created_at';

        $records = $this->model->with('zipCode')
            ->when($request->search, function ($query, $search) {
                $query->where('street', 'like', "%{$search}%")
                      ->orWhere('city', 'like', "%{$search}%")
                      ->orWhere('state', 'like', "%{$search}%");
            })
            ->orderBy($order, $direction)
            ->paginate(10)
            ->withQueryString();

        return Inertia::render("{$this->source}Index", [
            'title' => 'Addresses',
            'routeName' => $this->routeName,
            'addresses' => $records,
            'search' => $request->search ?? '',
            'order' => $order,
            'direction' => $direction,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render("{$this->source}Create", [
            'title' => 'Add Address',
            'routeName' => $this->routeName,
            'zipCodes' => ZipCode::all(['id', 'zip']),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_address' => 'nullable|string',
            'street' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'zip_code' => 'nullable|integer',
            'apt_number' => 'nullable|string',
            'country' => 'nullable|string',
            'zip_code_id' => 'nullable|exists:zip_codes,id',
        ]);

        $this->model->create($validated);

        return redirect()->route('address.index')
            ->with('success', 'Address created successfully');
    }

    public function edit(Address $address): Response
    {
        return Inertia::render("{$this->source}Edit", [
            'title' => 'Edit Address',
            'routeName' => $this->routeName,
            'address' => $address,
            'zipCodes' => ZipCode::all(['id', 'zip']),
        ]);
    }

    public function update(Request $request, Address $address)
    {
        $validated = $request->validate([
            'full_address' => 'nullable|string',
            'street' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'zip_code' => 'nullable|integer',
            'apt_number' => 'nullable|string',
            'country' => 'nullable|string',
            'zip_code_id' => 'nullable|exists:zip_codes,id',
        ]);

        $address->update($validated);

        return redirect()->route('address.index')
            ->with('success', 'Address updated successfully');
    }

    public function destroy(Address $address)
    {
        $address->delete();

        return redirect()->route('address.index')
            ->with('success', 'Address deleted successfully');
    }
}
