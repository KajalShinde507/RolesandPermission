<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;
use App\Book;
class SendEmail extends Mailable
{
    use Queueable, SerializesModels;
     public $book;
     //public $job;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($book)
    {
       // $this->job = $job;
       $this->book =$book;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.test')->with('status','mail sent');
        
                    
    }
}
