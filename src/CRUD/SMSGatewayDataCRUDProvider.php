<?php

namespace Larapress\Notifications\CRUD;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Larapress\CRUD\Services\CRUD\Traits\CRUDProviderTrait;
use Larapress\CRUD\Services\CRUD\ICRUDProvider;
use Larapress\CRUD\Services\CRUD\ICRUDVerb;

class SMSGatewayDataCRUDProvider implements ICRUDProvider
{
    use CRUDProviderTrait;

    public $name_in_config = 'larapress.notifications.routes.sms_gateways.name';
    public $model_in_config = 'larapress.notifications.routes.sms_gateways.model';
    public $compositions_in_config = 'larapress.notifications.routes.sms_gateways.compositions';

    public $verbs = [
        ICRUDVerb::VIEW,
        ICRUDVerb::SHOW,
        ICRUDVerb::CREATE,
        ICRUDVerb::EDIT,
        ICRUDVerb::DELETE
    ];
    public $validSortColumns = [
        'id',
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public $searchColumns = [
        'name',
        'gateway',
    ];

    /**
     * Undocumented function
     *
     * @return array
     */
    public function getValidRelations(): array
    {
        return [
            'author' => config('larapress.crud.user.provider'),
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
            'name' => 'required|string|unique:sms_gateways,name',
            'gateway' => 'required|string|in:' . implode(',', array_keys(config('larapress.notifications.sms.gateways'))),
            'flags' => 'nullable|numeric',
            'data' => 'required|json_object',
        ];
    }

    /**
     * Exclude current id in name unique request
     *
     * @param Request $request
     *
     * @return array
     */
    public function getUpdateRules(Request $request): array
    {
        $rules = $this->getCreateRules($request);
        $rules['name'] .= ',' . $request->route('id');

        return $rules;
    }

    /**
     * Undocumented function
     *
     * @param array $args
     *
     * @return array
     */
    public function onBeforeCreate(array $args): array
    {
        $args['author_id'] = Auth::user()->id;

        return $args;
    }
}
