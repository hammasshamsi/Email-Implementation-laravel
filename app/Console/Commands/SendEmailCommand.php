<?php

namespace App\Console\Commands;

use App\Mail\UserEmail;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-email-command';

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
        $users = User::all();

        if($users->isEmpty()){
            $this->error('Users Not Found');
            return 1;
        }

        foreach ($users as $user){
            Mail::to($user->email)->send(new UserEmail());
            $this->info('Email to: ' . $user->email . 'sent successfully');
        }
        return 0;
    }
}
