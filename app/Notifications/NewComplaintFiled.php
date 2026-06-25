<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Complaint;

class NewComplaintFiled extends Notification
{
    use Queueable;

    public $complaint;

    public function __construct(Complaint $complaint)
    {
        $this->complaint = $complaint;
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Complaint Filed - Barangay Complaints System')
            ->greeting('Hello Admin!')
            ->line('A new complaint has been filed in the system.')
            ->line('Filed by: ' . $this->complaint->complainant->name)
            ->line('Complaint Type: ' . $this->complaint->complaint_type)
            ->line('Respondent: ' . $this->complaint->respondent_name)
            ->action('View Complaint', route('admin.complaints.index'))
            ->line('Please review and take appropriate action.');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'complaint_id' => $this->complaint->id,
            'complaint_type' => $this->complaint->complaint_type,
            'complainant_name' => $this->complaint->complainant->name,
            'respondent_name' => $this->complaint->respondent_name,
            'message' => 'New complaint filed by ' . $this->complaint->complainant->name,
        ];
    }
}
