<?php

namespace App\Mail;

use App\Models\travel_check;
use App\Models\Travel;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TravelCheckConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $check;
    public $travel;

    public function __construct(travel_check $check, Travel $travel)
    {
        $this->check = $check;
        $this->travel = $travel;
    }

    public function build()
    {
        return $this->view('emails.travel-check-confirmation')
                    ->subject('Ceļojuma čeka apstiprinājums');
    }
}