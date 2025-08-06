<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\RentalOrder;
use App\Mail\RentalConfirmationMail;
use Illuminate\Support\Facades\Mail;

class SendRentalConfirmationEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rental:send-confirmation {order_id} {email?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send rental confirmation email for a specific order';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $orderId = $this->argument('order_id');
        $email = $this->argument('email');

        try {
            $order = RentalOrder::with(['product', 'user', 'rentalAddress'])
                ->find($orderId);

            if (!$order) {
                $this->error("Rental order with ID {$orderId} not found!");
                return 1;
            }

            // If email is provided, override the user's email
            if ($email) {
                $order->user->email = $email;
            }

            $this->info("Sending rental confirmation email to: {$order->user->email}");
            
            Mail::to($order->user->email)->send(new RentalConfirmationMail($order));
            
            $this->info("Rental confirmation email sent successfully!");
            
            return 0;
        } catch (\Exception $e) {
            $this->error("Failed to send email: " . $e->getMessage());
            return 1;
        }
    }
}
