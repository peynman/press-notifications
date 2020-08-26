<?php


namespace Larapress\Notifications\CRUD;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Larapress\CRUD\Services\BaseCRUDProvider;
use Larapress\CRUD\Services\ICRUDProvider;
use Larapress\CRUD\Services\IPermissionsMetadata;
use Larapress\Notifications\Models\Notification;

class NotificationCRUDProvider implements ICRUDProvider, IPermissionsMetadata
{
	use BaseCRUDProvider;

    public $name_in_config = 'larapress.notifications.routes.notifications.name';
    public $verbs = [
        self::VIEW,
        'send',
    ];
    public $model = Notification::class;
	public $validSortColumns = [
        'id',
        'status',
        'created_at',
        'author_id',
        'status'
    ];
	public $validRelations = [
        'author'
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
	public $defaultShowRelations = [
        'author',
        'user',
    ];

	/**
	 * @param SMSMessage $object
	 *
	 * @return bool
	 */
	public function onBeforeAccess( $object )
	{
		/** @var User $user */
		$user = Auth::user();
		if (!$user->hasRole('super-role')) {
			return $object->author_id === $user->id;
		}

		return true;
	}

    /**
     * Undocumented function
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return Illuminate\Database\Eloquent\Builder
     */
	public function onBeforeQuery( $query )
	{
        /** @var IProfileUser|ICRUDUser $user */
        $user = Auth::user();
        if (! $user->hasRole(config('larapress.profiles.security.roles.super-role'))) {
            $query->orWhere('author_id', $user->id);
        }

		return $query;
	}
}
