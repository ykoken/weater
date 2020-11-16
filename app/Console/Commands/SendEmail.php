<?php

namespace App\Console\Commands;

use App\Jobs\EmailJob;
use App\Mail\WeaterSendEmail;
use App\Models\Weater;
use App\User;
use Illuminate\Queue\Jobs\Job;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmail extends Command
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
    protected $description = 'Weater Send Email Process';

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
        try {
            $getUsers = User::with('favorites')->get();
            foreach ($getUsers as $getUser) {
                if (!empty($getUser->favorites)) {
                    foreach ($getUser->favorites as $favorite) {
                        $getCityWeater = Weater::where('id', $favorite->city_id)->first();
                        Mail::queue(new WeaterSendEmail($getUser->email, $getCityWeater));
                        EmailJob::dispatch($getUser->mobile_number, $getCityWeater);
                    }
                }
            }

            $this->info('Email and Notification Pushed');
        } catch (Exception $e) {
            $this->error($e->getMessage());
            \Log::error($e);
        }


    }
}
