<?php


namespace App\Mail;

use App\Models\reguser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailNotify extends Mailable
{
    use Queueable, SerializesModels;
    
    public $user;

    /**
     * Create a new message instance.
     *
     * @param User $user
     */
    public function __construct(reguser $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        try {
            return $this->to('WebApp@example.com')
                        ->subject('New User Registered')
                        ->view('emails.new_user_notification'); // Assuming you have a view named 'emails.new_user_notification.blade.php'
        } 
        catch (\Exception $e) {
            // Log any errors that occur during email building
            Log::error('Error building email: ' . $e->getMessage());
            // Return null or any other fallback behavior you want
            return null;
        }
        // return $this->to('WebApp@example.com')
        //             ->subject('New User Registered')
        //             ->view('emails.new_user_notification'); // Assuming you have a view named 'emails.new_user_notification.blade.php'
    }
}






// namespace App\Mail;

// use App\Models\User;
// use Illuminate\Bus\Queueable;
// use Illuminate\Contracts\Queue\ShouldQueue;
// use Illuminate\Mail\Mailable;
// use Illuminate\Mail\Mailables\Content;
// use Illuminate\Mail\Mailables\Envelope;
// use Illuminate\Queue\SerializesModels;

// class MailNotify extends Mailable
// {
//     use Queueable, SerializesModels;

//     public $user;

//     /**
//      * Create a new message instance.
//      *
//      * @param User $user
//      */
//     public function __construct(User $user)
//     {
//         $this->user = $user;
//     }


//     /**
//      * Get the message envelope.
//      */
//     public function envelope(): Envelope
//     {
        
//         return new Envelope(
//             from: new Address('laravele6@gmail.com', 'Registeration App'),
//             subject: 'Mail Notify',
//         );
//     }

//     /**
//      * Get the message content definition.
//      */
//     public function content(): Content
//     {
//         return new Content(
//             view: 'emails.new_user_notification',
//         );
//     }

//     /**
//      * Get the attachments for the message.
//      *
//      * @return array<int, \Illuminate\Mail\Mailables\Attachment>
//      */
//     public function attachments(): array
//     {
//         return [];
//     }
// }
