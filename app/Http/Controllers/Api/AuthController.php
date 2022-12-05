<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Perfil;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Create User
     * @param Request $request
     * @return User 
     */
    public function createUser(Request $request)
    {
        try {
            //Validated
            $validateUser = Validator::make($request->all(), 
            [
                'nombre' => 'required',
                'apellido' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'Error de validación',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $user = User::create([
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'rol_id' => 2
            ]);

            $perfil = Perfil::create([
                "usuario_id" => $user->id
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Usuario creado exitosamente',
                'token' => $user->createToken("API TOKEN")->plainTextToken,
                'user' => $user,
                'perfil_id' => $perfil->id
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    /**
     * Login The User
     * @param Request $request
     * @return User
     */
    public function loginUser(Request $request)
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
                    'message' => 'Error de validación',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if(!Auth::attempt($request->only(['email', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'El correo eléctronico y la contraseña no coinciden con nuestros registros',
                ], 401);
            }

            if(Auth::attempt($request->only(['email', 'password']))) {
                $user = User::where('email', $request->email)->first();
                $perfil = Perfil::where('usuario_id', $user->id)->first();

                return response()->json([
                    'status' => true,
                    'message' => 'Usario logeado correctamente',
                    'token' => $user->createToken("API TOKEN")->plainTextToken,
                    'user' => $user,
                    'perfil_id' => $perfil->id
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'No autorizado'
                ], 401);
            }

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message)
    {
    	$response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];


        return response()->json($response, 200);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];


        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }


        return response()->json($response, $code);
    }

}
