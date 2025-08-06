<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Mail\WelcomeEmail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WelcomeEmailTest extends TestCase
{
    use RefreshDatabase;

    public function test_welcome_email_can_be_sent()
    {
        Mail::fake();

        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Mail::to($user->email)->send(new WelcomeEmail($user));

        Mail::assertSent(WelcomeEmail::class, function ($mail) use ($user) {
            return $mail->hasTo($user->email) &&
                   $mail->user->id === $user->id;
        });
    }

    public function test_welcome_email_has_correct_subject()
    {
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        $mailable = new WelcomeEmail($user);

        $this->assertEquals('Welcome to Aarogya Bharat, John Doe!', $mailable->envelope()->subject);
    }

    public function test_welcome_email_contains_user_data()
    {
        $user = User::factory()->create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
        ]);

        $mailable = new WelcomeEmail($user);

        $this->assertEquals($user, $mailable->user);
    }
} 