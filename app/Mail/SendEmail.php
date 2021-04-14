<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $content;
    public $subject;
    public $provider;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($content, $subject,$provider)
    {
        $this->content = $content;
        $this->subject = $subject;
        $this->provider =$provider;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)
            ->view('email.index', [
                'test' => $this->content,
                'provider' => $this->provider,
            ]);
    }
}
