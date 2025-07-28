<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Person;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CustomerExport;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::with('person')->get();
        return Inertia::render('Customers/Index', ['customers' => $customers]);
    }

    public function create()
    {
        $people = Person::all();
        return Inertia::render('Customers/Create', ['people' => $people]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'people_id' => 'required|exists:people,id',
        ]);

        Customer::create($request->all());

        return redirect()->route('customers.index');
    }

    public function show(Customer $customer)
    {
        $customer->load('person');
        return Inertia::render('Customers/Show', ['customer' => $customer]);
    }

    public function edit(Customer $customer)
    {
        $people = Person::all();
        return Inertia::render('Customers/Edit', ['customer' => $customer, 'people' => $people]);
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers,email,' . $customer->id,
            'people_id' => 'required|exists:people,id',
        ]);

        $customer->update($request->all());

        return redirect()->route('customers.index');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('customers.index');
    }

    public function exportExcel()
    {
        return Excel::download(new CustomerExport, 'customers.xlsx');
    }
}
