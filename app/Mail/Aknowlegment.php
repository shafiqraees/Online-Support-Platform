<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Aknowlegment extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;
    protected $packet;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('malikshafiq@gmail.com', 'Online Support Platform')
            ->subject('Support Platform')
            ->markdown('emails.acknowledgement')
            ->with([
                'data' => $this->data,
            ]);
    }
}
