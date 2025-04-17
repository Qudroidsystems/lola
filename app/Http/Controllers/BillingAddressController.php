<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BillingAddressController extends Controller
{
    public function edit()
    {
        $address = auth()->user()->billingAddress()->first() ?? new BillingAddress();
        return view('frontend.billing-address.edit', compact('address'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'zip' => 'required|string|max:20',
            'phone' => 'nullable|string|max:20',
        ]);

        try {
            auth()->user()->billingAddress()->updateOrCreate(
                ['user_id' => auth()->id()],
                $request->only('street', 'city', 'state', 'zip', 'phone')
            );

            return redirect()->route('user.dashboard')->with('success', 'Address updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating address: ' . $e->getMessage());
        }
    }
}
