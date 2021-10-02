<?php

namespace Larapress\Notifications\Services\Notifications;

use Larapress\Profiles\IProfileUser;
use Larapress\CRUD\Services\Pagination\PaginatedResponse;

interface INotificationsRepository {
    /**
     * Undocumented function
     *
     * @param IProfileUser $user
     * @param int $page
     * @param int|null $limit
     *
     * @return PaginatedResponse
     */
    public function getUnseenNotificationsPaginated(IProfileUser $user, $page = 1, $limit = null);

    /**
     * Undocumented function
     *
     * @param IProfileUser $user
     * @param int $page
     * @param int|null $limit
     *
     * @return PaginatedResponse
     */
    public function getOldNotificationsPaginated(IProfileUser $user, $page = 1, $limit = null);
}
