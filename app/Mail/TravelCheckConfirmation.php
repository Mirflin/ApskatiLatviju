<?php

// namespace App\Mail;

// use Illuminate\Bus\Queueable;
// use Illuminate\Mail\Mailable;
// use Illuminate\Mail\Mailables\Content;
// use Illuminate\Mail\Mailables\Envelope;
// use Illuminate\Queue\SerializesModels;
// use App\Models\TravelCheck;
// use App\Models\Travel;

// class TravelCheckConfirmation extends Mailable
// {
//     use Queueable, SerializesModels;

//     public $check;
//     public $travel;

//     public function __construct(TravelCheck $check, Travel $travel)
//     {
//         $this->check = $check;
//         $this->travel = $travel;
//     }

//     public function envelope(): Envelope
//     {
//         return new Envelope(
//             subject: 'Jūsu ceļojuma čeka apstiprinājums',
//         );
//     }

//     public function content(): Content
//     {
//         return new Content(
//             view: 'emails.travel-check-confirmation',
//         );
//     }

//     public function attachments(): array
//     {
//         return [];
//     }
// }


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