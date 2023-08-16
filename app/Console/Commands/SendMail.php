<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Mail\MailSend;
use Illuminate\Console\Command;

class SendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $emails = User::pluck('email')->toArray();
        $data =['titles' => 'Hello World','body' =>'so bad'];
        foreach ($emails as $email){
            Mail::to($email)->send(new MailSend($data));
        }
    }
}
