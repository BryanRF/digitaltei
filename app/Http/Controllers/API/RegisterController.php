<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(Request $request): JsonResponse
{
    try {
        $customer = Customer::create([
            'name' => $request->name,
            'contact_name' => $request->contact_name,
            'ruc' => $request->ruc,
            'ubication' => $request->ubication,
            'address' => $request->address,
            'phone' => $request->phone,
            'customer_type_id' => $request->customer_type_id,
        ]);

        $user = User::where('email', $request->email)->whereNotNull('email_verified_at')->first();

        if ($user && $customer) {
            $user->customer_id = $customer->id;
            $user->user_type_id = 3;
            $user->save();

            return response()->json(['success' => true, 'user' => $user]);
        } elseif ($customer) {
            $user = new User();
            $user->email = $request->email;
            $user->name = $customer->name;
            $user->password = ($request->password);
            $user->customer_id = $customer->id;
            $user->email_verified_at = now();
            $user->user_type_id = 2;
            $user->save();

            return response()->json(['success' => true, 'user' => $user]);
        }

        return response()->json(['error' => 'Sucedio algún error con el registro']);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Ocurrió una excepción durante el registro: ' . $e->getMessage()]);
    }
}

}
