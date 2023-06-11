<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function register(Request $request): JsonResponse
{
    DB::beginTransaction();
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
            //aqui vemos si el usuario es empleado 
        $user = User::where('email', $request->email)->whereNotNull('email_verified_at')->first();

        if ($user && $customer) {
            $user->customer_id = $customer->id;
            $user->user_type_id = 3;
            $user->save();
            $message['success'] =  true;
            $message['message'] =  'Cliente registrado correctamente.';
            $message['user'] =  $user;
            $message['codigo']=200;
            DB::commit();
        return response()->json([$message]);
            //si no es empleado lo registramos normal como cliente 
        } elseif ($customer) {
            $existingUser = User::where('email', $request->email)->whereNotNull('customer_id')->first();
            if ($existingUser) {
                $message['success'] =  false;
                $message['message'] =  'El correo electrónico ya está registrado. Pruebe con otro correo.';
                $message['user'] =  $user;
                $message['codigo']=401;
                DB::rollback();
            return response()->json([$message]);
            }
            $user = new User();
            $user->email = $request->email;
            $user->name = $customer->name;
            $user->password = ($request->password);
            $user->customer_id = $customer->id;
            $user->email_verified_at = now();
            $user->user_type_id = 2;
            $user->save();
            $message['success'] =  true;
            $message['message'] =  'Cliente registrado correctamente.';
            $message['user'] =  $user;
            $message['codigo']=200;
            DB::commit();
        return response()->json([$message]);
        }
            $message['success'] =  false;
            $message['message'] =  'Sucedio algún error con el registro.';
            $message['codigo']= 404;
            DB::rollback();
        return response()->json([$message]);
    } catch (\Exception $e) {
            $message['success'] =  false;
            $message['message'] =  'Sucedio algún error con el registro.';
            $message['error'] =  $e->getMessage();
            $message['codigo']= 404;
            DB::rollback();
        return response()->json([$message]);
    }
}


}
