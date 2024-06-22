<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;

class authController extends Controller
{

    // use Response;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function register(Request $request)
    {
        try {

            $params = json_decode($request->getContent());
            if (empty($params->email) || !filter_var($params->email, FILTER_VALIDATE_EMAIL))
                {
                    return Response::json(['erro'=>'Please provide a valid email address and try agian', 400, false]);
                }

                if (empty($params->password)) {
                    return Response::json(['error'=>'Password cannot be empty', 400, false]);
                }
                $user = User::query()->where('email', $params->email)->first(); //Checking if the provided email already existed in the DB
                if (!is_null($user)) {
                        return Response::json(['error'=>'This email address provided already exists. Please use a another email', 400, false]);
                    }
                //hashing the password  && Ensuring to keep this practice (tenary if you dont have the APP_KEY value on your .env file) backup incase the env file is missing this value
                $secretKey = empty(env('APP_KEY')) ? 'base64:UaY73KVgGOa99uFjacq29YLXZBqFGBund7YLahdDA5A=' : env('APP_KEY'); $hashedPassword = hash("sha256", trim($params->password) . $secretKey); $username = uniqid().rand(100,9999); //Hasing the supplied password
                //save the new user details
                $user = new User(); $user->email = $params->email; $user->password = $hashedPassword; $user->user_type = 2; $user->name = $params->name; $user->status = 1;
                $user->save();
                //Generate token for the user
                $token = $user->createToken(env('APP_KEY'))->plainTextToken;
                //Show the token or return it to a storage. Can store this in localstorage and use it to make request in headers
                return Response::json(['name'=>$params->name,'email'=>$params->email,'token'=>$token, 200, true]);

            } catch (\Exception $e) { return Response::json([$e->getMessage(), 400, false]);
        }
    }


    public function login(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(),
            [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if(!Auth::attempt($request->only(['email', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            $user = User::where('email', $request->email)->first();

            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
