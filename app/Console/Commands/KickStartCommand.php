<?php

namespace App\Console\Commands;

use App\Actions\KickStart\CreateAdminAction;
use Illuminate\Console\Command;

class KickStartCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:kick-start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make an application out of the box.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        if(\Cache::get('app:kick-started')) {
            $this->error('Application already kick started.');
            return -1;
        }

        $this->info('Kick starting the application...');
        $this->info("Creating admin user...");

        $this->info("Enter the admin's email:");
        $email = $this->ask('Email');

        $this->info("Enter the admin's password:");
        $password = $this->secret('Password');

        if(!CreateAdminAction::make($email, $password)) {
            $this->error("Admin user creation failed.");
            return -2;
        }

        $this->info("Admin user created successfully.");

        \Cache::forever('app:kick-started', true);
        return 0;
    }
}
