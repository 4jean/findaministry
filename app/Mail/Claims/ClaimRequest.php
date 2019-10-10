<?php

namespace App\Mail\Claims;

use App\Models\Claim;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ClaimRequest extends Mailable
{
    use Queueable, SerializesModels;

  protected $claim;
    public function __construct(Claim $claim)
    {
        $this->claim = $claim;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data['claim'] = $this->claim;
        return $this->view('emails.claim.new', $data)
            ->subject('New Claim Request')
            ->attach(Storage::path($this->claim->url));
    }
}
