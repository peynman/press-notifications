<?php

namespace Larapress\Notifications\CRUD;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Larapress\CRUD\Exceptions\AppException;
use Larapress\CRUD\Services\CRUD\Traits\CRUDProviderTrait;
use Larapress\CRUD\Services\CRUD\ICRUDProvider;
use Larapress\CRUD\Services\CRUD\ICRUDVerb;
use Larapress\Notifications\Controllers\NotificationController;
use Larapress\Notifications\Models\Notification;

class NotificationCRUDProvider implements ICRUDProvider
{
    use CRUDProviderTrait;

    public $name_in_config = 'larapress.notifications.routes.notifications.name';
    public $model_in_config = 'larapress.notifications.routes.notifications.model';
    public $compositions_in_config = 'larapress.notifications.routes.notifications.compositions';

    public $validSortColumns = [
        'id',
        'status',
        'author_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public $filterFields = [
        'author_id' => 'equals:author_id',
        'user_id' => 'equals:user_id',
        'status' => 'equals:status',
    ];
    public $searchColumns = [
        'message',
        'title',
    ];

    /**
     * Undocumented function
     *
     * @return array
     */
    public function getPermissionVerbs(): array
    {
        return [
            ICRUDVerb::VIEW,
            ICRUDVerb::SHOW,
            ICRUDVerb::EDIT,
            ICRUDVerb::CREATE,
            ICRUDVerb::DELETE,
            ICRUDVerb::EXPORT => [
                'uses' => '\\'.NotificationController::class.'@exportNotificationUsers',
                'methods' => ['POST'],
                'url' => config('larapress.notifications.routes.notifications.name').'/export',
            ],
            'send' => [
                'uses' => '\\'.NotificationController::class.'@sendBatchNotification',
                'methods' => ['POST'],
                'url' => config('larapress.notifications.routes.notifications.name').'/send',
            ],
            'any.dismiss' => [
                'uses' => '\\'.NotificationController::class.'@dismissNotification',
                'methods' => ['POST'],
                'url' => config('larapress.notifications.routes.notifications.name').'/dismiss/{notification_id}'
            ],
            'any.view' => [
                'uses' => '\\'.NotificationController::class.'@viewNotification',
                'methods' => ['POST'],
                'url' => config('larapress.notifications.routes.notifications.name').'/view/{notification_id}'
            ],
        ];
    }

    /**
     * Undocumented function
     *
     * @return array
     */
    public function getValidRelations(): array
    {
        return [
            'user' => config('larapress.crud.user.provider'),
            'author' => config('larapress.crud.user.provider')
        ];
    }


    /**
     * Undocumented function
     *
     * @param Request $request
     * @return array
     */
    public function getCreateRules(Request $request): array
    {
        return [
            'flags' => 'nullable|numeric',
            'message' => 'required|string',
            'title' => 'required|string',
            'status' => 'required|numeric|in:'.implode(',', [
                Notification::STATUS_CREATED,
                Notification::STATUS_DISMISSED,
                Notification::STATUS_SEEN,
                Notification::STATUS_UNSEEN,
            ]),
            'data' => 'nullable|json_object',
        ];
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return array
     */
    public function getUpdateRules(Request $request): array
    {
        return $this->getCreateRules($request);
    }

    /**
     * Undocumented function
     *
     * @param array $args
     *
     * @return array
     */
    public function onBeforeCreate($args): array
    {
        $args['author_id'] = Auth::user()->id;

        $class = config('larapress.crud.user.model');
        /** @var IProfileUser */
        $targetUser = call_user_func([$class, 'find'], $args['user_id']);

        /** @var IProfileUser $user */
        $user = Auth::user();
        if ($user->hasRole(config('larapress.profiles.security.roles.customer'))) {
            if ($args['user_id'] !== $user->id) {
                throw new AppException(AppException::ERR_ACCESS_DENIED);
            }
        }
        if ($user->hasRole(config('larapress.profiles.security.roles.affiliate'))) {
            if (is_null($targetUser) || !in_array($targetUser->getMembershipDomainId(), $user->getAffiliateDomainIds())) {
                throw new AppException(AppException::ERR_ACCESS_DENIED);
            }
        }

        return $args;
    }

    /**
     * Undocumented function
     *
     * @param array $args
     * @return array
     */
    public function onBeforeUpdate($args): array
    {
        return $this->onBeforeCreate($args);
    }

    /**
     * @param Notification $object
     *
     * @return bool
     */
    public function onBeforeAccess($object): bool
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasRole(config('larapress.profiles.security.roles.super_role'))) {
            return $object->author_id === $user->id;
        }

        return true;
    }

    /**
     * Undocumented function
     *
     * @param Builder $query
     * @return Builder
     */
    public function onBeforeQuery(Builder $query): Builder
    {
        /** @var IProfileUser|ICRUDUser $user */
        $user = Auth::user();
        if (! $user->hasRole(config('larapress.profiles.security.roles.super_role'))) {
            $query->where('author_id', $user->id);
        }

        return $query;
    }
}
