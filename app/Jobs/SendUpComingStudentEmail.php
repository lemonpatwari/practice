<?php

namespace App\Jobs;

use App\Mail\SendEmail;
use App\Models\Provider;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;

class SendUpComingStudentEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $provider;
    protected $email;
    protected $content;
    protected $campaign_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($provider, $email, $content, $campaign_id)
    {
        $this->provider = $provider;
        $this->email = $email;
        $this->content = $content;
        $this->campaign_id = $campaign_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->email)->queue(
            new SendEmail($this->content, 'subject',$this->provider)
        );
    }
}
