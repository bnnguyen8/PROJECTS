<?php

namespace App\Jobs;

use App\Mail\OrderShipped;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

// php artisan make:job SendMail to create this file

// php artisan queue:table
// php artisan migrate
// to create table jobs

// change QUEUE_CONNECTION=sync to QUEUE_CONNECTION=database in .env file
// composer dump-autoload to update autoload when you change .env file

// change values in MAIL_MAILER, MAIL_HOST, MAIL_PORT, MAIL_USERNAME, MAIL_PASSWORD, MAIL_ENCRYPTION, MAIL_FROM_ADDRESS, MAIL_FROM_NAME in .env file
// https://myaccount.google.com/apppasswords
// php artisan config:cache

// php artisan queue:work run this in a new terminal to observe the queue


class SendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email)
    {
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // nếu muốn truyền dữ liệu vào OrderShipped thì bỏ vào object
        // ở đây và trong class thì khởi tạo __construct($data) và truyền vào
        Mail::to($this->email)->send(new OrderShipped());
    }
}
