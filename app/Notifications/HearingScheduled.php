<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Hearing;

class HearingScheduled extends Notification
{
    use Queueable;

    public $hearing;

    public function __construct(Hearing $hearing)
    {
        $this->hearing = $hearing;
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Hearing Scheduled - Barangay Complaints System')
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('A hearing has been scheduled for your complaint.')
            ->line('Complaint Type: ' . $this->hearing->complaint->complaint_type)
            ->line('Hearing Date: ' . $this->hearing->hearing_date->format('F d, Y'))
            ->line('Hearing Time: ' . $this->hearing->hearing_time)
            ->action('View Details', route('resident.complaints.show', $this->hearing->complaint))
            ->line('Please make sure to attend the hearing on the scheduled date and time.');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'hearing_id' => $this->hearing->id,
            'complaint_id' => $this->hearing->complaint_id,
            'complaint_type' => $this->hearing->complaint->complaint_type,
            'hearing_date' => $this->hearing->hearing_date->format('F d, Y'),
            'hearing_time' => $this->hearing->hearing_time,
            'message' => 'A hearing has been scheduled for ' . $this->hearing->hearing_date->format('F d, Y') . ' at ' . $this->hearing->hearing_time,
        ];
    }
}
