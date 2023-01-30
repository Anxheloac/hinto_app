<?php

namespace Tests\Feature;

use App\Mail\UserPosts as UserPostsMail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class EmailSendTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_send_mail_successful()
    {
        Mail::fake();
        $response = $this->postJson(route('api.mail.post'));

        // Assert that a mailable was sent...
        Mail::assertQueued(UserPostsMail::class, function ($mail) {
            $testUser = !empty($mail->users) ? $mail->users->first(): null;
            if ($testUser) {
                //Check that there were 3 posts sent for each user
                return $testUser->posts->count() == 3;
            }

            return false;
        });

        $response->assertStatus(202);
    }
}
