<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\TruckerMail;

class SendEmailJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $emails;

    public function __construct(array $emails)
    {
        $this->emails = $emails;
    }

    public function handle()
    {
        foreach ($this->emails as $item) {
            Mail::to($item['email'])->send(new TruckerMail($item['subject']));
        }
    }
}
