<?php


namespace Larapress\Notifications\CRUD;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Larapress\CRUD\Exceptions\AppException;
use Larapress\CRUD\Services\CRUD\Traits\CRUDProviderTrait;
use Larapress\CRUD\Services\CRUD\ICRUDProvider;
use Larapress\CRUD\Services\CRUD\ICRUDVerb;
use Larapress\Notifications\Controllers\SMSMessageController;
use Larapress\Notifications\Models\SMSMessage;
use Larapress\Notifications\Services\SMSService\Jobs\SendSMS;
use Larapress\Profiles\Models\PhoneNumber;

class SMSMessageCRUDProvider implements ICRUDProvider
{
    use CRUDProviderTrait;

    public $name_in_config = 'larapress.notifications.routes.sms_messages.name';
    public $model_in_config = 'larapress.notifications.routes.sms_messages.model';
    public $compositions_in_config = 'larapress.notifications.routes.sms_messages.compositions';

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
    public function getPermissionVerbs(): array
    {
        return [
            ICRUDVerb::VIEW,
            ICRUDVerb::SHOW,
            ICRUDVerb::CREATE,
            ICRUDVerb::EDIT,
            ICRUDVerb::DELETE,
            'send' => [
                'uses' => '\\'.SMSMessageController::class.'@sendBatchMessage',
                'methods' => ['POST'],
                'url' => config('larapress.notifications.routes.sms_messages.name').'/send',
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
            'sms_gateway' => config('larapress.notifications.routes.sms_gateways.provider'),
            'author' => config('larapress.crud.user.provider'),
            'user' => config('larapress.crud.user.provider'),
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
            'sms_gateway_id' => 'required|numeric|exists:sms_gateways,id',
            'flags' => 'nullable|numeric',
            'message' => 'required|string',
            'send_at' => 'nullable|datetime_zoned',
            'from' => 'required|string',
            'to' => 'required|numeric',
            'status' => 'required|numeric|in:'.implode(',', [
                SMSMessage::STATUS_CREATED,
                SMSMessage::STATUS_SENT,
                SMSMessage::STATUS_FAILED_SEND,
                SMSMessage::STATUS_RECEIVED,
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

        /** @var PhoneNumber */
        $phone = PhoneNumber::with('user')->where('number', $args['to'])->first();
        if (!is_null($phone) && !is_null($phone->user)) {
            /** @var IProfileUser $user */
            $user = Auth::user();
            if ($user->hasRole(config('larapress.profiles.security.roles.customer'))) {
                if ($phone->user !== $user->id) {
                    throw new AppException(AppException::ERR_ACCESS_DENIED);
                }
            }
            if ($user->hasRole(config('larapress.profiles.security.roles.affiliate'))) {
                if (!in_array($phone->user->getMembershipDomainId(), $user->getAffiliateDomainIds())) {
                    throw new AppException(AppException::ERR_ACCESS_DENIED);
                }
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
     * Undocumented function
     *
     * @param SMSMessage $object
     * @param array $input_data
     *
     * @return void
     */
    public function onAfterCreate($object, array $input_data): void
    {
        if (is_null($object->send_at) && $object->status === SMSMessage::STATUS_CREATED) {
            SendSMS::dispatch($object);
        }
    }

    /**
     * Undocumented function
     *
     * @param SMSMessage $object
     * @param array $input_data
     *
     * @return void
     */
    public function onAfterUpdate($object, array $input_data): void
    {
        if (is_null($object->send_at) && $object->status === SMSMessage::STATUS_CREATED) {
            SendSMS::dispatch($object);
        }
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
