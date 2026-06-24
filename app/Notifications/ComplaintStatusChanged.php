<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Complaint;

class ComplaintStatusChanged extends Notification
{
    use Queueable;

    public $complaint;
    public $oldStatus;

    public function __construct(Complaint $complaint, $oldStatus)
    {
        $this->complaint = $complaint;
        $this->oldStatus = $oldStatus;
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Complaint Status Updated - Barangay Complaints System')
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('Your complaint status has been updated.')
            ->line('Complaint Type: ' . $this->complaint->complaint_type)
            ->line('Previous Status: ' . $this->oldStatus)
            ->line('New Status: ' . $this->complaint->status)
            ->action('View Complaint', route('resident.complaints.show', $this->complaint))
            ->line('Thank you for using Barangay Complaints System!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'complaint_id' => $this->complaint->id,
            'complaint_type' => $this->complaint->complaint_type,
            'old_status' => $this->oldStatus,
            'new_status' => $this->complaint->status,
            'message' => 'Your complaint status has been updated to ' . $this->complaint->status,
        ];
    }
}
