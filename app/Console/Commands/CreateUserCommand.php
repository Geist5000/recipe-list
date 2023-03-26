<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new user in the database';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $username = $this->ask("What should be the username?");
        while (User::query()->whereUsername($username)->exists()) {
            $username = $this->ask("This usename is already taken.\nWhat should be the username?");
        }
        $password = $this->ask("What should be the password");

        $user = new User();
        $user->username = $username;
        $user->password = Hash::make($password);
        $user->save();
    }
}
