<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use App\Models\Comment;
use Livewire\Component;
use Illuminate\Http\Response;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\Notifiable;

class CommentNotifications extends Component
{

    // use Notifiable;

    const NOTIFICATION_TRESHOLD = 10;
    public $notifications;
    public $notificationCount;
    public $isLoading;

    protected $listeners = ['getNotifications'];

    public function mount()
    {
        $this->notifications = collect([]);
        $this->getNotificationCount();
        $this->isLoading = true;
    }

    public function getNotificationCount()
    {
        $this->notificationCount = auth()->user()->unreadNotifications->count();
        if ($this->notificationCount > self::NOTIFICATION_TRESHOLD) {
            $this->notificationCount = self::NOTIFICATION_TRESHOLD . '+';
        }
    }

    public function getNotifications()
    {
        $this->notifications = auth()->user()->unreadNotifications()->latest()->take(self::NOTIFICATION_TRESHOLD)->get();

        $this->isLoading = false;
    }

    public function render()
    {
        return view('livewire.comment-notifications');
    }

    public function markAllAsRead()
    {
        if (auth()->guest()) {
            abort(Response::HTTP_FORBIDDEN);
        }

        auth()->user()->unreadNotifications->markAsRead();
        $this->getNotificationCount();
        $this->getNotifications();
    }

    public function markAsRead($notificationId)
    {
        if (auth()->guest()) {
            abort(Response::HTTP_FORBIDDEN);
        }
        $notification = DatabaseNotification::findOrFail($notificationId);
        $notification->markAsRead();

        $this->scrollToNotification($notification);
    }

    protected function scrollToNotification($notification)
    {
        $idea = Idea::find($notification->data['idea_id']);
        if (!$idea) {
            session()->flash('error_message', 'The idea could not be found!');
            return redirect()->route('idea.index');
        }

        $comment = Comment::find($notification->data['comment_id']);
        if (!$comment) {
            session()->flash('error_message', 'The comment could not be found!');
            return redirect()->route('idea.index');
        }

        $indexOfComment = $idea->comments()->pluck('id')->search($comment->id);
        $page = (int) ($indexOfComment / $comment->getPerPage()) + 1;

        session()->flash('scrollToComment', $comment->id);

        return redirect()->route('idea.show', [
            'idea' => $notification->data['idea_slug'],
            'page' => $page
        ]);
    }
}
