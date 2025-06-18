<?php

namespace App\Mail;

use App\Models\Services_check;
use App\Models\Service;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class ServiceCheckConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $check;
    public $service;

    public function __construct(Services_check $check, Service $service)
    {
        $this->check = $check;
        $this->service = $service;
    }

    public function build()
    {
        return $this->subject('Pakalpojuma čeka apstiprinājums')
                    ->view('emails.service-check-confirmation');
    }
}