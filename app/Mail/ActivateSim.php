<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActivateSim extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var Order
     */
    public $order;
    public $status;

    

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order, $status = null)
    {
        $this->order = $order;
        $this->status = $status;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        if ($this->status != 'error' ) {

            return $this->markdown('emails.activesim.activeSim')->subject('Tarjeta SIM activada con éxito');

        }else{

            return $this->markdown('emails.activesim.activeSimError')->subject('Error al Avtivar SIM ');

        }
    }

    
}