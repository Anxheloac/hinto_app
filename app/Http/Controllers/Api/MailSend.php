<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\SendPostsMail;
use App\Mail\UserPosts as UserPostsMail;
use App\Models\User\User;
use App\Services\EmailServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class MailSend extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $inputMail = $request->input_email;

        SendPostsMail::dispatch($inputMail);

        return response()->json([], Response::HTTP_ACCEPTED);
    }
}
