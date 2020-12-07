<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TempNotificationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailData)
    {
        $this->data =  $mailData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $recipients = array_map('trim', explode(',', $this->data['settings_data']['notification_emails']));
        return $this->from($this->data['settings_data']['email_from'])
            ->subject('Alert Noticiation Email')
            ->to($recipients)
            ->view('admin.pages.mails.temp-notification-mail', $this->data);
    }
}
