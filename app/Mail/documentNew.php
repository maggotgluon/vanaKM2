<?php

namespace App\Mail;

use App\Models\document_request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class documentNew extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(document_request $doc)
    {
        //
        $this->doc = $doc;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $doc = $this->doc;
        return $this->subject('This is my Test Mail Subject')
                    ->view('mail.new', compact('article') );

        // return $this->view('view.name');
    }
}
