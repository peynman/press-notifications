<?php

namespace Larapress\Notifications\CRUD;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Larapress\CRUD\Services\CRUD\Traits\CRUDProviderTrait;
use Larapress\CRUD\Services\CRUD\ICRUDProvider;
use Larapress\CRUD\Services\CRUD\ICRUDVerb;
use Larapress\CRUD\Services\RBAC\IPermissionsMetadata;

class NotificationCRUDProvider implements ICRUDProvider
{
    use CRUDProviderTrait;

    public $name_in_config = 'larapress.notifications.routes.notifications.name';
    public $model_in_config = 'larapress.notifications.routes.notifications.model';
    public $compositions_in_config = 'larapress.notifications.routes.notifications.compositions';

    public $verbs = [
        ICRUDVerb::VIEW,
        'send',
    ];
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
        'equals:id',
        'message',
        'title',
    ];

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
     * @param SMSMessage $object
     *
     * @return bool
     */
    public function onBeforeAccess($object): bool
    {
        /** @var User $user */
        $user = Auth::user();
        if (! $user->hasRole('super-role')) {
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
