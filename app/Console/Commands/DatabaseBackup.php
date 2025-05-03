<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DatabaseBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:rundb';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup the database tables and their data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tables = DB::select('SHOW TABLES');
        $backupSql = '';
        
        foreach ($tables as $table) {
            $dbName = env('DB_DATABASE'); // or config('database.connections.mysql.database')
            $tableKey = 'Tables_in_' . $dbName;
            $tableName = $table->$tableKey;
            $createTable = DB::select("SHOW CREATE TABLE `$tableName`")[0]->{'Create Table'};
            $backupSql .= "$createTable;\n\n";
        
            $rows = DB::table($tableName)->get();
            foreach ($rows as $row) {
                $values = array_map(function ($val) {
                    return is_null($val) ? 'NULL' : "'" . addslashes($val) . "'";
                }, (array)$row);
                $backupSql .= "INSERT INTO `$tableName` VALUES (" . implode(',', $values) . ");\n";
            }
            $backupSql .= "\n\n";
        }
        
        // Create a unique filename with timestamp
        $filename = 'backup/backup_' . date('Y_m_d_His') . '.sql';
        Storage::put($filename, $backupSql);
        
        // OR use storage_path() to store directly in storage/app/
        // file_put_contents(storage_path("app/backup/$filename"), $backupSql);
    }
    
}
