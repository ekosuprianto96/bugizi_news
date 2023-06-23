<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SubsriberNotif extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct($data, $category)
    {
        return $this->data = [
            'data' => $data,
            'category' => $category
        ];
    }

    public function build()
    {
        return $this->subject('New Post')
            ->view('blog.mails.post', [
                'data' => $this->data['data'],
                'category' => $this->data['category']
            ]);
    }
}
