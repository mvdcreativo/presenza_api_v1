<?php

namespace App\Http\Controllers\Api;

use App\Mail\MessageContact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Support\Facades\Log;
USE Illuminate\Support\Facades\Mail;

class MessageController extends Controller
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
    public function __invoke(Request $request)
    {
        $msg = $request->validate([
            'name'=> 'required',
            'email'=> 'required|email',
            'phone'=> 'required',
            'message'=> 'required|min:3',
            'property'=> 'nullable'
        ]);



        $message= new Message;
        $message->name = $request->name;
        $message->email = $request->email;
        $message->phone = $request->phone;
        $message->message = $request->message;
        $message->save();

        $mail_destino = "presenzaprop@gmail.com";


        try {
            Mail::to($mail_destino)

            ->queue(new MessageContact($msg));
            // Notification::route('mail', $mail_destino)->notify(new ContatNotification($msg));

        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json("mensaje error", 500);

        }

        return response()->json("mensaje enviado", 200);

    }


}
