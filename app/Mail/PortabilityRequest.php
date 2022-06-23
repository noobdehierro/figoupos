<?php

namespace App\Mail;

use App\Models\Portability;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PortabilityRequest extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The portability instance.
     *
     * @var Portability
     */
    public $portability;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Portability $portability)
    {
        $this->portability = $portability;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.portabilities.request');
    }
}
