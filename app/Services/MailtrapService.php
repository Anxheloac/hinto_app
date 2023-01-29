<?php

namespace App\Services;

use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

class MailtrapService implements EmailServiceInterface
{
    /**
     * @param string $email
     * @param Mailable $mailable
     * @return bool
     */
    public function sendEmail(string $email, Mailable $mailable)
    {
        if (config('queue.default') == 'sync') {
            $sent = Mail::to($email)->send($mailable);
        } else {
            $sent = Mail::to($email)->queue($mailable);
        }

        return $sent;
    }
}
