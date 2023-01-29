<?php

namespace App\Services;

use Illuminate\Mail\Mailable;

interface EmailServiceInterface
{
    /**
     * @param string $email
     * @param Mailable $mailable
     * @return bool
     */
    public function sendEmail(string $email, Mailable $mailable);
}
