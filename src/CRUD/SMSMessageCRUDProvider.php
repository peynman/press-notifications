<?php


namespace Larapress\Notifications\CRUD;

use Illuminate\Support\Facades\Auth;
use Larapress\CRUD\Services\BaseCRUDProvider;
use Larapress\CRUD\Services\ICRUDProvider;
use Larapress\CRUD\Services\IPermissionsMetadata;
use Larapress\Notifications\Models\SMSMessage;
use Larapress\Notifications\Services\SMSService\Jobs\SendSMS;

class SMSMessageCRUDProvider implements ICRUDProvider, IPermissionsMetadata
{
    use BaseCRUDProvider;

    public $name_in_config = 'larapress.notifications.routes.sms_messages.name';
    public $class_in_config = 'larapress.notifications.routes.sms_messages.model';
    public $verbs = [
        self::VIEW,
        self::CREATE,
        self::EDIT,
        self::DELETE,
        'send',
    ];
    public $createValidations = [
        'sms_gateway_id' => 'required|numeric|exists:sms_gateways,id',
        'flags' => 'nullable|numeric',
        'message' => 'required|string',
        'from' => 'required|string',
        'to' => 'required|numeric',
    ];
    public $updateValidations = [
        'sms_gateway_id' => 'required|numeric|exists:sms_gateways,id',
        'flags' => 'nullable|numeric',
        'message' => 'required|string',
        'from' => 'required|string',
        'to' => 'required|numeric',
    ];
    public $validSortColumns = [
        'id',
        'sms_gateway_id',
        'status',
        'created_at',
        'send_at',
        'delivered_at',
        'updated_at',
        'author_id'
    ];
    public $validRelations = [
        'sms_gateway',
        'author'
    ];
    public $searchColumns = [
        'equals:id',
        'equals:sms_gateway_id',
        'to',
        'from',
    ];

    /**
     * Undocumented function
     *
     * @param array $args
     * @return array
     */
    public function onBeforeCreate($args)
    {
        $args['author_id'] = Auth::user()->id;

        return $args;
    }

    /**
     * Undocumented function
     *
     * @param SMSMessage $object
     * @param array $input_data
     * @return void
     */
    public function onAfterCreate($object, $input_data)
    {
        SendSMS::dispatch($object);
    }

    /**
     * @param SMSMessage $object
     *
     * @return bool
     */
    public function onBeforeAccess($object)
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
    public function onBeforeQuery($query)
    {
        /** @var IProfileUser|ICRUDUser $user */
        $user = Auth::user();
        if (! $user->hasRole(config('larapress.profiles.security.roles.super-role'))) {
            $query->orWhere('author_id', $user->id);
        }

        return $query;
    }
}
