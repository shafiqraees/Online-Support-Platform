<?php

namespace App\Jobs;

use App\Mail\TicketResolveMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class TicketResolveJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $data;
    protected $packet;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data,$packet)
    {
        $this->data = $data;
        $this->packet = $packet;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = $this->data;
        $packet = $this->packet;
        if(isset($data->customer->email)) {
            Mail::to($data->customer->email)->send(new TicketResolveMail($data,$packet));
        }
    }
}
