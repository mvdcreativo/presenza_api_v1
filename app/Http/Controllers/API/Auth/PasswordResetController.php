<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Notifications\PasswordResetSuccess;
use App\User;
use App\PasswordReset;
use App\Mail\Notificaciones;
USE Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;



class PasswordResetController extends Controller
{




    /**
     * Create token password reset
     *
     * @param  [string] email
     * @return [string] message
     */
    public function create(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user){
            return response()->json([
                "message" => "No podemos encontrar un usuario con esa dirección de correo electrónico."
            ], 404);
        }
        $passwordReset = PasswordReset::updateOrCreate(
            ['email' => $user->email],
            [
                'email' => $user->email,
                'token' => Str::random(60)
             ]
        );
        if ($user && $passwordReset){

            $mail_destino = $user->email;
            $msg = [
                'subject' => 'Nueva Era - Restablecimiento de contraseña',
                'title' => 'Cambiamos tu contraseña?',
                'paragraph' => 'Enviamos este correo electrónico porque recibimos una solicitud de restablecimiento de contraseña para su cuenta. Esta solicitud es válida por 12hs.',
                'button' => [ 
                    'button_name' => 'Crear contraseña',
                    'button_link' => url('/api/password/find/'.$passwordReset->token)
                ]
            ];

            // Mail::to($mail_destino)->queue(new Notificaciones($msg));
            // // $user->notify(
            // //     new PasswordResetRequest($passwordReset->token)
            // // );

            // return response()->json([
            //     'message' => '¡Hemos enviado un enlace por correo electrónico!'
            // ]);
        }
    }





    /**
     * Find token password reset
     *
     * @param  [string] $token
     * @return [string] message
     * @return [json] passwordReset object
     */
    public function find($token)
    {
        $passwordReset = PasswordReset::where('token', $token)->first();
        if (!$passwordReset)
            return redirect()->away("https://nuevaerauruguay.com/acceder?error='Este token de restablecimiento de contraseña no es válido.'");
            // return response()->json([
            //     'message' => 'Este token de restablecimiento de contraseña no es válido.'
            // ], 404);
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();
            return redirect()->away("https://nuevaerauruguay.com/acceder?error='Este token de restablecimiento de contraseña no es válido.'");

            // return response()->json([
            //     'message' => 'Este token de restablecimiento de contraseña no es válido.'
            // ], 404);
        }
        return redirect()->away("https://nuevaerauruguay.com/acceder?email=".$passwordReset->email."&token=".$passwordReset->token);
        // return response()->json($passwordReset);
    }




     /**
     * Reset password
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @param  [string] token
     * @return [string] message
     * @return [json] user object
     */
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|confirmed',
            'token' => 'required|string'
        ]);
        $passwordReset = PasswordReset::where([
            ['token', $request->token],
            ['email', $request->email]
        ])->first();
        if (!$passwordReset)
            return response()->json([
                'message' => 'Este token de restablecimiento de contraseña no es válido.'
            ], 404);
        $user = User::where('email', $passwordReset->email)->first();
        if (!$user)
            return response()->json([
                'message' => 'No podemos encontrar un usuario con esa dirección de correo electrónico.'
            ], 404);
        $user->password = bcrypt($request->password);
        $user->save();
        $passwordReset->delete();
        // $user->notify(new PasswordResetSuccess($passwordReset));
        return response()->json([
            'message' => 'Contraseña actualizada correctamente.'
        ], 200); 
        // return response()->json($user);
    }
}