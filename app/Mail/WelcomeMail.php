<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Attachment;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public User $user , public $password)
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'بلاگ زین - خوش امدید',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.welcome',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
           Attachment::fromUrl('https://www.google.com/search?sca_esv=16b93b4960e2b313&rlz=1C1GCEA_enIR1034IR1034&sxsrf=AE3TifPIMelxtDIHNC7_isBZpSfoh8_Kcw:1765995762402&udm=2&fbs=AIIjpHzAx70LpVteQ3HFTBH-UbSXkJwSfrgFwbmI2z_c8Q7HSS2O4cDcLOjOeFfJWyOVljWNGsc9caU_MduyA8kBQ_WbohziVIG62mNi2jgdtkKVb4vEO1B5v43DUe_h0ayXzDh2Hpu1IRwlmFflxtHYkQaGJpDjaHQ6jcbfWer42WAb0uH6EejVy7pRbXPoncpn8TwEf8m2mrxPB-U-u2nDaB_FB4KA8HnhT-pP14BJTZMo_BRX5oE&q=%D8%B9%D8%A7%D9%85%D8%B1+%D8%AE%D8%A7%D9%86&sa=X&sqi=2&ved=2ahUKEwjD5N7wnsWRAxWRVPEDHWKKJ0wQtKgLegQIFBAB#sv=CAMSVhoyKhBlLVJydlNXQkxzd2g5RkVNMg5ScnZTV0JMc3doOUZFTToOQ0ljQWpuWXZmLU1BeE0gBCocCgZtb3NhaWMSEGUtUnJ2U1dCTHN3aDlGRU0YADABGAcg3a-B3QEwAkoKCAEQAhgCIAIoAg')
        ];
    }
}
