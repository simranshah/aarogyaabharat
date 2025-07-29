<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:import {file : Path to the Excel/CSV file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import products from Excel/CSV file with optimized performance';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filePath = $this->argument('file');

        // Check if file exists
        if (!file_exists($filePath)) {
            $this->error("File not found: {$filePath}");
            return 1;
        }

        // Set unlimited execution time for command line
        set_time_limit(0);
        ini_set('memory_limit', '1G');

        $this->info("Starting product import from: {$filePath}");
        $this->info("This may take several minutes for large files...");

        try {
            $startTime = microtime(true);
            
            Excel::import(new ProductsImport, $filePath);
            
            $endTime = microtime(true);
            $executionTime = round($endTime - $startTime, 2);
            
            $this->info("✅ Products imported successfully!");
            $this->info("⏱️  Execution time: {$executionTime} seconds");
            
            return 0;
        } catch (\Exception $e) {
            $this->error("❌ Import failed: " . $e->getMessage());
            \Log::error('Product import command failed: ' . $e->getMessage());
            return 1;
        }
    }
} 