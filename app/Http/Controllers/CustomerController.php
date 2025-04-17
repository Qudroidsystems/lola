<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();
        //return response()->json($customers);
        return view('customer.index')->with('customers',$customers);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('customer.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'phone_number' => 'required|string|max:15|unique:customers,phone_number',
            'phone_number_2' => 'nullable|string|max:15',
            'home_address' => 'required|string',
            'office_address' => 'nullable|string',
            'gender' => 'nullable|in:male,female,other',
        ]);

        $customer = Customer::create($validated);

        //return response()->json(['message' => 'Customer created successfully', 'customer' => $customer], 201);
        return redirect()->back()->with('success', 'Customer record created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer = Customer::findOrFail($id);
        return response()->json($customer);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $customer = Customer::findOrFail($id);

        $validated = $request->validate([
            'first_name' => 'string|max:255',
            'last_name' => 'string|max:255',
            'email' => 'email|unique:customers,email,' . $customer->id,
            'phone_number' => 'string|max:15|unique:customers,phone_number,' . $customer->id,
            'phone_number_2' => 'nullable|string|max:15',
            'home_address' => 'string',
            'office_address' => 'nullable|string',
            'gender' => 'nullable|in:male,female,other',
        ]);

        $customer->update($validated);

        return response()->json(['message' => 'Customer updated successfully', 'customer' => $customer]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return response()->json(['message' => 'Customer deleted successfully']);
    }
}
