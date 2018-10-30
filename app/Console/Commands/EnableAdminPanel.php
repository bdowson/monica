<?php

namespace App\Console\Commands;

use App\Models\User\User;
use Illuminate\Console\Command;

class EnableAdminPanel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:enable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Enable admin panel for user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Prompt for user_id
        $user = $this->ask('What is the user\'s ID?');

        $user = User::find($user);

        // Show an error and exit if the user does not exist
        if (!$user) {
            $this->error('No user with that ID.');
            return;
        }

        // Set user to admin
        $user->is_admin = 1;
        $user->save();

        // Set user account to admin
        $user->Account->admin_panel = 1;
        $user->Account->save();

        $this->info('User ' . $user->getNameAttribute() . ' is now an admin');
    }
}