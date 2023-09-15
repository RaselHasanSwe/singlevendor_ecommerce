<?php

namespace App\Jobs;

use App\Mail\OrderComplete as MailOrderComplete;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class OrderComplete implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( public string $body, public string $to, public string | null $filePath )
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() : void
    {
        Mail::to($this->to)
            ->send( new MailOrderComplete(body:$this->body, filePath:$this->filePath));
    }
}
