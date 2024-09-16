<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ShopMail extends Mailable
{
    use Queueable, SerializesModels;

    public $recipientName; // 受取人の名前
    public $fromAddress;   // 送信元メールアドレス
    public $fromName;      // 送信元名
    public $subject;       // 件名
    public $body;          // 本文
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($recipientName, $fromAddress, $fromName, $subject, $body)
    {
        $this->recipientName = $recipientName;
        $this->fromAddress = $fromAddress;
        $this->fromName = $fromName;
        $this->subject = $subject;
        $this->body = $body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.shop_mail')
        ->from($this->fromAddress, $this->fromName) // 送信元の設定
            ->subject($this->subject) // 件名の設定
            ->with([
                'name' => $this->recipientName, // 受取人の名前
                'body' => $this->body,          // 本文
            ]);
    }
}
