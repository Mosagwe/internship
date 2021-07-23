<?php

namespace App\Notifications;

use App\Models\Payroll;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProcessedPayrollNotification extends Notification
{
    use Queueable;

    /**
     * @var Payroll
     */
    private $payroll;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Payroll $payroll)
    {
        $this->payroll=$payroll;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Payroll Processed Notification')
            ->markdown('mail.payrolls.processed',[
                'user'=>$notifiable,
                'payroll'=>$this->payroll
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
