<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use App\Mail\SendEmail;
use User;
use Mail;
use App\Book;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $book;
    public $timeout=100;
    //public $job;
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($book)
    {
        
       $this->book=$book;
         
       
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $book= Book::select('bookname')            
        ->orderBy('price', 'desc')   
        ->take(5)                
        ->get();
    
       
       Mail::to('kajalshinde507@gmail.com')->send(new SendEmail($book));
       //print_r($book);
      //var_dump('books data'.$this->book);
       //dd(config('queue.default'));
    

      
    }
    
}
