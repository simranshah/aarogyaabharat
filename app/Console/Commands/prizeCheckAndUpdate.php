<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Admin\Product;

class prizeCheckAndUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:prize-check-and-update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $products = Product::all();
        foreach ($products as $product) {
            $product->our_price = $product->original_price - ($product->original_price * $product->discount_percentage / 100);
            $product->save();
        }
        $this->info('Product prices updated successfully.');
    }
}
