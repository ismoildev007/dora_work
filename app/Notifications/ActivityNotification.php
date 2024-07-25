<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Activity as ActivityModel;

class ActivityNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $activity;

    /**
     * Create a new notification instance.
     */
    public function __construct(ActivityModel $activity)
    {
        $this->activity = $activity;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'id' => $this->activity->id,
            'description' => $this->activity->description,
            'activity_type' => $this->activity->activity_type,
            'activity_date' => $this->activity->activity_date,
            'staff_id' => $this->activity->staff_id,
            'client_id' => $this->activity->client_id,
            'project_id' => $this->activity->project_id,
        ];
    }
}
