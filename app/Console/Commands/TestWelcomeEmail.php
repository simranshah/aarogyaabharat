<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\WelcomeEmail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class TestWelcomeEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:test-welcome {email?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test the welcome email functionality';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        
        if (!$email) {
            $email = $this->ask('Enter email address to test:');
        }

        // Check if user exists
        $user = User::where('email', $email)->first();
        
        if (!$user) {
            $this->error("User with email {$email} not found!");
            return 1;
        }

        $this->info("Sending welcome email to: {$email}");
        
        try {
            Mail::to($email)->send(new WelcomeEmail($user));
            $this->info('Welcome email sent successfully!');
            return 0;
        } catch (\Exception $e) {
            $this->error('Failed to send welcome email: ' . $e->getMessage());
            return 1;
        }
    }
} 