<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class DepositReceiptSubmitted extends Notification
{
    use Queueable;

    public $application;

    public function __construct($application)
    {
        $this->application = $application;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'A new deposit receipt has been submitted for review.',
            'application_id' => $this->application->id,
            'transaction' => $this->application->transaction,
            'applicant' => $this->application->applicant,
            'created_at' => now()->toDateTimeString(),
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'application_id' => $this->application->id,
            'applicant' => $this->application->applicant,
            'message' => 'A new deposit receipt has been submitted for review',
        ];
    }


    public function toMail($notifiable)
    {
            return (new MailMessage)
            ->subject('New Deposit Receipt Submitted')
                ->view('emails.deposit-rciept', [
                    'application' => $this->application,
                    'notifiable' => $notifiable
                ]);
    }
}