<?php

namespace App\Mail;

use App\Models\Vendor;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VendorApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $vendor;

    /**
     * Create a new message instance.
     */
    public function __construct(Vendor $vendor)
    {
        $this->vendor = $vendor;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Your Vendor Account is Approved')
            ->view('emails.vendor-approved')
            ->with([
                'url' => route('vendor.password.setup', ['email' => $this->vendor->email]),
            ]);
    }
}