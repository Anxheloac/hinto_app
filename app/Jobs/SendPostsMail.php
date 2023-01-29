<?php

namespace App\Jobs;

use App\Mail\UserPosts as UserPostsMail;
use App\Models\User\User;
use App\Services\EmailServiceInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendPostsMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var string
     */
    protected ?string $inputMail;

    /**
     * Create a new job instance.
     * @param string $inputMail
     * @return void
     */
    public function __construct(string $inputMail = null)
    {
        $this->inputMail = $inputMail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(EmailServiceInterface $emailService)
    {
        $users = User::with(['posts' => function ($query) {
            $query->limit(3);
        }])->get();

        $mailable = new UserPostsMail($users);
        $emailService->sendEmail($this->inputMail ?? config('mail.posts_mail.reciever'), $mailable);
    }
}
