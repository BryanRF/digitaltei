<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Employee;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Support\Facades\Session;
class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**
    Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->required();
            $table->string('contact_name')->nullable();
            $table->string('ruc')->nullable();
            $table->string('ubication')->nullable();
            $table->string('address')->required();
            $table->string('phone')->nullable();
            $table->unsignedInteger('customer_type_id')->required();
            $table->foreign('customer_type_id')->references('id')->on('customer_types');
            $table->timestamps();
            $table->softDeletes();
     */
    public function store(Request $request):JsonResponse
    {
        $customer = Customer::create([
            'name' => $request->name,
            'contact_name' => $request->contact_name,
            'ruc' => $request->ruc,
            'ubication' => $request->ubication,
            'address' => $request->address,
            'phone' => $request->phone,
            'customer_type_id' => $request->customer_type_id,
        ]);
        $user = User::where('email',$request->email)->whereNotNull('email_verified_at')->first();
        if($user && $customer){
            $user->customer_id = $customer->id;
            $user->user_type_id = 3;
            $user->save();

        }else
        if ($customer) {
            $user = new User();
            $user->email= $request->email;
            $user->name= $customer->name;
            $user->password= ($request->password);
            $user->customer_id = $customer->id;
            $user->email_verified_at = now();
            $user->user_type_id = 2;
            $user->save();
        
        }
        return response()->json(['success' => true, 'user' => $user]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function login(Request $request):JsonResponse
    {
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $request->email)
        ->whereNotNull('employee_id')
        ->whereNull('customer_id')
        ->first();
        if ($user) {
            $employee = Employee::select('id', 'phone','avatar')
                ->where('id', $user->employee_id)
                ->first();
            return response()->json(['user employee' => true, 'user' => $user, 'employee' => $employee]);
        }

    if (!Auth::attempt($credentials)) {
        $errors = [];
        
        if (!User::where('email', $credentials['email'])->exists()) {
            $errors['email'] = 'El email ingresado no existe en nuestros registros.';
        } else {
            $errors['password'] = 'La contraseña ingresada es incorrecta.';
        }
        
        return response()->json(['errors' => $errors], 401);
    }
        $user = Auth::user();
        Session::flush();
        Auth::logout();
        return response()->json(['success' => true, 'user' => $user]);
    }

    
}
