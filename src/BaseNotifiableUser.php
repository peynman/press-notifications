<?php

namespace Larapress\Notifications;

use Larapress\Notifications\Models\Notification;

trait BaseNotifiableUser {

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user_notifications() {
        return $this->hasMany(
            Notification::class,
            'user_id'
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function unseen_notifications() {
        return $this->user_notifications()
                    ->whereNotIn('status', [Notification::STATUS_DISMISSED, Notification::STATUS_SEEN]);
    }
}
