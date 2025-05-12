<?php

namespace App\Mail;

use App\Models\Staff;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StaffInvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $staff;

    public function __construct(Staff $staff)
    {
        $this->staff = $staff;
    }

    public function build()
    {
        return $this->subject('Staff Invitation')
            ->view('emails.staff-invitation')
            ->with([
                'url' => route('staff.confirm', ['email' => $this->staff->email]),
            ]);
    }
}
