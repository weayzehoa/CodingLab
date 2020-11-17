<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminSendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.mails.contents.adminsendmailbody');
                    // ->from($this->details['from'], $this->details['name'])
                    // ->subject($this->details['subject'])
                    // ->text('emails.orders.shipped_plain')
                    // ->with([
                    //     'Name' => $this->details->name,
                    //     'Text' => $this->details->text,
                    // ])
                    // ->attach('/path/to/file')
                    // ->attach('/path/to/file', [
                    //     'as' => 'name.pdf',
                    //     'mime' => 'application/pdf',
                    // ])
                    // ->attachFromStorage('/path/to/file')
                    // ->attachFromStorage('/path/to/file', 'name.pdf', [
                    //     'mime' => 'application/pdf'
                    // ])
                    // ->attachFromStorageDisk('s3', '/path/to/file')
                    // ->attachData($this->pdf, 'name.pdf', [
                    //     'mime' => 'application/pdf',
                    // ])
    }
}
