<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use App\Mail\MagicLoginMail;
use App\Models\User;
use Tests\TestCase;

class MagicLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_request_login_link()
    {
        Mail::fake();
        $user = User::factory()->create();

        $response = $this->post('/login/magic', [
            'email' => $user->email,
        ]);

        $response->assertRedirect();

        Mail::assertSent(MagicLoginMail::class, function ($mail) use ($user) {
            return $mail->hasTo($user->email);
        });
    }


    public function test_user_can_login_with_valid_token()
    {
        $user = User::factory()->create();
        $token = $user->generateLoginToken();
        $user->save();

        $response = $this->get('/login/magic/' . $token);

        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_login_fails_with_invalid_token()
    {
        $response = $this->get('/login/magic/invalidtoken');

        $response->assertRedirect(route('login'));
        $this->assertGuest();
    }
}
