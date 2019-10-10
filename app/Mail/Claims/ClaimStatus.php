<?php

namespace App\Mail\Claims;

use App\Models\Claim;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClaimStatus extends Mailable
{
    use Queueable, SerializesModels;

    protected $claim;
    public function __construct($claim_id)
    {
        $this->claim = Claim::find($claim_id);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = $this->claim->approved ? 'Your Claim Has Been Approved' : 'Your Claim Was Rejected';
        $data['claim'] = $this->claim;
        return $this->view('emails.claim.status', $data)
            ->subject($subject);
    }
}
