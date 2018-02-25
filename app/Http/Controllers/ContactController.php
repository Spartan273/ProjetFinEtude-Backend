<?php

namespace App\Http\Controllers;
// require 'vendors/autoload.php';
use Mail;
use Mailgun\Mailgun;

use Illuminate\Http\Request;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ContactController extends Controller
{


    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function postMail(Request $request) {

        $title = $request->input('title');
        $destinataire = $request->input('geny-g7@hotmail.com');
        $expediteur = $request->input('expediteur');
        $content = $request->input('content');



        Mail::send('send', ['title' => $title, 'content' => $content, 'expediteur' => $expediteur], function ($message) use ($destinataire)
        {

            $message->from(env('MAIL_USERNAME'));
            $message->subject('ShareTul: Demande de location');
            $message->to('sami273@live.ca');

        });

        return response()->json(['message' => 'Message envoyés!']);

    }
}
