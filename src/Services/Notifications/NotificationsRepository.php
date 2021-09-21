<?php

namespace Larapress\Notifications\Services\Notifications;

use Larapress\Profiles\IProfileUser;
use Larapress\CRUD\Services\Pagination\PaginatedResponse;
use Larapress\Notifications\Models\Notification;

class NotificationsRepository implements INotificationsRepository
{
    /**
     * Undocumented function
     *
     * @param IProfileUser $user
     * @param int $page
     * @param int|null $limit
     *
     * @return PaginatedResponse
     */
    public function getUnseenNotificationsPaginated(IProfileUser $user, $page = 0, $limit = null)
    {
        $limit = PaginatedResponse::safeLimit($limit);
        return new PaginatedResponse(
            Notification::query()
                ->where('user_id', $user->id)
                ->where('status', Notification::STATUS_UNSEEN)
                ->paginate($limit, ['*'], 'page', $page)
        );
    }

    /**
     * Undocumented function
     *
     * @param IProfileUser $user
     * @param int $page
     * @param int|null $limit
     *
     * @return PaginatedResponse
     */
    public function getOldNotificationsPaginated(IProfileUser $user, $page = 0, $limit = null)
    {
        $limit = PaginatedResponse::safeLimit($limit);
        return new PaginatedResponse(
            Notification::query()
                ->where('user_id', $user->id)
                ->where('status', '!=', Notification::STATUS_UNSEEN)
                ->paginate($limit, ['*'], 'page', $page)
        );
    }
}
