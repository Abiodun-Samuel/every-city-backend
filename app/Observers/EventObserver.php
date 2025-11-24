<?php

namespace App\Observers;

use App\Models\Event;

class EventObserver
{
    private function setStatus(Event $event)
    {
        $now = now();

        if ($event->ends_at < $now) {
            $event->status = 'past';
        } elseif ($event->starts_at > $now) {
            $event->status = 'upcoming';
        } else {
            $event->status = 'current';
        }
    }
    public function creating(Event $event): void
    {
        $this->setStatus($event);
    }

    public function updating(Event $event): void
    {
        $this->setStatus($event);
    }
}
