<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BillingAddressController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|string|max:10',
            'phone' => 'required|string|max:15',
        ]);

        try {
            $billingAddress = BillingAddress::updateOrCreate(
                ['user_id' => Auth::id()],
                $request->all()
            );

            return redirect()->back()->with('success', 'Billing address updated!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating billing address: ' . $e->getMessage());
        }
    }
}
