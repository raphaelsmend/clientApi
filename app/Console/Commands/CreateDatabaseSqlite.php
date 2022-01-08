<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Exception;

class CreateDatabaseSqlite extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create-database:sqlite {database}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Database Sqlite';

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        $database = $this->argument('database');

        try {
            $databasePath = database_path("sqlite/{$database}.sqlite3");
            copy(database_path('sqlite/example.sqlite3'), $databasePath);
            chmod($databasePath, 755);

            $this->info(sprintf('Successfully created %s database sqlite', $database));
        } catch (Exception $exception) {
            $this->error(sprintf('Failed to create %s database sqlite, %s', $database, $exception->getMessage()));
        }
    }
}
