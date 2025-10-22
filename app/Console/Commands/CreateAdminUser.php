<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crmnow:create-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an admin user for CRMNOW';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->ask('Admin name', 'Admin');
        $email = $this->ask('Admin email', 'admin@crmnow.com');
        $password = $this->secret('Admin password (min 8 characters)');

        if (strlen($password) < 8) {
            $this->error('Password must be at least 8 characters long.');
            return 1;
        }

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
            'role' => 'admin',
        ]);

        $this->info("Admin user created successfully!");
        $this->info("Email: {$user->email}");
        $this->info("Role: {$user->role}");

        return 0;
    }
}
