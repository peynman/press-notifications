<?php


namespace Larapress\Notifications\CRUD;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Larapress\CRUD\Services\CRUD\Traits\CRUDProviderTrait;
use Larapress\CRUD\Services\CRUD\ICRUDProvider;
use Larapress\CRUD\Services\CRUD\ICRUDVerb;
use Larapress\CRUD\Services\RBAC\IPermissionsMetadata;
use Larapress\Notifications\Models\SMSMessage;
use Larapress\Notifications\Services\SMSService\Jobs\SendSMS;

class SMSMessageCRUDProvider implements ICRUDProvider
{
    use CRUDProviderTrait;

    public $name_in_config = 'larapress.notifications.routes.sms_messages.name';
    public $model_in_config = 'larapress.notifications.routes.sms_messages.model';
    public $compositions_in_config = 'larapress.notifications.routes.sms_messages.compositions';

    public $verbs = [
        ICRUDVerb::VIEW,
        ICRUDVerb::CREATE,
        ICRUDVerb::EDIT,
        ICRUDVerb::DELETE,
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
        'author_id',
        'sms_gateway_id',
        'status',
        'created_at',
        'send_at',
        'delivered_at',
        'updated_at',
        'deleted_at',
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
     * @return array
     */
    public function getValidRelations(): array
    {
        return [
            'sms_gateway' => config('larapress.notifications.routes.sms_gateways.provider'),
            'author' => config('larapress.crud.user.provider'),
            'user' => config('larapress.crud.user.provider'),
        ];
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

        return $args;
    }

    /**
     * Undocumented function
     *
     * @param SMSMessage $object
     * @param array $input_data
     *
     * @return void
     */
    public function onAfterCreate($object, array $input_data): void
    {
        SendSMS::dispatch($object);
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
        if (!$user->hasRole('super-role')) {
            return $object->author_id === $user->id;
        }

        return true;
    }

    /**
     * Undocumented function
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function onBeforeQuery(Builder $query): Builder
    {
        /** @var IProfileUser|ICRUDUser $user */
        $user = Auth::user();
        if (! $user->hasRole(config('larapress.profiles.security.roles.super_role'))) {
            $query->orWhere('author_id', $user->id);
        }

        return $query;
    }
}
