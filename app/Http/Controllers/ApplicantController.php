<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Address;
use App\Http\Requests\StoreApplicantRequest;
use App\Http\Requests\UpdateApplicantRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ApplicantController extends Controller
{
    private Applicant $model;
    private string $routeName = 'applicant.';
    private string $source = 'Applicant/';

    public function __construct()
    {
        $this->middleware('auth');
        $this->model = new Applicant();
    }

    public function index(Request $request): Response
    {
        $direction = $request->direction ?? 'desc';
        $order = $request->order ?? 'created_at';

        $records = $this->model->with('address')->when($request->search, function ($query, $search) {
            if ($search !== '') {
                $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('surname', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('phone', 'LIKE', "%{$search}%");
            }
        });

        $records = $records->orderBy($order, $direction)
            ->paginate(10)
            ->withQueryString();

        return Inertia::render("{$this->source}Index", [
            'title' => 'Applicants',
            'routeName' => $this->routeName,
            'applicants' => $records,
            'search' => $request->search ?? '',
            'order' => $order,
            'direction' => $direction,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render("{$this->source}Create", [
            'title' => 'Create Applicant',
            'routeName' => $this->routeName,
        ]);
    }

    public function store(StoreApplicantRequest $request)
    {
        $addressData = $request->only(['full_address','street','city','state','zip_code','apt_number','country']);
        $address = Address::create($addressData);

        $applicantData = $request->only(['name','surname','email','phone','car']);
        $applicantData['address_id'] = $address->id;
        $this->model::create($applicantData);

        return redirect()->route('applicant.index')->with('success', 'Applicant created successfully.');
    }

    public function edit(Applicant $applicant): Response
    {
        $applicant->load('address');
        return Inertia::render("{$this->source}Edit", [
            'title' => 'Edit Applicant',
            'routeName' => $this->routeName,
            'applicant' => $applicant,
        ]);
    }

    public function update(UpdateApplicantRequest $request, Applicant $applicant)
    {
        $addressData = $request->only(['full_address','street','city','state','zip_code','apt_number','country']);
        if ($applicant->address) {
            $applicant->address->update($addressData);
        } else {
            $address = Address::create($addressData);
            $applicant->address_id = $address->id;
        }

        $applicantData = $request->only(['name','surname','email','phone','car']);
        $applicant->update($applicantData);
        $applicant->save();

        return redirect()->route('applicant.index')->with('success', 'Applicant updated successfully.');
    }

    public function destroy(Applicant $applicant)
    {
        $applicant->delete();
        return redirect()->route('applicant.index')->with('success', 'Applicant removed successfully.');
    }
}
